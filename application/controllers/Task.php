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
    
    public function create_task()
    {
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

    public function list_tasks($list_id = null)
    {
        if($list_id) {
            $this->session->set_userdata('list_id', $list_id);
        }

        $list = $this->Lists_model->found_list($list_id ? $list_id : $_SESSION['list_id']);
        $data['list_name'] = $list->name;
        $data['list_descrip'] = $list->descrip;

        $list_tasks = $this->Task_model->get_tasks($list_id ? $list_id : $_SESSION['list_id']);
        $data['list_tasks'] = $list_tasks;
        
        $data['menu'] = list_tasks_menu($list_id ? $list_id : $_SESSION['list_id']);
        $data['aside'] = $this->load->view('templates/aside.php', $data, true);
    
        $this->load->view('templates/header.php');
        $this->load->view('templates/nav.php');
        $this->load->view('list_tasks', $data);
        $this->load->view('templates/footer.php');
    }
    
    public function show_task($task_id = null)
    {
        $data['menu'] = list_tasks_menu($_SESSION['list_id']);
    
        $data['aside'] = $this->load->view('templates/aside.php', $data, true);
        $task = $this->Task_model->found_task($task_id);

        $data['task'] = task_data(clone $task);
    
        $this->load->view('templates/header.php');
        $this->load->view('templates/nav.php');
        $this->load->view('show_task', $data);
        $this->load->view('templates/footer.php');
    }

    public function form_edit_task($task_id)
    {
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
        $rules = rules_new_task();    
        $this->form_validation->set_rules($rules);
            
        //update
        if($this->form_validation->run() == FALSE) {    
            $this->form_edit_task($this->input->post('id'));
        } else {
            // actualizar la tarea JAVI
        }
    }

}
