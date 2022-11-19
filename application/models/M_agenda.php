<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_agenda extends CI_Model
{
    function list($table){
        $this->db->select('*');
        $this->db->from($table);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result(); 
        }else{
            return 'ok';
        } 
    }

    function list_eventos($table){
        $this->db->select('
        a.id,
        a.nombre as title,
        a.observacion as descripcion,
        date(a.f_inicio) as f_inicio,
        date(a.f_fin) as f_fin,
        a.id_tipo_evento,
        a.f_inicio as start,
        a.f_fin as end,
        year(date(a.f_inicio)) as y1,
        DATE_FORMAT(a.f_inicio, "%m") as m1,
        day(date(a.f_inicio)) as d1,
        DATE_FORMAT(a.f_inicio, "%H") as h1,
        DATE_FORMAT(a.f_inicio, "%i") as u1,
        year(date(a.f_fin)) as y2,
        DATE_FORMAT(a.f_fin, "%m") as m2,
        day(date(a.f_fin)) as d2,
        DATE_FORMAT(a.f_fin, "%H") as h2,
        DATE_FORMAT(a.f_fin, "%i") as u2,
        b.data_class as className
        ');
        $this->db->from($table.' as a');
        $this->db->join('ag_tipo_evento as b','a.id_tipo_evento=b.id','inner');
        $this->db->where('a.del',0);
        $this->db->where('a.id_usuario',$_SESSION['_SESSIONUSER']);        
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result(); 
        }else{
            return 'error';
        } 
    }

    function insert($table,$array){
        $this->db->insert($table,$array);
        return $this->db->insert_id();
    }

    function eliminar($table,$id)
    {
        return $this->db->delete($table, array('id' => $id));
    }  

    function update($table,$array,$id){
        $this->db->where('id',$id);
        return $this->db->update($table,$array);
    }
    
}