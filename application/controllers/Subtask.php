<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subtask extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Subtask_model');
    }
    

	public function list_subtasks($task_id = null) 
	{
        $list_subtasks = 'la lista de subtareas';

        $data['lists_subtasks'] = $list_subtasks;

        $data['menu'] = list_subtasks_menu();

        $data['aside'] = $this->load->view('templates/aside.php', $data, true);

		$this->load->view('templates/header.php');
		$this->load->view('templates/nav.php');
		$this->load->view('list_subtasks', $data);
		$this->load->view('templates/footer.php');
	}

    public function create()
    {
        $subtask = $this->input->post();

        $data['menu'] = list_subtasks_menu();
        $data['aside'] = $this->load->view('templates/aside.php', $data, true);

        if($subtask) {

        }

        $this->load->view('templates/header.php');
        $this->load->view('templates/nav.php');
        $this->load->view('new_subtask', $data);
        $this->load->view('templates/footer.php');
    }

    public function show($subtask_id = null)
    {
        $data['menu'] = list_subtasks_menu();
    
        $data['aside'] = $this->load->view('templates/aside.php', $data, true);
    
        $this->load->view('templates/header.php');
        $this->load->view('templates/nav.php');
        $this->load->view('show_subtask', $data);
        $this->load->view('templates/footer.php');
        
    }
}
