<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lists extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('List_tasks' , 'User_list'));
    }

	public function index()
	{
        $data['menu'] = lists_menu();
        
        $data['aside'] = $this->load->view('templates/aside.php', $data, true);
        
		$this->load->view('templates/header.php');
		$this->load->view('templates/nav.php');
		$this->load->view('lists', $data);
		$this->load->view('templates/footer.php');
	}
    
    public function new() {
        $data['menu'] = lists_menu();
        
        $data['aside'] = $this->load->view('templates/aside.php', $data, true);

		$this->load->view('templates/header.php');
		$this->load->view('templates/nav.php');
        $this->load->view('new_list', $data);
		$this->load->view('templates/footer.php');       
    }

    public function create() {
        //variables of form
        $name = $this->input->post('name');
        $descrip = $this->input->post('descrip');
		date_default_timezone_set('America/Argentina/San_Luis');
        $create_date = date('Y-m-d');
        //data for database
        $data_list = array( 'name' => $name,
                            'descrip' => $descrip,
                            'create_date' => $create_date   );
        //inserts
        if (!empty($name)) {
            if ($list_id = $this->List_tasks->create_list($data_list)) {
                $data_user_list = array(
                    'user_id' => 1, /* $_SESSION[id] */
                    'list_id' => $list_id,
                    'perm' => 1,
                    'link_date' => date('Y-m-d')
                );
                if ($this->User_list->create_link($data_user_list)) {

                    # Here the view SUCCESS
                    echo 'correct';

                }else{

                    # Here the view FAILED
                    echo 'incorrect';

                }
            }
        }else{
            # Here return the False Values 
                # $name is required, but $descrip is optional or required?
        }
    }

}