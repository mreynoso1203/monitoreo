<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class C_web_solicitud extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('image_lib');
        $this->load->model('Mdl_compartido');
        $this->load->model('M_web_solicitud');
        $this->load->model('M_web_marca');
        $this->load->model('M_web_categoria');
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
        $header['menu_activo'] = 'web_solicitud';

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
        $this->load->view('web_solicitud', $data);
        $this->load->view('layouts/v_footer');

    }


    /*
        -PRODUCTOS
    */
    function obtener_datos_solicitud(){
        
        $dato = trim($this->input->post('dato',true));
        $result = $this->M_web_solicitud->list('web_solicitud_contacto',$dato);
        $result_tipo_solicitud = $this->M_web_solicitud->get_tipo_solicitud('web_solicitud_tipo');
        $cadena ='';
        $contador=0; 
        foreach ($result as $key) {
            $contador++; 
            $tipo = "'".'productos'."'";
            $cadena_tipo='<select disabled id="select_categoria_'.$key->id.'" class="form-control form-control-sm" ><option value="">Seleccione</option>'; 
            if($key->id_tipo_consulta!=''){
                foreach ($result_tipo_solicitud as $key_y) {
                    if($key_y->id==$key->id_tipo_consulta){
                        $cadena_tipo.='<option selected value="'.$key_y->id.'">'.$key_y->descripcion.'</option>';
                    }else{
                        $cadena_tipo.='<option  value="'.$key_y->id.'">'.$key_y->descripcion.'</option>';
                    }
                }
            }
            $cadena_tipo.='</select>'; 

            $img = 'sinimagen.png';
            $cadena.='
                <div class="col-lg-12">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="">Nombres</label>
                                    <input type="text" disabled class="form-control form-control-sm" id="'.$key->id.'" placeholder="nombre" value="'.$key->nombres.'" required>
                                    <label class="form-label" for="">Fecha Registro</label>
                                    <input type="text" disabled class="form-control form-control-sm" value="'.$key->f_registro.'" required>  
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="">Correo</label>
                                    <input type="text" disabled class="form-control form-control-sm" id="'.$key->id.'" placeholder="nombre" value="'.$key->correo.'" required>  
                                    <label class="form-label" for="">Tipo Solicitud </label>'.$cadena_tipo.'
                                </div>
                            </div>     
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="">Celular</label>
                                    <input type="text" disabled class="form-control form-control-sm" id="'.$key->id.'" placeholder="nombre" value="'.$key->celular.'" required>
                                </div>
                            </div>                                                    
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="">Comentario</label>
                                    <textarea type="text" disabled class="form-control form-control-sm" >'.$key->comentarios.'</textarea>                                                                       
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
            ';
        }            
        $ar['datos']=$cadena;
        echo json_encode($ar); 
    }

}
?>
