<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Model{

    // $data is an array where are all data for insert, with key => vlaue

    //Create User
    public function create_user($data){
        if($this->bd->insert('users' , $data)){
            return true;
        }return false;
    }

    //Looking for User by ID
    public function found_user($id){
        if ($query = $this->db->get_where('users', array('id' => $id))) {
            return $query->result();
        }return false;
    }

    //Search All Users 
    public function get_users(){
        if ($query = $this->db->get('users')) {
            return $query->result();
        }return false;
    }

}

