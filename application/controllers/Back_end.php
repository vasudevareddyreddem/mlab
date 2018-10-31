<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Back_end extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();	
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('email');
		$this->load->library('user_agent');
		$this->load->helper('directory');
		$this->load->helper('security');
		$this->load->model('Admin_model');
	
			if($this->session->userdata('mlab_details'))
			{
				$mlab_details=$this->session->userdata('mlab_details');
				$data['mlab_details']=$this->Admin_model->get_admin_details($mlab_details['a_id']);
				$this->load->view('admin/header',$data);
				$this->load->view('admin/sidebar',$data);
				//$this->load->view('admin/footer');
			}
		}
	
}
