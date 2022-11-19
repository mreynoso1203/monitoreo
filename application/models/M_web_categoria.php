<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_web_categoria extends CI_Model
{
    function get_categorias($table){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('del',0);
        $this->db->order_by('f_registro','desc');
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result(); 
        }else{
            return 'error';
        } 
    }
}