<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lists extends CI_Model{

    // $data is an array where are all data for insert, with key => vlaue

    //Create List
    public function create_list($data){
        if($this->bd->insert('lists' , $data)){
            return true;
        } return false;
    }

    //Looking for IDs of lists through the User ID
    public function get_ids_lists($id){
        if ($this->db->get_where('user_list', array('user_id' => $id))) {
            return $query->result();
        } return false;
    }

    //Looking for Lists Table by User ID
    public function get_lists($id){
        $lists = array();
        $res = $this->db->get_ids_lists($id);
        foreach ( $res as $i ) {
            if ($this->db->get_where('lists', array('id' => $i->list_id)))
                {  $lists = $query->result();  }
            else { return false; }
        } return $lists;
    }

    //Update List by ID
    public function update_list($id, $name, $edit_date){
        if (    $this->db->set('name' , $name) &&
                $this->db->set('descrip' , $descrip) &&
                $this->db->set('edit_date' , $edit_date) &&
                $this->db->where('id' , $id) &&
                $this->db->update('lists') )
           {  return true;  }
        return false;
    }

}