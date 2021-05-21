<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function sign_up()
    {
        $user = $this->input->post();

        if($user) {
            echo 'aca aca';
        }    

        $this->load->view('templates/header.php');
		$this->load->view('templates/nav.php');
		$this->load->view('sign_up');
		$this->load->view('templates/footer.php');
    }

    public function log_in() {

        $user = $this->input->post();

        if($user) {
            echo 'aca aca';
            // acá hay que averiguar como llevarlo a la vista list del controlador Lists
        }
        
        $this->load->view('templates/header.php');
        $this->load->view('templates/nav.php');
        $this->load->view('log_in');
        $this->load->view('templates/footer.php');

    }

    public function log_out() {
        echo 'aca aca';

        $this->load->view('templates/header.php');
        $this->load->view('templates/nav.php');
        $this->load->view('home');
        $this->load->view('templates/footer.php');

    }

}
