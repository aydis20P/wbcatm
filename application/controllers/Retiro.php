<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Retiro extends CI_Controller {

    public function __construct(){
                parent::__construct();
                $this->load->library('session');
                $this->load->helper('url');
    }

    public function index(){
        //cargar vista
        $this->load->view('base_templates/header');
        $this->load->view('atm_templates/retiro/retiro');
        $this->load->view('base_templates/footer');
    }

    public function realizaRetiro(){
        //recuperar el id de la cuenta de la variable de sesión
        $idcuenta = $this->session->userdata('idcuenta');
        //recuperar monto del formulario
        $monto = $this->input->post('monto');

        //hacer petición de retiro de la cuenta
        $uri = getenv('api_url') . "/v1/cuentas/retiro";
        $headers = array('Content-Type' => 'application/json',
                         'Authorization' => 'Bearer ' . $this->session->userdata('jwt'));
        $data = array('idcuenta' => $idcuenta,
                       'totalRetirado' => (float)$monto);
        $response = Requests::post($uri, $headers, json_encode($data));
        if ($response->status_code == 201) {
            //regresar vista de éxito
            $this->load->view('base_templates/header');
            $this->load->view('atm_templates/retiro/retiro_exito', $data);
            $this->load->view('base_templates/footer');
        }
        else{
            //regresar vista de fallo
            echo $response->body;
            $this->load->view('base_templates/header');
            $this->load->view('atm_templates/retiro/retiro_fallo');
            $this->load->view('base_templates/footer');
        }
    }

    public function regresar(){
        redirect('/menu/index');
    }
}
