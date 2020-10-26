<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	
	public function __construct(){
		parent::__construct();
		$data = array();
		$this->load->model('login_model');

	} 

	// Show login page
    public function index() {
		$this->load->view('login');
    }
    public function admin_login()
    {
        $this->form_validation->set_rules('username','User Name','required');
        $this->form_validation->set_rules('password','User password','required');
    
        if($this->form_validation->run()){
            // grab user input
            $username = $this->security->xss_clean($this->input->post('username'));
            $password = $this->security->xss_clean($this->input->post('password'));
    
			 $data = array(
                'username' => $username,
                'password' => md5($password) 
			);
			
            $run = $this->login_model->login_entry($data);
            if($run)
			{
				$this->session->set_flashdata('login','Login successfully'); 
				redirect(base_url('welcome'));
			}
			else{
				$this->session->set_flashdata('incorrect','Incorrect username or password.'); 
				redirect(base_url('login'));
			}
        }else{
            $this->session->set_flashdata('incorrect','Username and password required'); 
            redirect(base_url('login'));
        }
    }
    
	
    public function logout(){
        unset(
            $_SESSION['username'],
            $_SESSION['logged_in']
        );
        $this->session->sess_destroy();
        redirect(base_url('login'));
    }

}
