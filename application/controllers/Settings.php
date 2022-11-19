<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_compartido');
        $this->load->model('M_settings');
        date_default_timezone_set('America/Lima');
    }

    function activar_session_vertical(){
        $arr = array(
            'layout'=>'vertical'
        );
        $result = $this->M_settings->update('settings',$arr);
    }

    function activar_session_horizontal(){
        $arr = array(
            'layout'=>'horizontal'
        );
        $result = $this->M_settings->update('settings',$arr);
    }

    function set_layout_mode(){
        $dato = trim($this->input->post('dato',true));
        $arr = array(
            'layout_mode'=>$dato
        );
        $result = $this->M_settings->update('settings',$arr);
    }

    function set_layout_width(){
        $dato = trim($this->input->post('dato',true));
        $arr = array(
            'layout_width'=>$dato
        );
        $result = $this->M_settings->update('settings',$arr);
    }

    function set_layout_position(){
        $dato = trim($this->input->post('dato',true));
        $arr = array(
            'layout_position'=>$dato
        );
        $result = $this->M_settings->update('settings',$arr);
    }

    function set_topbar_color(){
        $dato = trim($this->input->post('dato',true));
        $arr = array(
            'topbar_color'=>$dato
        );
        $result = $this->M_settings->update('settings',$arr);
    }

    function sidebar_size(){
        $dato = trim($this->input->post('dato',true));
        $arr = array(
            'sidebar_size'=>$dato
        );
        $result = $this->M_settings->update('settings',$arr);
    }

    function set_sidebar_color(){
        $dato = trim($this->input->post('dato',true));
        $arr = array(
            'sidebar_color'=>$dato
        );
        $result = $this->M_settings->update('settings',$arr);
    }

    
    

}

?>
