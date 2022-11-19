<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_voucher');
        $this->load->model('Mdl_compartido');
    }

    public function index()
    {
        $header['menu'] = $this->Mdl_compartido->permisos_menu();
        $this->load->view('includes/header.php',$header);
        $this->load->view('panel_principal');
        $this->load->view('includes/footer.php');
    }

    public function listar_voucher(){
        $fetch_data = $this->Mdl_voucher->make_datatables();
        $data = array();
        foreach($fetch_data as $row)
        {
            $sub_array = array();
            $sub_array[] = $row->codigo;
            $sub_array[] = $row->agencia;
            $sub_array[] = $row->dni;
            $sub_array[] = $row->tipo_plan;
            $sub_array[] = $row->destino;
            $sub_array[] = $row->costo;
            $sub_array[] = '<a href="#" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="#" class="btn btn-warning"><i class="fa fa-cog" aria-hidden="true"></i></a>';
            $data[] = $sub_array;
        }
        $output = array(
            "draw"                    =>     intval($_POST["draw"]),
            "recordsTotal"          =>      $this->Mdl_voucher->get_all_data(),
            "recordsFiltered"     =>     $this->Mdl_voucher->get_filtered_data(),
            "data"                    =>     $data
        );
        echo json_encode($output);
    }
}