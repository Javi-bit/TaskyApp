<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function sign_up()
    {        
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = $this->input->post('pass');

        // Validation Form
        $rules = rules_sign_up();
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE) {
            # Here return all errors about from
            $this->load->view('templates/header.php');
            $this->load->view('templates/nav.php');
            $this->load->view('sign_up');
            $this->load->view('templates/footer.php');
        }else{
            # Here validate that the user does not exist and create a new user
            #   how to crypt and decrypt
            if ($this->User_model->validate_user($email, $password)) {
                # [ERROR] User Exists
                $this->session->set_flashdata('msg', '¡El mail ya ha sido registrado!');
                $this->session->set_flashdata('alert', 'danger');
                $this->load->view('templates/header.php');
                $this->load->view('templates/nav.php');
                $this->load->view('sign_up');
                $this->load->view('templates/footer.php');
            }else{
                #Data for database
                date_default_timezone_set('America/Argentina/San_Luis');
                $data = array(
                    'username' => $username,
                    'email' => $email,
                    'pass' => $password,
                    'create_date' => date('Y-m-d')
                );
                #Create New User
                if (!$this->User_model->create_user($data)) {
                    # failed 
                    $this->session->set_flashdata('msg', '¡Ocurrió un problema al crear el usuario, intentalo nuevamente!');
                    $this->session->set_flashdata('alert', 'danger');
                    $this->load->view('templates/header.php');
                    $this->load->view('templates/nav.php');
                    $this->load->view('sign_up');
                    $this->load->view('templates/footer.php');
                }else{
                    # success, please LogIn NOW'
                    $this->session->set_flashdata('msg', '¡Usuario creado correctamente!');
                    $this->session->set_flashdata('alert', 'success');
                    redirect('User/log_in');
                }
            }
        }
    }

    public function log_in() 
    {
        $email = $this->input->post('email');
        $password = $this->input->post('pass');
        
        // Validation Form
        $rules = rules_log_in();
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE) {
            # Here return all errors about from
            $this->load->view('templates/header.php');
            $this->load->view('templates/nav.php');
            $this->load->view('log_in');
            $this->load->view('templates/footer.php');
        }else{
            # Here validate that the user exist
            # how to crypt and decrypt
            if ($res = $this->User_model->validate_user($email , $password)) {
                #   Open session
                $user = array(  'user_id' => $res->id,
                                'username' => $res->username,
                                'email' => $res->email,
                                'is_logged' => TRUE    );
                $this->session->set_userdata($user);

                redirect(base_url('Lists'));

            }else{
                $this->session->set_flashdata('msg', '¡Ocurrió un problema al iniciar sesión, intentalo nuevamente!');
                $this->session->set_flashdata('alert', 'danger');
                $this->load->view('templates/header.php');
                $this->load->view('templates/nav.php');
                $this->load->view('log_in');
                $this->load->view('templates/footer.php');
            }
        }
    }

    public function log_out() 
    {
        //close session
        $user = array('user_id' , 'is_logged');
        $this->session->unset_userdata($user);
        $this->session->sess_destroy();
        //redirect
        redirect(base_url(''));

    }

    public function edit() {

        $edit = $this->input->post();

        if($edit) {



        } else {
            $this->load->view('templates/header.php');
            $this->load->view('templates/nav.php');
            $this->load->view('edit_user');
            $this->load->view('templates/footer.php');
        }

    }


    function check_old_pass($old_pass) {
        
        $user = $this->User_model->found_user($_SESSION['user_id']);
        $storage_pass = $user->pass;
        
        if($old_pass != $storage_pass) {
            return false;
        } else {
            return true;
        }
    }

    public function change_pass() {
        $change_pass = $this->input->post();

        if($change_pass) {

            $rules = rules_change_pass();
            $this->form_validation->set_rules($rules);
    
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/header.php');
                $this->load->view('templates/nav.php');
                $this->load->view('change_pass');
                $this->load->view('templates/footer.php');
            } else {

            }

        } else {
            $this->load->view('templates/header.php');
            $this->load->view('templates/nav.php');
            $this->load->view('change_pass');
            $this->load->view('templates/footer.php');
        }
    }

}
