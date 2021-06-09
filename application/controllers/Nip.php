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
        //verificar que el nip es correcto
        if ($nip == $this->session->userdata('nip')) {
            redirect('/menu/index');
        }
        else{
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