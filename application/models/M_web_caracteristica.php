<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_web_caracteristica extends CI_Model
{
    function get_detalle($table,$id){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('del',0);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result(); 
        }else{
            return 'error';
        } 
    }

    function insert($table,$array){
        return $this->db->insert($table,$array);
    }

    function list($table,$dato){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('del',0);
        if($dato!=''){
        $this->db->like('t_nombre',$dato);
        }
        $this->db->order_by('f_registro','desc');
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

    function add_get_id($table){
        $this->db->insert($table,array('f_registro'=>date('Y-m-d H:i:s')));
        return $this->db->insert_id();
    }

}