<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task_model extends CI_Model{

    // $data is an array where are all data for insert, with key => vlaue

    //Create Task
    public function create_task($data){
        if($this->bd->insert('tasks' , $data)){
            return true;
        }return false;
    }

    //Looking for Tasks by List ID
    public function get_tasks($id){
        if ($query = $this->db->get_where('tasks', array('list_id' => $id))) {
            return $query->result();
        }return false;
    }

    //Looking for Task by Task ID
    public function found_task($id){
        if ($query = $this->db->get_where('tasks', array('id' => $id))) {
            return $query->row();
        }return false;
    }

    //Update Task by ID
    public function update_task($id, $name, $descrip, $priori, $expir, $memo, $colour, $state, $edit_date){
        if (    $this->db->set('name' , $name) &&
                $this->db->set('descrip' , $descrip) &&
                $this->db->set('priori' , $priori) &&
                $this->db->set('expir' , $expir) &&
                $this->db->set('memo' , $memo) &&
                $this->db->set('colour' , $colour) &&
                $this->db->set('state' , $state) &&
                $this->db->set('edit_date' , $edit_date) &&
                $this->db->where('id' , $id) &&
                $this->db->update('tasks') )
           {  return true;  }
        return false;
    }

    //Sort tasks by User ID (column => dates or Priori or another | type: DESC or ASC)
    public function get_sort_tasks($id , $column , $type){
        $this->db->order_by($column , $type);
        if ($query = $this->db->get_where('tasks', array('list_id' => $id))) {
            return $query->result();
        }return false;
    }

}