<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_list extends CI_Model{

    // $data is an array where are all data for insert, with key => vlaue

    //Create Relation List with user_list.
    public function create_link($data){
        if ($this->db->insert('user_list' , $data)) {
            return true;
        } return false;
    }

    //Looking for IDs of lists through the User ID (column is user_id or list_id)
    public function get_link($column, $id){
        if ($query = $this->db->get_where('user_list', array($column => $id))) {
            return $query->result();
        } return false;
    }
}