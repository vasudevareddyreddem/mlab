<?php
/**
 *
 */
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/Back_end.php');
class Pharmacypickupboy extends Back_end
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Pharmacypickupboy_model');
    $this->load->model('Lab_model');
  }
  //pickupboy list
  public function index()
  {
    if ($this->session->userdata('mlab_details')) {
      $login_details = $this->session->userdata('mlab_details');
      if ($login_details['role'] == 3) {
        $data['pickupboy_list'] = $this->Pharmacypickupboy_model->get_pickupboy($login_details['a_id']);
        $this->load->view('pharmacy_pickupboy/pickupboy_list',$data);
        $this->load->view('admin/footer');
      } else {
        $this->session->set_flashdata('error','You have no permissions');
        redirect('dashboard');
      }
    } else {
      $this->session->set_flashdata('error','Please login to continue');
      redirect('admin');
    }
  }
  //pickupboy create - (view)
  public function add()
  {
    if ($this->session->userdata('mlab_details')) {
      $login_details = $this->session->userdata('mlab_details');
      if ($login_details['role'] == 3) {
        $this->load->view('pharmacy_pickupboy/add_pickupboy');
        $this->load->view('admin/footer');
      } else {
        $this->session->set_flashdata('error','You have no permissions');
        redirect('dashboard');
      }
    } else {
      $this->session->set_flashdata('error','Please login to continue');
      redirect('admin');
    }
  }
  //pickupboy insert
  public function insert()
  {
    if ($this->session->userdata('mlab_details')) {
      $login_details = $this->session->userdata('mlab_details');
      if ($login_details['role'] == 3) {
        $post = $this->input->post();
        $check_email = $this->Admin_model->check_email_exits($post['email']);
        if(count($check_email)>0){
          $this->session->set_flashdata('error',"Email address already exists. Please another email address.");
          redirect('pickupboy/create');
        }
        $post_data = $this->input->post();
        if ($post_data) {
          $addl_data = array(
            'role' => 5,
            'password' => md5($post_data['confirmPassword']),
            'org_password' => $post_data['confirmPassword'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'created_by' => $login_details['a_id'],
            'status' => 1
          );
          $post_data = array_merge($post_data,$addl_data);
          unset($post_data['confirmPassword']);
          if ($this->Pharmacypickupboy_model->insert($post_data)) {
            $this->session->set_flashdata('success','Pickupboy created successfully');
            redirect('pharmacypickupboy/index');
          } else {
            $this->session->set_flashdata('error','Please try again');
            redirect($this->session->referrer());
          }
        } else {
          $thid->session->set_flashdata('error','Please try again');
          redirect($this->agent->referrer());
        }
      } else {
        $this->session->set_flashdata('error','You have no permissions');
        redirect('dashboard');
      }
    } else {
      $this->session->set_flashdata('error','Please login to continue');
      redirect('admin');
    }
  }
  //pickup orders - (view)
  public function pickup()
  {
    if($this->session->userdata('mlab_details')) {
      $admindetails = $this->session->userdata('mlab_details');
      if($admindetails['role'] == 5) {
        $pickup_orders=$this->Pharmacypickupboy_model->accepted_orders_for_pickup($admindetails['created_by']);
		
		if(isset($pickup_orders) && count($pickup_orders)>0){
			foreach($pickup_orders as $list){
			$cust=$this->Pharmacypickupboy_model->get_customer_details($list['cust_id']);
			$data['pickup_orders'][$list['cust_order_id']]=$list;
			$data['pickup_orders'][$list['cust_order_id']]['cust_name']=isset($cust['name'])?$cust['name']:'';
			$data['pickup_orders'][$list['cust_order_id']]['email']=isset($cust['email'])?$cust['email']:'';
			$data['pickup_orders'][$list['cust_order_id']]['mobile']=isset($cust['mobile'])?$cust['mobile']:'';
			}
		}else{
			$data=array();
		}
		$this->load->view('pharmacy_pickupboy/pickup_orders',$data);
        $this->load->view('admin/footer');
      } else {
        $this->session->set_flashdata('error',"You have no permission to access");
        redirect('dashboard');
      }
    } else {
      $this->session->set_flashdata('error','Please login to continue');
      redirect('admin');
    }
  }
  // order delivery status 
  
  public  function orderstatus(){
	 if($this->session->userdata('mlab_details')) {
      $admindetails = $this->session->userdata('mlab_details');
      if($admindetails['role'] == 5){
			$order_id=base64_decode($this->uri->segment(3));
			$stusdetails=array(
            'status'=>3,
            'updated_date'=>date('Y-m-d H:i:s')
          );
          $statusdata= $this->Pharmacypickupboy_model->update_order_details($order_id,$stusdetails);
          if(count($statusdata)>0){
			  $this->session->set_flashdata('success',"Order successfully Delivered.");
			  redirect('pharmacypickupboy/completed');
          }else {
            $this->session->set_flashdata('error',"Technical problem will occurred. Please try again.");
            redirect('pharmacypickupboy');
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
  //completed order - (view)
  public function completed()
  {
    if($this->session->userdata('mlab_details')) {
      $admindetails = $this->session->userdata('mlab_details');
      if($admindetails['role'] == 5) {
		    $pickup_orders=$this->Pharmacypickupboy_model->completed_orders($admindetails['created_by']);
		foreach($pickup_orders as $list){
			$cust=$this->Pharmacypickupboy_model->get_customer_details($list['cust_id']);
			$data['pickup_orders'][$list['cust_order_id']]=$list;
			$data['pickup_orders'][$list['cust_order_id']]['cust_name']=isset($cust['name'])?$cust['name']:'';
			$data['pickup_orders'][$list['cust_order_id']]['email']=isset($cust['email'])?$cust['email']:'';
			$data['pickup_orders'][$list['cust_order_id']]['mobile']=isset($cust['mobile'])?$cust['mobile']:'';
		}
        $this->load->view('pharmacy_pickupboy/completed_orders',$data);
        $this->load->view('admin/footer');
      } else {
        $this->session->set_flashdata('error',"You have no permission to access");
        redirect('dashboard');
      }
    } else {
      $this->session->set_flashdata('error','Please login to continue');
      redirect('admin');
    }
  }
  
  
  //edit pickupboy (view)
  public function edit(){
		if($this->session->userdata('mlab_details')){
			$login_details=$this->session->userdata('mlab_details');
			if($login_details['role'] == 3){
				$p_id = base64_decode($this->uri->segment(3));
				$data['pickupboy_details']=$this->Pharmacypickupboy_model->get_pickupboy_details($p_id);
				$this->load->view('pharmacy_pickupboy/edit_pickupboy',$data);
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
  //update pickupboy
  public function update()
  {
    if ($this->session->userdata('mlab_details')) {
      $login_details = $this->session->userdata('mlab_details');
      if ($login_details['role'] == 3) {
        $post = $this->input->post();
        $details=$this->Pharmacypickupboy_model->get_pickupboy_details($post['a_id']);
        if($details['email']!=$post['email']){
          $check_email=$this->Admin_model->check_email_exits($post['email']);
          if(count($check_email)>0){
            $this->session->set_flashdata('error',"Email address already exists. Please another email address.");
            redirect('pharmacypickupboy/edit/'.base64_encode($post['a_id']));
          }
        }
        $post_data = $this->input->post();
        if ($post_data) {
			  $addl_data = array(
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
			  );
          $post_data = array_merge($post_data,$addl_data);
          if ($this->Pharmacypickupboy_model->update_pickupboy_details($post['a_id'],$post_data)) {
            $this->session->set_flashdata('success','Pickupboy updated successfully');
            redirect('pharmacypickupboy/index');
          } else {
            $this->session->set_flashdata('error','Please try again');
            redirect($this->session->referrer());
          }
        } else {
          $thid->session->set_flashdata('error','Please try again');
          redirect($this->agent->referrer());
        }
      } else {
        $this->session->set_flashdata('error','You have no permissions');
        redirect('dashboard');
      }
    } else {
      $this->session->set_flashdata('error','Please login to continue');
      redirect('admin');
    }
  }
  //Pickupboy Status
  public function status($value='')
  {
    if($this->session->userdata('mlab_details'))
    {
      $admindetails=$this->session->userdata('mlab_details');
      if($admindetails['role'] == 3){
        $a_id = $this->uri->segment(3);
        $status = base64_decode($this->uri->segment(4));
        if($status == 1) {
          $statu = 0;
        } else {
          $statu = 1;
        }
        if($a_id!=''){
          $stusdetails=array(
            'status'=>$statu,
            'updated_at'=>date('Y-m-d H:i:s')
          );
          $statusdata= $this->Pharmacypickupboy_model->update_pickupboy_details(base64_decode($a_id),$stusdetails);
          if(count($statusdata) > 0) {
            if($status == 1) {
              $this->session->set_flashdata('success',"Pickupboy successfully deactivated.");
            } else {
              $this->session->set_flashdata('success',"Pickupboy successfully activated.");
            }
            redirect('pharmacypickupboy');
          } else {
            $this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
            redirect('pharmacypickupboy');
          }
        }else{
          $this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
          redirect('pharmacypickupboy');
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
  //delete pickupboy
  public function delete()
  {
    if($this->session->userdata('mlab_details'))
		{
			$admindetails=$this->session->userdata('mlab_details');
			if($admindetails['role'] == 3){
				$a_id = $this->uri->segment(3);
				if($a_id != ''){
				  $stusdetails = array(
						'status'=>2,
						'updated_at'=>date('Y-m-d H:i:s')
					);
					$statusdata= $this->Pharmacypickupboy_model->update_pickupboy_details(base64_decode($a_id),$stusdetails);
					if(count($statusdata) > 0) {
						$this->session->set_flashdata('success',"Pickupboy successfully Deleted.");
						redirect('pharmacypickupboy');
					} else {
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('pharmacypickupboy');
					}
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('pharmacypickupboy');
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

?>
