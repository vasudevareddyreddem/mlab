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
					$data['test_lists']=$this->Lab_model->get_test_list($login_details['a_id']);
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
					$check=$this->Lab_model->check_lab_check_ornot($post['test_type'],$post['test_name']);
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
						$check=$this->Lab_model->check_lab_check_ornot($post['test_type'],$post['test_name']);
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
	public function orders(){
		if($this->session->userdata('mlab_details'))
			{
			$login_details=$this->session->userdata('mlab_details');
				if($login_details['role']==1){
					$data['order_list']=$this->Lab_model->get_all_lab_orders_list($login_details['a_id']);
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
					$data['order_list']=$this->Lab_model->get_lab_orders_list($login_details['a_id']);
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
	
	
	
}
