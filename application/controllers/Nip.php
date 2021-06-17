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
        $numeroCuenta = $this->session->userdata('numerocuenta');

        //Pedir jwt para recibir autorización en las peticiones
        $uri = getenv('api_url') . '/v1/auth';
        $data = array('client' => getenv('site'),
                      'numerocuenta' => $numeroCuenta,
                      'nip' => $nip);
        $headers = array('Content-Type' => 'application/json');
        $response = Requests::post($uri, $headers, json_encode($data));

        if($response->status_code == 200){
            //agregar jwt a una variable de sesión
            $this->session->set_userdata(array('jwt' => json_decode($response->body)->jwt));

            //solicitar el id del cuentahabiente y el id de la cuenta
            $uri = getenv('api_url') . "/v1/cuentas/" . $this->session->userdata('numerocuenta');
            $headers = array('Authorization' => 'Bearer '.$this->session->userdata('jwt'));
            $request = Requests::get($uri, $headers);
            if ($request->status_code == 200) {
                $response = json_decode($request->body);
               //guardarlos en variable de sesión 
               $this->session->set_userdata(array('idcuenta' => $response->idcuenta,
                                                   'idcuentahabiente' => $response->idcuentahabiente));
            }
            else{
                //cargar vista de error
                echo $request->body;
            }

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
