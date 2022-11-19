<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_web_solicitud extends CI_Model
{
    function get_tipo_solicitud($table){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by('f_registro','desc');
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result(); 
        }else{
            return 'error';
        } 
    }

    function get_detalle($table,$id){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('del',0);
        $this->db->where('id_producto',$id);
        $this->db->order_by('f_registro','desc');
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result(); 
        }else{
            return 'error';
        } 
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

    function add_get_id_producto($table){
        $this->db->insert($table,array('f_registro'=>date('Y-m-d H:i:s'),'foto'=>'sinimagen.png'));
        return $this->db->insert_id();
    }

    function add_get_slider_detalle($table,$id_producto){
        $this->db->insert($table,array('f_registro'=>date('Y-m-d H:i:s'),'imagen'=>'sin_imagen.png','id_producto'=>$id_producto,'texto_1'=>'¡Aquiere Ahora!','texto_2'=>'TU NUEVA MOTO','texto_3'=>'','texto_boton'=>'SOLICITA AHORA'));
        return $this->db->insert_id();
    }

    function add_get_id_detalle($table,$id){
        $this->db->insert($table,array('f_registro'=>date('Y-m-d H:i:s'),'id_producto'=>$id));
        return $this->db->insert_id();
    }
}