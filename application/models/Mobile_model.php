<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mobile_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	
	//*add patient*/
	public function check_mobile_num($num){
		$this->db->select('u.u_id')->from('users as u');
		$this->db->where('u.mobile',$num);
		$this->db->where('u.status',1);
		$this->db->where('u.otp_verified',1);
        return $this->db->get()->row_array();
	}
	public function check_otp($id,$otp){
		$this->db->select('u.u_id,u.otp,u.otp_verified')->from('users as u');
		$this->db->where('u.u_id',$id);
		$this->db->where('u.otp',$otp);
		$this->db->where('u.status',1);
		$this->db->where('u.otp_verified',0);
        return $this->db->get()->row_array();
	}
	public function check_user_details($id){
		$this->db->select('u.u_id,u.mobile,u.otp')->from('users as u');
		$this->db->where('u.u_id',$id);
		$this->db->where('u.status',1);
		$this->db->where('u.otp_verified',0);
        return $this->db->get()->row_array();
	}
	public  function save_user($d){
		$this->db->insert('users',$d);
		return $this->db->insert_id();
	}
	
	public  function update_user($id,$d){
		$this->db->where('u_id',$id);
		return $this->db->update('users',$d);
	}
	public function get_qr_code_num(){
		$this->db->select('u.u_id,u.barcode_text')->from('users as u');
		$this->db->order_by('u.u_id','desc');
        return $this->db->get()->row_array();
	}
	/* user login */
	public  function check_login_details($mob,$pwd){
		$this->db->select('u.u_id,u.otp_verified,u.mobile,u.name')->from('users as u');
		$this->db->where('u.mobile',$mob);
		$this->db->where('u.password',$pwd);
		$this->db->where('u.status',1);
		$this->db->order_by('u.u_id','desc');
		//$this->db->where('u.otp_verified',1);
        return $this->db->get()->row_array();
	}
	public  function get_user_details($id){
		$this->db->select('u.u_id,u.role,u.name,u.email,u.mobile,u.barcode,u.barcode_text,u.address,u.profile_pic')->from('users as u');
		$this->db->where('u.u_id',$id);
        return $this->db->get()->row_array();
	}
	public  function get_user_password($id){
		$this->db->select('u.u_id,u.password')->from('users as u');
		$this->db->where('u.u_id',$id);
        return $this->db->get()->row_array();
	}
	public function get_forgot_user_details($e){
		$this->db->select('u_id,email,name,mobile,otp_verified,org_password')->from('users');
		$this->db->where('org_password is  NOT NULL');
		$this->db->where('email',$e);
		$this->db->or_where('mobile',$e);
		return $this->db->get()->row_array();
	}
	public  function check_login_mobile($mob){
		$this->db->select('u.u_id,u.otp_verified,u.mobile,u.name')->from('users as u');
		$this->db->where('u.mobile',$mob);
		$this->db->where('u.status',1);
        return $this->db->get()->row_array();
	}
	/* shipping address */
	public function save_shipping_address($d){
		$this->db->insert('shipping_address',$d);
		return $this->db->insert_id();
	}
	public  function update_shipping_address($id,$d){
		$this->db->where('s_ad_id',$id);
		return $this->db->update('shipping_address',$d);
	}
	
	
	
	
	
	
}