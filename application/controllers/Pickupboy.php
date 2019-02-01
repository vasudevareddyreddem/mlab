<?php
/**
 *
 */
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/Back_end.php');
class Pickupboy extends Back_end
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Pickupboy_model');
    $this->load->model('Lab_model');
  }
  //pickupboy list
  public function index()
  {
    if ($this->session->userdata('mlab_details')) {
      $login_details = $this->session->userdata('mlab_details');
      if ($login_details['role'] == 2) {
        $data['pickupboy_list'] = $this->Pickupboy_model->get_pickupboy();
        $this->load->view('pickupboy/pickupboy_list',$data);
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
  public function create()
  {
    if ($this->session->userdata('mlab_details')) {
      $login_details = $this->session->userdata('mlab_details');
      if ($login_details['role'] == 2) {
        $this->load->view('pickupboy/add_pickupboy');
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
      if ($login_details['role'] == 2) {
        $post = $this->input->post();
        $check_email = $this->Admin_model->check_email_exits($post['email']);
        if(count($check_email)>0){
          $this->session->set_flashdata('error',"Email address already exists. Please another email address.");
          redirect('pickupboy/create');
        }
        $post_data = $this->input->post();
        if ($post_data) {
          $addl_data = array(
            'role' => 4,
            'password' => md5($post_data['confirmPassword']),
            'org_password' => $post_data['confirmPassword'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'created_by' => $login_details['role'],
            'status' => 1
          );
          $post_data = array_merge($post_data,$addl_data);
          unset($post_data['confirmPassword']);
          if ($this->Pickupboy_model->insert($post_data)) {
            $this->session->set_flashdata('success','Pickupboy created successfully');
            redirect('pickupboy');
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
      if($admindetails['role'] == 4) {
        $data['pickup_orders'] = $this->Pickupboy_model->accepted_orders_for_pickup();
        $this->load->view('pickupboy/pickup_orders',$data);
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
  //pickup order on going - (view)
  public function ongoing()
  {
    if($this->session->userdata('mlab_details')) {
      $admindetails = $this->session->userdata('mlab_details');
      if($admindetails['role'] == 4) {
        $data['ongoing_orders'] = $this->Pickupboy_model->on_going_pickup_orders();
        $this->load->view('pickupboy/ongoing_orders',$data);
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
  //completed order - (view)
  public function completed()
  {
    if($this->session->userdata('mlab_details')) {
      $admindetails = $this->session->userdata('mlab_details');
      if($admindetails['role'] == 4) {
        $data['completed_orders'] = $this->Pickupboy_model->completed_orders();
        $this->load->view('pickupboy/completed_orders',$data);
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
  //order pickup status change
  public function order_pickup()
  {
    if($this->session->userdata('mlab_details')) {
      $admindetails = $this->session->userdata('mlab_details');
      if($admindetails['role'] == 4) {
        $order_item_id_id=base64_decode($this->uri->segment(3));
        if($order_item_id_id!=''){
          $stusdetails = array(
            'lab_status'=>3,
            'updated_at'=>date('Y-m-d H:i:s')
          );
          $statusdata= $this->Lab_model->update_order_item_status($order_item_id_id,$stusdetails);
          if(count($statusdata)>0){

            /*$details=$this->Lab_model->order_item_details($order_item_id_id);
            $username=$this->config->item('smsusername');
            $pass=$this->config->item('smspassword');
            $sender=$this->config->item('sender');
            $msg="Dear ".$details['name']." , your lab tests order is accepted .sample pickup date & time is ".$details['date']." ".$details['time'].". if any instructions given while ordering please follow it. Any queries call 7997999108";
            $ch2 = curl_init();
            curl_setopt($ch2, CURLOPT_URL,"http://trans.smsfresh.co/api/sendmsg.php");
            curl_setopt($ch2, CURLOPT_POST, 1);
            curl_setopt($ch2, CURLOPT_POSTFIELDS,'user='.$username.'&pass='.$pass.'&sender='.$sender.'&phone='.$details['mobile'].'&text='.$msg.'&priority=ndnd&stype=normal');
            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
            //echo '<pre>';print_r($ch);exit;
            $server_output = curl_exec ($ch2);
            curl_close ($ch2);*/
            //echo '<pre>';print_r($msg);exit;

            $this->session->set_flashdata('success',"Order picked up successfully.");
            redirect('pickupboy/pickup');
          }else{
            $this->session->set_flashdata('error',"Technical problem will occurred. Please try again.");
            redirect('pickupboy/pickup');
          }
        }else{
          $this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
          redirect('pickupboy/pickup');
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
  //order on going status status change
  public function ongoing_orders()
  {
		if($this->session->userdata('mlab_details')) {
			$admindetails = $this->session->userdata('mlab_details');
			if($admindetails['role'] == 4){
					$order_item_id_id = base64_decode($this->uri->segment(3));
					if($order_item_id_id != ''){
						$stusdetails = array(
							'lab_status' => 4,
							'updated_at' => date('Y-m-d H:i:s')
							);
							$statusdata = $this->Lab_model->update_order_item_status($order_item_id_id,$stusdetails);
							if(count($statusdata) > 0){

								/*$details=$this->Lab_model->order_item_details($order_item_id_id);
								$username=$this->config->item('smsusername');
								$pass=$this->config->item('smspassword');
								$sender=$this->config->item('sender');
								$msg="Dear ".$details['name']." , your lab tests order is accepted .sample pickup date & time is ".$details['date']." ".$details['time'].". if any instructions given while ordering please follow it. Any queries call 7997999108";
								$ch2 = curl_init();
								curl_setopt($ch2, CURLOPT_URL,"http://trans.smsfresh.co/api/sendmsg.php");
								curl_setopt($ch2, CURLOPT_POST, 1);
								curl_setopt($ch2, CURLOPT_POSTFIELDS,'user='.$username.'&pass='.$pass.'&sender='.$sender.'&phone='.$details['mobile'].'&text='.$msg.'&priority=ndnd&stype=normal');
								curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
								//echo '<pre>';print_r($ch);exit;
								$server_output = curl_exec ($ch2);
								curl_close ($ch2);*/
								//echo '<pre>';print_r($msg);exit;

								$this->session->set_flashdata('success',"Order processing successfully.");
								redirect('pickupboy/ongoing');
							} else {
									$this->session->set_flashdata('error',"Technical problem will occurred. Please try again.");
									redirect('pickupboy/pickup');
							}
					} else {
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('pickupboy/pickup');
					}
			} else {
				$this->session->set_flashdata('error',"You have no permission to access");
				redirect('dashboard');
			}
		} else {
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
  }
  //order on going status status change
  public function complete_orders()
  {
		if($this->session->userdata('mlab_details')) {
			$admindetails = $this->session->userdata('mlab_details');
			if($admindetails['role'] == 4){
					$order_item_id_id=base64_decode($this->uri->segment(3));
					if($order_item_id_id != '') {
						$stusdetails=array(
							'lab_status'=> 5,
							'updated_at'=>date('Y-m-d H:i:s')
							);
							$statusdata= $this->Lab_model->update_order_item_status($order_item_id_id,$stusdetails);
							if(count($statusdata) > 0) {

								/*$details=$this->Lab_model->order_item_details($order_item_id_id);
								$username=$this->config->item('smsusername');
								$pass=$this->config->item('smspassword');
								$sender=$this->config->item('sender');
								$msg="Dear ".$details['name']." , your lab tests order is accepted .sample pickup date & time is ".$details['date']." ".$details['time'].". if any instructions given while ordering please follow it. Any queries call 7997999108";
								$ch2 = curl_init();
								curl_setopt($ch2, CURLOPT_URL,"http://trans.smsfresh.co/api/sendmsg.php");
								curl_setopt($ch2, CURLOPT_POST, 1);
								curl_setopt($ch2, CURLOPT_POSTFIELDS,'user='.$username.'&pass='.$pass.'&sender='.$sender.'&phone='.$details['mobile'].'&text='.$msg.'&priority=ndnd&stype=normal');
								curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
								//echo '<pre>';print_r($ch);exit;
								$server_output = curl_exec ($ch2);
								curl_close ($ch2);*/
								//echo '<pre>';print_r($msg);exit;

								$this->session->set_flashdata('success',"Order completed successfully.");
								redirect('pickupboy/completed');
							}else{
									$this->session->set_flashdata('error',"Technical problem will occurred. Please try again.");
									redirect('pickupboy/pickup');
							}
					} else {
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('pickupboy/pickup');
					}

			} else {
					$this->session->set_flashdata('error',"You have no permission to access");
					redirect('dashboard');
			}
		} else {
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
  }

}

?>
