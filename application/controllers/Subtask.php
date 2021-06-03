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
        if(!isset($_SESSION['user_id'])) {
            redirect(base_url(''));
        }
        if($task_id) {  $this->session->set_userdata('task_id', $task_id);  }

        $list_subtasks = $this->Subtask_model->get_subtasks($task_id);

        $data['lists_subtasks'] = $list_subtasks;

        $data['menu'] = list_subtasks_menu($_SESSION['task_id'], $_SESSION['list_id']);

        $data['aside'] = $this->load->view('templates/aside.php', $data, true);

		$this->load->view('templates/header.php');
		$this->load->view('templates/nav.php');
		$this->load->view('list_subtasks', $data);
		$this->load->view('templates/footer.php');
	}

    public function form_new_subtask($msg = NULL, $alert = NULL) 
    {
        $data['menu'] = list_subtasks_menu($_SESSION['task_id'], $_SESSION['list_id']);
        $data['aside'] = $this->load->view('templates/aside.php', $data, true);

        if($msg) {
            $data['msg'] = $msg;
            $data['alert'] = $alert;
        }

        $this->load->view('templates/header.php');
        $this->load->view('templates/nav.php');
        $this->load->view('new_subtask', $data);
        $this->load->view('templates/footer.php');
    }

    
    public function create_subtask($task_id = null)
    {
        $subtask = $this->input->post();
        $subtask = $_SESSION['task_id'];

        $rules = rules_new_subtask();

        $this->form_validation->set_rules($rules);
            
        //inserts
        if($this->form_validation->run()) {
            if ($this->Subtask_model->create_subtask($subtask)) {
                # code...
            }
        } else {
            $this->form_new_subtask();
        }

    }

    public function show_subtask($subtask_id = null)
    {
        $data['menu'] = list_subtasks_menu($_SESSION['task_id'], $_SESSION['list_id']);
    
        $data['aside'] = $this->load->view('templates/aside.php', $data, true);
    
        $this->load->view('templates/header.php');
        $this->load->view('templates/nav.php');
        $this->load->view('show_subtask', $data);
        $this->load->view('templates/footer.php');
        
    }
}
