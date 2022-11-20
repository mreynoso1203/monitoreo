<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class C_web_informacion extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('image_lib');
        $this->load->model('Mdl_compartido');
        //$this->load->model('Model_marcas');
        //$this->load->model('Model_categorias');
        $this->load->model('M_web_informacion');
        $this->load->model('M_settings');
        date_default_timezone_set('America/Lima');
    }

    public function index(){
        $permiso = $this->Mdl_compartido->permisos_controlador('web_informacion');
        if (!$permiso)
            redirect('');
        
        if(!isset($_SESSION['_SESSIONUSER'])){
            redirect('login');
        }

        $header['menu'] = $this->Mdl_compartido->permisos_menu();
        $header['menu_activo'] = 'web_informacion';

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
        $this->load->view('web_informacion', $data);
        $this->load->view('layouts/v_footer');

    }

    function obtener_datos(){
        $id = 1;

        $result = $this->M_web_informacion->get_data_x_id('web_informacion',$id);
        foreach ($result as $key) {
            $ar['t_distrito']=$key->distrito; 
            $ar['t_direccion']=$key->direccion; 
            $ar['t_celular']=$key->celular; 
            $ar['t_whatsapp']=$key->whatsapp; 
            $ar['t_correo']=$key->correo; 
            $ar['t_des_breve']=$key->descripcion_footer; 
            $ar['t_des_walink']=$key->boton_walink; 
        }            
        echo json_encode($ar); 
    }

    function obtener_datos_redes(){
        $result = $this->M_web_informacion->list('web_redes');
        $cadena ='';
        $contador=0; 
        foreach ($result as $key) {
            $contador++; 
            $cadena.='
                <div class="row mb-3">
                    <h6>Icono '.$contador.' </h6>
                    <div class="col-lg-2 mb-3">
                        <span>Red Social: </span>
                        <input type="text" class="form-control form-control-sm" id="t_redes_descripcion_'.$key->id.'" placeholder="Descripción redes" required value="'.$key->descripcion.'">
                    </div>
                    <div class="col-lg-2 mb-3">
                        <span>Icono: </span>
                        <input type="text" class="form-control form-control-sm" id="t_redes_icono_'.$key->id.'" placeholder="Icono redes" required value="'.$key->icono.'">
                    </div> 
                    <div class="col-lg-6 mb-3">
                        <span>Link / URL : </span>
                        <input type="text" class="form-control form-control-sm" id="t_redes_url_'.$key->id.'" placeholder="URL" required value="'.$key->url.'">
                    </div> 
                    <div class="col-lg-2 mb-3">
                        <span>Activar : </span>
                        <select class="form-control form-control-sm" id="t_redes_estado_'.$key->id.'">
                    ';
                    if($key->estado==0){
                        $cadena.='
                            <option value="0" selected>Activo</option>
                            <option value="1" >Inactivo</option>
                        ';
                    }else{
                        $cadena.='
                            <option value="0" >Activo</option>
                            <option value="1" selected>Inactivo</option>
                        ';
                    }
            $cadena.='
                        </select>
                    </div>  
                    <div class="col-lg-5 mb-3">
                        <span>Imagen(16x16 pixeles) : </span>
                        <input type="file" class="form-control form-control-sm" id="t_redes_img_'.$key->id.'" placeholder="Icono imagen (16x16 pixeles)" required >
                    </div>
                    
                    <div class="col-lg-1 mt-3">
                        <button class="btn btn-sm btn-danger" onclick="actualizar_inf_redes('.$key->id.');" >Actualizar</button>
                    </div>                                                                                                                                                
                </div>
            ';
        }            
        $ar['datos']=$cadena;
        echo json_encode($ar); 
    }

    function actualizar_inf_principal(){
        $t_distrito     = trim($this->input->post('t_distrito',true));
        $t_direccion    = trim($this->input->post('t_direccion',true));
        $t_celular      = trim($this->input->post('t_celular',true));
        $t_whatsapp     = trim($this->input->post('t_whatsapp',true));
        $t_correo       = trim($this->input->post('t_correo',true));
        $t_des_breve    = trim($this->input->post('t_des_breve',true));
        $t_des_walink    = trim($this->input->post('t_des_walink',true));

        $id = 1; 

        $array = array(
            'distrito'=>$t_distrito,
            'direccion'=>$t_direccion,
            'celular'=>$t_celular,
            'whatsapp'=>$t_whatsapp,
            'correo'=>$t_correo,
            'descripcion_footer'=>$t_des_breve,
            'boton_walink'=>$t_des_walink
        );

        $result = $this->M_web_informacion->update('web_informacion',$array,$id);
        echo $result;
    }

    function actualizar_inf_redes(){
        $t_redes_descripcion    = trim($this->input->post('t_redes_descripcion',true));
        $t_redes_icono          = trim($this->input->post('t_redes_icono',true));
        $t_redes_url            = trim($this->input->post('t_redes_url',true));
        $t_redes_estado         = trim($this->input->post('t_redes_estado',true));
        $id                     = trim($this->input->post('id',true));

        $array = array(
            'descripcion'=>$t_redes_descripcion,
            'icono'=>$t_redes_icono,
            'url'=>$t_redes_url,
            'estado'=>$t_redes_estado
        );

        $result = $this->M_web_informacion->update('web_redes',$array,$id);
        echo $result;
    }   
    
    
    /*PARA SLIDER*/
        /*
        -PRODUCTOS
    */
    function agregar(){
        $tipo =trim($this->input->post('tipo',false));
        $id =trim($this->input->post('id',false));
        $table='';
        switch ($tipo) {
            case 'slider':
                $table='web_slider';
                $id= $this->M_web_informacion->add_get_id($table);
                break; 
            case 'banner':
                $table='web_banner_inicio';
                $id= $this->M_web_informacion->add_get_id($table);
                break;                 
            default:
                break;
        }
    }

    function obtener_datos_slider(){
        $result = $this->M_web_informacion->list('web_slider');
        $cadena ='';
        $contador=0; 
        foreach ($result as $key) {
            $contador++; 
            $tipo = "'".'slider'."'";

            $cadena_activo='<select id="select_activo_'.$key->id.'" class="form-control form-control-sm" ><option value="">Seleccione</option>'; 
            if($key->estado==0){
                $cadena_activo.='<option selected value="0">SI</option>';
                $cadena_activo.='<option  value="1">NO</option>';
            }else{
                $cadena_activo.='<option  value="0">SI</option>';
                $cadena_activo.='<option  selected value="1">NO</option>';
            }
            $cadena_activo.='</select>'; 


            $img = 'sinimagen.png';
            if($key->imagen!=''){
                $img = $key->imagen;
            }
            $cadena.='
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2" >
                                <div class="mb-3" style="text-align: center;">
                                    <img id="img_slider_'.$key->id.'" style="width:128px;" src="../monitoreo/public/img/w_slider/'.$img.'">
                                </div>
                            </div>                        
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label" for="">Texto1</label>
                                            <input type="text" class="form-control form-control-sm" id="t_texto1_'.$key->id.'" placeholder="nombre" value="'.$key->texto_1.'" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="">Texto2</label>
                                            <input type="text" class="form-control form-control-sm" id="t_texto2_'.$key->id.'" placeholder="nombre" value="'.$key->texto_2.'" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="">Texto3</label>
                                            <input type="text" class="form-control form-control-sm" id="t_texto3_'.$key->id.'" placeholder="nombre" value="'.$key->texto_3.'" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="">Walink</label>
                                            <input type="text" class="form-control form-control-sm" id="t_texto_walink_slider_'.$key->id.'" placeholder="nombre" value="'.$key->link.'" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="">Texto Boton</label>
                                            <input type="text" class="form-control form-control-sm" id="t_texto_boton_'.$key->id.'" placeholder="nombre" value="'.$key->texto_boton.'" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="">Activar Slider </label>'.$cadena_activo.'
                                        </div>                                                                                                                        
                                    </div>

                                    <label class="mt-1">Foto (500x400 pixeles)</label>
                                    <input class="form-control form-control-sm" name="file_slider" type="file" id="file_slider_'.$key->id.'">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mt-4">
                                    <button title="actualizar" class="btn btn-danger btn-sm" onclick="actualizar('.$tipo.','.$key->id.',0);" > <i class="mdi mdi-update"></i> Actualizar</button>
                                    <button title="eliminar" class="btn btn-danger btn-sm" onclick="eliminar('.$tipo.','.$key->id.',0);" > <i class="mdi mdi-delete"></i>  </button>
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
        $id               = trim($this->input->post('id',true));

        $t_texto1_ = trim($this->input->post('t_texto1_',true));
        $t_texto2_ = trim($this->input->post('t_texto2_',true));
        $t_texto3_ = trim($this->input->post('t_texto3_',true));
        $t_texto_walink_ = trim($this->input->post('t_texto_walink_',true));
        $t_texto_boton_ = trim($this->input->post('t_texto_boton_',true));
        $select_activo_ = trim($this->input->post('select_activo_',true));
        $tipo = trim($this->input->post('tipo',true));


        $table=''; 
        switch ($tipo) {
            case 'slider':
                $table='web_slider';
                $array = array(
                    'texto_1'=>$t_texto1_,
                    'texto_2'=>$t_texto2_,
                    'texto_3'=>$t_texto3_,
                    'link'=>$t_texto_walink_,
                    'texto_boton'=>$t_texto_boton_,
                    'estado'=>$select_activo_
                );
                break;
            case 'banner':
                $table='web_banner_inicio';
                $array = array(
                    'walink'=>$t_texto1_
                );
                break;   
            case 'seccion':
                $table='web_secciones';
                $array = array(
                    'texto_1'=>$t_texto1_,
                    'texto_2'=>$t_texto2_,
                    'link'=>$t_texto_walink_,
                    'texto_boton'=>$t_texto3_
                );
                break;                                   
            default:
                # code...
                break;
        }

        $result = $this->M_web_informacion->update($table,$array,$id);
        echo $result;
    } 

    public function subir_foto(){
        $tipo = trim($this->input->post('tipo',true));
        $id = trim($this->input->post('id',true));
        $table=''; 
        $ruta=''; 
        $campo=''; 
        switch ($tipo) {
            case 'slider':
                $table='web_slider';
                $ruta='../monitoreo/public/img/w_slider';
                $campo='imagen';
                $allowed ='png|jpg|jpeg';
                break;
            case 'banner':
                $table='web_banner_inicio';
                $ruta='../monitoreo/public/img/w_banner';
                $campo='imagen';
                $allowed ='png|jpg|jpeg';
                break;
            case 'seccion':
                $table='web_secciones';
                $ruta='../monitoreo/public/img/w_seccion';
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
                        'foto'=>$nombre,
                        'id_producto'=>$id,
                        'f_registro'=>date('Y-m-d H:i:s'),
                        'del'=>0
                    );
                    $res = $this->M_web_informSSacion->insert($table,$array);
                    break;                
                default:
                    $array = array(
                        $campo=>$nombre
                    );
                    $res = $this->M_web_informacion->update($table,$array,$id);
                    break;
            }            
            if($res){
                    $valida='si';
            }else{
                    $valida='no';
            }         
        }else{
            $valida="sinimagen.jpg".$this->upload->display_errors();
            //.$this->upload->display_errors();;
        }        

        $ar['valida'] = $valida;
        $dato_json   = json_encode($ar);
        echo $dato_json;                
    }

    function eliminar(){
        $id         = trim($this->input->post('id',true));
        $tipo       = trim($this->input->post('tipo',true));
        $table=''; 
        switch ($tipo) {
            case 'slider':
                $table='web_slider';
                break;
            default:
                break;
        }
        $array = array(
            'del'=>1,
            'f_delete'=>date('Y-m-d H:i:s')
        );

        $result = $this->M_web_informacion->update($table,$array,$id);
        echo $result;
    }

    function obtener_datos_banner(){
        $result = $this->M_web_informacion->list('web_banner_inicio');
        $cadena ='';
        $contador=0; 
        foreach ($result as $key) {
            $contador++; 
            $tipo = "'".'banner'."'";

            $img = 'sinimagen.png';
            if($key->imagen!=''){
                $img = $key->imagen;
            }
            $cadena.='
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2" >
                                <div class="mb-3" style="text-align: center;">
                                    <img id="img_banner_'.$key->id.'" style="width:128px;" src="../monitoreo/public/img/w_banner/'.$img.'">
                                </div>
                            </div>                        
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label" for="">Link</label>
                                            <input type="text" class="form-control form-control-sm" id="t_texto_walink_banner_'.$key->id.'" placeholder="nombre" value="'.$key->walink.'" required>
                                        </div>
                                    </div>

                                    <label class="mt-1">Foto (360x475 pixeles)</label>
                                    <input class="form-control form-control-sm" name="file_banner" type="file" id="file_banner_'.$key->id.'">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mt-4">
                                    <button title="actualizar" class="btn btn-danger btn-sm" onclick="actualizar('.$tipo.','.$key->id.',0);" > <i class="mdi mdi-update"></i> Actualizar</button>
                                    <!--<button title="eliminar" class="btn btn-danger btn-sm" onclick="eliminar('.$tipo.','.$key->id.',0);" > <i class="mdi mdi-delete"></i>  </button>-->
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

    function obtener_datos_seccion(){
        $result = $this->M_web_informacion->list('web_secciones');
        $cadena ='';
        $contador=0; 
        foreach ($result as $key) {
            $contador++; 
            $tipo = "'".'seccion'."'";

            $img = 'sinimagen.png';
            if($key->imagen!=''){
                $img = $key->imagen;
            }
            $cadena.='
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2" >
                                <div class="mb-3" style="text-align: center;">
                                    <img id="img_banner_'.$key->id.'" style="width:128px;" src="../monitoreo/public/img/w_seccion/'.$img.'">
                                </div>
                            </div>                        
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label" for="">Texto 1</label>
                                            <input type="text" class="form-control form-control-sm" id="t_seccion_texto1_'.$key->id.'" placeholder="Texto titulo" value="'.$key->texto_1.'" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="">Texto 2</label>
                                            <textarea  class="form-control form-control-sm" id="t_seccion_texto2_'.$key->id.'">'.$key->texto_2.'</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="">Texto Botón</label>
                                            <input type="text" class="form-control form-control-sm" id="t_seccion_texto_boton_'.$key->id.'" placeholder="Texto Boton" value="'.$key->texto_boton.'" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="">Link</label>
                                            <input type="text" class="form-control form-control-sm" id="t_seccion_link_'.$key->id.'" placeholder="Link de Whatsapp" value="'.$key->link.'" required>
                                        </div>
                                    </div>

                                    <label class="mt-1">Foto (140x140 pixeles)</label>
                                    <input class="form-control form-control-sm" name="file_seccion" type="file" id="file_seccion_'.$key->id.'">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mt-4">
                                    <button title="actualizar" class="btn btn-danger btn-sm" onclick="actualizar('.$tipo.','.$key->id.',0);" > <i class="mdi mdi-update"></i> Actualizar</button>
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
}

?>
