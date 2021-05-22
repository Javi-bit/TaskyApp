<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subtask_model extends CI_Model{

    // $data is an array where are all data for insert, with key => vlaue

    //Create SubTask
    public function create_subtask($data){
        if($this->bd->insert('subtasks' , $data)){
            return true;
        }return false;
    }

    //Looking for SubTasks by Task ID
    public function get_subtasks($id){
        if ($query = $this->db->get_where('subtasks', array('task_id' => $id))) {
            return $query->result();
        }return false;
    }

    //Looking for SubTask by SubTask ID
    public function found_subtask($id){
        if ($query = $this->db->get_where('subtasks', array('id' => $id))) {
            return $query->result();
        }return false;
    }

    //Update SubTask by ID
    public function update_subtask($id, $name, $descrip, $colour, $state, $edit_date){
        if (    $this->db->set('name' , $name) &&
                $this->db->set('descrip' , $descrip) &&
                $this->db->set('colour' , $colour) &&
                $this->db->set('state' , $state) &&
                $this->db->set('edit_date' , $edit_date) &&
                $this->db->where('id' , $id) &&
                $this->db->update('subtasks') )
           {  return true;  }
        return false;
    }

    //Sort subtasks by Task ID (column => dates or another | type: DESC or ASC)
    public function get_sort_subtasks($id , $column , $type){
        $this->db->order_by($column , $type);
        if ($query = $this->db->get_where('subtasks', array('task_id' => $id))) {
            return $query->result();
        }return false;
    }

}


