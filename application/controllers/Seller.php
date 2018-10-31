<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/Back_end.php');

class Seller extends Back_end {
	
		public function __construct() 
		{
		parent::__construct();	
		$this->load->model('Seller_model');
	
		}
	
	
	public function index(){
		if($this->session->userdata('mlab_details'))
			{
			$login_details=$this->session->userdata('mlab_details');
				if($login_details['role']==1){
					
					$this->load->view('admin/add_seller_lab');
					$this->load->view('admin/footer');
				}else{
					$this->session->set_flashdata('error','You have no permissions');
					redirect('dashboard');
				}

		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	public function addpost(){
		if($this->session->userdata('mlab_details'))
			{
			$login_details=$this->session->userdata('mlab_details');
				if($login_details['role']==1){
					$post=$this->input->post();
					echo '<pre>';print_r($post);exit;
				}else{
					$this->session->set_flashdata('error','You have no permissions');
					redirect('dashboard');
				}

		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
}
