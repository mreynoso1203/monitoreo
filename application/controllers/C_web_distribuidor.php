<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class C_web_distribuidor extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('image_lib');
        $this->load->model('Mdl_compartido');
        $this->load->model('M_web_distribuidor');
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
        $this->load->view('web_distribuidor', $data);
        $this->load->view('layouts/v_footer');

    }

    public function subir_foto(){
        $id = $_SESSION['_SESSIONUSER'];
        $valida='';
        $config=[
            'upload_path'=>"../indietro/public/img/w_distribuidor",
            'allowed_types'=>'png|jpg|jpeg',
            'file_name'=> ''.$id.'_'
        ];
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file')){
            $data=array("upload_data"=>$this->upload->data());
            $nombre=$data['upload_data']['file_name'];
            $array = array(
                'img_cabecera'=>$nombre
            );
            $res = $this->M_web_distribuidor->update('web_page_distribuidor',$array,1);
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

    function agregar(){
        echo $this->M_web_distribuidor->add_get_id();
    }

    function obtener_datos(){
        
        $dato = trim($this->input->post('dato',true));

        $result = $this->M_web_distribuidor->list('web_distribuidor',$dato);
        $cadena ='';
        $contador=0; 
        foreach ($result as $key) {
            $contador++; 
            $msj_des = '';
            $msj_dir = '';
            $msj_lat = '';
            $msj_lon = '';
            $msj_url = '';
            if($key->descripcion==''){
                $msj_des=' * Obligatorio';
            }
            if($key->direccion==''){
                $msj_dir=' * Obligatorio';
            }
            if($key->latitud==''){
                $msj_lat=' * Obligatorio';
            }
            if($key->longitud==''){
                $msj_lon=' * Obligatorio';
            }
            if($key->url==''){
                $msj_url=' * Obligatorio';
            }

            $cadena.='
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="">Descripción</label>
                                    <label style="color:red;">'.$msj_des.'</label>
                                    <input type="text" class="form-control form-control-sm" id="t_descripcion_'.$key->id.'" placeholder="Razón Social" value="'.$key->descripcion.'" required>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label class="form-label" for="">Dirección</label>
                                    <label style="color:red;">'.$msj_dir.'</label>
                                    <input type="text" class="form-control form-control-sm" id="t_direccion_'.$key->id.'" placeholder="Dirección" value="'.$key->direccion.'" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label class="form-label" for="">Latitud</label>
                                    <label style="color:red;">'.$msj_lat.'</label>
                                    <input type="text" class="form-control form-control-sm" id="t_latitud_'.$key->id.'" placeholder="Dirección" value="'.$key->latitud.'" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label class="form-label" for="">Longitud</label>
                                    <label style="color:red;">'.$msj_lon.'</label>
                                    <input type="text" class="form-control form-control-sm" id="t_longitud_'.$key->id.'" placeholder="Dirección" value="'.$key->longitud.'" required>
                                </div>
                            </div>                                                        
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="">URL</label>
                                    <label style="color:red;">'.$msj_url.'</label>
                                    <input type="text" class="form-control form-control-sm" id="t_url_'.$key->id.'" placeholder="Walink" value="'.$key->url.'" required>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="mt-4">
                                    <button title="actualizar" class="btn btn-danger btn-sm" onclick="actualizar('.$key->id.');" > <i class="mdi mdi-update"></i> </button>
                                    <button title="eliminar" class="btn btn-danger btn-sm" onclick="eliminar('.$key->id.');" > <i class="mdi mdi-delete"></i> </button>
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
        $t_direccion      = trim($this->input->post('t_direccion',true));
        $t_longitud       = trim($this->input->post('t_longitud',true));
        $t_latitud        = trim($this->input->post('t_latitud',true));
        $t_url            = trim($this->input->post('t_url',true));
        $id               = trim($this->input->post('id',true));

        $array = array(
            'descripcion'=>$t_descripcion,
            'direccion'=>$t_direccion,
            'latitud'=>$t_longitud,
            'longitud'=>$t_latitud,
            'url'=>$t_url
        );

        $result = $this->M_web_distribuidor->update('web_distribuidor',$array,$id);
        echo $result;
    } 

    function eliminar(){
        $id = trim($this->input->post('id',true));
        $array = array(
            'del'=>1,
            'f_delete'=>date('Y-m-d H:i:s')
        );

        $result = $this->M_web_distribuidor->update('web_distribuidor',$array,$id);
        echo $result;
    }

}
?>
