<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//@include_once( APPPATH . 'controllers/Back_end.php');

class Pharmacyadmin extends  CI_Controller {


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
			$this->load->view('pharmacy/header',$data);
			$this->load->view('pharmacy/sidebar',$data);
			//$this->load->view('admin/footer');
		}

	$this->load->model('Pharmacy_model1');
		}
    public function index(){
			if($this->session->userdata('mlab_details'))
	{
		$admin=$this->session->userdata('mlab_details');
	$res=$this->Pharmacy_model1->no_of_orders($admin['a_id']);
	if(count($res)>0){
		$data['rorders']=count($res);
	}
	else{
		$data['rorders']=0;
	}
	$res=$this->Pharmacy_model1->orders_dispatched($admin['a_id']);
	if(count($res)>0){
		$data['dorders']=count($res);
	}
	else{
		$data['dorders']=0;
	}
	$res=$this->Pharmacy_model1->total_amount($admin['a_id']);

		$data['amt']=$res['tot'];



      $this->load->view('pharmacy/dashboard',$data);
      $this->load->view('pharmacy/footer');
		}
		else{
			redirect('login');
		}

    }
		public function orders(){
			if($this->session->userdata('mlab_details'))
			{
				$admin=$this->session->userdata('mlab_details');
				$res=$this->Pharmacy_model1->get_user_orders($admin['a_id']);
				//echo '<pre>';print_r($res);exit;
				if(count($res)>0){
					$data['list']=$res;
					$data['status']=1;

				}else{
				$data['status']=0;
				}
				$this->load->view('pharmacy/view-orders',$data);
				$this->load->view('pharmacy/footer');
			}else{
			redirect('login');
			}

		}
		public function rejectedorders(){
			if($this->session->userdata('mlab_details'))
			{
				$admin=$this->session->userdata('mlab_details');
				$res=$this->Pharmacy_model1->get_user_rejected_orders($admin['a_id']);
				//echo '<pre>';print_r($res);exit;
				if(count($res)>0){
					$data['list']=$res;
					$data['status']=1;

				}else{
				$data['status']=0;
				}
				$this->load->view('pharmacy/reject-orders',$data);
				$this->load->view('pharmacy/footer');
			}else{
			redirect('login');
			}

		}
		public function upload_medicine(){
			if($this->session->userdata('mlab_details'))
	{
			$this->load->view('pharmacy/upload-medicine');
			$this->load->view('pharmacy/footer');
		}
		else{
			redirect('login');
		}

		}
		public function dispatch_medicine(){
			if($this->session->userdata('mlab_details'))
	{
            $admin=$this->session->userdata('mlab_details');
			$res=$this->Pharmacy_model1->ready_to_dispatch($admin['a_id']);
			//echo '<pre>';print_r($res);exit;
			if(count($res)>0){
				$data['status']=1;
				$data['list']=$res;
			}
			else{
				$data['status']=0;
			}
			$this->load->view('pharmacy/dispatch-medicine',$data);
			$this->load->view('pharmacy/footer');
		}
		else{
			redirect('login');
		}

		}
		public function history(){
			if($this->session->userdata('mlab_details'))
	{
		$admin=$this->session->userdata('mlab_details');
		$res=$this->Pharmacy_model1->history($admin['a_id']);
		//echo '<pre>';print_r($res);exit;
		if(count($res)>0){
		$data['status']=1;
		$data['list']=$res;
		}
		else{
		$data['status']=0;
		}
			$this->load->view('pharmacy/history',$data);
			$this->load->view('pharmacy/footer');
		}
		else{
			redirect('login');
		}

		}
		public function ins_med(){
			if($this->session->userdata('mlab_details'))
	{
		$admin=$this->session->userdata('mlab_details');
			$hsn=$this->input->post('hsn');
			$mfr=$this->input->post('mfr');
			$mname=$this->input->post('mname');
			$mtype=$this->input->post('mtype');
			$exp=$this->input->post('exp');
			$dos=$this->input->post('dos');
			$qty=$this->input->post('qty');
			$rate=$this->input->post('rate');
			$cgst=$this->input->post('cgst');
			$sgst=$this->input->post('sgst');
			$mrp=$this->input->post('mrp');
			//echo '<pre>';print_r($mname);exit;
			$cnt=count($mname);
			$data=array();
			$dup=array();
			  for($i=0;$i<$cnt;$i++){
					 for($j=0;$j<$cnt;$j++){

						 if($i==$j){

						 }
						 else{
							  if(isset($mname[$j])){

						 if($mname[$i]==$mname[$j]){
							 unset($mname[$i]);
							  unset($hsn[$i]);
								unset($mfr[$i]);
								 unset($mtype[$i]);
								 unset($exp[$i]);
								 unset($dos[$i]);
								 unset($qty[$i]);
								 unset($rate[$i]);
								 unset($cgst[$i]);
								 unset($sgst[$i]);
								 unset($mrp[$i]);


							 break;

						 }
					 }
}
					 }
					 if(isset($mname[$i])){

						$res=$this->Pharmacy_model1->check_medicine($mname[$i],$dos[$i]);
						if(count($res)>0){
							$dup[]=array('med'=>$mname[$i],'dos'=>$dos[$i]);
						}
						else{
					 $data[]=array('medicine_name'=>$mname[$i],
				 'medicine_type'=>$mtype[$i],
				 'expiry_date'=>$exp[$i],
			 'dosage'=>$dos[$i],
		 'quantity'=>$qty[$i],
		 'rate'=>$rate[$i],
	 'mrp'=>$mrp[$i],
	 'sgst'=>$sgst[$i],
	'cgst'=>$cgst[$i],
	'hsn'=>$hsn[$i],
	'mfr'=>$mfr[$i],
	'status'=>1,
	'created_date'=>date('Y-m-d H:i:s'),
	'created_by'=>$admin['a_id'],
);
}
}
				}
				if(count($data)>0){
			$res=$this->Pharmacy_model1->ins_medicine($data);
			$da['dup']=$dup;
			if($res==1){
          if(count($dup)>0){
				$this->load->view('pharmacy/upload-medicine',$da);
				$this->load->view('pharmacy/footer');
				exit;
			}
			else{
					$this->session->set_flashdata('success',"Medicines list uploaded successfully");
				redirect('pharmacyadmin/medicine_list');
			}

			}
			else{
			$this->session->set_flashdata('error',"Medicines are not uploaded try once again");
			$this->load->view('pharmacy/upload-medicine');
			$this->load->view('pharmacy/footer');
			exit;
		}
	}
	else{
		$da['dup']=$dup;
		$this->load->view('pharmacy/upload-medicine',$da);
		$this->load->view('pharmacy/footer');
	}
}
else{
	redirect('login');
}




		}

public function medicine_list(){

	if($this->session->userdata('mlab_details'))
{
		$admin=$this->session->userdata('mlab_details');
$res=$this->Pharmacy_model1->get_medicines($admin['a_id']);
if(count($res)>0){
	$data['status']=1;
	$data['mlist']=$res;

}
else{
	$data['status']=0;

}
$this->load->view('pharmacy/medicine_list',$data);
$this->load->view('pharmacy/footer');
}
else{
	redirect('login');
}
}
public function edit_medicine(){
		if($this->session->userdata('mlab_details'))
{

	$id=base64_decode($this->uri->segment(3));
$data['med']=$this->Pharmacy_model1->get_medicine_det($id);
if(count($data['med'])>0){
	$this->load->view('pharmacy/edit_medicine',$data);
	$this->load->view('pharmacy/footer');

}
else{
	$this->session->set_flashdata('error',"This medicine deleted by another User");
	redirect($_SERVER['HTTP_REFERER']);
}
}
else{
	redirect('login');
}

}
public function insert_edit_med(){
	if($this->session->userdata('mlab_details'))
{
$id=base64_decode($this->input->post('id'));
$hsn=$this->input->post('hsn');
$mfr=$this->input->post('mfr');
$mname=$this->input->post('mname');
$mtype=$this->input->post('mtype');
$exp=$this->input->post('exp');
$dos=$this->input->post('dos');
$qty=$this->input->post('qty');
$rate=$this->input->post('rate');
$cgst=$this->input->post('cgst');
$sgst=$this->input->post('sgst');
$mrp=$this->input->post('mrp');
$data=array('medicine_name'=>$mname,
'medicine_type'=>$mtype,
'expiry_date'=>$exp,
'dosage'=>$dos,
'quantity'=>$qty,
'rate'=>$rate,
'mrp'=>$mrp,
'sgst'=>$sgst,
'cgst'=>$cgst,
'hsn'=>$hsn,
'mfr'=>$mfr,

'updated_date'=>date('Y-m-d H:i:s'),
'updated_by'=>1,
);
$res=$this->Pharmacy_model1->save_edit_medicines($id,$data);
if($res==1){
	$this->session->set_flashdata('success',"Medicine Details Updated successfully");
	redirect('pharmacyadmin/medicine_list');

}
else{
	$this->session->set_flashdata('error',"Medicine Details Not Updated");
	redirect('pharmacyadmin/edit_medicine/'.base64_encode($id));

}
}
else{
	redirect('login');
}


}
public function accept_order(){
	if($this->session->userdata('mlab_details'))
{
	$id=base64_decode($this->uri->segment(3));

$data['id']=$id;
    $res=$this->Pharmacy_model1->check_order($id);
		if(count($res)>0){

		}
		else{
				redirect('pharmacyadmin/orders');
		}


	$pid=1;
	$res=$this->Pharmacy_model1->medicine_list($pid);
	if(count($res)>0){
		$data['status']=1;
		$data['mlist']=$res;
		$data['jmlist']=json_encode($res);

	}
	else{
		$data['status']=0;
	}

		$this->load->view('pharmacy/billing',$data);
		$this->load->view('pharmacy/footer');
	}
	else{
		redirect('login');
	}


}
public function add_billing(){
	if($this->session->userdata('mlab_details'))
{
	$admin=$this->session->userdata('mlab_details');
	$med=$this->input->post('medicine');
	$price=$this->input->post('price');
	$qty=$this->input->post('qty');
	$dis=$this->input->post('discount');
	$tot=$this->input->post('total');
	$date=$this->input->post('date');
$id=base64_decode($this->input->post('order_id'));
	//$med=$this->input->post('medicine');
	$data=array();
	if($med){
	foreach($med as $key=>$val){
		$data[]=array('med_id'=>$val,
									'del_date'=>$date,
									'cust_order_id'=>$id,
								'unit_price'=>$price[$key],
							'quantity'=>$qty[$key],
							'discount'=>$dis[$key],
							'total'=>$tot[$key],
							'status'=>1,
							'created_by'=>$admin['a_id'],
							'created_date'=>date('Y-m-d H:i:s'));

	}
}
else{
	$this->session->set_flashdata('error',"Enter Medicine name");
	redirect('pharmacyadmin/orders');

}
	$res=$this->Pharmacy_model1->accept_order($data);
	$data1=array();
	if($res==1){
		$id=base64_decode($this->input->post('order_id'));
			$data1=array('status'=>2,
		'updated_by_admin'=>1,
		'updated_date'=>date('Y-m-d H:i:s')
		);
	$res=$this->Pharmacy_model1->user_order_accept($data1,$id);
	if($res==1){
		$this->session->set_flashdata('success',"order added successfully");
		redirect('pharmacyadmin/orders');
	}
	$this->session->set_flashdata('error',"This order not added try again");
	redirect('pharmacyadmin/orders');


	}
}
else{
	redirect('login');
}


}
public function cancel_order(){
	if($this->session->userdata('mlab_details'))
{
	$id=base64_decode($this->uri->segment(3));
	$data1=array('status'=>3,
'updated_by_admin'=>1,
'updated_date'=>date('Y-m-d H:i:s')
);
$res=$this->Pharmacy_model1->user_order_accept($data1,$id);
if($res==1){
	$this->session->set_flashdata('success',"order added successfully");
	redirect('pharmacyadmin/orders');
}
$this->session->set_flashdata('error',"This order not added try again");
redirect('pharmacyadmin/orders');
}
else{
	redirect('admin');
}


}
public function med_del(){
	if($this->session->userdata('mlab_details'))
{
	$id=base64_decode($this->uri->segment(3));
	$data=array('updated_date'=>date('Y-m-d H:i:s'),
							'status'=>0,
						'updated_by'=>1);
						$res=$this->Pharmacy_model1->delete_medicine($data,$id);
						if($res==1){
							$this->session->set_flashdata('success',"order added successfully");
							redirect('pharmacyadmin/medicine_list');
						}
						$this->session->set_flashdata('error',"This order not added try again");
						redirect('pharmacyadmin/medicine_list');

}
else{
	redirect('admin');
}
}
public function dispatch_order(){
	if($this->session->userdata('mlab_details'))
{
	$admin=$this->session->userdata('mlab_details');
	$id=base64_decode($this->uri->segment(3));
	$data=array('status'=>2,
'updated_by'=>$admin['a_id'],
'updated_date'=>date('Y-m-d H:i:s')
);
	$res=$this->Pharmacy_model1->dispatch_order($data,$id);
	if($res==1){
		$this->session->set_flashdata('success',"order added successfully");
		redirect('pharmacyadmin/dispatch_medicine');
	}
	$this->session->set_flashdata('error',"This order not added try again");
	redirect('pharmacyadmin/dispatch_medicine');

}
else{
	redirect('admin');
}


}
public function profile(){
	if($this->session->userdata('mlab_details'))
{
	$mlab_details=$this->session->userdata('mlab_details');
	$data['mlab_details']=$mlab_details;
	//$data['details']=$this->Pharmacy_model->get_admin_details($mlab_details['a_id']);
	//echo '<pre>';print_r($data);exit;
	$this->load->view('pharmacy/profile',$data);
	$this->load->view('pharmacy/footer');

}else{
	$this->session->set_flashdata('loginerror','Please login to continue');
	redirect('admin');
}

}
public function profileedit()
{
	if($this->session->userdata('mlab_details'))
	{
		$admindetails=$this->session->userdata('mlab_details');
		$data['mlab_details']=$this->Pharmacy_model1->get_admin_details($admindetails['a_id']);
		$this->load->view('pharmacy/edit-profile',$data);
		$this->load->view('pharmacy/footer');

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
		//echo '<pre>';print_r($post);
		$userdetails=$this->Admin_model->get_admin_details($admindetails['a_id']);
		if($userdetails['email']!=$post['email']){

			$check_email=$this->Admin_model->check_email_exits($post['email']);
			if(count($check_email)>0){
				$this->session->set_flashdata('error',"Email address already exists. Please another email address.");
				redirect('pharmacy/edit');
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
				'altmobile'=>isset($post['altmobile'])?$post['altmobile']:$userdetails['altmobile'],
				'gstin'=>isset($post['gstin'])?$post['gstin']:$userdetails['gstin'],
				'profile_pic'=>$image,
				);
			//echo '<pre>';print_r($updatedetails);exit;


		$profile_update=$this->Admin_model->update_profile_details($post['a_id'],$updatedetails);
		if(count($profile_update)>0){
			$this->session->set_flashdata('success','Profile Details successfully Updated');
			redirect('pharmacyadmin/profile');

		}else{
			$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
			redirect('pharmacyadmin/profileedit');
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
				$this->load->view('pharmacy/changepassword');
				$this->load->view('pharmacy/footer');

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
						redirect('pharmacyadmin/profile');
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('pharmacyadmin/changepassword');
					}

			}else{
				$this->session->set_flashdata('error',"Password and Confirm Password not matched");
				redirect('pharmacyadmin/changepassword');
			}

		}else{
			$this->session->set_flashdata('error',"Old Password not matched");
			redirect('pharmacyadmin/changepassword');
		}


	}else{
		 $this->session->set_flashdata('error','Please login to continue');
		 redirect('');
	}

}

  }
