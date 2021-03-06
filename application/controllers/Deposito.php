<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposito extends CI_Controller {

    public function __construct(){
                parent::__construct();
                $this->load->library('session');
                $this->load->helper('url');
    }

    public function index(){
        //cargar vista
        $this->load->view('base_templates/header');
        $this->load->view('atm_templates/deposito/deposito');
        $this->load->view('base_templates/footer');
    }

    public function realizaDeposito(){
        //recuperar el id de la cuenta de la variable de sesión
        $idcuenta = $this->session->userdata('idcuenta');
        //recuperar monto del formulario
        $monto = $this->input->post('monto');

        //hacer petición de deposito a la cuenta
        $uri = getenv('api_url') . "/v1/cuentas/deposito";
        $headers = array('Content-Type' => 'application/json',
                         'Authorization' => 'Bearer ' . $this->session->userdata('jwt'));
        $data = array('idcuenta' => $idcuenta,
                       'totalDepositado' => (float)$monto);
        $response = Requests::post($uri, $headers, json_encode($data));
        if ($response->status_code == 201) {
            //regresar vista de éxito
            $this->load->view('base_templates/header');
            $this->load->view('atm_templates/deposito/deposito_exito', $data);
            $this->load->view('base_templates/footer');
        }
        else{
            //regresar vista de fallo
            $this->load->view('base_templates/header');
            $this->load->view('atm_templates/deposito/deposito_fallo');
            $this->load->view('base_templates/footer');
        }
    }

    public function regresar(){
        redirect('/menu/index');
    }
}
