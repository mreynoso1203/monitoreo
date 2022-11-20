<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class C_web_nosotros extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('image_lib');
        $this->load->model('Mdl_compartido');
        $this->load->model('M_web_nosotros');
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
        $this->load->view('web_nosotros', $data);
        $this->load->view('layouts/v_footer');

    }

    public function subir_foto(){
        $tipo = trim($this->input->post('tipo',true));
        switch ($tipo) {
            case 'cabecera':
                $ruta = "../monitoreo/public/img/w_nosotros"; 
                $file_name = 'cabecera_';
                $campo = 'img_cabecera';
                break;
            case 'portada':
                $ruta = "../monitoreo/public/img/w_nosotros"; 
                $file_name = 'portada_';
                $campo = 'img_portada';
                break;   
            case 'img_1':
                $ruta = "../monitoreo/public/img/w_nosotros"; 
                $file_name = 'img_s1_1';
                $campo = 'img_1';
                break;  
            case 'img_2':
                $ruta = "../monitoreo/public/img/w_nosotros"; 
                $file_name = 'img_s1_2';
                $campo = 'img_2';
                break;
            case 'img_3':
                $ruta = "../monitoreo/public/img/w_nosotros"; 
                $file_name = 'img_s1_3';
                $campo = 'img_3';
                break; 
            case 'img_4':
                $ruta = "../monitoreo/public/img/w_nosotros"; 
                $file_name = 'img_s1_4';
                $campo = 'img_4';
                break;
            case 'img_5':
                $ruta = "../monitoreo/public/img/w_nosotros"; 
                $file_name = 'img_s2_5';
                $campo = 'img_5';
                break;                                                                                            
            default:
                break;
        }
        $id = $_SESSION['_SESSIONUSER'];
        $valida='';
        $config=[
            'upload_path'=>$ruta,
            'allowed_types'=>'png|jpg|jpeg',
            'file_name'=> $file_name
        ];
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file')){
            $data=array("upload_data"=>$this->upload->data());
            $nombre=$data['upload_data']['file_name'];
            $array = array(
                $campo=>$nombre
            );
            $res = $this->M_web_nosotros->update('web_nosotros',$array,1);
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



    function obtener_datos(){
        
        $result = $this->M_web_nosotros->list('web_nosotros');
        $cadena ='';
        $contador=0; 
        foreach ($result as $key) {
            $contador++; 
            $msj_des = '';
            $msj_dir = '';
            $msj_url = '';
            if($key->des_historia==''){
                $msj_des=' * Obligatorio';
            }
            if($key->des_mision==''){
                $msj_dir=' * Obligatorio';
            }
            if($key->des_vision==''){
                $msj_url=' * Obligatorio';
            }
            $cadena.='
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="">Historia</label>
                                    <label style="color:red;">'.$msj_des.'</label>
                                    <textarea type="text" class="form-control" id="t_historia_'.$key->id.'">'.$key->des_historia.'</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="">Vision</label>
                                    <label style="color:red;">'.$msj_dir.'</label>
                                    <textarea type="text" class="form-control" id="t_vision_'.$key->id.'">'.$key->des_vision.'</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="">Mision</label>
                                    <label style="color:red;">'.$msj_dir.'</label>
                                    <textarea type="text" class="form-control" id="t_mision_'.$key->id.'">'.$key->des_mision.'</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mt-4">
                                    <button title="actualizar" class="btn btn-danger btn-sm" onclick="actualizar('.$key->id.');" > <i class="mdi mdi-update"></i> Actualizar </button>
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
        $t_historia_    = trim($this->input->post('t_historia_',true));
        $t_vision_      = trim($this->input->post('t_vision_',true));
        $t_mision_            = trim($this->input->post('t_mision_',true));
        $id               = trim($this->input->post('id',true));

        $array = array(
            'des_historia'=>$t_historia_,
            'des_vision'=>$t_vision_,
            'des_mision'=>$t_mision_
        );

        $result = $this->M_web_nosotros->update('web_nosotros',$array,$id);
        echo $result;
    } 
}
?>
