<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ListTasks extends CI_Controller {

	public function index()
	{
        $data['menu'] = list_tasks_menu();

        $data['aside'] = $this->load->view('templates/aside.php', $data, true);

		$this->load->view('templates/header.php');
		$this->load->view('templates/nav.php');
		$this->load->view('list_tasks', $data);
		$this->load->view('templates/footer.php');
	}
}
