<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class C_web_categoria extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('image_lib');
        $this->load->model('Mdl_compartido');
        $this->load->model('M_web_categoria');
        $this->load->model('M_settings');
        date_default_timezone_set('America/Lima');
    }

    public function index(){
        $permiso = $this->Mdl_compartido->permisos_controlador('web_distribuidor');
        if (!$permiso)
            redirect('');
        
        if(!isset($_SESSION['_SESSIONUSER'])){
            redirect('login');
        }

        $header['menu'] = $this->Mdl_compartido->permisos_menu();
        $header['menu_activo'] = 'web_distribuidor';

        $config = $this->M_settings->get_settings();
        $header['config'] = $config;
        $position='horizontal';
        if($config!='error'){
            foreach ($config as $key) {
                $position=$key->layout;
            }
        }
        
        $data['datos']='';
        $header['datos_header']='';
        $header['lang']='en';
        $this->load->view('layouts/v_head',$header);
        if($position=='vertical'){
            $this->load->view('layouts/vertical_menu',$header);
        }else{
            $this->load->view('layouts/horizontal-menu',$header);
        }
        $this->load->view('web_categoria', $data);
        $this->load->view('layouts/v_footer');

    }

    public function subir_foto(){
        $tipo = trim($this->input->post('tipo',true));
        $id = trim($this->input->post('id',true));
        $table=''; 
        $ruta=''; 
        $campo=''; 
        switch ($tipo) {
            case 'categoria':
                $table='web_categoria';
                $ruta='../monitoreo/public/img/w_categoria';
                $campo='imagen';
                $allowed ='png|jpg|jpeg';
                break;
            default:
                # code...
                break;
        }

        $valida='';
        $config=[
            'upload_path'=>$ruta,
            'allowed_types'=>$allowed,
            'file_name'=> ''.$id.'_'
        ];
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file')){
            $data=array("upload_data"=>$this->upload->data());
            $nombre=$data['upload_data']['file_name'];
            $res=0; 
            switch ($tipo) {
                case 'fotos':
                    $array = array(
                        'imagen'=>$nombre,
                        'id'=>$id,
                        'f_registro'=>date('Y-m-d H:i:s'),
                        'del'=>0
                    );
                    $res = $this->M_web_categoria->insert($table,$array);
                    break;
                default:
                    $array = array(
                        $campo=>$nombre
                    );
                    $res = $this->M_web_categoria->update($table,$array,$id);
                    break;
            }            
            if($res){
                    $valida='si';
            }else{
                    $valida='no';
            }         
        }else{
            $nombre="sinimagen.jpg".$this->upload->display_errors();
            //.$this->upload->display_errors();;
        }        

        $ar['valida'] = $valida;
        $ar['imagen'] = $nombre;
        $dato_json   = json_encode($ar);
        echo $dato_json;                
    }


    /*
        -CARACTERISTICAS
    */
    function agregar(){
        $tipo =trim($this->input->post('tipo',false));
        $id =trim($this->input->post('id',false));
        $table='';
        switch ($tipo) {
            case 'categoria':
                $table='web_categoria';
                echo $this->M_web_categoria->add_get_id($table);
                break;
            default:
                break;
        }
    }

    function obtener_datos(){
        
        $dato = trim($this->input->post('dato',true));

        $result = $this->M_web_categoria->list('web_categoria',$dato);
        $cadena ='';
        $contador=0; 
        foreach ($result as $key) {
            $contador++; 
            $msj_des = '';
            $msj_dir = '';
            $msj_url = '';
            $tipo = "'".'categoria'."'";

            if($key->descripcion==''){
                $msj_des=' * Obligatorio';
            }
            $img = 'sin_imagen.png';
            if($key->imagen!=''){
                $img = $key->imagen;
            }
            $cadena.='
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2" style="background: #c5c5c500;">
                                    <div class="mb-3" style="text-align: center;">
                                        <img id="img_'.$key->id.'" src="../monitoreo/public/img/w_categoria/'.$img.'">
                                    </div>
                                </div>                        
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="">Descripción</label>
                                        <label style="color:red;">'.$msj_des.'</label>
                                        <input type="text" class="form-control form-control-sm" id="t_descripcion_'.$key->id.'" placeholder="Razón Social" value="'.$key->descripcion.'" required>
                                        <input class="pt-2" name="file_" type="file" id="file_'.$key->id.'">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mt-4">
                                        <button title="actualizar" class="btn btn-danger btn-sm" onclick="actualizar('.$tipo.','.$key->id.',0);" > <i class="mdi mdi-update"></i> Actualizar </button>
                                        <button title="eliminar" class="btn btn-danger btn-sm" onclick="eliminar('.$tipo.','.$key->id.',0);" > <i class="mdi mdi-delete"></i> </button>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }            
        $ar['datos']=$cadena;
        echo json_encode($ar); 
    }

    function actualizar(){
        $t_descripcion    = trim($this->input->post('t_descripcion',true));
        $tipo            = trim($this->input->post('tipo',true));
        $id               = trim($this->input->post('id',true));

        $table=''; 
        switch ($tipo) {
            case 'categoria':
                $table='web_categoria';
                $array = array(
                    'descripcion'=>$t_descripcion
                );
                break;
            default:
                # code...
                break;
        }

        $result = $this->M_web_categoria->update($table,$array,$id);
        echo $result;
    } 

    function eliminar(){
        $id         = trim($this->input->post('id',true));
        $tipo       = trim($this->input->post('tipo',true));
        $table=''; 
        switch ($tipo) {
            case 'categoria':
                $table='web_categoria';
                break;
            default:
                break;
        }
        $array = array(
            'del'=>1,
            'f_delete'=>date('Y-m-d H:i:s')
        );

        $result = $this->M_web_categoria->update($table,$array,$id);
        echo $result;
    }

}
?>
