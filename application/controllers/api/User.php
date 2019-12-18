<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class User extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
		$this->load->library('email');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('security');
		$this->load->model('Mobile_model');
		$this->load->library('zend');
    }

	public function login_post()
    {
        $mobile=$this->post('mobile');
        $password=$this->post('pwd');
		if($mobile ==''){
			$message = array('status'=>0,'message'=>'mobile is required');
			$this->response($message, REST_Controller::HTTP_OK);			
		}if($password ==''){
			$message = array('status'=>0,'message'=>'Password is required');
			$this->response($message, REST_Controller::HTTP_OK);			
		}
		$check_login=$this->Mobile_model->check_login_details($mobile,md5($password));
		if(count($check_login)>0){
				if($check_login['otp_verified']==1){
					$message = array('status'=>1,'u_id'=>$check_login['u_id'],'message'=>'User successfully Login');
					$this->response($message, REST_Controller::HTTP_OK);
				}else{
					$message = array('status'=>0, 'u_id'=>$check_login['u_id'],'message'=>'Your Mobile number not verified. Please verify your mobile number.');
					$this->response($message, REST_Controller::HTTP_OK);
				}
			}else{
				$message = array('status'=>0,'message'=>'Login Details are wrong. Plase try again.');
				$this->response($message, REST_Controller::HTTP_OK);
			}

	}
	
	public function register_post()
    {
        $name=$this->post('name');
        $email=$this->post('email');
        $mobile=$this->post('mobile');
        $password=$this->post('password');
		if($name ==''){
		$message = array('status'=>0,'message'=>'Email is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		if($mobile ==''){
		$message = array('status'=>0,'message'=>'mobile is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($password ==''){
		$message = array('status'=>0,'message'=>'Password is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$check=$this->Mobile_model->check_mobile_num($mobile);
		if(count($check)>0){
			$message = array('status'=>0,'message'=>'Mobile number already used. Please use another Mobile number.');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		$otp=mt_rand(100000, 999999);
		$a_d=array(
			'role'=>1,
			'name'=>isset($name)?$name:'',
			'email'=>isset($email)?$email:'',
			'mobile'=>isset($mobile)?$mobile:'',
			'password'=>isset($password)?md5($password):'',
			'profile_pic'=>'noimg.png',
			'org_password'=>isset($password)?$password:'',
			'otp'=>isset($otp)?$otp:'',
			'created_at'=>date('Y-m-d H:i:s'),
		);
		$save=$this->Mobile_model->save_user($a_d);
		if(count($save)>0){
			/*qr code */
				$qc=$this->Mobile_model->get_qr_code_num();
				$number =($qc['u_id']);
				$unique = str_pad($number, 8, "0", STR_PAD_LEFT);
				$qcode = "KMS".$unique;
				$this->load->library('ciqrcode');
				$params['data'] =$qcode;
				$params['level'] = 'H';
				$params['size'] =3;
				$params['cachedir'] = FCPATH.'assets/userbarcode/';
				$qrcode_img=$number.'-'.time().'.png';
				$path='assets/userbarcode/'.$qrcode_img;
				$params['savename'] =FCPATH.$path;
				$this->ciqrcode->generate($params);
				$u_q_d=array('barcode'=>$qrcode_img,'barcode_text'=>$qcode);
				$this->Mobile_model->update_user($save,$u_q_d);
			/*qr code */
			/*sms*/
				$apikey=$this->config->item('apikey');
				$sender=$this->config->item('sender');
				$msg = "Your register Otp is : ".$otp;
				$ch2 = curl_init();
				curl_setopt($ch2, CURLOPT_URL,'http://sms.pearlsms.com/public/sms/send');
				curl_setopt($ch2, CURLOPT_POST, 1);
				curl_setopt($ch2, CURLOPT_POSTFIELDS,'sender='.$sender.'&smstype=TRANS&numbers='.$mobile.'&apikey='.$apikey.'&message='.$msg.'');
				curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
				$server_output = curl_exec ($ch2);
				curl_close ($ch2);
			/*sms*/				
			$message = array('status'=>1,'u_id'=>$save,'message'=>'Otp Send to your mobile number check it once');
			$this->response($message, REST_Controller::HTTP_OK);
		}else{
				$message = array('status'=>0,'message'=>'Technical problem will occured. Please try again.');
				$this->response($message, REST_Controller::HTTP_OK);
		}

	}
	public function mobileverify_post()
    {
        $u_id=$this->post('u_id');
        $otp=$this->post('otp');
		if($u_id ==''){
		$message = array('status'=>0,'message'=>'user_id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($otp ==''){
			$message = array('status'=>0,'message'=>'otp is required');
			$this->response($message, REST_Controller::HTTP_OK);			
		}
		$check=$this->Mobile_model->check_otp($u_id,$otp);
		//echo '<pre>';print_r($check);exit;
		if(count($check)>0){
			if($check['otp']==$otp){
				$u_a_d=array(
					'otp_verified'=>1,
					'updated_at'=>date('Y-m-d H:i:s'),
				);
				$update=$this->Mobile_model->update_user($u_id,$u_a_d);
				if(count($update)>0){
					$message = array('status'=>1,'u_id'=>$u_id,'message'=>'Mobile verified successfully');
					$this->response($message, REST_Controller::HTTP_OK);
				}else{
					$message = array('status'=>0,'u_id'=>$u_id,'message'=>'Technical problem will occured. Please try again.');
					$this->response($message, REST_Controller::HTTP_OK);
				}
			}else{
				$message = array('status'=>0,'u_id'=>$u_id,'message'=>'OTP not matched. Please try again.');
				$this->response($message, REST_Controller::HTTP_OK);
			}
							
		}else{
			$message = array('status'=>0,'u_id'=>$u_id,'message'=>'Data not found. Please try again.');
			$this->response($message, REST_Controller::HTTP_OK);
		}

	}
	public function otpresend_post()
    {
        $u_id=$this->post('u_id');
		if($u_id ==''){
		$message = array('status'=>0,'message'=>'user_id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$check=$this->Mobile_model->check_user_details($u_id);
		//echo '<pre>';print_r($check);exit;
		if(count($check)>0){
				$u_a_d=array(
					'otp_verified'=>0,
					'updated_at'=>date('Y-m-d H:i:s'),
				);
				$update=$this->Mobile_model->update_user($u_id,$u_a_d);
				if(count($update)>0){
						$apikey=$this->config->item('apikey');
						$sender=$this->config->item('sender');
						$msg = "Your register Otp is : ".$check['otp'];
						$mobile=$check['mobile'];
						$ch2 = curl_init();
						curl_setopt($ch2, CURLOPT_URL,'http://sms.pearlsms.com/public/sms/send');
						curl_setopt($ch2, CURLOPT_POST, 1);
						curl_setopt($ch2, CURLOPT_POSTFIELDS,'sender='.$sender.'&smstype=TRANS&numbers='.$mobile.'&apikey='.$apikey.'&message='.$msg.'');
						curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
						$server_output = curl_exec ($ch2);
						curl_close ($ch2);	
						//echo '<pre>';print_r($server_output);exit;
					$message = array('status'=>1,'u_id'=>$u_id,'message'=>'Otp Send to your mobile number check it once');
					$this->response($message, REST_Controller::HTTP_OK);
				}else{
					$message = array('status'=>0,'u_id'=>$u_id,'message'=>'Technical problem will occured. Please try again.');
					$this->response($message, REST_Controller::HTTP_OK);
				}
							
		}else{
			$message = array('status'=>0,'u_id'=>$u_id,'message'=>'Data not found. Please try again.');
			$this->response($message, REST_Controller::HTTP_OK);
		}

	}
	public function details_post()
    {
        $u_id=$this->post('u_id');
		if($u_id ==''){
		$message = array('status'=>0,'message'=>'user_id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$details=$this->Mobile_model->get_user_details($u_id);
		if(count($details)>0){
			$message = array('status'=>1,'details'=>$details,'barcode'=>base_url('assets/userbarcode'), 'path'=>base_url('assets/profile_pic'),'message'=>'User details are found');
			$this->response($message, REST_Controller::HTTP_OK);					
		}else{
			$message = array('status'=>0,'details'=>new stdClass(),'barcode'=>base_url('assets/userbarcode'),'path'=>base_url('assets/profile_pic'),'message'=>'User details are not found. Please try again.');
			$this->response($message, REST_Controller::HTTP_OK);
		}

	}
	 public function changepwd_post()
    {
		$u_id=$this->post('u_id');
		$pwd=$this->post('pwd');
		$oldpwd=$this->post('oldpwd');
        if($u_id==''){
            $message = array('status' => 0,'message' => 'User id is required');
            $this->response($message, REST_Controller::HTTP_OK);
        }if($pwd==''){
            $message = array('status' => 0,'message' => 'Password is required');
            $this->response($message, REST_Controller::HTTP_OK);
        }if($oldpwd==''){
            $message = array('status' => 0,'message' => 'Old password is required');
            $this->response($message, REST_Controller::HTTP_OK);
        }		
		$d=$this->Mobile_model->get_user_password($u_id);
		//echo '<pre>';print_r($d);exit;
			if($d['password']==md5($oldpwd)){
				$add=array(
				'password'=>isset($pwd)?md5($pwd):'',
				'org_password'=>isset($pwd)?$pwd:'',
				'updated_at'=>date('Y-m-d H:i:s'),
				);
				$update=$this->Mobile_model->update_user($u_id,$add);
				if(count($update)>0){
						$message = array('status'=>1,'u_id'=>$u_id,'message'=>'Password successfully Updated');
						$this->response($message, REST_Controller::HTTP_OK);
				}else{
					$message = array('status'=>0,'u_id'=>$u_id,'message'=>'Technical problem will occurred .Please try again');
					$this->response($message, REST_Controller::HTTP_OK);
				}
			}else{
				$message = array('status' => 0,'u_id'=>$u_id,'message' => 'Your password and confirmation password do not match');
				$this->response($message, REST_Controller::HTTP_OK);
			}
			
     }
	 
	 public function updateprofile_post()
    {
		$u_id=$this->post('u_id');
		$email = $this->post('email');
		$name = $this->post('name');
		$mobile = $this->post('mobile');
		$address = $this->post('address');
       if($u_id=='') {
            $message = array('status' => 0,'message' => 'User id is required');
            $this->response($message, REST_Controller::HTTP_OK);
        }if($email=='') {
            $message = array('status' => 0,'message' => 'Email is required');
            $this->response($message, REST_Controller::HTTP_OK);
        }if($name=='') {
            $message = array('status' => 0,'message' => 'Name is required');
            $this->response($message, REST_Controller::HTTP_OK);
        }
		if($mobile=='') {
            $message = array('status' => 0,'message' => 'mobile is required');
            $this->response($message, REST_Controller::HTTP_OK);
        }if($address=='') {
            $message = array('status' => 0,'message' => 'Address is required');
            $this->response($message, REST_Controller::HTTP_OK);
        }
		$d=$this->Mobile_model->get_user_details($u_id);
		//echo '<pre>';print_r($d);exit;
			if($d['mobile']!=$mobile){
				$check=$this->Mobile_model->check_login_mobile($mobile);
				if(count($check)>0){
						 $message = array('status' => 0,'message' => 'Mobile number already exists. Please use another mobile number');
						$this->response($message, REST_Controller::HTTP_OK);				
				}
			}
			$add=array(
			'email'=>isset($email)?$email:'',
			'name'=>isset($name)?$name:'',
			'mobile'=>isset($mobile)?$mobile:'',
			'address'=>isset($address)?$address:'',
			'updated_at'=>date('Y-m-d H:i:s'),
			);
			$update=$this->Mobile_model->update_user($u_id,$add);
			if(count($update)>0){
					$message = array('status'=>1,'u_id'=>$u_id, 'message'=>'User details successfully Updated');
					$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}
			
     }
	 public  function profileimage_post(){
		$u_id=$this->post('u_id');
		if($u_id=='') {
			$message = array('status' => 0,'message' => 'User id is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		if(count($_FILES)==0){
			$message = array('status'=>0,'message'=>'upload image is required');
			$this->response($message, REST_Controller::HTTP_OK);	
		}
		$d=$this->Mobile_model->get_user_details($u_id);
		if($d['profile_pic']!=''){
			unlink('assets/profile_pic/'.$d['profile_pic']);
		}
		$pic=$_FILES['img']['name'];
		$picname = str_replace(" ", "", $pic);
		$imagename=microtime().basename($picname);
		$imgname = str_replace(" ", "", $imagename);
		if(move_uploaded_file($_FILES['img']['tmp_name'], 'assets/profile_pic/'.$imgname)){
			$addimg=array(
			'profile_pic'=>$imgname,
			);
			$save_img=$this->Mobile_model->update_user($u_id,$addimg);
			if(count($save_img)>0){
					$message = array('status'=>1,'u_id'=>$u_id,'path'=>base_url('assets/profile_pic/'),'message'=>'Image successfully Updated');
					$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}
			
		}else{
			$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		
	 }
	
	public  function forgotpwd_post(){
			$email=$this->post('mobile');
			if($email==''){
				$message = array('status'=>0,'message'=>'Mobile/Email id is required');
				$this->response($message, REST_Controller::HTTP_OK);			
			}
			$checking=$this->Mobile_model->get_forgot_user_details($email);
			if(count($checking)>0){
				if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
						$this->load->library('email');
						$this->email->set_newline("\r\n");
						$this->email->set_mailtype("html");
						$this->email->from($checking['email']);
						$this->email->to('info@keerthipharmacy.com');
						$this->email->subject('forgot - password');
						$body =  $checking['name']." your account login password  is :  ".$checking['org_password'].' ';
						$this->email->message($body);
						$this->email->send();
						
						$message = array('status'=>1,'message'=>'Temporary password sent to your registered Email address check it once');
						$this->response($message, REST_Controller::HTTP_OK);
				} else {
					$apikey=$this->config->item('apikey');
					$sender=$this->config->item('sender');
					$msg = $checking['name']." your account login password  is :  ".$checking['org_password'].' ';
					$ch2 = curl_init();
					curl_setopt($ch2, CURLOPT_URL,'http://sms.pearlsms.com/public/sms/send');
					curl_setopt($ch2, CURLOPT_POST, 1);
					curl_setopt($ch2, CURLOPT_POSTFIELDS,'sender='.$sender.'&smstype=TRANS&numbers='.$checking['mobile'].'&apikey='.$apikey.'&message='.$msg.'');
					curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
					$server_output = curl_exec ($ch2);
					curl_close ($ch2);
					$message = array('status'=>1,'message'=>'Temporary password sent to your registered mobile number check it once');
					$this->response($message, REST_Controller::HTTP_OK);
				}
			
			}else{
					$message = array('status'=>1,'message'=>'Invalid enter email/mobile number . Please try again.');
					$this->response($message, REST_Controller::HTTP_OK);
			}
		
	}
	
	
	
	
	public  function add_address_post(){
			$u_id=$this->post('u_id');
			$address=$this->post('address');
			if($u_id==''){
				$message = array('status'=>0,'message'=>'User id is required');
				$this->response($message, REST_Controller::HTTP_OK);			
			}if($address==''){
				$message = array('status'=>0,'message'=>'Address  is required');
				$this->response($message, REST_Controller::HTTP_OK);			
			}
			$add=array(
			'u_id'=>isset($u_id)?$u_id:'',
			'address'=>isset($address)?$address:'',
			'created_at'=>date('Y-m-d H:i:s'),
			'created_by'=>isset($u_id)?$u_id:'',
			);
			$save=$this->Mobile_model->save_shipping_address($add);
			if(count($save)>0){
					$message = array('status'=>1,'s_ad_id'=>$save,'message'=>'Shipping address added successfully');
			     	$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array('status'=>0, 'message'=>'Technical problem will occurred .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}
	}
	public  function edit_address_post(){
			$s_ad_id=$this->post('s_ad_id');
			$name=$this->post('name');
			$mobile=$this->post('mobile');
			$email=$this->post('email');
			$address=$this->post('address');
			$landmark=$this->post('landmark');
			$city=$this->post('city');
			$state=$this->post('state');
			$country=$this->post('country');
			$pincode=$this->post('pincode');
			if($s_ad_id==''){
				$message = array('status'=>0,'message'=>'Save address id is required');
				$this->response($message, REST_Controller::HTTP_OK);			
			}if($name==''){
				$message = array('status'=>0,'message'=>'Name  is required');
				$this->response($message, REST_Controller::HTTP_OK);			
			}if($mobile==''){
				$message = array('status'=>0,'message'=>'Mobile  is required');
				$this->response($message, REST_Controller::HTTP_OK);			
			}if($email==''){
				$message = array('status'=>0,'message'=>'Email  is required');
				$this->response($message, REST_Controller::HTTP_OK);			
			}if($address==''){
				$message = array('status'=>0,'message'=>'Address  is required');
				$this->response($message, REST_Controller::HTTP_OK);			
			}if($landmark==''){
				$message = array('status'=>0,'message'=>'Land Mark  is required');
				$this->response($message, REST_Controller::HTTP_OK);			
			}if($city==''){
				$message = array('status'=>0,'message'=>'City is required');
				$this->response($message, REST_Controller::HTTP_OK);			
			}if($state==''){
				$message = array('status'=>0,'message'=>'State is required');
				$this->response($message, REST_Controller::HTTP_OK);			
			}if($country==''){
				$message = array('status'=>0,'message'=>'Country is required');
				$this->response($message, REST_Controller::HTTP_OK);			
			}if($pincode==''){
				$message = array('status'=>0,'message'=>'Pincode is required');
				$this->response($message, REST_Controller::HTTP_OK);			
			}
			$ud=array(
			'name'=>isset($name)?$name:'',
			'mobile'=>isset($mobile)?$mobile:'',
			'email'=>isset($email)?$email:'',
			'address'=>isset($address)?$address:'',
			'landmark'=>isset($landmark)?$landmark:'',
			'city'=>isset($city)?$city:'',
			'state'=>isset($state)?$state:'',
			'country'=>isset($country)?$country:'',
			'pincode'=>isset($pincode)?$pincode:'',
			'updated_at'=>date('Y-m-d H:i:s'),
			);
			$update=$this->Mobile_model->update_shipping_address($s_ad_id,$ud);
			if(count($update)>0){
					$message = array('status'=>1,'s_ad_id'=>$s_ad_id,'message'=>'Shipping address updated successfully');
			     	$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array('status'=>0,'s_ad_id'=>$s_ad_id,'message'=>'Technical problem will occurred .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}
	}
	public  function delete_address_post(){
			$s_ad_id=$this->post('s_ad_id');
			if($s_ad_id==''){
				$message = array('status'=>0,'message'=>'Save address id is required');
				$this->response($message, REST_Controller::HTTP_OK);			
			}
			$ud=array(
			'status'=>2,
			'updated_at'=>date('Y-m-d H:i:s'),
			);
			$update=$this->Mobile_model->update_shipping_address($s_ad_id,$ud);
			if(count($update)>0){
					$message = array('status'=>1,'s_ad_id'=>$s_ad_id,'message'=>'Shipping address deleted successfully');
			     	$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array('status'=>0,'s_ad_id'=>$s_ad_id,'message'=>'Technical problem will occurred .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}
	}
	public  function delivery_address_list_post(){
			$user_id=$this->post('user_id');
			if($user_id==''){
				$message = array('status'=>0,'message'=>'User id is required');
				$this->response($message, REST_Controller::HTTP_OK);			
			}
			$a_list=$this->Mobile_model->get_shipping_address_list($user_id);
			if(count($a_list)>0){
				$message = array('status'=>1,'user_id'=>$user_id,'list'=>$a_list,'message'=>'Address list are found');
				$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array('status'=>0,'user_id'=>$user_id,'list'=>array(),'message'=>'Address list are not found');
				$this->response($message, REST_Controller::HTTP_OK);
			}
	}
	public  function parentcredential_post(){
				$details=array('key'=>'rzp_test_1CSnweG2HOTawb','API_keySecret'=>'5idRiZ46N5rQFBWwVwBgtABF');
				$message = array('status'=>1,'detail'=>$details,'message'=>'Details are found');
				$this->response($message, REST_Controller::HTTP_OK);
			
	}
	
	
	

}
