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

    //Looking for User by E-mail
    public function validate_user($email){
        if ($query = $this->db->get_where('users', array('email' => $email))) {
            if($query->result()) {    return $query->row();    }
        }return false;
    }


    //Search All Users 
    public function get_users(){
        if ($query = $this->db->get('users')) {
            return $query->result();
        }return false;
    }

    //Update User by ID, Name and E-mail
    public function update_user($id, $name, $email){
        if (    $this->db->set('username' , $name) &&
                $this->db->set('email' , $email) &&
                $this->db->where('id' , $id) &&
                $this->db->update('users') )
           {  return true;  }
        return false;
    }

    //Update User by ID, New Password
    public function update_pass($id, $pass){
        if (    $this->db->set('pass' , $pass) &&
                $this->db->where('id' , $id) &&
                $this->db->update('users') )
           {  return true;  }
        return false;
    }

    //Delete User by ID
    public function delete_user($id){
        if ($this->db->where('id' , $id) && $this->db->delete('users')) {
            return true;
        }return false;
    }

}

