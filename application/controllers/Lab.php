<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/Back_end.php');

class Lab extends Back_end {
	
		public function __construct() 
		{
		parent::__construct();	
		$this->load->model('Lab_model');
	
		}
	
	
	public function index(){
		if($this->session->userdata('mlab_details'))
			{
			$login_details=$this->session->userdata('mlab_details');
				if($login_details['role']==2){
					
					$data['tab']=base64_decode($this->uri->segment(3));
					$data['test_lists']=$this->Lab_model->get_all_test_list($login_details['a_id']);
					$this->load->view('lab/upload-lab-tests',$data);
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
	public function testedit(){
		if($this->session->userdata('mlab_details'))
			{
			$login_details=$this->session->userdata('mlab_details');
				if($login_details['role']==2){
					
					$l_id=base64_decode($this->uri->segment(3));
					$data['test_name_details']=$this->Lab_model->get_lab_test_name_details($l_id);
					//echo '<pre>';print_r($data);exit;
					$this->load->view('lab/edit-lab-tests',$data);
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
	
	public function testaddpost(){
		if($this->session->userdata('mlab_details'))
			{
			$login_details=$this->session->userdata('mlab_details');
				if($login_details['role']==2){
					
					$post=$this->input->post();
					$check=$this->Lab_model->check_lab_check_ornot($post['test_type'],$post['test_name'],$login_details['a_id']);
					if(count($check)>0){
						$this->session->set_flashdata('error',"Test name already exists. Please another Test name.");
						redirect('lab');
					}
					
					$add=array(
					'lab_id'=>$login_details['a_id'],
					'test_type'=>isset($post['test_type'])?$post['test_type']:'',
					'test_name'=>isset($post['test_name'])?$post['test_name']:'',
					'test_duartion'=>isset($post['test_duartion'])?$post['test_duartion']:'',
					'test_amount'=>isset($post['test_amount'])?$post['test_amount']:'',
					'delivery_charge'=>isset($post['delivery_charge'])?$post['delivery_charge']:'',
					'created_at'=>date('Y-m-d H:i:s'),
					'updated_at'=>date('Y-m-d H:i:s'),
					'created_by'=>$login_details['a_id'],
					);
					$save=$this->Lab_model->save_labtest($add);
					if(count($save)>0){
						$this->session->set_flashdata('success','Test name successfully added');
						redirect('lab/index/'.base64_encode(1));
						
					}else{
						$this->session->set_flashdata('error',"Technical problem will occurred. Please try again.");
						redirect('lab');
					}
				}else{
					$this->session->set_flashdata('error','You have no permissions');
					redirect('dashboard');
				}

		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	public function testeditpost(){
		if($this->session->userdata('mlab_details'))
			{
			$login_details=$this->session->userdata('mlab_details');
				if($login_details['role']==2){
					
					$post=$this->input->post();
					//echo '<pre>';print_r($post);exit;
					$test_name_details=$this->Lab_model->get_lab_test_name_details($post['l_t_id']);
					if($test_name_details['test_type']!=$post['test_type'] || $test_name_details['test_name']!=$post['test_name']){
						$check=$this->Lab_model->check_lab_check_ornot($post['test_type'],$post['test_name'],$login_details['a_id']);
						if(count($check)>0){
							$this->session->set_flashdata('error',"Lab test already exists. Please another Test name.");
							redirect('lab/testedit/'.base64_encode($post['l_t_id']));
						}
					}
					$upd=array(
					'test_type'=>isset($post['test_type'])?$post['test_type']:'',
					'test_name'=>isset($post['test_name'])?$post['test_name']:'',
					'test_duartion'=>isset($post['test_duartion'])?$post['test_duartion']:'',
					'test_amount'=>isset($post['test_amount'])?$post['test_amount']:'',
					'delivery_charge'=>isset($post['delivery_charge'])?$post['delivery_charge']:'',
					'updated_at'=>date('Y-m-d H:i:s'),
					'created_by'=>$login_details['a_id'],
					);
					$update_data=$this->Lab_model->update_testname_details($post['l_t_id'],$upd);
					if(count($update_data)>0){
						$this->session->set_flashdata('success','Lab test details successfully updated');
						redirect('lab/index/'.base64_encode(1));
						
					}else{
						$this->session->set_flashdata('error',"Technical problem will occurred. Please try again.");
						redirect('lab/testedit/'.base64_encode($post['l_t_id']));
					}
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
			if($admindetails['role']==2){
					$l_id=$this->uri->segment(3);
					$status=base64_decode($this->uri->segment(4));
					if($status==1){
						$statu=0;
					}else{
						$statu=1;
					}
					if($l_id!=''){
						$stusdetails=array(
							'status'=>$statu,
							'updated_at'=>date('Y-m-d H:i:s')
							);
							//echo '<pre>';print_r(base64_decode($l_id));exit;
							$statusdata= $this->Lab_model->update_testname_details(base64_decode($l_id),$stusdetails);
							if(count($statusdata)>0){
								$this->Lab_model->update_packages_test_list_details(base64_decode($l_id),$stusdetails);
								//echo $this->db->last_query();exit;

								if($status==1){
								$this->session->set_flashdata('success',"Test Name successfully deactivated.");
								}else{
									$this->session->set_flashdata('success',"Test Name successfully activated.");
								}
								redirect('lab/index/'.base64_encode(1));
							}else{
									$this->session->set_flashdata('error',"Technical problem will occurred. Please try again.");
									redirect('lab/index/'.base64_encode(1));
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('lab/index/'.base64_encode(1));
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
			if($admindetails['role']==2){
					$l_id=$this->uri->segment(3);
					if($l_id!=''){
						$stusdetails=array(
							'status'=>2,
							'updated_at'=>date('Y-m-d H:i:s')
							);
							$statusdata= $this->Lab_model->update_testname_details(base64_decode($l_id),$stusdetails);
							if(count($statusdata)>0){
							$this->Lab_model->update_packages_test_list_details(base64_decode($l_id),$stusdetails);

								$this->session->set_flashdata('success',"Test Name successfully Deleted.");
								redirect('lab/index/'.base64_encode(1));
							}else{
									$this->session->set_flashdata('error',"Technical problem will occurred. Please try again.");
									redirect('lab/index/'.base64_encode(1));
							}
					}else{
						$this->session->set_flashdata('error',"Technical problem will occurred. Please try again.");
						redirect('lab/index/'.base64_encode(1));
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
	public function packages(){
		if($this->session->userdata('mlab_details'))
			{
			$login_details=$this->session->userdata('mlab_details');
				if($login_details['role']==2){
					
					$data['tab']=base64_decode($this->uri->segment(3));
					$data['packages_test_lists']=$this->Lab_model->get_packages_test_lists($login_details['a_id']);
					$data['test_lists']=$this->Lab_model->get_test_list($login_details['a_id']);

					//echo '<pre>';print_r($data);exit;
					$this->load->view('lab/upload-lab-packages',$data);
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
	public function testpackagepost(){
		if($this->session->userdata('mlab_details'))
			{
			$login_details=$this->session->userdata('mlab_details');
				if($login_details['role']==2){
					
					$post=$this->input->post();
					
					//echo '<pre>';print_r($post);exit;
					$check=$this->Lab_model->check_package_name_exist($post['test_package_name'],$login_details['a_id']);
					if(count($check)>0){
						$this->session->set_flashdata('error',"Package already exists. Please another Package.");
						redirect('lab/packages/');
					}
					$x = $post['discount'];
					$y = $post['amount'];
					$percent = $x/$y;
					$percent_friendly = number_format( $percent * 100, 2 ) . '%'; 
					
					$add_package=array(
					'lab_id'=>$login_details['a_id'],
					'test_package_name'=>isset($post['test_package_name'])?$post['test_package_name']:'',
					'discount'=>isset($post['discount'])?$post['discount']:'',
					'amount'=>isset($post['amount'])?$post['amount']:'',
					'instruction'=>isset($post['instruction'])?$post['instruction']:'',
					'percentage'=>isset($percent_friendly)?$percent_friendly:'',
					'delivery_charge'=>isset($post['delivery_charge'])?$post['delivery_charge']:'',
					'reports_time'=>isset($post['reports_time'])?$post['reports_time']:'',
					'status'=>1,
					'created_at'=>date('Y-m-d H:i:s'),
					'updated_at'=>date('Y-m-d H:i:s'),
					'created_by'=>$login_details['a_id'],
					);
					$save=$this->Lab_model->save_package($add_package);
					if(count($save)>0){
						foreach($post['test_name'] as $lis){
							if($lis!=''){
								$add_package_test=array(
								'l_t_p_id'=>$save,
								'test_id'=>isset($lis)?$lis:'',
								'status'=>1,
								'created_at'=>date('Y-m-d H:i:s'),
								'updated_at'=>date('Y-m-d H:i:s'),
								'created_by'=>$login_details['a_id'],
								);
								//echo '<pre>';print_r($add_package_test);
								$this->Lab_model->save_package_test_names($add_package_test);
								}
						}
						//exit;
						$this->session->set_flashdata('success','Package successfully added');
						redirect('lab/packages/'.base64_encode(1));
						
					}else{
						$this->session->set_flashdata('error',"Technical problem will occurred. Please try again.");
						redirect('lab/packages');
					}
				}else{
					$this->session->set_flashdata('error','You have no permissions');
					redirect('dashboard');
				}

		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	public function packagestatus()
	{
		if($this->session->userdata('mlab_details'))
		{
			$admindetails=$this->session->userdata('mlab_details');
			//echo '<pre>';print_r($admindetails);exit;
			if($admindetails['role']==2){
					$l_id=$this->uri->segment(3);
					$status=base64_decode($this->uri->segment(4));
					if($status==1){
						$statu=0;
					}else{
						$statu=1;
					}
					if($l_id!=''){
						$stusdetails=array(
							'status'=>$statu,
							'updated_at'=>date('Y-m-d H:i:s')
							);
							$statusdata= $this->Lab_model->update_package_test_details(base64_decode($l_id),$stusdetails);
							if(count($statusdata)>0){
								$p_test_list=$this->Lab_model->get_package_test_list(base64_decode($l_id));
								if(count($p_test_list)>0){
									$updstusdetails=array(
									'status'=>$statu,
									'updated_at'=>date('Y-m-d H:i:s')
									);
									foreach($p_test_list as $li){
										//echo "dsasd";
										$this->Lab_model->update_package_test_name_details($li['p_t_id'],$updstusdetails);
										//echo $this->db->last_query();exit;
									}
									
								}
								if($status==1){
								$this->session->set_flashdata('success',"Package successfully deactivated.");
								}else{
									$this->session->set_flashdata('success',"Package successfully activated.");
								}
								redirect('lab/packages/'.base64_encode(1));
							}else{
									$this->session->set_flashdata('error',"Technical problem will occurred. Please try again.");
									redirect('lab/packages/'.base64_encode(1));
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('lab/packages'.base64_encode(1));
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
	public function packagedeletes()
	{
		if($this->session->userdata('mlab_details'))
		{
			$admindetails=$this->session->userdata('mlab_details');
			//echo '<pre>';print_r($admindetails);exit;
			if($admindetails['role']==2){
					$l_id=$this->uri->segment(3);
					
					if($l_id!=''){
						$stusdetails=array(
							'status'=>2,
							'updated_at'=>date('Y-m-d H:i:s')
							);
							$statusdata= $this->Lab_model->update_package_test_details(base64_decode($l_id),$stusdetails);
							if(count($statusdata)>0){
								$p_test_list=$this->Lab_model->get_package_test_list(base64_decode($l_id));
								if(count($p_test_list)>0){
									$updstusdetails=array(
									'status'=>2,
									'updated_at'=>date('Y-m-d H:i:s')
									);
									foreach($p_test_list as $li){
										//echo "dsasd";
										$this->Lab_model->update_package_test_name_details($li['p_t_id'],$updstusdetails);
										//echo $this->db->last_query();exit;
									}
									
								}
								$this->session->set_flashdata('success',"Package successfully deleted.");
								
								redirect('lab/packages/'.base64_encode(1));
							}else{
									$this->session->set_flashdata('error',"Technical problem will occurred. Please try again.");
									redirect('lab/packages/'.base64_encode(1));
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('lab/packages'.base64_encode(1));
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
	public function packageedit(){
		if($this->session->userdata('mlab_details'))
			{
			$login_details=$this->session->userdata('mlab_details');
				if($login_details['role']==2){
					
					$pack_id=base64_decode($this->uri->segment(3));
					$data['packages_name_details']=$this->Lab_model->get_packages_test_details($pack_id);
					$data['test_lists']=$this->Lab_model->get_test_list($login_details['a_id']);
					//echo '<pre>';print_r($data);exit;
					$this->load->view('lab/edit-lab-packages',$data);
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
	public function packageeditpost(){
		if($this->session->userdata('mlab_details'))
			{
			$login_details=$this->session->userdata('mlab_details');
				if($login_details['role']==2){
					
					$post=$this->input->post();
					$x = $post['discount'];
					$y = $post['amount'];
					$percent = $x/$y;
					$percent_friendly = number_format( $percent * 100, 2 ) . '%'; 
								
					//echo '<pre>';print_r($post);exit;
					$packages_name_details=$this->Lab_model->get_packages_test_details($post['p_id']);
					//echo '<pre>';print_r($packages_name_details);exit;
					if($packages_name_details['test_package_name'] != $post['test_package_name']){
					$check=$this->Lab_model->check_package_name_exist($post['test_package_name'],$login_details['a_id']);
						if(count($check)>0){
							$this->session->set_flashdata('error',"Package already exists. Please another Package.");
							redirect('lab/packageedit/'.base64_encode($post['p_id']));
						}
					
					}
					$add_package=array(
					'test_package_name'=>isset($post['test_package_name'])?$post['test_package_name']:'',
					'discount'=>isset($post['discount'])?$post['discount']:'',
					'amount'=>isset($post['amount'])?$post['amount']:'',
					'instruction'=>isset($post['instruction'])?$post['instruction']:'',
					'percentage'=>isset($percent_friendly )?$percent_friendly :'',
					'delivery_charge'=>isset($post['delivery_charge'])?$post['delivery_charge']:'',
					'reports_time'=>isset($post['reports_time'])?$post['reports_time']:'',

					'updated_at'=>date('Y-m-d H:i:s'),
					'created_by'=>$login_details['a_id'],
					);
					
						//exit;
					$update=$this->Lab_model->update_package_test_details($post['p_id'],$add_package);
					if(count($update)>0){
						
						/*deleting*/
						foreach($packages_name_details['package_test_list'] as $lists){
								$p_t_ids[]=$lists['test_id'];
								if (in_array($lists['test_id'], $post['test_name']))
								{
									$add_package_test=array(
									'status'=>1,
									'updated_at'=>date('Y-m-d H:i:s'),
									);
									$this->Lab_model->update_package_test_names($lists['p_t_id'],$lists['test_id'],$add_package_test);
								}else{
									$add_package_test=array(
									'status'=>2,
									'updated_at'=>date('Y-m-d H:i:s'),
									);
									$this->Lab_model->update_package_test_names($lists['p_t_id'],$lists['test_id'],$add_package_test);
								}
							}
						/*deleting*/
						/*adding*/
						foreach($post['test_name'] as $list){
							if (in_array($list, $p_t_ids))
							{
								//echo "2222";
							}else{
								$add_package_test=array(
									'l_t_p_id'=>$post['p_id'],
									'test_id'=>isset($list)?$list:'',
									'status'=>1,
									'created_at'=>date('Y-m-d H:i:s'),
									'updated_at'=>date('Y-m-d H:i:s'),
									'created_by'=>$login_details['a_id'],
									);
									
									//echo '<pre>';print_r($add_package_test);exit;
								$this->Lab_model->save_package_test_names($add_package_test);
							}
						}
						/*adding*/
						
						$this->session->set_flashdata('success','Package successfully updated');
						redirect('lab/packages/'.base64_encode(1));
						
					}else{
						$this->session->set_flashdata('error',"Technical problem will occurred. Please try again.");
						redirect('lab/packageedit/'.base64_encode($post['p_id']));
					}
				}else{
					$this->session->set_flashdata('error','You have no permissions');
					redirect('dashboard');
				}

		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	
	/*orders  purpose*/
	public function allorders(){
		if($this->session->userdata('mlab_details'))
			{
			$login_details=$this->session->userdata('mlab_details');
				if($login_details['role']==2){
					$data['order_list']=$this->Lab_model->get_all_lab_orders_list($login_details['a_id']);
					//echo '<pre>';print_r($data);exit;
					$this->load->view('lab/all_order_list',$data);
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
	public function orders(){
		if($this->session->userdata('mlab_details'))
			{
			$login_details=$this->session->userdata('mlab_details');
				if($login_details['role']==1){
					$data['order_list']=$this->Lab_model->get_all_admin_lab_orders_list($login_details['a_id']);
					//echo '<pre>';print_r($data);exit;
					$this->load->view('admin/lab_order_list',$data);
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
	public function reports(){
		if($this->session->userdata('mlab_details'))
			{
			$login_details=$this->session->userdata('mlab_details');
				if($login_details['role']==2){
					$data['order_list']=$this->Lab_model->get_reports_lab_orders_list($login_details['a_id']);
					//echo '<pre>';print_r($data);exit;
					$this->load->view('lab/upload-reports',$data);
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
	public function uploadreports(){
		if($this->session->userdata('mlab_details'))
			{
			$login_details=$this->session->userdata('mlab_details');
				if($login_details['role']==2){
					$order_item_id=base64_decode($this->uri->segment(3));
					$data['order_item_id']=$order_item_id;
					$data['order_list']=$this->Lab_model->get_order_item_details($order_item_id);
					//echo '<pre>';print_r($data);exit;
					$this->load->view('lab/upload_reports_file',$data);
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
	/* order status accept */
	public  function orderstatus_accept(){
		if($this->session->userdata('mlab_details'))
		{
			$admindetails=$this->session->userdata('mlab_details');
			//echo '<pre>';print_r($admindetails);exit;
			if($admindetails['role']==2){
					$order_item_id_id=base64_decode($this->uri->segment(3));
					if($order_item_id_id!=''){
						$stusdetails=array(
							'lab_status'=>1,
							'updated_at'=>date('Y-m-d H:i:s')
							);
							$statusdata= $this->Lab_model->update_order_item_status($order_item_id_id,$stusdetails);
							if(count($statusdata)>0){
								
								$details=$this->Lab_model->order_item_details($order_item_id_id);
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
								curl_close ($ch2);
								//echo '<pre>';print_r($msg);exit;
								
								$this->session->set_flashdata('success',"Order successfully accepted.");
								redirect('lab/allorders');
							}else{
									$this->session->set_flashdata('error',"Technical problem will occurred. Please try again.");
									redirect('lab/allorders');
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('lab/allorders');
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
	public  function orderstatus_reject(){
		if($this->session->userdata('mlab_details'))
		{
			$admindetails=$this->session->userdata('mlab_details');
			
			$post=$this->input->post();
			//echo '<pre>';print_r($post);exit;
			if($admindetails['role']==2){
					$order_item_id_id=base64_decode($post['order_item_id_id']);
					if($order_item_id_id!=''){
						$stusdetails=array(
							'reason'=>isset($post['reason'])?$post['reason']:'',
							'lab_status'=>2,
							'updated_at'=>date('Y-m-d H:i:s')
							);
							$statusdata= $this->Lab_model->update_order_item_status($order_item_id_id,$stusdetails);
							if(count($statusdata)>0){
								
								$details=$this->Lab_model->order_item_details($order_item_id_id);
								$username=$this->config->item('smsusername');
								$pass=$this->config->item('smspassword');
								$sender=$this->config->item('sender');
								$msg="Dear ".$details['name']." , your lab test order is rejected because ".$post['reason'];
								$ch2 = curl_init();
								curl_setopt($ch2, CURLOPT_URL,"http://trans.smsfresh.co/api/sendmsg.php");
								curl_setopt($ch2, CURLOPT_POST, 1);
								curl_setopt($ch2, CURLOPT_POSTFIELDS,'user='.$username.'&pass='.$pass.'&sender='.$sender.'&phone='.$details['mobile'].'&text='.$msg.'&priority=ndnd&stype=normal');
								curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
								//echo '<pre>';print_r($ch);exit;
								$server_output = curl_exec ($ch2);
								curl_close ($ch2);
								//echo '<pre>';print_r($msg);exit;
								
								$this->session->set_flashdata('success',"Order successfully rejected.");
								redirect('lab/allorders');
							}else{
									$this->session->set_flashdata('error',"Technical problem will occurred. Please try again.");
									redirect('lab/allorders');
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('lab/allorders');
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
	
	/* report file upload  */
	
	public  function uploadfile(){
		if($this->session->userdata('mlab_details'))
		{
	 	   $post=$this->input->post();
		   $pic=$_FILES['image']['name'];
	   	   $picname = str_replace(" ", "", $pic);
		   $imagename=microtime().basename($picname);
		   $imgname = str_replace(" ", "", $imagename);
		   $details=$this->Lab_model->get_test_report_file_names($post['o_p_t_id']);
		   if(isset($details['report_file']) && $details['report_file']!=''){
			   unlink('assets/reportfiles/'.$details['report_file']);
		   }
			if(move_uploaded_file($_FILES['image']['tmp_name'], 'assets/reportfiles/'.$imgname)){
				$addimg=array(
				'report_file'=>$imgname,
				'org_report_file'=>$pic,
				'file_upload_file'=>date('Y-m-d H:i:s')
				);
				$save_img=$this->Lab_model->update_test_report_file($post['o_p_t_id'],$addimg);
				if(count($save_img)>0){
					$all_details=$this->Lab_model->get_test_report_file_names($post['o_p_t_id']);
					$file=base_url('assets/reportfiles/'.$all_details['report_file']);
					$htmlmessage = "Lab tests reports has been uploaded from the Lab";
					$this->load->library('email');
					$this->email->set_newline("\r\n");
					$this->email->set_mailtype("html");
					$this->email->from('medpharmla.com');
					$this->email->to($all_details['email']);
					$this->email->attach($file);
					$this->email->subject('Lab - Reprits '.$all_details['org_report_file']);
					//echo $html;exit;
					$this->email->message($htmlmessage);
					$this->email->send();
					
					/* sms*/
						$username=$this->config->item('smsusername');
						$pass=$this->config->item('smspassword');
						$sender=$this->config->item('sender');
						$msg="Dear ".$all_details['name']." , your lab tests reports are sent to your registered email address. please, check it. Any queries call 7997999108";
						$ch2 = curl_init();
						curl_setopt($ch2, CURLOPT_URL,"http://trans.smsfresh.co/api/sendmsg.php");
						curl_setopt($ch2, CURLOPT_POST, 1);
						curl_setopt($ch2, CURLOPT_POSTFIELDS,'user='.$username.'&pass='.$pass.'&sender='.$sender.'&phone='.$all_details['mobile'].'&text='.$msg.'&priority=ndnd&stype=normal');
						curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
						//echo '<pre>';print_r($ch);exit;
						$server_output = curl_exec ($ch2);
						curl_close ($ch2);
					/* sms*/
					$this->session->set_flashdata('success',"Report file successfully uploaded.");
					redirect('lab/uploadreports/'.base64_encode($post['order_item_id']));
				}else{
					$this->session->set_flashdata('error',"Technical problem will occurred. Please try again.");
					redirect('lab/uploadreports/'.base64_encode($post['order_item_id']));
				}
				//echo '<pre>';print_r($_FILES);exit;
			}else{
				$this->session->set_flashdata('error',"Technical problem will occurred. Please try again.");
				redirect('lab/uploadreports/'.base64_encode($post['order_item_id']));
			}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
		
	}
	
	public  function importtest(){
		
		if($this->session->userdata('mlab_details'))
		{
			$login_details=$this->session->userdata('mlab_details');
			$limitSize	= 1000000000; //(15 kb) - Maximum size of uploaded file, change it to any size you want
			$fileName	= basename($_FILES['test_file']['name']);
			$fileSize	= $_FILES["test_file"]["size"];
			$fileExt	= substr($fileName, strrpos($fileName, '.') + 1);
		if(substr($_FILES['test_file']['name'], 0, 5)=='tests'){
											
										if (($fileExt == "xlsx") && ($fileSize < $limitSize)) {
												include_once('simplexlsx.class.php');
												$getWorksheetName = array();
												$xlsx = new SimpleXLSX( $_FILES['test_file']['tmp_name'] );
												$getWorksheetName = $xlsx->getWorksheetName();
												//echo $xlsx->sheetsCount();exit;
														for($j=1;$j <= $xlsx->sheetsCount();$j++){
														$cnt=$xlsx->sheetsCount()-1;
														$arry=$xlsx->rows($j);
														unset($arry[0]);

																//echo "<pre>";print_r($arry);exit;
																foreach($arry as $key=>$fields)
																{
																		if(isset($fields[1]) && $fields[1]!='' && $fields[2]!='' && $fields[3]!=''){
																		$totalfields[] = $fields;
																		
																		if(empty($fields[0])) {
																			$data['errors'][]="Test type is required. Row Id is :  ".$key.'<br>';
																			$error=1;
																		}else if($fields[0]!=''){
																			$regex ="/^[ A-Za-z0-9_@.}{@#&`~\\/,|=^?$%*)(_+-]*$/"; 
																			if(!preg_match($regex, $fields[0]))	  	
																			{
																			$data['errors'][]='Test type wont allow "  <> []. Row Id is :  '.$key.'<br>';
																			$error=1;
																			}
																		}
																		if(empty($fields[1])) {
																			$data['errors'][]="Test name is required. Row Id is :  ".$key.'<br>';
																			$error=1;
																		}else if($fields[1]!=''){
																			$regex ="/^[ A-Za-z0-9_@.}{@#&`~\\/,|=^?$%*)(_+-]*$/"; 
																			if(!preg_match($regex, $fields[1]))	  	
																			{
																			$data['errors'][]='Test name wont allow "  <> []. Row Id is :  '.$key.'<br>';
																			$error=1;
																			}
																		}
																		if(empty($fields[2])) {
																			$data['errors'][]="Reports in is required. Row Id is :  ".$key.'<br>';
																			$error=1;
																		}else if($fields[2]!=''){
																			$regex ="/^[ A-Za-z0-9_@.}{@#&`~\\/,|=^?$%*)(_+-]*$/"; 
																			if(!preg_match($regex, $fields[2]))	  	
																			{
																			$data['errors'][]='Reports in wont allow "  <> []. Row Id is :  '.$key.'<br>';
																			$error=1;
																			}
																		}
																		if(empty($fields[3])) {
																			$data['errors'][]="Amount is required. Row Id is :  ".$key.'<br>';
																			$error=1;
																		}else if($fields[3]!=''){
																			$regex ="/^[0-9.]+$/"; 
																			if(!preg_match( $regex, $fields[3]))	  	
																			{
																			$data['errors'][]='Amount can only consist of digits. Row Id is :  '.$key.'<br>';
																			$error=1;
																			}
																		}
																		if(empty($fields[4])) {
																			$data['errors'][]="Sample pickup Charges is required. Row Id is :  ".$key.'<br>';
																			$error=1;
																		}else if($fields[4]!=''){
																			$regex ="/^[0-9.]+$/"; 
																			if(!preg_match( $regex, $fields[4]))	  	
																			{
																			$data['errors'][]='Sample pickup Charges can only consist of digits. Row Id is :  '.$key.'<br>';
																			$error=1;
																			}
																		}
																		$check=$this->Lab_model->check_lab_check_ornot($fields[0],$fields[1],$login_details['a_id']);
																		if(count($check)>0){
																			$data['errors'][]='Lab test already exists. Please another Test name . Row Id is :  '.$key.'<br>';
																			$error=1;	
																		}
																		
																		
																		
																 }else{
																	 $this->session->set_flashdata('error','fields are missing check once again');
																	 redirect('lab');
																 }
																}
																//echo '<pre>';print_r($data);exit;
														if(count($data['errors'])>0){
														$this->session->set_flashdata('addsuccess',$data['errors']);
														redirect('lab');
														}

													}
													if(count($data['errors'])<=0){
														
															foreach($totalfields as $data){
																//echo "<pre>";print_r($data);exit;
																$add=array(
																'lab_id'=>$login_details['a_id'],
																'test_type'=>isset($data[0])?$data[0]:'',
																'test_name'=>isset($data[1])?$data[1]:'',
																'test_duartion'=>isset($data[2])?$data[2]:'',
																'test_amount'=>isset($data[3])?$data[3]:'',
																'delivery_charge'=>isset($data[4])?$data[4]:'',
																'created_at'=>date('Y-m-d H:i:s'),
																'updated_at'=>date('Y-m-d H:i:s'),
																'created_by'=>$login_details['a_id'],
																);
																$results=$this->Lab_model->save_labtest($add);
																			

														   }
															
													}
													if(count($results)>0){
													$this->session->set_flashdata('addcus','Tests are successfully added');
													redirect('lab/index/'.base64_encode(1));	
													}
													
												
										}else{
											$this->session->set_flashdata('error','Your are uploaded  wrong File');
											redirect('lab');	
										}
										
									}else{
										$this->session->set_flashdata('error','Your are uploaded  wrong File. Please upload correctfile!');
										redirect('lab');
									}
			}else{
			 $this->session->set_flashdata('error','Please login to continue');
			 redirect('admin');
		}
	}
	
	
	
	
}
