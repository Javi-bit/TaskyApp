<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Task_model' , 'Lists_model'));
    }

    public function form_new_task($msg = null, $alert = null) 
    {
        if(!isset($_SESSION['is_logged'])) {
            redirect(base_url(''));
        }

        $data['list_id'] = $_SESSION['list_id'];
        $data['menu'] = list_tasks_menu($_SESSION['list_id']);
        $data['aside'] = $this->load->view('templates/aside.php', $data, true);

        if($msg) {
            $data['msg'] = $msg;
            $data['alert'] = $alert;
        }

        $this->load->view('templates/header.php');
        $this->load->view('templates/nav.php');
        $this->load->view('new_task', $data);
        $this->load->view('templates/footer.php');
    }

    public function check_memo()
    {
        $memo = $this->input->post('memo');
        $expir = $this->input->post('expir');

        if($memo >= $expir && $memo != 0) {
            return false;
        } else {
            return true;
        }

    }
    
    public function create_task()
    {
        if(!isset($_SESSION['is_logged'])) {
            redirect(base_url(''));
        }

        $rules = rules_new_task();    
        $this->form_validation->set_rules($rules);
            
        //inserts
        if($this->form_validation->run() == FALSE) {    
            $this->form_new_task($_SESSION['list_id']);
        } else {
            $task = $this->input->post();

            if ($task_id = $this->Task_model->create_task($task)) {
                $this->session->set_flashdata('msg', '¡Tarea creada correctamente!');
                $this->session->set_flashdata('alert', 'success');
                redirect('Task/show_task/'.$task_id);
            }else{
                $this->form_new_task('¡Hubo un error al crear la tarea, intenta nuevamente!', 'danger');
            }
        }
    }

    public function list_tasks($list_id = null, $column = null)
    {
        if(!isset($_SESSION['is_logged'])) {
            redirect(base_url(''));
        }

        if($list_id) {  $this->session->set_userdata('list_id', $list_id);  }

        if (!empty($column)) {   $list_tasks = $this->sort_tasks($column);  }
                        else {   $list_tasks = $this->Task_model->get_tasks($list_id ? $list_id : $_SESSION['list_id']);   }

        $list = $this->Lists_model->found_list($list_id ? $list_id : $_SESSION['list_id']);
        $data['list_name'] = $list->name;
        $data['list_descrip'] = $list->descrip;

        $data['list_tasks'] = $list_tasks;
        
        $data['menu'] = list_tasks_menu($list_id ? $list_id : $_SESSION['list_id']);
        $data['aside'] = $this->load->view('templates/aside.php', $data, true);
    
        $this->load->view('templates/header.php');
        $this->load->view('templates/nav.php');
        $this->load->view('list_tasks', $data);
        $this->load->view('templates/footer.php');
    }

    public function sort_tasks($column){
        if($_SESSION['sort_task'] == 'ASC'){
            $this->session->set_userdata('sort_task', 'DESC');
            return $this->Task_model->get_sort_tasks($_SESSION['list_id'], $column, $_SESSION['sort_task']);
        }
        $this->session->set_userdata('sort_task', 'ASC');
        return $this->Task_model->get_sort_tasks($_SESSION['list_id'], $column, $_SESSION['sort_task']);
    }
    
    public function show_task($task_id = null)
    {
        if(!isset($_SESSION['is_logged'])) {
            redirect(base_url(''));
        }

        $data['menu'] = list_tasks_menu($_SESSION['list_id']);
    
        $data['aside'] = $this->load->view('templates/aside.php', $data, true);
        $task = $this->Task_model->found_task($task_id);

        $data['task'] = task_data(clone $task);
    
        $this->load->view('templates/header.php');
        $this->load->view('templates/nav.php');
        $this->load->view('show_task', $data);
        $this->load->view('templates/footer.php');
    }

    public function form_edit_task($task_id, $msg = null, $alert = null)
    {
        if(!isset($_SESSION['is_logged'])) {
            redirect(base_url(''));
        }

        if($msg) {
            $data['msg'] = $msg;
            $data['alert'] = $alert;
        }

        if($task_id) {  $this->session->set_userdata('task_id', $task_id);  }

        $data['menu'] = list_tasks_menu($_SESSION['list_id']);
        $data['aside'] = $this->load->view('templates/aside.php', $data, true);
        
        $task = $this->Task_model->found_task($task_id);
        $data['task'] = $task;

        $this->load->view('templates/header.php');
        $this->load->view('templates/nav.php');
        $this->load->view('edit_task', $data);
        $this->load->view('templates/footer.php');
    }

    public function update_task()
    {
        if(!isset($_SESSION['is_logged'])) {
            redirect(base_url(''));
        }

        $new_data = $this->input->post();
		date_default_timezone_set('America/Argentina/San_Luis');
        $new_data ['edit_date'] = date("Y-m-d");

        $rules = rules_new_task();    
        $this->form_validation->set_rules($rules);
        //update
        if($this->form_validation->run() == FALSE) {    
            $this->form_edit_task($this->input->post('id'));
        } else {
            //SUCCESS
            if ($this->Task_model->update_task($this->input->post('id'),$new_data['name'],$new_data['descrip'],
                                                $new_data['priori'],$new_data['expir'],$new_data['memo'],
                                                $new_data['colour'],$new_data['state'],$new_data['edit_date'])) {
                $this->session->set_flashdata('msg', '¡Tarea editada correctamente!');
                $this->session->set_flashdata('alert', 'success');
                redirect(base_url('Task/show_task/'.$this->input->post('id')));
            } else {
                $this->form_edit_task($this->input->post('id'), '¡No se pudo editar la tarea, intenta nuevamente!', 'danger');
            }
        }
    }

    public function delete_task($task_id = null)
    {
        if(!isset($_SESSION['is_logged'])) {
            redirect(base_url(''));
        }
        
        if ($this->Task_model->delete_task($task_id)) {
            redirect(base_url('Task/list_tasks'));
        } else {
            $this->session->set_flashdata('swal');
            redirect(base_url('Task/list_tasks'));
        }
    }

}
