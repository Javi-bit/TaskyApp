<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lists_model extends CI_Model{

    // $data is an array where are all data for insert, with key => vlaue

    //Create List and link with user_list.
    public function create_list($data){
        if( $this->db->insert('lists', $data) ){
            return $this->db->insert_id();
        } return false;
    }

    //Looking for IDs of lists through the User ID (column is user_id or list_id)
    public function get_link($column, $id){
        if ($query = $this->db->get_where('user_list', array($column => $id))) {
            return $query->result();
        } return false;
    }

    //Looking for Lists Table by User ID
    public function get_lists($id){
        $lists = array();
        $res = $this->get_link('user_id' , $id);    
        $cont = 0;
        foreach ( $res as $i ) {
            $query = $this->db->get_where('lists', array('id' => $i->list_id));
            $lists[$cont] = $query->row();
            $cont++;
        } return $lists;
    }

    //Update List by ID
    public function update_list($id, $name, $descrip, $edit_date){
        if (    $this->db->set('name' , $name) &&
                $this->db->set('descrip' , $descrip) &&
                $this->db->set('edit_date' , $edit_date) &&
                $this->db->where('id' , $id) &&
                $this->db->update('lists') )
           {  return true;  }
        return false;
    }

    //Create Relation List with user_list.
    public function create_link($data){
        if ($this->db->insert('user_list' , $data)) {
            return true;
        } return false;
    }

    //Looking for List by ID
    public function found_list($id){
        if ($query = $this->db->get_where('lists', array('id' => $id))) {
            return $query->row();
        }return false;
    }

    //Delete Lists by ID
    public function delete_list($id, $tasks){
        foreach ($tasks as $i)
        {       $this->db->where('task_id' , $i->id);
                $this->db->delete('subtasks');          }
        if ($this->db->where('list_id' , $id) && $this->db->delete('tasks') &&
            $this->db->where('list_id' , $id) && $this->db->delete('user_list') && 
            $this->db->where('id' , $id) && $this->db->delete('lists')) {
            return true;
        }return false;
    }


}