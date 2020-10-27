<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		parent::__construct();
		$data = array();
		$this->load->model('user_model');
	} 

	public function index()
	{
		$config = array();
        $config["base_url"] = base_url('welcome/index');
        $config["total_rows"] = $this->user_model->get_count('users');
		$config["per_page"] = 3;
		$config['full_tag_open']="<ul class='pagination'>";
		$config['full_tag_close']="</ul>";
		$config['next_tag_open']="<li class='page-item'>";
		$config['next_tag_close']="</li>";
		$config['prev_tag_open']="<li class='page-item'>";
		$config['prev_tag_close']="</li>";
		$config['num_tag_open']="<li class='page-item'>";
		$config['num_tag_close']="</li>";
		$config['cur_tag_open']="<li class='active'><a>";
		$config['cur_tag_close']="</a></li>";
		
		
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	
		$data["links"] = $this->pagination->create_links();
		$data['users'] = $this->user_model->get_pagination($config["per_page"], $page,'users');
		

		// $data['users'] = $this->user_model->all_users();
		$this->load->view('user',$data);
	}

	public function user_add(){
		$this->load->view('user_add');
	}
	
	public function user_edit($id)
	{
     	$data[0] =  $this->user_model->single_user($id);
		$data['row']  = $data[0][0];
		$this->load->view('user_add',$data);
	}

	public function user_update()
	{
		$editid = $this->input->post('id');
		$this->form_validation->set_rules('name','Name Required','required');
		
		if($editid == '' || $editid == null){
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		}
		$this->form_validation->set_rules('dob','DOB Required','required');
		$this->form_validation->set_rules('status','Status Required','required');
	
		if($this->form_validation->run()){
			$name = $this->security->xss_clean($this->input->post('name'));
			$email = $this->security->xss_clean($this->input->post('email'));
			$dob = $this->security->xss_clean($this->input->post('dob'));
			$status = $this->security->xss_clean($this->input->post('status'));
			$img = $this->security->xss_clean($this->input->post('image'));
		
	
			$image1 = $this->input->post('image1');
			if(!empty($_FILES['image']['name'])){
				// 	echo "notemppty";
				// exit;
				
				if(!empty($image1)){
					unlink("uploads/".$image1);
				}

				$_FILES['file']['name']     = $_FILES['image']['name'];
				$_FILES['file']['type']     = $_FILES['image']['type'];
				$_FILES['file']['tmp_name'] = $_FILES['image']['tmp_name'];
				$_FILES['file']['error']    = $_FILES['image']['error'];
				$_FILES['file']['size']     = $_FILES['image']['size'];
				
				// File upload configuration
				$uploadPath = 'uploads/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				
				// Load and initialize upload library
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				// Upload file to server
				if($this->upload->do_upload('file')){
					// echo "upladed";
					// exit;
					$fileData = $this->upload->data();
					$uploadData['file_name'] = $fileData['file_name'];
					$uploadData['uploaded_on'] = date("Y-m-d H:i:s");
					$imgData = $fileData['file_name'];
			
				}else{
					echo "notuploaded";
					// exit;
				}
			}else{
				$imgData = $image1;			
			}

			$data = array(
				'name' => $name,
				'email' => $email,
				'dob' => $dob,
				'photo' => $imgData,
				'status' => $status	
			);
		
			if($editid){
					
				$run = $this->user_model->user_update($data, $editid);				
				if($run)
				{
					$this->session->set_flashdata('messageadd','User Updated Successfully.'); 
					redirect(base_url("welcome"));
				}
				else{
					$data['row'] = array(
						'errors' => validation_errors(),
						'emailErr' => 'Email Already Exist',
						'id' => $this->security->xss_clean($this->input->post('id')),
						'name' => $this->security->xss_clean($this->input->post('name')),
						'email' => $this->security->xss_clean($this->input->post('email')),
						'dob' => $this->security->xss_clean($this->input->post('dob')),
						'status' => $this->security->xss_clean($this->input->post('status')),
						'photo' => $imgData
					);
					$this->load->view('user_add',$data);
				}
				
			}else{

				$run = $this->user_model->user_add($data);
				if($run)
				{
					$this->session->set_flashdata('messageadd','User Add Successfully.'); 
					redirect(base_url("welcome"));
				}
				else{
					$this->session->set_flashdata('messageadd','Add error.'); 
					redirect(base_url('add'));
				}
			}
		}
		else
		{
			$data['row'] = array(
                'errors' => validation_errors(),
				'id' => $this->security->xss_clean($this->input->post('id')),
				'name' => $this->security->xss_clean($this->input->post('name')),
				'email' => $this->security->xss_clean($this->input->post('email')),
				'dob' => $this->security->xss_clean($this->input->post('dob')),
				'status' => $this->security->xss_clean($this->input->post('status')),
				'photo' => $this->security->xss_clean($this->input->post('image'))
			);
			$this->load->view('user_add',$data);
		}
	}

	public function user_del($id){
		$run = $this->user_model->single_user($id);
		foreach($run as $data){
			$dimg = $data['photo'];
		}
		// echo $dimg;
		// exit();
		$run = $this->user_model->user_del($id);
		if($run){
			if(!empty($dimg)){
				unlink("uploads/".$dimg);
			}
			$this->session->set_flashdata('message','User Deleted Successfully');
			redirect(base_url("welcome"));
		}else{
			$this->session->set_flashdata('message','Delete error');
			redirect(base_url("welcome"));
		}

	}
}
