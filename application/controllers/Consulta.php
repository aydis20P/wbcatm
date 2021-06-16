<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consulta extends CI_Controller {

    public function __construct(){
                parent::__construct();
                $this->load->library('session');
                $this->load->helper('url');
    }

    public function index(){
        //recuperar el id de la cuenta de la variable de sesión
        $idcuenta = $this->session->userdata('idcuenta');
        //hacer petición de saldo de la cuenta
        $uri = getenv('api_url') . "/v1/cuentas/" . $idcuenta . "/saldo";
        //header de autorización
        $headers = array('Authorization' => 'Bearer '.$this->session->userdata('jwt'));
        $request = Requests::get($uri, $headers);
        if ($request->status_code == 200) {
            $response = json_decode($request->body);
            //agregar a la data para gregarlo al template
            $data = (array) $response;
            $this->load->view('base_templates/header');
            $this->load->view('atm_templates/consulta/consulta', $data);
            $this->load->view('base_templates/footer');
        }
        else{
            //cargar vista de error
            echo $request->body;
            $this->load->view('base_templates/header');
            $this->load->view('atm_templates/consulta/consulta_fallo');
            $this->load->view('base_templates/footer');
        }
    }

    public function regresar(){
        redirect('/menu/index');
    }
}
