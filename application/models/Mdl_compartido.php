<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once("file_all/pdf/dompdf/autoload.inc.php");
use Dompdf\Dompdf;
use Dompdf\Options;

class Mdl_compartido extends CI_Model
{

    public function permisos_menu()
    {
        $permiso = $this->retornarcampo($_SESSION['_SESSIONUSER'],'coduser','tb_usuarios2','tipo_user');
        if($permiso == 100){
            return array();
        }elseif($permiso == 80){
            // return array('control_monitoreo','usuario_monitoreo','tipo_servicio','calificacion','criterio','criterioxservicio','campania','usuarioxcampania','actividad','monitoreo','dashboard','dashboard_usuario','agenda','control_marcador','dashboard_marcador','dashboard_productividad','dashboard_control_audio_marcador','usuario_integra','usuarioxcampania_integra','monitoreo_integra','informe_integra','campania_audios','usuario_audios','monitoreo_audios','informe_audios','perfil','system_link','view_recursos'); 
            return array('agenda','perfil','web_informacion','web_distribuidor'); 
        }elseif($permiso == 60){
            return array('control_monitoreo','tipo_servicio','criterio','criterioxservicio','monitoreo','dashboard','dashboard_usuario','agenda','dashboard_marcador','dashboard_productividad','dashboard_control_audio_marcador','usuario_integra','usuarioxcampania_integra','monitoreo_integra','informe_integra','campania_audios','usuario_audios','usuarioxcampania_audio','monitoreo_audios','informe_audios','perfil','view_recursos'); 
        }elseif($permiso == 40){
            return array('monitoreo','agenda','usuario_integra','usuarioxcampania_integra','monitoreo_integra','perfil'); 
        }elseif($permiso == 20){
            return array('agenda','perfil','view_recursos'); 
        }else{
            return null;
        }
    }

    public function permisos_controlador( $controlador )
    {
        $permiso = $this->permisos_menu();
        if (!is_null($permiso))
        {
            foreach ($permiso as $per)
            {
                if ($per == $controlador)
                    return true;
            }
            return false;
        }
        return false;
    }

    public function retornarcampo($id,$campo,$tabla,$retorno){
        $query = $this->db->get_where($tabla,array($campo=>$id));
        if($query->num_rows() > 0){
            foreach ($query->result() as $row){
                return $row->$retorno;
            }
        }
    }

    public function insert_table($table,$arraydata){
        $query = $this->db->insert($table,$arraydata);
        return $query;
    }

    public function insert_table_get_id($table,$arraydata){
        $this->db->insert($table,$arraydata);
        return $this->db->insert_id();
    }

    public function encriptar($key){
        $encrip = hash_hmac('sha512',$key, 'KAJFBD@./*-_15fl221dlkaik2123');
        return $encrip;
    }

    public function eliminar_repuesto($table,$campo,$valor){
        $this->db->where($campo, $valor);
        return $this->db->delete($table);
    }
    function dias_transcurridos($fecha_i,$fecha_f)
    {
        date_default_timezone_set('America/Lima');
        $datetime1 = new DateTime($fecha_i);
        $datetime2 = new DateTime($fecha_f);
        $interval = $datetime1->diff($datetime2);
        return $interval->format('%R%a');
    }
    function busqresultfila($table,$camposarray,$busq,$innerjoin,$idunion){
        $i = 0;
        foreach($camposarray as $newcampoo){
            if(count($camposarray) > 1){
                if($i == 1){
                    $this->db->where($newcampoo,$busq);
                }else{
                    $this->db->or_where($newcampoo,$busq);
                }
            }else{
                $this->db->where($newcampoo,$busq);
            }
        }
        if(count($innerjoin) > 0){
            foreach($innerjoin as $jointable){
                $this->db->join($jointable, ''.$jointable.'.'.$idunion.' = '.$table.'.'.$idunion.'');
            }
        }
        $this->db->select('*');
        $this->db->from($table);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->num_rows();
        }else{
            return '0';
        }
    }
    function CalculaEdad( $fecha ) {
        list($Y,$m,$d) = explode("-",$fecha);
        return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
    }
    function convertfecha($split,$valor){
        $var = explode($split,$valor);
        return $var[2].'-'.$var[1].'-'.$var[0];
    }
    function pdf_create($html)
    {
        /*require_once("file_all/dompdf/dompdf_config.inc.php");
        $dompdf = new DOMPDF();
        $dompdf->load_html($html);
        $dompdf->set_paper("A4","portrait");
        $dompdf->render();
        //return $dompdf->stream("sample.pdf");
        return $dompdf->output();*/
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        /*$dompdf->setPaper('A4', 'portrait');*/
        $options = new Options();
        $options->setIsRemoteEnabled(true);
        $options->setIsHtml5ParserEnabled(true);
        $options->setDefaultPaperSize('a4');
        $options->setDefaultMediaType('print');

        $dompdf->setOptions($options);
        $dompdf->render();
        return $dompdf->output();
    }

    public function getfiltros($value){
        $this->db->select('*');
        $this->db->from('tb_planes');
        $this->db->where('nombre', $value);
        $query = $this->db->get();
        $num_fila = $query->num_rows();
        if($num_fila > 0){
            $retorno = $query->result();
        }else{
            $retorno = 'error';
        }
        return $retorno;
    }
    
    //*excel

    public function eliminar_archivo($table,$campo,$valor){
        $this->db->where($campo, $valor);
        return $this->db->delete($table);
    }
    public function insert_table_excel($table,$arraydata){
        $this->db->insert($table,$arraydata);
        return $this->db->insert_id();
    }

}