<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index(){
        $this->load->view('base_templates/header');
        $this->load->view('atm_templates/principal/main');
        $this->load->view('base_templates/footer');
	}

    public function verifica(){
        //obtener el número de cuenta ingresado en el formulario
        $data["numCuenta"] = $this->input->post('numCuenta');

        //hacer petición de la información de la cuenta
        $uri = 'http://127.0.0.1:8000/wbankingcompanyapi/index.php/v1/cuentas/info/'.$data["numCuenta"];
        $request = Requests::get($uri);

        if ($request->status_code == 200) {
            $response = json_decode($request->body);
            //agregar a una variable de sesión
            $this->session->set_userdata((array)$response);
            //redireccionar
            redirect('/nip/index');
        }
        else{
            //cargar vista de error
            echo $request->body;
            $this->load->view('base_templates/header');
            $this->load->view('atm_templates/principal/verificar_fallo');
            $this->load->view('base_templates/footer');
        }
    }
}
