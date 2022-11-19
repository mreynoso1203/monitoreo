<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class C_web_caracteristica extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('image_lib');
        $this->load->model('Mdl_compartido');
        $this->load->model('M_web_caracteristica');
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
        $this->load->view('web_caracteristica', $data);
        $this->load->view('layouts/v_footer');

    }

    public function subir_foto(){
        $tipo = trim($this->input->post('tipo',true));
        $id = trim($this->input->post('id',true));
        $table=''; 
        $ruta=''; 
        $campo=''; 
        switch ($tipo) {
            case 'caracteristica':
                $table='web_detalle_caracteristica';
                $ruta='../indietro/public/img/w_detalle/w_iconos';
                $campo='imagen';
                $allowed ='png|jpg|jpeg';
                break;
            case 'productos':
                $table='web_producto';
                $ruta='../indietro/public/img/w_producto';
                $campo='foto';
                $allowed ='png|jpg|jpeg';
                break; 
            case 'slider':
                $table='web_detalle_producto_slider';
                $ruta='../indietro/public/img/w_detalle';
                $campo='imagen';
                $allowed ='png|jpg|jpeg';
                break;
            case 'fotos':
                $table='web_fotos_producto';
                $ruta='../indietro/public/img/w_d_producto';
                $campo='foto';
                $allowed ='png|jpg|jpeg';
                break;
            case 'pdf':
                $table='web_producto';
                $ruta='../indietro/public/img/w_archivo';
                $campo='archivo';
                $allowed ='pdf';
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
                        'foto'=>$nombre,
                        'id_producto'=>$id,
                        'f_registro'=>date('Y-m-d H:i:s'),
                        'del'=>0
                    );
                    $res = $this->M_web_caracteristica->insert($table,$array);
                    break;
                default:
                    $array = array(
                        $campo=>$nombre
                    );
                    $res = $this->M_web_caracteristica->update($table,$array,$id);
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
            case 'caracteristica':
                $table='web_detalle_caracteristica';
                echo $this->M_web_caracteristica->add_get_id($table);
                break;
            case 'productos':
                $table='web_producto';
                $table2='web_detalle_producto_slider';
                $id_producto= $this->M_web_caracteristica->add_get_id_producto($table);
                $this->M_web_caracteristica->add_get_slider_detalle($table2,$id_producto);
                break; 
            case 'detalle':
                    $table='web_detalle_producto';
                    $this->M_web_caracteristica->add_get_id_detalle($table,$id);
                    break;                                
            default:
                break;
        }
    }

    function obtener_datos_caracteristicas(){
        
        $dato = trim($this->input->post('dato',true));

        $result = $this->M_web_caracteristica->list('web_detalle_caracteristica',$dato);
        $cadena ='';
        $contador=0; 
        foreach ($result as $key) {
            $contador++; 
            $msj_des = '';
            $msj_dir = '';
            $msj_url = '';
            $tipo = "'".'caracteristica'."'";

            if($key->descripcion==''){
                $msj_des=' * Obligatorio';
            }
            $img = 'sinimagen.png';
            if($key->imagen!=''){
                $img = $key->imagen;
            }
            $cadena.='
                <div class="col-lg-12">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2" style="background: #c5c5c5;">
                                <div class="mb-3" style="text-align: center;">
                                    <img id="img_caracteristica_'.$key->id.'" src="../indietro/public/img/w_detalle/w_iconos/'.$img.'">
                                </div>
                            </div>                        
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">Descripción</label>
                                    <label style="color:red;">'.$msj_des.'</label>
                                    <input type="text" class="form-control form-control-sm" id="t_descripcion_caracteristica_'.$key->id.'" placeholder="Razón Social" value="'.$key->descripcion.'" required>
                                    <input class="pt-2" name="file_caracteristica" type="file" id="file_caracteristica_'.$key->id.'">
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
            case 'caracteristica':
                $t_nombre    = trim($this->input->post('t_nombre',true));
                $table='web_detalle_caracteristica';
                $array = array(
                    'descripcion'=>$t_nombre
                );
                break;
            case 'productos':
                $table='web_producto';
                $id_marca    = trim($this->input->post('id_marca',true));
                $id_categoria    = trim($this->input->post('id_categoria',true));
                $t_nombre    = trim($this->input->post('t_nombre',true));
                $pag_inicio    = trim($this->input->post('pag_inicio',true));

                $array = array(
                    't_des_breve'=>$t_descripcion,
                    'id_marca'=>$id_marca,
                    'id_categoria'=>$id_categoria,
                    't_nombre'=>$t_nombre,
                    'pag_inicio'=>$pag_inicio
                );
                break;      
                
                case 'detalle':
                    $table='web_detalle_producto';
                    $id_caracteristica    = trim($this->input->post('id_caracteristica',true));
                    $descripcion    = trim($this->input->post('descripcion',true));
    
                    $array = array(
                        'id_caracteristica'=>$id_caracteristica,
                        'descripcion'=>$descripcion
                    );
                    break; 
                case 'slider':
                    $table='web_detalle_producto_slider';
                    $t_texto1    = trim($this->input->post('texto_1',true));
                    $t_texto2    = trim($this->input->post('texto_2',true));
                    $t_texto3    = trim($this->input->post('texto_3',true));
                    $t_btn_whatsapp    = trim($this->input->post('t_btn_whatsapp',true));
                    $t_url_whatsapp    = trim($this->input->post('t_url_whatsapp',true));
                    $t_textobotton    = trim($this->input->post('texto_boton',true));
    
                    $array = array(
                        'texto_1'=>$t_texto1,
                        'texto_2'=>$t_texto2,
                        'texto_3'=>$t_texto3,
                        'texto_boton_wsp'=>$t_btn_whatsapp,
                        'url_boton_wsp'=>$t_url_whatsapp,
                        'texto_boton'=>$t_textobotton
                    );
                    break; 
                case 'redes':
                    $t_redes    = trim($this->input->post('t_redes',true));
                    $table='web_redes_producto';
                    $array = array(
                        'url'=>$t_redes
                    );
                    break;                     
            default:
                # code...
                break;
        }

        $result = $this->M_web_caracteristica->update($table,$array,$id);
        echo $result;
    } 

    function eliminar(){
        $id         = trim($this->input->post('id',true));
        $tipo       = trim($this->input->post('tipo',true));
        $table=''; 
        switch ($tipo) {
            case 'caracteristica':
                $table='web_detalle_caracteristica';
                break;
            case 'productos':
                $table='web_producto';
                break;    
            case 'detalle':
                $table='web_detalle_producto';
                break;
            case 'fotos':
                $table='web_fotos_producto';
                break;                                                
            default:
                break;
        }
        $array = array(
            'del'=>1,
            'f_delete'=>date('Y-m-d H:i:s')
        );

        $result = $this->M_web_caracteristica->update($table,$array,$id);
        echo $result;
    }

}
?>
