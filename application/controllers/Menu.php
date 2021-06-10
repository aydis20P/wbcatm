<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

    public function __construct(){
                parent::__construct();
                $this->load->library('session');
                $this->load->helper('url');
    }

    public function index(){
        $data["nombreCh"] = $this->session->userdata('nombre');
        $this->load->view('base_templates/header');
        $this->load->view('atm_templates/menu/menu', $data);
        $this->load->view('base_templates/footer');
    }

    public function regresaMain(){
        //redireccionar
        redirect('/main/index');
    }

    public function consultaSaldo(){
        redirect('/consulta/index');
    }

    public function depositarAMiCuenta(){
        redirect('/deposito/index');
    }

    public function disposicion(){
        redirect('/retiro/index');
    }

    public function transferencia(){
        redirect('/transferencia/index');
    }
}
