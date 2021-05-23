<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function sign_up()
    {        
        $user = $this->input->post();
        
        if($user) {
            $rules = rules_sign_up();
            $this->form_validation->set_rules($rules);
            
            if($this->form_validation->run()) {
                $data['msg'] = 'Usuario creado correctamente';

                //funciones crear el usuario con el modelo user y alguna funcion para la session de usuario

            } else {
                
            }
        }    

        $this->load->view('templates/header.php');
		$this->load->view('templates/nav.php');
		$this->load->view('sign_up');
		$this->load->view('templates/footer.php');
    }

    public function log_in() 
    {
        $user = $this->input->post();

        if($user) {
            $rules = rules_log_in();
            $this->form_validation->set_rules($rules);
            
            if($this->form_validation->run()) {

            } else {

            }
        }
        
        $this->load->view('templates/header.php');
        $this->load->view('templates/nav.php');
        $this->load->view('log_in');
        $this->load->view('templates/footer.php');
    }

    public function log_out() 
    {
        echo 'aca aca';

        $this->load->view('templates/header.php');
        $this->load->view('templates/nav.php');
        $this->load->view('home');
        $this->load->view('templates/footer.php');

    }

}
