<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_login');
        $this->load->model('Mdl_compartido');
    }
    public function index()
    {
        if(isset($_SESSION['_SESSIONUSER']))
        {
            redirect('voucher');
        }else{
            
            //$data['inf_comment'] = $this->Mdl_login->get_data_comment();
            //$data['inf_data'] = $this->Mdl_login->get_data_login();
            $this->load->view('login');
        }
    }
    public function login()
    {
        //echo 'ok';

        if(!empty($_POST)){
            echo $this->Mdl_login->login($this->input->post('ruc',TRUE),
                                        $this->input->post('usuario',TRUE),
                                        $this->input->post('contra',TRUE));
            exit;
        }
    }
    public function logout()
    {
        session_destroy();
        redirect('');
    }
    public function recuperar_view()
    {
        if(isset($_SESSION['_SESSIONUSER']))
        {
            redirect('voucher');
        }else{
            $this->load->view('login_recuperar');
        }
    }
    public function confirmar_view( $id = null)
    {
        if(isset($_SESSION['_SESSIONUSER']))
        {
            redirect('voucher');
        }else{
            $datos['id'] = $id;
            $this->load->view('login_confirmar',$datos);
        }
    }
    public function confirmar_action()
    {
        $id = $this->input->post('id_clave',TRUE);
        if (!is_null($id))
        {
            $coduser = $this->Mdl_login->retorvalue(array('passwdtemp'=>$id),'tb_pswdtemp','coduser');
            $clave = $this->Mdl_login->encriptar($this->input->post('newclave',TRUE));
            $query = $this->Mdl_login->updatepswd('usuarios',array('clave'=>$clave),array('coduser'=>$coduser));
            if ($query)
                $men = array('error' => 0 , 'mensaje' => 'Se cambio correctamente su clave, por favor ingrese nuevamente con su nueva clave.');
            else
                $men = array('error' => 1 , 'mensaje' => 'No se pudo realizar el cambio de contraseña, inténtelo nuevamente.');
        }
        else
        {
            $men = array('error' => 2, 'mensaje' => 'Expiró el tiempo para cambiar la contraseña');
        }
        echo json_encode($men);
    }
    public function recover()
    {
        if(!empty($_POST)){
            $fila = $this->Mdl_login->retornonfilas('usuarios',array('nruc'=>$this->input->post('ruc',TRUE),'usuario'=>$this->input->post('usuario',TRUE)));
            if($fila > 0){
                $this->load->library('email');
                $config['protocol'] = "smtp";
                // $config['smtp_host'] = "ssl://mail.global-assist.us";
            // $config['smtp_port'] = "465";
            $config['smtp_host'] = "mail.global-assist.us";
            //$config['smtp_crypto'] = "TLS";
            $config['smtp_user'] = "sistema@global-assist.us";
            $config['smtp_pass'] = "H7qgrx)Si9t2";
                $config['charset'] = "utf-8";
                $config['mailtype'] = "html";
                $config['newline'] = "\r\n";

                $this->email->initialize($config);
                //RETURN CORREO
                $email = $this->Mdl_login->retorvalue(array('nruc'=>$this->input->post('ruc',TRUE),'usuario'=>$this->input->post('usuario',TRUE)),'usuarios','correo');
                $name = $this->Mdl_login->retorvalue(array('nruc'=>$this->input->post('ruc',TRUE),'usuario'=>$this->input->post('usuario',TRUE)),'usuarios','nombre');
                $cuser = $this->Mdl_login->retorvalue(array('nruc'=>$this->input->post('ruc',TRUE),'usuario'=>$this->input->post('usuario',TRUE)),'usuarios','coduser');

                $codtemp = "";
                $nfila = $this->Mdl_login->retornonfilas('tb_pswdtemp',array('coduser'=>$this->input->post('usuario',TRUE)));
                if($nfila == 0){
                    do{
                        $codtemp = $this->Mdl_login->psdtemp($this->input->post('ruc',TRUE).$cuser);
                        $xfila = $this->Mdl_login->retornonfilas('tb_pswdtemp',array('passwdtemp'=>$codtemp,'coduser'=>$this->input->post('usuario',TRUE)));
                        if($xfila == 0){
                            $this->Mdl_compartido->insert_table('tb_pswdtemp',array('passwdtemp'=>$codtemp,'fecha'=>date('Y-m-d'),'coduser'=>$cuser,));
                            break;
                        }

                    }while(0 == 0);
                }else{
                    $codtemp = $this->Mdl_login->retorvalue(array('usuario'=>$this->input->post('usuario',TRUE)),'tb_pswdtemp','passwdtemp');
                }


                // $this->email->from('ventasperu@global-assist.us', 'Global');
                $this->email->from('ventasperu@global-assist.us', 'Global');
                $this->email->to($email);
                $copiaocula = ['prueba-correo-sac@global-assist.us'];
                $this->email->bcc($copiaocula);
                //MENSAJE
                $body = $this->Mdl_login->recover($name,$codtemp);
                $this->email->subject('Ha solicitado restablecer su contraseña');
                $this->email->message($body);

                $this->email->send();

                $men = array('error' => 0, 'mensaje' => 'Se ha enviado un correo con lo detalles para recuperar su clave.');
            }else{
                $men = array('error' => 1, 'mensaje' => 'Los datos ingresados son incorrectos, verifique e intente nuevamente');
            }

        }
        else
        {
            $men = array('error' => 2, 'mensaje' => 'No se pudo completar la acción, inténtelo nuevamente.');
        }
        echo json_encode($men);
    }

}