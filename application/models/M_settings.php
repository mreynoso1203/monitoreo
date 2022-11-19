<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_settings extends CI_Model
{   
    function get_settings(){
        $this->db->select('*');
        $this->db->from('settings');
        $this->db->where('id_usuario',$_SESSION['_SESSIONUSER']);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result(); 
        }else{
            return 'error';
        } 
    }

    function update($table,$array){
        $this->db->where('id_usuario',$_SESSION['_SESSIONUSER']);
        return $this->db->update($table,$array);
    }
}