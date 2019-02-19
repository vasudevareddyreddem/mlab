<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/Back_end.php');

class Pharmacy extends Back_end {

		public function __construct()
		{
		parent::__construct();
		$this->load->model('Pharmacy_model');

		}


	public function index(){
		if($this->session->userdata('mlab_details'))
			{
			$login_details=$this->session->userdata('mlab_details');
				if($login_details['role']==1){

					$this->load->view('admin/pharmacy_add');
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
	public function edit(){
		if($this->session->userdata('mlab_details'))
			{
			$login_details=$this->session->userdata('mlab_details');
				if($login_details['role']==1){

					$l_id=base64_decode($this->uri->segment(3));
					$data['pharmacy_details']=$this->Pharmacy_model->get_Pharmacy_details($l_id);
					$this->load->view('admin/edit_pharmacy',$data);
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
					$check_email=$this->Admin_model->check_email_exits($post['email']);
					if(count($check_email)>0){
						$this->session->set_flashdata('error',"Email address already exists. Please another email address.");
						redirect('pharmacy');
					}
					$add=array(
					'role'=>3,
					'name'=>isset($post['name'])?$post['name']:'',
					'email'=>isset($post['email'])?$post['email']:'',
					'mobile'=>isset($post['mobile'])?$post['mobile']:'',
					'altmobile'=>isset($post['altmobile'])?$post['altmobile']:'',
					'gstin'=>isset($post['gstin'])?$post['gstin']:'',
					'address1'=>isset($post['address'])?$post['address']:'',
					'address2'=>isset($post['address2'])?$post['address2']:'',
					'city'=>isset($post['city'])?$post['city']:'',
					'state'=>isset($post['state'])?$post['state']:'',
					'zipcode'=>isset($post['pincode'])?$post['pincode']:'',
					'country'=>isset($post['country'])?$post['country']:'',
					'accrediations'=>isset($post['accrediations'])?$post['accrediations']:'',
					'commission_amt'=>isset($post['commission_amt'])?$post['commission_amt']:'',
					'password'=>isset($post['confirmPassword'])?md5($post['confirmPassword']):'',
					'org_password'=>isset($post['confirmPassword'])?$post['confirmPassword']:'',
					'created_at'=>date('Y-m-d H:i:s'),
					'updated_at'=>date('Y-m-d H:i:s'),
					'created_by'=>$login_details['a_id'],

					
					);
					$save=$this->Pharmacy_model->save_pharmacy($add);
					if(count($save)>0){
						$this->session->set_flashdata('success','Pharmacy Details successfully Updated');
						redirect('pharmacy/lists');

					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('pharmacy');
					}
					//echo '<pre>';print_r($post);exit;
				}else{
					$this->session->set_flashdata('error','You have no permissions');
					redirect('dashboard');
				}

		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	public function editpost(){
		if($this->session->userdata('mlab_details'))
			{
			$login_details=$this->session->userdata('mlab_details');
				if($login_details['role']==1){
					$post=$this->input->post();
					//echo '<pre>';print_r($post);
					$details=$this->Pharmacy_model->get_pharmacy_details($post['a_id']);
					if($details['email']!=$post['email']){
						$check_email=$this->Admin_model->check_email_exits($post['email']);
						if(count($check_email)>0){
							$this->session->set_flashdata('error',"Email address already exists. Please another email address.");
							redirect('pharmacy/edit/'.base64_encode($post['a_id']));
						}
					}
					$add=array(
					'name'=>isset($post['name'])?$post['name']:'',
					'email'=>isset($post['email'])?$post['email']:'',
					'mobile'=>isset($post['mobile'])?$post['mobile']:'',
					'altmobile'=>isset($post['altmobile'])?$post['altmobile']:'',
					'gstin'=>isset($post['gstin'])?$post['gstin']:'',
					'address1'=>isset($post['address'])?$post['address']:'',
					'city'=>isset($post['city'])?$post['city']:'',
					'state'=>isset($post['state'])?$post['state']:'',
					'zipcode'=>isset($post['pincode'])?$post['pincode']:'',
					'country'=>isset($post['country'])?$post['country']:'',
					'accrediations'=>isset($post['accrediations'])?$post['accrediations']:'',
					'commission_amt'=>isset($post['commission_amt'])?$post['commission_amt']:'',
					'updated_at'=>date('Y-m-d H:i:s'),
					'created_by'=>$login_details['a_id'],
					);
						//echo '<pre>';print_r($add);exit;
					$update=$this->Pharmacy_model->update_seller_pharmacy_details($post['a_id'],$add);
					if(count($update)>0){
						$this->session->set_flashdata('success','Pharmacy Details successfully Updated');
						redirect('pharmacy/lists');

					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('pharmacy/edit/'.base64_encode($post['a_id']));
					}
					//echo '<pre>';print_r($post);exit;
				}else{
					$this->session->set_flashdata('error','You have no permissions');
					redirect('dashboard');
				}

		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	public function lists(){
		if($this->session->userdata('mlab_details'))
			{
			$login_details=$this->session->userdata('mlab_details');
				if($login_details['role']==1){

					$data['pharmacy_details']=$this->Pharmacy_model->get_all_pharmacy_details($login_details['a_id']);
					$this->load->view('admin/pharmacy_list',$data);
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
	public function status()
	{
		if($this->session->userdata('mlab_details'))
		{
			$admindetails=$this->session->userdata('mlab_details');
			//echo '<pre>';print_r($admindetails);exit;
			if($admindetails['role']==1){
					$a_id=$this->uri->segment(3);
					$status=base64_decode($this->uri->segment(4));
					if($status==1){
						$statu=0;
					}else{
						$statu=1;
					}
					if($a_id!=''){
						$stusdetails=array(
							'status'=>$statu,
							'updated_at'=>date('Y-m-d H:i:s')
							);
							$statusdata= $this->Pharmacy_model->update_seller_pharmacy_details(base64_decode($a_id),$stusdetails);
							if(count($statusdata)>0){
								if($status==1){
								$this->session->set_flashdata('success',"Pharmacy successfully deactivated.");
								}else{
									$this->session->set_flashdata('success',"Pharmacy successfully activated.");
								}
								redirect('pharmacy/lists');
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('pharmacy/lists');
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('pharmacy/lists');
					}

			}else{
					$this->session->set_flashdata('error',"You have no permission to access");
					redirect('dashboard');
			}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	public function deletes()
	{
		if($this->session->userdata('mlab_details'))
		{
			$admindetails=$this->session->userdata('mlab_details');
			//echo '<pre>';print_r($admindetails);exit;
			if($admindetails['role']==1){
					$a_id=$this->uri->segment(3);
					if($a_id!=''){
						$stusdetails=array(
							'status'=>2,
							'updated_at'=>date('Y-m-d H:i:s')
							);
							$statusdata= $this->Pharmacy_model->update_seller_pharmacy_details(base64_decode($a_id),$stusdetails);
							if(count($statusdata)>0){
								$this->session->set_flashdata('success',"Pharmacy successfully Deleted.");
								redirect('pharmacy/lists');
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('pharmacy/lists');
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('pharmacy/lists');
					}

			}else{
					$this->session->set_flashdata('error',"You have no permission to access");
					redirect('dashboard');
			}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
}
