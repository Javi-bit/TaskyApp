<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function form_sing_up($msg = null, $alert = null)
    {
        if (!isset($_SESSION['is_logged'])) {
            
            $data = null;

            if($msg) {
                $data['msg'] = $msg;
                $data['alert'] = $alert;
            }

            $this->load->view('templates/header.php');
            $this->load->view('templates/nav.php');
            $this->load->view('sign_up', $data);
            $this->load->view('templates/footer.php');
        }else{
            redirect(base_url('lists'));
        }
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
            $this->form_sing_up();
        }else{
            # Here validate that the user does not exist and create a new user
            #   how to crypt and decrypt
            if ($this->User_model->validate_user($email, $password)) {
                # [ERROR] User Exists
                $this->session->set_flashdata('msg', '¡El mail ya ha sido registrado!');
                $this->session->set_flashdata('alert', 'danger');
                $this->form_sing_up();
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
                    $this->form_sing_up('¡Ocurrió un problema al crear el usuario, intentalo nuevamente!', 'danger');
                }else{
                    # success, please LogIn NOW'
                    $this->session->set_flashdata('msg', '¡Usuario creado correctamente!');
                    $this->session->set_flashdata('alert', 'success');
                    redirect('User/log_in');
                }
            }
        }
    }

    public function form_log_in($msg = null, $alert = null)
    {
        if (!isset($_SESSION['is_logged'])) {
            if($msg) {
                $data['msg'] = $msg;
                $data['alert'] = $alert;
            }

            $this->load->view('templates/header.php');
            $this->load->view('templates/nav.php');
            $this->load->view('log_in', $data);
            $this->load->view('templates/footer.php');
        }else{
            redirect(base_url('lists'));
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
            $this->form_log_in();
        }else{
            # Here validate that the user exist
            # how to crypt and decrypt
            if ($resp = $this->User_model->validate_user($email , $password)) {
                #   Open session
                $user = array(  'user_id' => $resp->id,
                                'username' => $resp->username,
                                'email' => $resp->email,
                                'is_logged' => TRUE    );
                $this->session->set_userdata($user);

                redirect(base_url('Lists'));

            }else{
                $this->form_log_in('¡Usuario o contraseña inválidos!', 'danger');
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

    public function form_edit($msg = null, $alert = null) 
    {
        if (isset($_SESSION['is_logged'])) {
            $data = null;

            if($msg) {
                $data['msg'] = $msg;
                $data['alert'] = $alert;
            }

            $this->load->view('templates/header.php');
            $this->load->view('templates/nav.php');
            $this->load->view('edit_user', $data);
            $this->load->view('templates/footer.php');
        }else{
            redirect(base_url(''));
        }
    }

    public function update_user() 
    {
        $edit = $this->input->post();
        
        $rules = rules_edit_user();
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE) {
            # Here return all errors about from
            $this->form_edit();
        } else {
            if ($this->User_model->update_user($_SESSION['user_id'] , $edit['username'] , $edit['email']) == TRUE) {
                // reload the varibles of session
                $user = array(  'username' => $edit['username'],
                                'email' => $edit['email']   );
                $this->session->set_userdata($user);
                $this->form_edit('¡Usuario actualizado exitosamente!','success');
            }else{
                // error maybe need to pass the errors
                $this->form_edit('¡Ocurrió un problema al actualizar, intentalo nuevamente!', 'danger');
            }
        }    
    }

    // This is for check error in rules_helper for change pass
    public function check_old_pass($old_pass) {        
        $user = $this->User_model->found_user($_SESSION['user_id']);
        $storage_pass = $user->pass;
        
        if($old_pass != $storage_pass) {
            return false;
        } else {
            return true;
        }
    }

    public function form_change_pass($msg = null, $alert = null)
    {
        $data = null;

        if (isset($_SESSION['is_logged'])) {
            if($msg) {
                $data['msg'] = $msg;
                $data['alert'] = $alert;
            }

            $this->load->view('templates/header.php');
            $this->load->view('templates/nav.php');
            $this->load->view('change_pass', $data);
            $this->load->view('templates/footer.php');
        }else{
            redirect(base_url(''));
        }
    }

    public function update_pass() {
        $change_pass = $this->input->post();

        $rules = rules_change_pass();
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == FALSE) {
            $this->form_change_pass();
        } else {
            if($change_pass['new_pass'] != $change_pass['old_pass']){
                if ($this->User_model->update_pass($_SESSION['user_id'] , $change_pass['new_pass']) == TRUE) {
                    // reload the varibles of session
                    $this->form_edit('¡Contraseña cambiada exitosamente!','success');
                }else{
                    // error maybe need to pass the errors
                    $this->form_change_pass('¡Ocurrió un problema al actualizar, intentalo nuevamente!', 'danger');
                }
            }else{
                // error maybe need to pass the errors (its the same pass)
                $this->form_change_pass('¡Tu contraseña antigua es igual a la nueva!', 'info');
            }
        }
        
    }

}
