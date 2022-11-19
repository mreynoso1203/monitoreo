<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class C_web_multimedia extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('image_lib');
        $this->load->model('Mdl_compartido');
        $this->load->model('M_web_multimedia');
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
        $this->load->view('web_multimedia', $data);
        $this->load->view('layouts/v_footer');

    }

    public function subir_foto(){
        $tipo = trim($this->input->post('tipo',true));
        $table=''; 
        $ruta=''; 
        $campo=''; 
        switch ($tipo) {
            case 'multimedia':
                $table='web_fotos_multimedia';
                $ruta='../indietro/public/img/w_multimedia';
                $campo='foto';
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
            'file_name'=> 'multi_'
        ];
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file')){
            $data=array("upload_data"=>$this->upload->data());
            $nombre=$data['upload_data']['file_name'];
            $res=0; 
            switch ($tipo) {
                case 'multimedia':
                    $array = array(
                        'foto'=>$nombre,
                        'f_registro'=>date('Y-m-d H:i:s'),
                        'del'=>0
                    );
                    $res = $this->M_web_multimedia->insert($table,$array);
                    break;
                default:
                    $array = array(
                        $campo=>$nombre
                    );
                    $res = $this->M_web_multimedia->update($table,$array,$id);
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
        OBTENER DETALLE FOTO
    */
    function obtener_datos_fotos(){
        
        $tipo = trim($this->input->post('tipo',true));
        $result_detalle_foto = $this->M_web_multimedia->get('web_fotos_multimedia');
        $cadena ='';
        $contador=0; 
        $cadena='

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
                            <img width="100px" style="border:1px solid #ced4da; " src="../indietro/public/img/w_multimedia/'.$key->foto.'">
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
        -CARACTERISTICAS
    */
    function agregar(){
        $tipo =trim($this->input->post('tipo',false));
        $id =trim($this->input->post('id',false));
        $table='';
        switch ($tipo) {
            case 'multimedia':
                $table='web_fotos_multimedia';
                echo $this->M_web_multimedia->add_get_id($table);
                break;
            default:
                break;
        }
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

        $result = $this->M_web_multimedia->update($table,$array,$id);
        echo $result;
    } 

    function eliminar(){
        $id         = trim($this->input->post('id',true));
        $tipo       = trim($this->input->post('tipo',true));
        $table=''; 
        switch ($tipo) {
            case 'multimedia':
                $table='web_fotos_multimedia';
                break;
            default:
                break;
        }
        $array = array(
            'del'=>1,
            'f_delete'=>date('Y-m-d H:i:s')
        );

        $result = $this->M_web_multimedia->update($table,$array,$id);
        echo $result;
    }

}
?>
