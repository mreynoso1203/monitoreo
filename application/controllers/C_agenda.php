<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class C_agenda extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('image_lib');
        $this->load->model('Mdl_compartido');
        $this->load->model('M_actividad');
        $this->load->model('M_agenda');
        $this->load->model('M_settings');
        date_default_timezone_set('America/Lima');
    }

    public function index(){
        $permiso = $this->Mdl_compartido->permisos_controlador('agenda');
        if (!$permiso)
            redirect('');
        
        if(!isset($_SESSION['_SESSIONUSER'])){
            redirect('login');
        }


        $header['menu'] = $this->Mdl_compartido->permisos_menu();
        $header['menu_activo'] = 'agenda';

        $data['lst_tipo_eventos'] = $this->M_agenda->list('ag_tipo_evento');

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
        $this->load->view('v_agenda', $data);
        $this->load->view('layouts/v_footer');

    }

    public function tipo_control_office(){
        $resultado = $this->M_dashboard_monitoreo->tipo_control_office();
        echo json_encode($resultado);
    }

    public function agregar(){
        $title = trim($this->input->post('title',true));
        $tipo = trim($this->input->post('tipo',true));
        $obs = trim($this->input->post('descripcion',true));
        $start = trim($this->input->post('start',true));
        $end = trim($this->input->post('end',true));
        $hfin = trim($this->input->post('hfin',true));

        $array = array(
            'nombre'=>$title,
            'id_tipo_evento'=>$tipo,
            'observacion'=>$obs,
            'f_inicio'=>$start,
            'f_fin'=>$end,
            'f_registro'=>date('Y-m-d H:i:s'),
            'estado'=>0,
            'id_usuario'=>$_SESSION['_SESSIONUSER']
        );

        $result = $this->M_actividad->insert('ag_cronograma',$array);
        echo $result;
    }

    public function modificar(){
        $id = trim($this->input->post('id',true));
        $title = trim($this->input->post('title',true));
        $tipo = trim($this->input->post('tipo',true));
        $obs = trim($this->input->post('descripcion',true));
        $start = trim($this->input->post('start',true));
        $end = trim($this->input->post('end',true));
        $hfin = trim($this->input->post('hfin',true));

        $array = array(
            'nombre'=>$title,
            'id_tipo_evento'=>$tipo,
            'observacion'=>$obs,
            'f_inicio'=>$start,
            'f_fin'=>$end,
            'f_upd'=>date('Y-m-d H:m:s'),
            'estado'=>0
        );

        $result = $this->M_actividad->update('ag_cronograma',$array,$id);
        echo $result;
    }


    public function eliminar(){
        $id = trim($this->input->post('id',true));
        $array = array(
            'del'=>1,
            'f_delete'=>date('Y-m-d H:m:s')
        );

        $result = $this->M_actividad->update('ag_cronograma',$array,$id);
        echo $result;
    }



    public function cargar_eventos(){
        $resultado = $this->M_agenda->list_eventos('ag_cronograma');
        echo json_encode($resultado);
    }
}

?>
