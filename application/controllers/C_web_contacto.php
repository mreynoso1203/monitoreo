<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class C_web_contacto extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('image_lib');
        $this->load->model('Mdl_compartido');
        $this->load->model('M_web_contacto');
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
        $this->load->view('web_contacto', $data);
        $this->load->view('layouts/v_footer');

    }

    public function subir_foto(){
        $tipo = trim($this->input->post('tipo',true));
        switch ($tipo) {
            case 'cabecera':
                $ruta = "../indietro/public/img/w_contacto"; 
                $file_name = 'cabecera_';
                $campo = 'img_cabecera';
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
            $res = $this->M_web_contacto->update('web_contacto',$array,1);
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

    public function actualizar(){
        $text_iframe = trim($this->input->post('text_iframe',true));
        $array = array(
            'iframe'=>$text_iframe
        );
        $res = $this->M_web_contacto->update('web_contacto',$array,1);
        if($res){
                $valida='si';
        }else{
                $valida='no';
        }         

        $ar['valida'] = $valida;
        $dato_json   = json_encode($ar);
        echo $dato_json;                
    }

    function get_datos(){
        $result = $this->M_web_contacto->get_data_x_id('web_contacto',1);
        $text_iframe ='';
        $contador=0; 
        foreach ($result as $key) {
            $text_iframe=$key->iframe;
        }            
        $ar['text_iframe']=$text_iframe;
        echo json_encode($ar); 
    }

}
?>
