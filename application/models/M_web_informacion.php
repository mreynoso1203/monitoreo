<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_web_informacion extends CI_Model
{
    function add_get_id($table){
        $this->db->insert($table,array('f_registro'=>date('Y-m-d H:i:s'),'imagen'=>'sinimagen.png'));
        return $this->db->insert_id();
    }

    function update($table,$array,$id){
        $this->db->where('id',$id);
        return $this->db->update($table,$array);
    }

    function get_data_x_id($table,$id){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('id',$id);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result(); 
        }else{
            return 'error';
        } 
    }

    function list($table){
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



    
    function calificacion_agrupados_xservicio($table,$id_tipo_servicio){
        $this->db->select('a.id_calificacion,b.descripcion');
        $this->db->from($table.' as a');
        $this->db->join('tb_calificacion b','a.id_calificacion=b.id','inner');
        $this->db->where('a.id_tipo_servicio',$id_tipo_servicio);
        $this->db->group_by('a.id_calificacion');
        $this->db->order_by('a.id_calificacion','asc');
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result(); 
        }else{
            return 'ok';
        } 
    }
    /**/
    function make_datatables($table){
        $this->make_query($table);
        if($_POST["length"] != -1)
        {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function make_query($table)
    {  
        $this->db->select('*');
        $this->db->from($table);
        if(isset($_POST["search"]["value"]))
        {
            $busc = $_POST["search"]["value"];
            $this->db->where("(descripcion LIKE '%".$busc."%')", NULL, FALSE);
        }            
        $this->db->order_by('f_registro asc');
    }

    function get_all_data($table)
    {
        $this->db->select('*');
        $this->db->from($table);
        return $this->db->count_all_results();
    }  
      
    function get_filtered_data($table){
        $this->make_query($table);
        $query = $this->db->get();
        return $query->num_rows();
    }      
    /**/
        
    function insert($table,$array){
        return $this->db->insert($table,$array);
    }



    function validar($table,$dato)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('descripcion',$dato);
        return $this->db->count_all_results();
    }  

    function validar_x_id($table,$dato)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('id',$dato);
        return $this->db->count_all_results();
    }  


    
    function eliminar($table,$id)
    {
        return $this->db->delete($table, array('id' => $id));
    }  


}