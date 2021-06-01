<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Task_model' , 'Lists_model'));
    }

    public function form_new($id) 
    {
        $data['list_id'] = $id;
        $data['menu'] = list_tasks_menu($id);
        $data['aside'] = $this->load->view('templates/aside.php', $data, true);

        $this->load->view('templates/header.php');
        $this->load->view('templates/nav.php');
        $this->load->view('new_task', $data);
        $this->load->view('templates/footer.php');
        if($this->input->post()){    $this->create($id);    }
    }
    
    public function create($list_id = null)
    {
        $task = $this->input->post();

        $rules = rules_new_task();    
        $this->form_validation->set_rules($rules);
            
        //inserts
        if($this->form_validation->run() == FALSE) {    
            $this->form_new($list_id);
        } else {
            $data = array(
                'name' => $task['name'],
                'descrip' => $task['descrip'],
                'expir' => $task['expir'],
                'memo' => $task['memo'],
                'colour' => $task['colour'],
                'priori' => $task['priori'],
                'state' => $task['state'],
                'list_id' => $list_id
            );
            if ($this->Task_model->create_task($data)) {
                echo 'Creada';
            }else{
                echo 'Ocurrio un error';
            }
            
        }
    }

    public function list_tasks($list_id = null)
    {
        $list = $this->Lists_model->found_list($list_id);
        $data['list_name'] = $list->name;
        $data['list_descrip'] = $list->descrip;

        $list_tasks = $this->Task_model->get_tasks($list_id);
        $data['list_tasks'] = $list_tasks;
        
        $data['menu'] = list_tasks_menu($list_id);
        $data['aside'] = $this->load->view('templates/aside.php', $data, true);
    
        $this->load->view('templates/header.php');
        $this->load->view('templates/nav.php');
        $this->load->view('list_tasks', $data);
        $this->load->view('templates/footer.php');
        
    }
    
    public function show($task_id = null)
    {
        $data['menu'] = list_tasks_menu('nada');
    
        $data['aside'] = $this->load->view('templates/aside.php', $data, true);
    
        $this->load->view('templates/header.php');
        $this->load->view('templates/nav.php');
        $this->load->view('show_task', $data);
        $this->load->view('templates/footer.php');
        
    }

}
