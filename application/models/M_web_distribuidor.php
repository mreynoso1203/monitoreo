<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_web_distribuidor extends CI_Model
{
    function list($table,$dato){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by('f_registro','desc');
        $this->db->where('del',0);
        if($dato!=''){
        $this->db->like('descripcion',$dato);
        }
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result(); 
        }else{
            return 'error';
        } 
    }
    
    function update($table,$array,$id){
        $this->db->where('id',$id);
        return $this->db->update($table,$array);
    }

    function add_get_id(){
        $this->db->insert('web_distribuidor',array('f_registro'=>date('Y-m-d H:i:s')));
        return $this->db->insert_id();
    }
}