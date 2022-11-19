<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_perfil extends CI_Model
{   
    function insert($table,$array){
        return $this->db->insert($table,$array);
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
        $this->db->select('a.*,b.descripcion as tipo_servicio');
        $this->db->from($table.' as a');
        $this->db->join('tb_tipo_servicio as b','a.id_tipo_servicio=b.id','inner');
        if(isset($_POST["search"]["value"]))
        {
            $busc = $_POST["search"]["value"];
            $this->db->where("(a.descripcion LIKE '%".$busc."%')", NULL, FALSE);
        }            
        $this->db->order_by('a.f_registro asc');
    }

    function get_all_data($table)
    {
        $this->db->select('a.*,b.descripcion as tipo_servicio');
        $this->db->from($table.' as a');
        $this->db->join('tb_tipo_servicio as b','a.id_tipo_servicio=b.id','inner');
        return $this->db->count_all_results();
    }  
      
    function get_filtered_data($table){
        $this->make_query($table);
        $query = $this->db->get();
        return $query->num_rows();
    }      
    /**/

    function list($table,$table2=null){
        $this->db->select('a.*,b.descripcion as tipo_servicio');
        $this->db->from($table.' as a');
        $this->db->join($table2.' as b','a.id_tipo_servicio=b.id','inner');
        $this->db->order_by('tipo_servicio desc');
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result(); 
        }else{
            return 'ok';
        } 
    }

    function validar($table,$dato,$id)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('id!=',$id);
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
    
    function eliminar($table,$id)
    {
        return $this->db->delete($table, array('id' => $id));
    }  

    function update($table,$array,$id){
        $this->db->where('coduser',$id);
        return $this->db->update($table,$array);
    }

    function get_datos($table,$id){
        $this->db->select('a.*,b.descripcion as puesto,b.area');
        $this->db->from($table.' as a');
        $this->db->join('tb_tipo_usuario as b','a.tipo_user=b.id','inner');
        $this->db->where('a.coduser',$id);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result(); 
        }else{
            return 'error';
        } 
    }
}