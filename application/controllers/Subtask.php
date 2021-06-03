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

    
    public function create_subtask()
    {
        $subtask = $this->input->post();
        $subtask['task_id'] = $_SESSION['task_id'];

        $rules = rules_new_subtask();

        $this->form_validation->set_rules($rules);
            
        //inserts
        if($this->form_validation->run()) {
            if ($subtask_id = $this->Subtask_model->create_subtask($subtask)) {
                    $this->session->set_userdata('subtask_id', $subtask_id);
                    $this->session->set_flashdata('msg', '¡Subtarea creada correctamente!');
                    $this->session->set_flashdata('alert', 'success');
                    redirect(base_url('Subtask/show_subtask/'.$subtask_id));
            }
        } else {
            $this->form_new_subtask();
        }

    }

    public function show_subtask($subtask_id = null)
    {
        $data['menu'] = list_subtasks_menu($_SESSION['task_id'], $_SESSION['list_id']);
        $data['aside'] = $this->load->view('templates/aside.php', $data, true);
        
        $subtask = $this->Subtask_model->found_subtask($subtask_id);
        $data['subtask'] = $subtask;

        $this->load->view('templates/header.php');
        $this->load->view('templates/nav.php');
        $this->load->view('show_subtask', $data);
        $this->load->view('templates/footer.php');
    }

    public function form_edit_subtask()
    {
        $data['menu'] = list_subtasks_menu($_SESSION['task_id'], $_SESSION['list_id']);
        $data['aside'] = $this->load->view('templates/aside.php', $data, true);
        
        $subtask = $this->Subtask_model->found_subtask($_SESSION['subtask_id']);
        $data['subtask'] = $subtask;

        $this->load->view('templates/header.php');
        $this->load->view('templates/nav.php');
        $this->load->view('edit_subtask', $data);
        $this->load->view('templates/footer.php');
    }

    public function update_list()
    {
        $new_data = $this->input->post();
		date_default_timezone_set('America/Argentina/San_Luis');
        $new_data ['edit_date'] = date("Y-m-d");

        $rules = rules_new_subtask();    
        $this->form_validation->set_rules($rules);
        //update edit 
        if($this->form_validation->run()) {
            //SUCCESS
            if ($this->Lists_model->update_subtask()) {
                $this->session->set_flashdata('msg', '¡Subtarea editada correctamente!');
                $this->session->set_flashdata('alert', 'success');
                redirect(base_url('Subtask/show_subtask/'.$_SESSION['subtask_id']));
            }
        } else {
            $this->form_edit_subtask($this->input->post('id'));
        }
    }

    public function delete_subtask($subtask_id)
    {
        // maybe we can to ask first, if he is sure to acept this...
        if ($this->Subtask_model->delete_subtask($subtask_id)) {
            //  SUCCESS
            echo 'Eliminada!';
        }else{
            //  FAILED
            echo 'ERROR';
        }
    }
}
