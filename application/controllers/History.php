<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/Back_end.php');

class History extends Back_end {
	
		public function __construct() 
		{
		parent::__construct();	
		$this->load->model('History_model');
	
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
	public function laborders(){
		if($this->session->userdata('mlab_details'))
			{
			$login_details=$this->session->userdata('mlab_details');
				if($login_details['role']==2){
					$data['order_list']=$this->History_model->get_lab_orders_list($login_details['a_id']);
					//echo '<pre>';print_r($data);exit;
					$this->load->view('lab/order_list',$data);
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
	
}
