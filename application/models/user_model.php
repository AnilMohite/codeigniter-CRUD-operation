<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user_model extends CI_Model {

	public function index()
	{
		
    }
    
    public function all_users()
    {    
        $query = $this->db->get('users');
        return $query->result_array();
    }
    public function user_add($data)
    {    
        return $this->db->insert('users', $data);
    }
    public function single_user($id){	   
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $run = $query->result_array();
    }
    public function user_del($id){
        $this->db->where('id', $id);
        return $run =  $this->db->delete('users');
    }
    public function user_update($data,$id){
        $this->db->where('id', $id);
        $run =  $this->db->update('users', $data);
        if($run)
            return true;	
        else
            return false;  
    }

    //for pagination
    public function get_count($table) {
        return $this->db->count_all($table);
    }

    public function get_pagination($limit, $start,$table) {
        $this->db->limit($limit, $start);
        $this->db->order_by('id','desc');
        $query = $this->db->get($table);

        return $query->result_array();
    }
}
