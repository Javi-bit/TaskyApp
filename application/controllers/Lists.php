<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lists extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Lists_model');
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

    public function new($msg = null, $alert = null) {
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
                    'user_id' => 1, /* $_SESSION[id] */
                    'list_id' => $list_id,
                    'perm' => 1,
                    'link_date' => date('Y-m-d')
                );

                if ($this->Lists_model->create_link($data_user_list)) {
                    $msg = '¡Lista creada correctamente!';
                    $this->new($msg, 'success');
                } else {
                    $msg = 'Hubo un error inesperado, intenta nuevamente';
                    $this->new($msg, 'error');
                }
            }
        } else {
            $this->new();
        }
    }

    public function share_list($list_id = null)
    {
        $user = $this->input->post();

        if($user && $list_id) {

        }

        $this->load->view('templates/header.php');
		$this->load->view('templates/nav.php');
		$this->load->view('share_list');
		$this->load->view('templates/footer.php');
    }

}
