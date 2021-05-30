<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{

    // $data is an array where are all data for insert, with key => vlaue

    //Create User
    public function create_user($data){
        if($this->db->insert('users' , $data)){
            return true;
        }return false;
    }

    //Looking for User by ID
    public function found_user($id){
        if ($query = $this->db->get_where('users', array('id' => $id))) {
            return $query->row();
        }return false;
    }

    //Looking for User by E-mail and Password
    public function validate_user($email, $password){
        if ($query = $this->db->get_where('users', array('email' => $email, 'pass' => $password))) {
            if($query->result()) {    return $query->row();    }
        }return false;
    }


    //Search All Users 
    public function get_users(){
        if ($query = $this->db->get('users')) {
            return $query->result();
        }return false;
    }

}

