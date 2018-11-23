<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/Back_end.php');

class Dashboard extends Back_end {

	public function __construct() 
	{
		parent::__construct();	
		
	}
	public function index()
	{
		if($this->session->userdata('mlab_details'))
		{
			$login_detail=$this->session->userdata('mlab_details');
			if($login_detail['role']==1){
				$data['lab_list']=$this->Admin_model->get_lab_total_list($login_detail['a_id']);	
				$data['pharmacy_list']=$this->Admin_model->get_pharmacy_total_list($login_detail['a_id']);	
				$data['total_lab_list']=$this->Admin_model->get_all_lab_total_list($login_detail['a_id']);	
				$data['total_pharmacy_list']=$this->Admin_model->get_all_pharmacy_total_list($login_detail['a_id']);	
				//echo '<pre>';print_r($data);exit;
				$this->load->view('admin/dashboard',$data);
			}else if($login_detail['role']==2){
				$data['total_orders']=$this->Admin_model->get_total_lab_orders($login_detail['a_id']);
				$data['total_received_orders']=$this->Admin_model->get_total_received_lab_orders($login_detail['a_id']);
				$data['total_reject_orders']=$this->Admin_model->get_total_reject_lab_orders($login_detail['a_id']);
				//echo '<pre>';print_r($data);exit;
				$this->load->view('lab/dashboard',$data);
			}
			$this->load->view('admin/footer');

		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	public function profile()
	{
		if($this->session->userdata('mlab_details'))
		{
			$admindetails=$this->session->userdata('mlab_details');
			$data['mlab_details']=$this->Admin_model->get_admin_details($admindetails['a_id']);
			$this->load->view('admin/profile',$data);
			$this->load->view('admin/footer');

		}else{
			$this->session->set_flashdata('loginerror','Please login to continue');
			redirect('admin');
		}
	}
	public function changepassword()
	{
		if($this->session->userdata('mlab_details'))
		{
			$admindetails=$this->session->userdata('mlab_details');
				$this->load->view('html/changepassword');
				$this->load->view('html/footer');
			
		}else{
			$this->session->set_flashdata('loginerror','Please login to continue');
			redirect('admin');
		}
	}
	public function changepasswordpost(){
	 
		if($this->session->userdata('mlab_details'))
		{
			$admindetails=$this->session->userdata('mlab_details');
			$post=$this->input->post();
			$admin_details = $this->Admin_model->get_adminpassword_details($admindetails['a_id']);
			if($admin_details['a_password']== md5($post['oldpassword'])){
				if(md5($post['password'])==md5($post['confirmpassword'])){
						$updateuserdata=array(
						'a_password'=>md5($post['confirmpassword']),
						'a_org_password'=>$post['confirmpassword'],
						'a_updated_at'=>date('Y-m-d H:i:s'),
						);
						//echo '<pre>';print_r($updateuserdata);exit;
						$upddateuser = $this->Admin_model->update_admin_details($admindetails['a_id'],$updateuserdata);
						if(count($upddateuser)>0){
							$this->session->set_flashdata('success',"password successfully updated");
							redirect('dashboard/changepassword');
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('dashboard/changepassword');
						}
					
				}else{
					$this->session->set_flashdata('error',"Password and Confirm password are not matched");
					redirect('dashboard/changepassword');
				}
				
			}else{
				$this->session->set_flashdata('error',"Old password are not matched");
				redirect('dashboard/changepassword');
			}
				
			
		}else{
			 $this->session->set_flashdata('error','Please login to continue');
			 redirect('');
		} 
	 
	}
	public function logout(){
		$admindetails=$this->session->userdata('mlab_details');
		$userinfo = $this->session->userdata('mlab_details');
        $this->session->unset_userdata($userinfo);
		$this->session->sess_destroy('mlab_details');
		$this->session->unset_userdata('mlab_details');
        redirect('admin');
	}
	
	
	
	
	
}
