<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login_model extends CI_Model {
    
    public function login_entry($data)
    {
        //$this->load->database();   
        $this->db->where('username', $data['username']);
        $this->db->where('password', $data['password']);
        $query = $this->db->get('admin');
        if($query->num_rows()==1){
            $newdata = array(
                    'username'  => $data['username'],
                    'logged_in' => TRUE
            );
        
            $this->session->set_userdata($newdata);
            return true;
        }		
        else
        {
            return false;
        }
    }

}
