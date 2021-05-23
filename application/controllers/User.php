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
                    $msg['msg'] = 'Ocurrio un problema al iniciar sesion, intentalo nuevamente!';
                    $this->load->view('templates/header.php');
                    $this->load->view('templates/nav.php');
                    $this->load->view('sign_up', $msg);
                    $this->load->view('templates/footer.php');
                }else{
                    # success, please LogIn NOW
                    $this->load->view('templates/header.php');
                    $this->load->view('templates/nav.php');
                    $this->load->view('log_in');
                    $this->load->view('templates/footer.php');
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
            #   how to crypt and decrypt
            if ($res = $this->User_model->validate_user($email , $password)) {
                #   Open session
                $data = array(  'id' => $res->id,
                                'username' => $res->username,
                                'is_logged' => TRUE     );
                $this->session->set_userdata($data);

                $msg['menu'] = lists_menu();
                $msg['aside'] = $this->load->view('templates/aside.php', $msg, true);
                $msg['msg'] = 'Usuario creado correctamente';

                $this->load->view('templates/header.php');
                $this->load->view('templates/nav.php');
                $this->load->view('lists', $msg);
                $this->load->view('templates/footer.php');
            }else{
                $msg['msg'] = 'Ocurrio un problema al iniciar sesion, intentalo nuevamente!';
                $this->load->view('templates/header.php');
                $this->load->view('templates/nav.php');
                $this->load->view('log_in', $msg);
                $this->load->view('templates/footer.php');
            }
        }
    }

    public function log_out() 
    {
        //close session
        $data = array('id' , 'is_logged');
        $this->session->unset_userdata($data);
        $this->session->sess_destroy();
        //redirect
        $this->load->view('templates/header.php');
        $this->load->view('templates/nav.php');
        $this->load->view('home');
        $this->load->view('templates/footer.php');

    }

}
