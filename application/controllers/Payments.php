<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/Back_end.php');
require_once ('razorpay-php/Razorpay.php');
use Razorpay\Api\Api as RazorpayApi;
class Payments extends Back_end {
	
		public function __construct() 
		{
		parent::__construct();	
		$this->load->model('Payments_model');
	
		}
	
	
	public function index(){
		if($this->session->userdata('mlab_details'))
			{
			$login_details=$this->session->userdata('mlab_details');
			if($login_details['role']==2){
				//echo "sdasd";
						$lab_details=$this->Payments_model->get_lab_details($login_details['a_id']);
						$payments_year_list=$this->Payments_model->get_lab_payments_list($login_details['a_id']);
						//echo '<pre>';print_r($lab_details);exit;
							if(isset($payments_year_list) && count($payments_year_list)>0){
								$start_date=$end_date='';
								$cnt=1;foreach($payments_year_list as $list){
										$start_date = $list['current_year'].'-01-01';
										$end_date = $list['current_year'].'-12-31';
											for($date = $start_date; $date <= $end_date; $date = date('Y-m-d', strtotime($date. ' + 7 days')))
											{
												$dayss =  date('d', strtotime($date));
												$week =  date('W', strtotime($date));
												$year =  date('Y', strtotime($date));
													if(date('m')==12 && $dayss == 30 || $dayss ==31){
														$year_add =  date('Y');
														$year =  $year_add+1;
														$from = date("Y-m-d", strtotime("{$year}-W{$week}+1")); 
													}else{
														$from = date("Y-m-d", strtotime("{$year}-W{$week}+1")); 
													}
												//Returns the date of monday in week
												if($from < $start_date) $from = $start_date;
													if(date('m')==12 && $dayss == 30 || $dayss ==31){
														$year_add =  date('Y');
														$year =  $year_add+1;
														$to = date("Y-m-d", strtotime("{$year}-W{$week}-7"));   //Returns the date of sunday in week
													}else{
														$to = date("Y-m-d", strtotime("{$year}-W{$week}-7"));   //Returns the date of sunday in week
													}
												
												if($to > $end_date) $to = $end_date;
												//echo 'From'.$from.'to'.$to;
												$weeks_list[$cnt][]=array('From'=>$from,'to'=>$to,'week'=>$dayss);//Output : Start Date-->2012-09-03 End Date-->2012-09-09
											}
								$cnt++;}
							}
							foreach($weeks_list as $lis){
								$count=1;$get_order_list='';foreach($lis as $li){
										//echo '<pre>';print_r($li);
										$get_order_list=$this->Payments_model->get_inbween_week_orders_list($li['From'],$li['to'],$login_details['a_id']);
										$cash_delivery=$this->Payments_model->get_inbween_week_cash_ondelivery_orders_orders_list($li['From'],$li['to'],$login_details['a_id']);
										$org_cash_delivery=$this->Payments_model->get_inbween_week_cash_commision_org_amt_ondelivery_orders_orders_list($li['From'],$li['to'],$login_details['a_id']);
										$online_delivery=$this->Payments_model->get_inbween_week_online_orders_orders_list($li['From'],$li['to'],$login_details['a_id']);
										$org_online_delivery=$this->Payments_model->get_inbween_week_online_orders_commision_org_amt_orders_list($li['From'],$li['to'],$login_details['a_id']);
										if(count($get_order_list)>0){
											//$datas[$count]=$get_order_list;
											$datas[$count]['week_from']=$li['From'];
											$datas[$count]['week_to']=$li['to'];
											$datas[$count]['cash']=isset($cash_delivery['cash_amount'])?$cash_delivery['cash_amount']:'';
											$datas[$count]['online']=isset($online_delivery['online_amount'])?$online_delivery['online_amount']:'';
											$datas[$count]['with_out_delivery_online_amt']=isset($org_online_delivery['online_amount'])?$org_online_delivery['online_amount']:'';
											$datas[$count]['with_out_delivery_cash_amt']=isset($org_cash_delivery['cash_amount'])?$org_cash_delivery['cash_amount']:'';
											$datas[$count]['commision_amt']=($org_cash_delivery['cash_amount']*$lab_details['commission_amt'])/100;
											$datas[$count]['cnt']=+count($get_order_list);
										}
										
									
								$count++;}
							}
							//echo '<pre>';print_r($datas);exit;
							if(isset($datas) && count($datas)>0){
								$data['week_wise_payments']=$datas;
							}else{
								$data['week_wise_payments']=array();
							}
							//echo '<pre>';print_r($data);exit;
					$this->load->view('lab/seller_payments',$data);
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
	public function laborders(){
		if($this->session->userdata('mlab_details'))
			{
			   $login_details=$this->session->userdata('mlab_details');
				if($login_details['role']==2){
					$data['order_list']=$this->History_model->get_lab_orders_list($login_details['a_id']);
					//echo '<pre>';print_r($data);exit;
					$this->load->view('lab/order_list',$data);
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
	public  function pay(){
		if($this->session->userdata('mlab_details'))
			{
				$from_date=base64_decode($this->uri->segment(3));	
				$to_date=base64_decode($this->uri->segment(4));
				//if($from_date!='' && $to_date!=''){
						$login_details=$this->session->userdata('mlab_details');
						$lab_details=$this->Payments_model->get_lab_details($login_details['a_id']);
						$get_order_list=$this->Payments_model->get_inbween_week_orders_list($from_date,$to_date,$login_details['a_id']);
						$cash_delivery=$this->Payments_model->get_inbween_week_cash_ondelivery_orders_orders_list($from_date,$to_date,$login_details['a_id']);
						$org_cash_delivery=$this->Payments_model->get_inbween_week_cash_commision_org_amt_ondelivery_orders_orders_list($from_date,$to_date,$login_details['a_id']);
						$online_delivery=$this->Payments_model->get_inbween_week_online_orders_orders_list($from_date,$to_date,$login_details['a_id']);
						$org_online_delivery=$this->Payments_model->get_inbween_week_online_orders_commision_org_amt_orders_list($from_date,$to_date,$login_details['a_id']);
							if(count($get_order_list)>0){
							//$datas[$count]=$get_order_list;
							$datas['week_from']=$from_date;
							$datas['week_to']=$to_date;
							$datas['cash']=isset($cash_delivery['cash_amount'])?$cash_delivery['cash_amount']:'';
							$datas['online']=isset($online_delivery['online_amount'])?$online_delivery['online_amount']:'';
							$datas['with_out_delivery_online_amt']=isset($org_online_delivery['online_amount'])?$org_online_delivery['online_amount']:'';
							$datas['with_out_delivery_cash_amt']=isset($org_cash_delivery['cash_amount'])?$org_cash_delivery['cash_amount']:'';
							$datas['commision_amt']=($org_cash_delivery['cash_amount']*$lab_details['commission_amt'])/100;
							$datas['cnt']=+count($get_order_list);
						}
						$amount_pay=number_format($datas['commision_amt'], 2, '.', ' ');
						/* payment purpose*/
						$api_id= $this->config->item('keyId');
						$api_Secret= $this->config->item('API_keySecret');
						$api = new RazorpayApi($api_id,$api_Secret);
							//$api = new RazorpayApi($this->config->load('keyId'), $this->config->load('API_keySecret'));
							$orderData = [
									'receipt'         => $login_details['a_id'],
									'amount'          => $amount_pay * 100, // 2000 rupees in paise
									'currency'        => 'INR',
									'payment_capture' => 1 // auto capture
							];

						$razorpayOrder = $api->order->create($orderData);
						$razorpayOrderId = $razorpayOrder['id'];
						$displayAmount = $amount = $orderData['amount'];
						$displayCurrency=$orderData['currency'];
						$datas['lab_details']=$lab_details;
						$datas['details'] = [
											"key"               => $api_id,
											"amount"            => $amount,
											"name"              => $lab_details['name'],
											"description"       => "cash on delivery orders commision amount",
											"image"             => "",
											"prefill"           => [
											"name"              => $lab_details['name'],
											"email"             => $lab_details['email'],
											"contact"           => $lab_details['mobile'],
											],
											"notes"             => [
											"address"           => $lab_details['address1'].$lab_details['city'],
											"merchant_order_id" => $razorpayOrder['id'],
											],
											"theme"             => [
											"color"             => "#F37254"
											],
											"order_id"          => $razorpayOrderId,
											"display_currency"          => $orderData['currency'],
							];
							
					$this->load->view('lab/pay',$datas);
					$this->load->view('admin/footer');
					//echo '<pre>';print_r($datas);exit;
					
				// }else{
					// $this->session->set_flashdata('error','Please login to continue');
					// redirect('Payments/index');
				// }
				

			
				
			}else{
			   $this->session->set_flashdata('error','Please login to continue');
			  redirect('admin');
		}
	}
	
}
