<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lists extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Lists_model' , 'User_model' , 'Task_model'));
    }

	public function index()
	{
        if(!isset($_SESSION['is_logged'])) {
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

    public function form_new_list($msg = null, $alert = null) {
        if(!isset($_SESSION['is_logged'])) {
            redirect(base_url(''));
        }

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

    public function create_list() 
    {
        if(!isset($_SESSION['is_logged'])) {
            redirect(base_url(''));
        }
        
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
                    $this->session->set_flashdata('msg', '¡Lista creada correctamente!');
                    $this->session->set_flashdata('alert', 'success');
                    redirect(base_url('Lists/show_list/'.$list_id));
                } else {
                    $this->form_new_list('Hubo un error inesperado, intenta nuevamente', 'danger');
                }
            }
        } else {
            $this->form_new_list();
        }
    }

    public function show_list($list_id)
    {
        if(!isset($_SESSION['is_logged'])) {
            redirect(base_url(''));
        }

        $data['menu'] = lists_menu();
        $data['aside'] = $this->load->view('templates/aside.php', $data, true);

        $list = $this->Lists_model->found_list($list_id);

        $data['list'] = $list;

		$this->load->view('templates/header.php');
		$this->load->view('templates/nav.php');
		$this->load->view('show_list', $data);
		$this->load->view('templates/footer.php');
    }


    public function form_share_list($list_id, $msg = null, $alert = null)
    {
        if(!isset($_SESSION['is_logged'])) {
            redirect(base_url(''));
        }

        if($msg) {
            $data['msg'] = $msg;
            $data['alert'] = $alert;
        }

        $data['list_id'] = $list_id;

        $this->load->view('templates/header.php');
		$this->load->view('templates/nav.php');
		$this->load->view('share_list', $data);
		$this->load->view('templates/footer.php');
    }

    public function share_list()
    {
        if(!isset($_SESSION['is_logged'])) {
            redirect(base_url(''));
        }

        $user = $this->input->post();

        $rules = rules_share_list();    
        $this->form_validation->set_rules($rules);
            
        if($this->form_validation->run()) {
            $user_id = null;
            //  Search a User by E-mail
            $allUsers = $this->User_model->get_users();
            foreach ($allUsers as $i){
                if ($i->email == $user['email']) {
                    $user_id = $i->id;
                }
            }
            //Checks if user email exists
            if(!$user_id) {
                $this->form_share_list($this->input->post('list_id'), '¡El email ingresado no existe!', 'danger');
            //Checks if user is the same 
            } else if($user_id === $_SESSION['user_id']) {
                $this->form_share_list($this->input->post('list_id'), '¡No puedes compartir la lista contigo mismo!', 'warning');
            } else {
                //  Insert
                $data_user_list = array(    'user_id' => $user_id,
                                            'list_id' => $this->input->post('list_id'),
                                            'perm' => 2         );
                if ($this->Lists_model->create_link($data_user_list)) {
                    $this->form_share_list($this->input->post('list_id'), '¡Lista compartida!', 'success');
                }else{
                    $this->form_share_list($this->input->post('list_id'), '¡No se pudo compartir la lista!', 'danger');
                }
            }
        } else {
            $this->form_share_list($this->input->post('list_id'));
        }

    }

    public function form_edit_list($list_id)
    {
        if(!isset($_SESSION['is_logged'])) {
            redirect(base_url(''));
        }

        if($list_id) {  $this->session->set_userdata('list_id', $list_id);  }

        $data['menu'] = lists_menu($list_id);
        $data['aside'] = $this->load->view('templates/aside.php', $data, true);
        
        $list = $this->Lists_model->found_list($list_id);
        $data['list'] = $list;

        $this->load->view('templates/header.php');
        $this->load->view('templates/nav.php');
        $this->load->view('edit_list', $data);
        $this->load->view('templates/footer.php');
    }

    public function update_list()
    {
        if(!isset($_SESSION['is_logged'])) {
            redirect(base_url(''));
        }

        $new_data = $this->input->post();
		date_default_timezone_set('America/Argentina/San_Luis');
        $new_data ['edit_date'] = date("Y-m-d");

        $rules = rules_new_list();    
        $this->form_validation->set_rules($rules);
        //update edit 
        if($this->form_validation->run()) {
            //SUCCESS
            if ($this->Lists_model->update_list($this->input->post('id'),$new_data['name'],
                                                $new_data['descrip'],$new_data['edit_date'])) {
                $this->session->set_flashdata('msg', '¡Lista editada correctamente!');
                $this->session->set_flashdata('alert', 'success');
                redirect(base_url('Lists/show_list/'.$this->input->post('id')));
            }
        } else {
            $this->form_edit_list($this->input->post('id'));
        }
    }

    public function delete_list($list_id = null)
    {
        if(!isset($_SESSION['is_logged'])) {    redirect(base_url(''));     }

        $tasks = $this->Task_model->get_tasks($list_id);

        if ($this->Lists_model->delete_list($list_id, $tasks)) {
            $this->session->set_flashdata('swal', array(
                'icon' => 'success',
                'title' => 'Éxito',
                'text' => 'Eliminaste correctamente la lista.',
            ));
            redirect(base_url('Lists'));
        } else {
            $this->session->set_flashdata('swal', array(
                'icon' => 'error',
                'title' => 'Error',
                'text' => 'No se pudo eliminar la lista, intenta nuevamente más tarde.',
            ));
            redirect(base_url('Lists'));
        }
    }

}
