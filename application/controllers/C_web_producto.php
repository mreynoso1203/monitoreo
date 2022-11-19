<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class C_web_producto extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('image_lib');
        $this->load->model('Mdl_compartido');
        $this->load->model('M_web_producto');
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
        $this->load->view('web_producto', $data);
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
                    $res = $this->M_web_producto->insert($table,$array);
                    break;
                default:
                    $array = array(
                        $campo=>$nombre
                    );
                    $res = $this->M_web_producto->update($table,$array,$id);
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
        OBTENER DETALLE SLIDER
    */
    function obtener_datos_slider(){
        
        $dato = trim($this->input->post('dato',true));
        $tipo = trim($this->input->post('tipo',true));
        $id = trim($this->input->post('id',true));
        $result_detalle_producto = $this->M_web_producto->get_detalle('web_detalle_producto_slider',$id);
        $cadena ='';
        $contador=0; 
        $cadena=''; 
        if($result_detalle_producto!='error'){
            foreach ($result_detalle_producto as $key) {
                $contador++; 
                $msj_texto1='';
                $msj_texto2='';
                $msj_texto3='';
                $msj_texto_boton='';
                
                $tipo = "'".'slider'."'";

                if($key->texto_1==''){
                    $msj_texto1=' * Obligatorio';
                }

                if($key->texto_2==''){
                    $msj_texto2=' * Obligatorio';
                }

                if($key->texto_3==''){
                    $msj_texto3=' * Obligatorio';
                }

                if($key->texto_boton==''){
                    $msj_texto_boton=' * Obligatorio';
                }
                
                $cadena.='
                    <div class="col-lg-12">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-7">
                                    <h5>Detalle Slider Producto</h5>
                                </div>
                                <div class="col-lg-7">
                                    <label>Texto1: </label>
                                    <label style="color:red;">'.$msj_texto1.'</label>
                                    <input type="text" id="text_slider_texto1_'.$key->id.'" class="form-control form-control-sm" placeholder="descripcion.." value="'.$key->texto_1.'">
                                </div>

                                <div class="col-lg-7">
                                    <label>Texto2: </label>
                                    <label style="color:red;">'.$msj_texto2.'</label>
                                    <input type="text" id="text_slider_texto2_'.$key->id.'" class="form-control form-control-sm" placeholder="descripcion.." value="'.$key->texto_2.'">
                                </div>

                                <div class="col-lg-7">
                                    <label>Texto3: </label>
                                    <label style="color:red;">'.$msj_texto3.'</label>
                                    <input type="text" id="text_slider_texto3_'.$key->id.'" class="form-control form-control-sm" placeholder="descripcion.." value="'.$key->texto_3.'">
                                </div>

                                <div class="col-lg-7">
                                    <label>Texto Botón Cotizar: </label>
                                    <label style="color:red;">'.$msj_texto_boton.'</label>
                                    <input type="text" id="text_slider_textoboton_'.$key->id.'" class="form-control form-control-sm" placeholder="descripcion.." value="'.$key->texto_boton.'">
                                </div>

                                <div class="col-lg-7">
                                    <label>Texto botón Whatasapp: </label>
                                    <input type="text" id="text_boton_whatsapp_'.$key->id.'" class="form-control form-control-sm" placeholder="descripcion.." value="'.$key->texto_boton_wsp.'">
                                </div>

                                <div class="col-lg-7">
                                    <label>Walink botón Whatsapp: </label>
                                    <input type="text" id="text_url_whatsapp_'.$key->id.'" class="form-control form-control-sm" placeholder="descripcion.." value="'.$key->url_boton_wsp.'">
                                </div>

                                <div class="col-lg-7">
                                    <label>Foto Moto (555x555 pixeles) </label>
                                    <input name="file_slider" type="file" id="file_slider_'.$key->id.'">
                                </div>



                                <div class="col-lg-12 mt-4">
                                    <button title="actualizar" class="btn btn-danger btn-sm" onclick="actualizar('.$tipo.','.$key->id.','.$key->id_producto.');" > <i class="mdi mdi-update"></i> Actualizar </button>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
            }      
        }else{
            $cadena='<label>---> Sin registros</label>';
        }      
        $ar['datos']=$cadena;
        echo json_encode($ar); 
    }

        /*
        OBTENER DETALLE SLIDER
    */
    function obtener_datos_pdf(){
        $tipo = trim($this->input->post('tipo',true));
        $id = trim($this->input->post('id',true));
        $result_detalle_producto = $this->M_web_producto->get_archivo('web_producto',$id);
        $cadena ='';
        $contador=0; 
        $cadena=''; 
        if($result_detalle_producto!='error'){
            foreach ($result_detalle_producto as $key) {
                $tipo = "'".'pdf'."'";
                $id_file = "'".'file_pdf_'.$key->id."'";

                $cadena.='
                    <div class="col-lg-12">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5>Archivo Ficha Tècnica</h5>
                                </div>
                                <div class="col-lg-12">
                                    <span>Pdf </span>
                                    <input name="file_slider" type="file" id="file_pdf_'.$key->id.'">
                                </div>
                                <div class="col-lg-12 mt-4">
                                    <button title="Subir Ficha Técnica" class="btn btn-danger btn-sm" onclick="subir_foto('.$id_file.','.$tipo.','.$key->id.');" > <i class="mdi mdi-update"></i> Subir </button>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
            }      
        }else{
            $cadena='<label>---> Sin registros</label>';
        }      
        $ar['datos']=$cadena;
        echo json_encode($ar); 
    }

    /*
        OBTENER DETALLE REDES
    */

    function obtener_datos_redes(){
        
        $id = trim($this->input->post('id',true));

        $result = $this->M_web_producto->get_detalle('web_redes_producto',$id);
        $cadena ='
            <div class="col-lg-12">
                <h5>Redes sociales</h5>
            </div>
        ';
        $contador=0; 
        foreach ($result as $key) {
            $contador++; 
            $tipo = "'".'redes'."'";

            $cadena.='
                <div class="col-lg-12">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2" style="background: #c5c5c5;">
                                <span>'.$key->descripcion.'</span>
                            </div>                        
                            <div class="col-md-6">
                                    <input type="text" class="form-control form-control-sm" id="t_descripcion_url_'.$key->id.'" placeholder="URL" value="'.$key->url.'">
                            </div>
                            <div class="col-md-2">
                                    <button title="actualizar" class="btn btn-danger btn-sm" onclick="actualizar('.$tipo.','.$key->id.','.$key->id_producto.');" > <i class="mdi mdi-update"></i> </button>
                                    <button title="eliminar" class="btn btn-danger btn-sm" onclick="eliminar('.$tipo.','.$key->id.','.$key->id_producto.');" > <i class="mdi mdi-delete"></i> </button>
                            </div>                                
                        </div>
                    </div>
                </div>
            ';
        }            
        $ar['datos']=$cadena;
        echo json_encode($ar); 
    }

    /*
        OBTENER DETALLE FOTO
    */
    function obtener_datos_fotos(){
        
        $tipo = trim($this->input->post('tipo',true));
        $id = trim($this->input->post('id',true));
        $result_detalle_foto = $this->M_web_producto->get_detalle('web_fotos_producto',$id);
        $cadena ='';
        $contador=0; 
        $cadena='

            <div class="col-lg-12">
                <h5>Fotos Adicionales</h5>
                <p>Las fotos adicionales pueden tener una resolución de 752x1000 o 1000x750 pixeles</p>
            </div>

            <div class="col-lg-12">
                    <label>Cargar Una foto</label>
                    <div style="display:flex;">
                        <input style="width:50%" id="file_fotos_'.$id.'" type="file" class="form-control form-control-sm"></input>
                        <button class="btn btn-sm btn-danger" onclick="subir_foto('."'".'file_fotos_'.$id."'".','."'".$tipo."'".','.$id.');"> Subir </button>
                    </div>
            </div>

        '; 
        if($result_detalle_foto!='error'){
            $cadena.='
                <div class="col-lg-12 mt-4">
                    <div style="display:flex;flex-direction:row;align-items:end;">'; 
                foreach ($result_detalle_foto as $key) {
                    $cadena.='
                        <div style="display:flex;flex-direction:column;" class="p-4">
                            <img width="100px" style="border:1px solid #ced4da; " src="../indietro/public/img/w_d_producto/'.$key->foto.'">
                            <button onclick="eliminar('."'".$tipo."'".','.$key->id.','.$key->id_producto.');" class="btn btn-sm btn-secondary"> X </button>
                        </div>
                    ';
                }      
                $cadena.='
                    </div>
                </div>';
        }else{
        }      
        $ar['datos']=$cadena;
        echo json_encode($ar); 
    }

    /*
        OBTENER DETALLE CARACTERISTICA
    */
    function obtener_datos_detalle(){
        
        $dato = trim($this->input->post('dato',true));
        $tipo = trim($this->input->post('tipo',true));
        $id = trim($this->input->post('id',true));
        $result_detalle_producto = $this->M_web_producto->get_detalle('web_detalle_producto',$id);
        $result_caracteristica = $this->M_web_caracteristica->get_detalle('web_detalle_caracteristica',$id);
        $cadena ='';
        $contador=0; 
        $cadena='
            <div class="col-lg-12">
                <h5>Características / Detalle Técnico</h5>
            </div>
        '; 
        if($result_detalle_producto!='error'){
            foreach ($result_detalle_producto as $key) {
                $contador++; 
                $msj_des = '';
                $msj_carac = '';
                $tipo = "'".'detalle'."'";

                if($key->descripcion==''){
                    $msj_des=' * Obligatorio';
                }
                if($key->id_caracteristica==null){
                    $msj_carac=' *';
                }

                $cadena_detalle='<select id="select_detalle_producto_'.$key->id.'" class="form-control form-control-sm" ><option value="">Seleccione</option>'; 
                if($key->id_producto!=''){
                    foreach ($result_caracteristica as $key_y) {
                        if($key_y->id==$key->id_caracteristica){
                            $cadena_detalle.='<option selected value="'.$key_y->id.'">'.$key_y->descripcion.'</option>';
                        }else{
                            $cadena_detalle.='<option  value="'.$key_y->id.'">'.$key_y->descripcion.'</option>';
                        }
                    }
                }
                $cadena_detalle.='</select>'; 

                $cadena.='
                    <div class="col-lg-12">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label style="color:red; display:none;">'.$msj_carac.'</label>
                                    '.$cadena_detalle.'
                                </div>
                                <div class="col-lg-7">
                                    <label style="color:red; display:none;">'.$msj_des.'</label>
                                    <input type="text" id="text_detalle_des_'.$key->id.'" class="form-control form-control-sm" placeholder="descripcion.." value="'.$key->descripcion.'">
                                </div>
                                <div class="col-lg-2 ">
                                    <button title="actualizar" class="btn btn-danger btn-sm" onclick="actualizar('.$tipo.','.$key->id.','.$key->id_producto.');" > <i class="mdi mdi-update"></i> </button>
                                    <button title="eliminar" class="btn btn-danger btn-sm" onclick="eliminar('.$tipo.','.$key->id.','.$key->id_producto.');" > <i class="mdi mdi-delete"></i> </button>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                ';
            }      
        }else{
            $cadena='<label>---> Sin registros</label>';
        }      
        $ar['datos']=$cadena;
        echo json_encode($ar); 
    }
    
    /*
        -PRODUCTOS
    */
    function obtener_datos_productos(){
        
        $dato = trim($this->input->post('dato',true));
        $result = $this->M_web_producto->list('web_producto',$dato);
        $result_categoria = $this->M_web_categoria->get_categorias('web_categoria',$dato);
        $result_marca = $this->M_web_marca->get_marcas('web_marca',$dato);
        $cadena ='';
        $contador=0; 
        foreach ($result as $key) {
            $contador++; 
            $msj_nom = '';
            $msj_des = '';
            $tipo = "'".'productos'."'";

            if($key->t_nombre==''){
                $msj_nom=' * Obligatorio';
            }
            if($key->t_des_breve==''){
                $msj_des=' * Obligatorio';
            }

            $cadena_marca='<select id="select_marca_'.$key->id.'" class="form-control form-control-sm" ><option value="">Seleccione</option>'; 
            if($key->id_marca!=''){
                foreach ($result_marca as $key_y) {
                    if($key_y->id==$key->id_marca){
                        $cadena_marca.='<option selected value="'.$key_y->id.'">'.$key_y->descripcion.'</option>';
                    }else{
                        $cadena_marca.='<option  value="'.$key_y->id.'">'.$key_y->descripcion.'</option>';
                    }
                }
            }
            $cadena_marca.='</select>'; 

            $cadena_categoria='<select id="select_categoria_'.$key->id.'" class="form-control form-control-sm" ><option value="">Seleccione</option>'; 
            if($key->id_marca!=''){
                foreach ($result_categoria as $key_y) {
                    if($key_y->id==$key->id_categoria){
                        $cadena_categoria.='<option selected value="'.$key_y->id.'">'.$key_y->descripcion.'</option>';
                    }else{
                        $cadena_categoria.='<option  value="'.$key_y->id.'">'.$key_y->descripcion.'</option>';
                    }
                }
            }
            $cadena_categoria.='</select>'; 

            $cadena_activo='<select id="select_activo_'.$key->id.'" class="form-control form-control-sm" ><option value="">Seleccione</option>'; 
            if($key->pag_inicio==0){
                $cadena_activo.='<option selected value="0">NO</option>';
                $cadena_activo.='<option  value="1">SI</option>';
            }else{
                $cadena_activo.='<option  value="0">NO</option>';
                $cadena_activo.='<option  selected value="1">SI</option>';
            }
            $cadena_activo.='</select>'; 


            $img = 'sinimagen.png';
            if($key->foto!=''){
                $img = $key->foto;
            }
            $cadena.='
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2" >
                                <div class="mb-3" style="text-align: center;">
                                    <img id="img_producto_'.$key->id.'" style="width:128px;" src="../indietro/public/img/w_producto/'.$img.'">
                                </div>
                            </div>                        
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label" for="">Nombre</label>
                                    <label style="color:red;">'.$msj_nom.'</label>
                                    <input type="text" class="form-control form-control-sm" id="t_nombre_productos_'.$key->id.'" placeholder="nombre" value="'.$key->t_nombre.'" required>
                                    <label class="form-label" for="">Descripción</label>
                                    <label style="color:red;">'.$msj_des.'</label>
                                    <textarea type="text" class="form-control pt-2" id="t_descripcion_productos_'.$key->id.'" placeholder="nombre" required>'.$key->t_des_breve.'</textarea>
                                    <div class="pt-1" style="display:flex;">
                                        <div style="width:30%">
                                            <label class="form-label" for="">Marca </label>'.$cadena_marca.'
                                        </div>
                                        <div style="width:30%">
                                            <label class="form-label" for="">Categorìa </label>'.$cadena_categoria.'
                                        </div>
                                        <div style="width:30%">
                                            <label class="form-label" for="">Pag.Inicio </label>'.$cadena_activo.'
                                        </div>
                                    </div>
                                    <label class="mt-1">Foto: </label>
                                    <input class="form-control form-control-sm" name="file_productos" type="file" id="file_productos_'.$key->id.'">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mt-4">
                                    <button title="actualizar" class="btn btn-danger btn-sm" onclick="actualizar('.$tipo.','.$key->id.',0);" > <i class="mdi mdi-update"></i> </button>
                                    <button title="eliminar" class="btn btn-danger btn-sm" onclick="eliminar('.$tipo.','.$key->id.',0);" > <i class="mdi mdi-delete"></i> </button>
                                </div>
                            </div> 
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="col-lg-12">
                                            <span>Detalle Técnica </span>
                                            <button title="Ver Características" class="btn btn-danger btn-sm form-control mt-1" onclick="obtener_datos_detalle('.$tipo.','.$key->id.');" > <i class="mdi mdi-account-details"></i> Ver</button>
                                            <button title="Ver Características" class="btn btn-danger btn-sm form-control mt-1" onclick="agregar('."'"."detalle"."'".','.$key->id.');" > <i class="mdi mdi-account-details"></i> Agregar</button>
                                        </div>
                                        <div class="col-lg-12">
                                            <span>Slider </span>
                                            <button title="Ver Detalle Slider" class="btn btn-danger btn-sm form-control mt-1" onclick="obtener_datos_slider('."'".'slider'."'".','.$key->id.');" > <i class="mdi mdi-account-details"></i> Ver</button>
                                        </div>
                                        <div class="col-lg-12">
                                            <span>Fotos </span>
                                            <button title="Ver Detalle Fotos Adicionales" class="btn btn-danger btn-sm form-control mt-1" onclick="obtener_datos_fotos('."'".'fotos'."'".','.$key->id.');" > <i class="mdi mdi-account-details"></i> Ver</button>
                                        </div>
                                        <div class="col-lg-12">
                                            <span>Redes Sociales </span>
                                            <button title="Ver redes sociales del producto" class="btn btn-danger btn-sm form-control mt-1" onclick="obtener_datos_redes('."'".'redes'."'".','.$key->id.');" > <i class="mdi mdi-account-details"></i> Ver</button>
                                        </div>
                                        <div class="col-lg-12">
                                            <span>PDF</span>
                                            <button title="Ver redes sociales del producto" class="btn btn-danger btn-sm form-control mt-1" onclick="obtener_datos_pdf('."'".'pdf'."'".','.$key->id.');" > <i class="mdi mdi-account-details"></i> Ver</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-10 mt-2">
                                        <div class="row" id="panel_archivo_'.$key->id.'">
                                        </div>
                                        <div class="row" id="panel_caracteristica_'.$key->id.'">
                                        </div>
                                        <div class="row" id="panel_slider_'.$key->id.'">
                                        </div>
                                        <div class="row" id="panel_fotos_'.$key->id.'">
                                        </div>
                                        <div class="row" id="panel_redes_'.$key->id.'">
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                            </div>   

                        </div>
                    </div>
                </div>
            ';
        }            
        $ar['datos']=$cadena;
        echo json_encode($ar); 
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
                echo $this->M_web_producto->add_get_id($table);
                break;
            case 'productos':
                $table='web_producto';
                $table2='web_detalle_producto_slider';
                $id_producto= $this->M_web_producto->add_get_id_producto($table);
                $this->M_web_producto->add_get_slider_detalle($table2,$id_producto);
                break; 
            case 'detalle':
                    $table='web_detalle_producto';
                    $this->M_web_producto->add_get_id_detalle($table,$id);
                    break;                                
            default:
                break;
        }
    }

    function obtener_datos_caracteristicas(){
        
        $dato = trim($this->input->post('dato',true));

        $result = $this->M_web_producto->list('web_detalle_caracteristica',$dato);
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
                            <div class="col-md-2">
                                <div class="mt-4">
                                    <button title="actualizar" class="btn btn-danger btn-sm" onclick="actualizar('.$tipo.','.$key->id.',0);" > <i class="mdi mdi-update"></i> </button>
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

        $result = $this->M_web_producto->update($table,$array,$id);
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

        $result = $this->M_web_producto->update($table,$array,$id);
        echo $result;
    }

}
?>
