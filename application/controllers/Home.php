<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
        if(isset($_SESSION['user_id'])) {
            redirect(base_url('Lists'));
        }
    
        $this->load->view('templates/header.php');
        $this->load->view('templates/nav.php');
        $this->load->view('home');
        $this->load->view('templates/footer.php');
	}
}
