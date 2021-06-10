<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subtask extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Subtask_model', 'Task_model', 'Lists_model'));
    }

	public function list_subtasks($task_id = null , $column = null) 
	{
        if(!isset($_SESSION['user_id'])) {redirect(base_url(''));}
        
        $task = $this->Task_model->found_task($task_id ? $task_id : $_SESSION['task_id']);
        if (empty($task)) {redirect(base_url('Task/list_tasks/'.$_SESSION['list_id']));}
        else{$exists = $this->Lists_model->get_link_user_list($_SESSION['list_id'],$_SESSION['user_id']);
            if (empty($exists)) {redirect(base_url('Task/list_tasks/'.$_SESSION['list_id']));}}

        if($task_id) {  $this->session->set_userdata('task_id', $task_id);  }

        if (!empty($column)) {   $list_subtasks = $this->sort_subtasks($column);  }
                        else {   $list_subtasks = $this->Subtask_model->get_subtasks($task_id ? $task_id : $_SESSION['task_id']);   }

        $data['task_name'] = $task->name;
        $data['task_descrip'] = $task->descrip;

        $data['list_subtasks'] = $list_subtasks;

        $data['menu'] = list_subtasks_menu($task_id ? $task_id : $_SESSION['task_id'], $_SESSION['list_id']);

        $data['aside'] = $this->load->view('templates/aside.php', $data, true);

		$this->load->view('templates/header.php');
		$this->load->view('templates/nav.php');
		$this->load->view('list_subtasks', $data);
		$this->load->view('templates/footer.php');
	}

    public function sort_subtasks($column){
        if($_SESSION['sort_subtask'] == 'ASC'){
            $this->session->set_userdata('sort_subtask', 'DESC');
            return $this->Subtask_model->get_sort_subtasks($_SESSION['task_id'], $column, $_SESSION['sort_subtask']);
        }
        $this->session->set_userdata('sort_subtask', 'ASC');
        return $this->Subtask_model->get_sort_subtasks($_SESSION['task_id'], $column, $_SESSION['sort_subtask']);
    }

    public function form_new_subtask($msg = NULL, $alert = NULL) 
    {
        if(!isset($_SESSION['is_logged'])) {
            redirect(base_url(''));
        }
        
        if(empty($_SESSION['task_id']) || empty($_SESSION['list_id'])) {
            redirect(base_url('Lists'));
        }

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
        if(!isset($_SESSION['is_logged'])) {
            redirect(base_url(''));
        }

        $subtask = $this->input->post();

        if(empty($subtask)) {
            redirect(base_url('Lists'));
        }

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
            } else {
                $this->form_new_subtask('¡No se pudo crear la subtarea, intenta nuevamente!', 'danger');
            }
        } else {
            $this->form_new_subtask();
        }

    }

    public function show_subtask($subtask_id = null)
    {
        if(!isset($_SESSION['is_logged'])) {    redirect(base_url(''));     }

        $data['menu'] = list_subtasks_menu($_SESSION['task_id'], $_SESSION['list_id']);
        $data['aside'] = $this->load->view('templates/aside.php', $data, true);
        
        $subtask = $this->Subtask_model->found_subtask($subtask_id);

        if(empty($subtask)) {
            redirect(base_url('Lists'));
        }

        $data['subtask'] = subtask_data(clone $subtask);

        $this->load->view('templates/header.php');
        $this->load->view('templates/nav.php');
        $this->load->view('show_subtask', $data);
        $this->load->view('templates/footer.php');
    }

    public function form_edit_subtask($subtask_id, $msg = null, $alert = null)
    {
        if(!isset($_SESSION['is_logged'])) {    redirect(base_url(''));     }

        if($subtask_id) {  $this->session->set_userdata('subtask_id', $subtask_id);  }

        if($msg) {
            $data['msg'] = $msg;
            $data['alert'] = $alert;
        }

        $data['menu'] = list_subtasks_menu($_SESSION['task_id'], $_SESSION['list_id']);
        $data['aside'] = $this->load->view('templates/aside.php', $data, true);
        
        $subtask = $this->Subtask_model->found_subtask($subtask_id ? $subtask_id : $_SESSION['subtask_id']);

        if(empty($subtask)) {
            redirect(base_url('Lists'));
        }

        $data['subtask'] = $subtask;

        $this->load->view('templates/header.php');
        $this->load->view('templates/nav.php');
        $this->load->view('edit_subtask', $data);
        $this->load->view('templates/footer.php');
    }

    public function update_subtask()
    {
        if(!isset($_SESSION['is_logged'])) {    redirect(base_url(''));     }

        $new_data = $this->input->post();

        if(empty($new_data)) {
            redirect(base_url('Lists'));
        }

		date_default_timezone_set('America/Argentina/San_Luis');
        $new_data ['edit_date'] = date("Y-m-d");

        $rules = rules_new_subtask();    
        $this->form_validation->set_rules($rules);
        //update edit 
        if($this->form_validation->run()) {
            //SUCCESS
            if ($this->Subtask_model->update_subtask($_SESSION['subtask_id'], $new_data['name'], $new_data['descrip'],
                                                    $new_data['state'], $new_data['edit_date'])){
                $this->session->set_flashdata('msg', '¡Subtarea editada correctamente!');
                $this->session->set_flashdata('alert', 'success');
                redirect(base_url('Subtask/show_subtask/'.$this->input->post('id')));
            } else {
                $this->form_edit_subtask($this->input->post('id'),'¡No se pudo editar la subtarea, intenta nuevamente!', 'danger');
            }
        } else {
            $this->form_edit_subtask($this->input->post('id'));
        }
    }

    public function delete_subtask($subtask_id)
    {
        if(!isset($_SESSION['is_logged'])) {
            redirect(base_url(''));
        }
        
        if ($this->Subtask_model->delete_subtask($subtask_id)) {
            redirect(base_url('Subtask/list_subtasks'));
        } else {
            $this->session->set_flashdata('swal', array(
                'icon' => 'error',
                'title' => 'Error',
                'text' => 'No se pudo eliminar la subtarea, intenta nuevamente más tarde.',
            ));
            $this->session->set_flashdata('swal');
            redirect(base_url('Subtask/list_subtasks'));
        }
    }
}
