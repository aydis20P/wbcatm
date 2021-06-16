<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nip extends CI_Controller {

    public function __construct(){
                parent::__construct();
                $this->load->library('session');
                $this->load->helper('url');
    }

    public function index(){
        //echo $this->session->userdata('nip');
        $data["nombreCh"] = $this->session->userdata('nombre');
        $this->load->view('base_templates/header');
        $this->load->view('atm_templates/nip/nip', $data);
        $this->load->view('base_templates/footer');
    }

    public function verifica(){
        //obtener el NIP ingresado en el formulario
        $nip = $this->input->post('nip');
        $numeroCuenta = $this->session->userdata('numeroCuenta');

        //Pedir jwt para recibir autorización en las peticiones
        $uri = 'http://127.0.0.1:8000/wbankingcompanyapi/index.php/v1/auth';
        $data = array('client' => 'wbcatm',
                      'numerocuenta' => $numeroCuenta,
                      'nip' => $nip);
        $headers = array('Content-Type' => 'application/json');
        $response = Requests::post($uri, $headers, json_encode($data));

        if($response->status_code == 200){
            //agregar jwt a una variable de sesión
            $this->session->set_userdata(array('jwt' => json_decode($response->body)->jwt));

            redirect('/menu/index');
        }
        else{
            echo $response->body;
            //cargar vista de error
            $this->load->view('base_templates/header');
            $this->load->view('atm_templates/nip/verificar_fallo');
            $this->load->view('base_templates/footer');
        }
    }

    public function regresaMain(){
        //redireccionar
        redirect('/main/index');
    }
}
