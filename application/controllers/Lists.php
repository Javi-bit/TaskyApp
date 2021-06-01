<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lists extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Lists_model' , 'User_model'));
    }

	public function index()
	{
        if(!isset($_SESSION['user_id'])) {
            redirect(base_url(''));
        }

        $lists = $this->Lists_model->get_lists($_SESSION['user_id']);
        $data['lists'] = $lists;

        $data['menu'] = lists_menu();
        
        $data['aside'] = $this->load->view('templates/aside.php', $data, true);
        
		$this->load->view('templates/header.php');
		$this->load->view('templates/nav.php');
		$this->load->view('lists', $data);
		$this->load->view('templates/footer.php');
	}

    public function form_new($msg = null, $alert = null) {
        $data['menu'] = lists_menu();
        $data['aside'] = $this->load->view('templates/aside.php', $data, true);

        if($msg) {
            $data['msg'] = $msg;
            $data['alert'] = $alert;
        }

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
                            'create_date' => $create_date );
        
        $rules = rules_new_list();    
        $this->form_validation->set_rules($rules);
            
        //inserts
        if($this->form_validation->run()) {
            if ($list_id = $this->Lists_model->create_list($data_list)) {
                $data_user_list = array(
                    'user_id' => $_SESSION['user_id'],
                    'list_id' => $list_id,
                    'perm' => 1,
                    'link_date' => date('Y-m-d')
                );

                if ($this->Lists_model->create_link($data_user_list)) {
                    $this->form_new('¡Lista creada correctamente!', 'success');
                } else {
                    $this->form_new('Hubo un error inesperado, intenta nuevamente', 'danger');
                }
            }
        } else {
            $this->form_new();
        }
    }

    public function share_list(int $list_id = null)
    {
        $user = $this->input->post();

        $rules = rules_share_list();    
        $this->form_validation->set_rules($rules);
            
        if($this->form_validation->run()) {
            //  Search a User by E-mail
            $allUsers = $this->User_model->get_users();
            foreach ($allUsers as $i){
                if ($i->email == $user['email']) {
                    $user_id = $i->id;
                }
            }
            //  Insert
            $data_user_list = array(    'user_id' => $user_id,
                                        'list_id' => $list_id,
                                        'perm' => 2         );
            if ($this->Lists_model->create_link($data_user_list)) {
                //  SUCCESS
                echo 'Compartida!';
            }else{
                //  FAILED
                echo 'ERROR';
            }
        }
        $this->load->view('templates/header.php');
		$this->load->view('templates/nav.php');
		$this->load->view('share_list');
		$this->load->view('templates/footer.php');
    }

    public function delete_list(int $list_id = null)
    {
        // maybe we can to ask first, if he is sure to acept this...
        if ($this->Lists_model->delete_list($list_id)) {
            //  SUCCESS
            echo 'Eliminada!';
        }else{
            //  FAILED
            echo 'ERROR';
        }
    }

}
