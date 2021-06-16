<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transferencia extends CI_Controller {

    public function __construct(){
                parent::__construct();
                $this->load->library('session');
                $this->load->helper('url');
    }

    public function index(){
        //cargar vista
        $this->load->view('base_templates/header');
        $this->load->view('atm_templates/transferencia/transferencia');
        $this->load->view('base_templates/footer');
    }

    public function realizaTransferencia(){
        //recuperar el id de la cuenta de la variable de sesión
        $idcuenta = $this->session->userdata('idcuenta');
        //recuperar monto del formulario
        $monto = $this->input->post('monto');
        //recuperar número de cuenta del beneficiario del formulario
        $numcuenta = $this->input->post('numcuenta');

        $idbeneficiario = NULL;
        //consultar la infromación de la cuenta del beneficiario
        $uri = getenv('api_url') . "/v1/cuentas/" . $numcuenta;
        $headers = array('Authorization' => 'Bearer ' . $this->session->userdata('jwt'));

        $request = Requests::get($uri, $headers);
        if ($request->status_code == 200) {
            $response = json_decode($request->body);
            $responseArray = (array) $response;
            $idbeneficiario = $responseArray["idcuenta"];
        }
        else{
            //regresar vista de fallo
            echo "petición get inválida (no se realizó ningún cargo a tu cuenta)";
            $this->load->view('base_templates/header');
            $this->load->view('atm_templates/transferencia/transferencia_fallo');
            $this->load->view('base_templates/footer');
            return;
        }

        //realizar retiro de la cuenta del cuentahabiente
        $uri = getenv('api_url') . "/v1/cuentas/retiro";
        $headers = array('Content-Type' => 'application/json',
                         'Authorization' => 'Bearer ' . $this->session->userdata('jwt'));
        $data = array('idcuenta' => $idcuenta,
                       'totalRetirado' => (float)$monto);
        $response = Requests::post($uri, $headers, json_encode($data));
        if ($response->status_code == 201) {
            echo "se retiró el monto de la cuenta del emisor<br>";
        }
        else{
            //regresar vista de fallo
            echo "error al retirar el monto de la cuenta del emisor (¿Saldo insufuciente?)";
            $this->load->view('base_templates/header');
            $this->load->view('atm_templates/transferencia/transferencia_fallo');
            $this->load->view('base_templates/footer');
            return;
        }

        //realizar depósito a la cuenta del beneficiario
        $uri = getenv('api_url') . "/v1/cuentas/deposito";
        $headers = array('Content-Type' => 'application/json',
                         'Authorization' => 'Bearer ' . $this->session->userdata('jwt'));
        $data = array('idcuenta' => $idbeneficiario,
                       'totalDepositado' => (float)$monto);
        $response = Requests::post($uri, $headers, json_encode($data));
        if ($response->status_code == 201) {
            echo "se depositó el monto a la cuenta del beneficiario<br>";
        }
        else{
            //regresar vista de fallo
            echo "error al depositar el monto a la cuenta del beneficiario";
            $this->load->view('base_templates/header');
            $this->load->view('atm_templates/transferencia/transferencia_fallo');
            $this->load->view('base_templates/footer');
            return;
        }

        //hacer petición para el registro de la trasnferencia en el historial
        $uri = getenv('api_url') . "/v1/transferencias";
        $headers = array('Content-Type' => 'application/json',
                         'Authorization' => 'Bearer ' . $this->session->userdata('jwt'));
        $data = array('idcuentahabiente' => (int)$idcuenta,
                       'idbeneficiario' => (int)$idbeneficiario,
                       'monto' => (float)$monto);
        $response = Requests::post($uri, $headers, json_encode($data));
        if ($response->status_code == 201) {
            //regresar vista de éxito
            $this->load->view('base_templates/header');
            $this->load->view('atm_templates/transferencia/transferencia_exito', $data);
            $this->load->view('base_templates/footer');
        }
        else{
            //regresar vista de fallo
            echo "error al registrar la transferencia en el historial de movimientos";
            $this->load->view('base_templates/header');
            $this->load->view('atm_templates/transferencia/transferencia_fallo', $data);
            $this->load->view('base_templates/footer');
            return;
        }
    }

    public function regresar(){
        redirect('/menu/index');
    }
}
