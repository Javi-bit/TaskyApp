<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {
    
    public function create($list_id = null)
    {
        $task = $this->input->post();

        //acá hay que poner las funciones del modelo task y vincularlo al id de la lista
    }

    public function list_tasks($list_id = null)
    {

        $list_tasks = $this->Task->get_tasks($list_id);

        $data['list_tasks'] = $list_tasks;

        $data['menu'] = list_tasks_menu();
    
        $data['aside'] = $this->load->view('templates/aside.php', $data, true);
    
        $this->load->view('templates/header.php');
        $this->load->view('templates/nav.php');
        $this->load->view('list_tasks', $data);
        $this->load->view('templates/footer.php');
        
    }
}
