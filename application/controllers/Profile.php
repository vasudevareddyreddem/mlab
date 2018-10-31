<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/Back_end.php');

class Profile extends Back_end {

	public function __construct() 
	{
		parent::__construct();	
		
	}
	public function index()
	{
		if($this->session->userdata('mlab_details'))
		{
			$mlab_details=$this->session->userdata('mlab_details');
			$data['details']=$this->Admin_model->get_admin_details($mlab_details['a_id']);
			//echo '<pre>';print_r($data);exit;
			$this->load->view('admin/profile');
			$this->load->view('admin/footer');

		}else{
			$this->session->set_flashdata('loginerror','Please login to continue');
			redirect('admin');
		}
	}
	public function edit()
	{
		if($this->session->userdata('mlab_details'))
		{
			$admindetails=$this->session->userdata('mlab_details');
			$data['userdetails']=$this->Admin_model->get_admin_details($admindetails['a_id']);
			$this->load->view('admin/edit-profile',$data);
			$this->load->view('admin/footer');

		}else{
			$this->session->set_flashdata('loginerror','Please login to continue');
			redirect('admin');
		}
	}
	public function editpost()
	{
		if($this->session->userdata('mlab_details'))
		{
			$admindetails=$this->session->userdata('mlab_details');
			$post=$this->input->post();
			//echo '<pre>';print_r($post);exit;
			$userdetails=$this->Admin_model->get_admin_details($admindetails['a_id']);
			if($userdetails['email']!=$post['email']){
				
				$check_email=$this->Admin_model->check_email_exits($post['email']);
				if(count($check_email)>0){
					$this->session->set_flashdata('error',"Email address already exists. Please another email address.");
					redirect('profile/edit');
				}
			}
				if(isset($_FILES['image']['name']) && $_FILES['image']['name']!=''){
						if($userdetails['profile_pic']!=''){
						unlink('assets/profile_pic/'.$userdetails['profile_pic']);
						}
							$temp = explode(".", $_FILES["image"]["name"]);
							$image = round(microtime(true)) . '.' . end($temp);
							move_uploaded_file($_FILES['image']['tmp_name'], "assets/profile_pic/" . $image);
						}else{
							$image=$userdetails['profile_pic'];
						}
					$updatedetails=array(
					'name'=>isset($post['name'])?$post['name']:'',
					'email'=>isset($post['email'])?$post['email']:'',
					'mobile'=>isset($post['mobile'])?$post['mobile']:'',
					'address1'=>isset($post['address1'])?$post['address1']:'',
					'address2'=>isset($post['address2'])?$post['address2']:'',
					'city'=>isset($post['city'])?$post['city']:'',
					'state'=>isset($post['state'])?$post['state']:'',
					'zipcode'=>isset($post['zipcode'])?$post['zipcode']:'',
					'profile_pic'=>$image,
					);
					
				
				
			$profile_update=$this->Admin_model->update_profile_details($post['a_id'],$updatedetails);
			if(count($profile_update)>0){
				$this->session->set_flashdata('success','Profile Details successfully Updated');
				redirect('profile');
				
			}else{
				$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
				redirect('profile/edit');
			}
		}else{
			$this->session->set_flashdata('loginerror','Please login to continue');
			redirect('admin');
		}
	}
	public function changepassword()
	{
		if($this->session->userdata('mlab_details'))
		{
				$this->load->view('admin/changepassword');
				$this->load->view('admin/footer');
			
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
			if($admin_details['password']== md5($post['oldpassword'])){
				if(md5($post['password'])== md5($post['confirmpassword'])){
						$updateuserdata=array(
						'password'=>md5($post['confirmpassword']),
						'org_password'=>$post['confirmpassword'],
						'updated_at'=>date('Y-m-d H:i:s'),
						);
						//echo '<pre>';print_r($updateuserdata);exit;
						$upddateuser = $this->Admin_model->update_profile_details($admindetails['a_id'],$updateuserdata);
						if(count($upddateuser)>0){
							$this->session->set_flashdata('success',"Password successfully updated");
							redirect('profile');
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('profile/changepassword');
						}
					
				}else{
					$this->session->set_flashdata('error',"Password and Confirm Password not matched");
					redirect('profile/changepassword');
				}
				
			}else{
				$this->session->set_flashdata('error',"Old Password not matched");
				redirect('profile/changepassword');
			}
				
			
		}else{
			 $this->session->set_flashdata('error','Please login to continue');
			 redirect('');
		} 
	 
	}
	
	
	
	
	
}
