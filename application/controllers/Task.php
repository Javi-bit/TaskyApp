<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Task_model');
    }
    
    public function create($list_id = null)
    {
        $task = $this->input->post();

        $data['menu'] = list_tasks_menu();
        $data['aside'] = $this->load->view('templates/aside.php', $data, true);

        if($task) {

            //acá hay que poner las funciones del modelo task y vincularlo al id de la lista

        }

        $this->load->view('templates/header.php');
        $this->load->view('templates/nav.php');
        $this->load->view('new_task', $data);
        $this->load->view('templates/footer.php');
    }

    public function list_tasks($list_id = null)
    {
        $list_tasks = $this->Task_model->get_tasks($list_id);

        $data['list_tasks'] = $list_tasks;

        $data['menu'] = list_tasks_menu();
    
        $data['aside'] = $this->load->view('templates/aside.php', $data, true);
    
        $this->load->view('templates/header.php');
        $this->load->view('templates/nav.php');
        $this->load->view('list_tasks', $data);
        $this->load->view('templates/footer.php');
        
    }

    public function new($msg = null, $alert = null) 
    {
        $data['menu'] = list_tasks_menu();
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
    
    public function show($task_id = null)
    {
        $data['menu'] = list_tasks_menu();
    
        $data['aside'] = $this->load->view('templates/aside.php', $data, true);
    
        $this->load->view('templates/header.php');
        $this->load->view('templates/nav.php');
        $this->load->view('show_task', $data);
        $this->load->view('templates/footer.php');
        
    }
}
