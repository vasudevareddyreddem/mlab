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
	public function edit(){
		if($this->session->userdata('mlab_details'))
			{
			$login_details=$this->session->userdata('mlab_details');
				if($login_details['role']==1){

					$l_id=base64_decode($this->uri->segment(3));
					$data['lab_details']=$this->Seller_model->get_lab_details($l_id);
					$this->load->view('admin/edit_seller_lab',$data);
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
						redirect('seller');
					}
					//qr code generation
					$this->load->library('ciqrcode');
if($this->input->post('discount')==null or $this->input->post('discount')==''){
	$qrvalue=0;

}
else{
	$qrvalue=$this->input->post('discount');
}

$params['data'] ='Discount Percentage:'.$qrvalue ;

$params['level'] = 'H';

$params['size'] = 10;

$params['cachedir'] = FCPATH.'assets/qrcode/';
$path='assets/qrcode/'.time().'.png';

$params['savename'] =FCPATH.$path;


$this->ciqrcode->generate($params);
//end of qr code generation

					$add=array(
					'role'=>2,
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
					'discount_per'=>$this->input->post('discount'),
					'qr_path'=>$path

					);
					$save=$this->Seller_model->save_seller($add);
					if(count($save)>0){
						$this->session->set_flashdata('success','Lab details  successsfully added');
						redirect('seller/lists');

					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('seller');
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
					$details=$this->Seller_model->get_lab_details($post['a_id']);
					if($details['email']!=$post['email']){
						$check_email=$this->Admin_model->check_email_exits($post['email']);
						if(count($check_email)>0){
							$this->session->set_flashdata('error',"Email address already exists. Please another email address.");
							redirect('seller/edit/'.base64_encode($post['a_id']));
						}
					}
					//qr code generation
					$this->load->library('ciqrcode');
if($this->input->post('discount')==null or $this->input->post('discount')==''){
	$qrvalue=0;

}
else{
	$qrvalue=$this->input->post('discount');
}

$params['data'] ='Discount Percentage:'.$qrvalue ;

$params['level'] = 'H';

$params['size'] = 10;

$params['cachedir'] = FCPATH.'assets/qrcode/';
$path='assets/qrcode/'.time().'.png';

$params['savename'] =FCPATH.$path;


$this->ciqrcode->generate($params);
//end of qr code generation
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
					'discount_per'=>$this->input->post('discount'),
					'qr_path'=>$path
					);

						//echo '<pre>';print_r($add);exit;
					$update=$this->Seller_model->update_seller_lab_details($post['a_id'],$add);
					if(count($update)>0){
						$this->session->set_flashdata('success','Lab details successsfully updated');
						redirect('seller/lists');

					}else{
						$this->session->set_flashdata('error',"Technical problem will occurred. Please try again.");
						redirect('seller/edit/'.base64_encode($post['a_id']));
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

					$data['lab_lists']=$this->Seller_model->get_sellers_list($login_details['a_id']);
					$this->load->view('admin/lab_list',$data);
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
							$statusdata= $this->Seller_model->update_seller_lab_details(base64_decode($a_id),$stusdetails);
							if(count($statusdata)>0){
								if($status==1){
								$this->session->set_flashdata('success',"Lab successfully deactivated.");
								}else{
									$this->session->set_flashdata('success',"Lab successfully activated.");
								}
								redirect('seller/lists');
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('seller/lists');
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('seller/lists');
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
							$statusdata= $this->Seller_model->update_seller_lab_details(base64_decode($a_id),$stusdetails);
							if(count($statusdata)>0){
								$this->session->set_flashdata('success',"Lab successfully Deleted.");
								redirect('seller/lists');
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('seller/lists');
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('seller/lists');
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
