<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lists extends CI_Controller {

	public function index()
	{
        $data['menu'] = lists_menu();
        
        $data['aside'] = $this->load->view('templates/aside.php', $data, true);
        
		$this->load->view('templates/header.php');
		$this->load->view('templates/nav.php');
		$this->load->view('lists', $data);
		$this->load->view('templates/footer.php');
	}
    
    public function new() {
        $data['menu'] = lists_menu();
        
        $data['aside'] = $this->load->view('templates/aside.php', $data, true);

		$this->load->view('templates/header.php');
		$this->load->view('templates/nav.php');
        $this->load->view('new_list', $data);
		$this->load->view('templates/footer.php');       
    }

    public function create() {
        $list = $this->input->post();
        //acá hay que poner las funciones del modelo list y vincularlo al usuario con el modelo user_list
    }

}
