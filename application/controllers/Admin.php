<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();	
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('email');
		$this->load->library('user_agent');
		$this->load->helper('directory');
		$this->load->helper('cookie');
		$this->load->helper('security');
		$this->load->model('Admin_model');
		$this->load->model('Users_model');
	}
	
	public function index(){
		
		if(!$this->session->userdata('mlab_details'))
		{
			$this->load->view('admin/login');
		}else{
			redirect('dashboard');
		}
	}
	public function loginpost()
	{
		if(!$this->session->userdata('mlab_details'))
		{
			$post=$this->input->post();
			//echo '<pre>';print_r($post);exit;
			$login_deta=array('email'=>$post['email'],'password'=>md5($post['password']));
			$check_login=$this->Admin_model->login_details($login_deta);
				$this->load->helper('cookie');

			if(isset($post['remember_me']) && $post['remember_me']==1){
					$usernamecookie = array('name' => 'username', 'value' => $post["email"],'expire' => time()+86500 ,'path'   => '/');
					$passwordcookie = array('name' => 'password', 'value' => $post["password"],'expire' => time()+86500,'path'   => '/');
					$remembercookie = array('name' => 'remember', 'value' => $post["remember_me"],'expire' => time()+86500,'path'   => '/');
					$this->input->set_cookie($usernamecookie);
					$this->input->set_cookie($passwordcookie);
					$this->input->set_cookie($remembercookie);
					$this->load->helper('cookie');
					$this->input->cookie('username', TRUE);
					//echo print_r($usernamecookie);exit;

					}else{
						$this->load->helper('cookie');
						delete_cookie('username');
						delete_cookie('password');
						delete_cookie('remember');
					}
			if(count($check_login)>0){
				$login_details=$this->Admin_model->get_admin_details($check_login['a_id']);
				$this->session->set_userdata('mlab_details',$login_details);
				redirect('dashboard');
			}else{
				$this->session->set_flashdata('error',"Invalid Email Address or Password!");
				redirect('admin');
			}
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('dashboard');
		}
	}
	public function forgotpassword()
	{	
		$this->load->view('admin/forgotpasword');
	}
	
	public function forgotpost(){
		$post=$this->input->post();
		$check_email=$this->Admin_model->check_email_exits($post['email']);
			if(count($check_email)>0){
				
				$data['details']=$check_email;
				$this->load->library('email');
				$this->email->set_newline("\r\n");
				$this->email->set_mailtype("html");
				$this->email->from($post['email']);
				$this->email->to('admin@grfpublishers.org');
				$this->email->subject('forgot - password');
				$body = $this->load->view('email/forgot',$data,TRUE);
				$this->email->message($body);
				$this->email->send();
				$this->session->set_flashdata('success','Check Your Email to reset your password!');
				redirect('admin');

			}else{
				$this->session->set_flashdata('error','The email you entered is not a registered email. Please try again. ');
				redirect('admin');	
			}
		
	}
	
	
}
