<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	public  function login_details($data){
		$this->db->select('*')->from('admin');		
		$this->db->where('email', $data['email']);
		$this->db->where('password',$data['password']);
		$this->db->where('status', 1);
        return $this->db->get()->row_array();
	}
	
	public  function get_admin_details($id){
		$this->db->select('*')->from('admin');		
		$this->db->where('a_id',$id);
        return $this->db->get()->row_array();
	}
	public function check_email_exits($email){
		$this->db->select('*')->from('admin');		
		$this->db->where('email', $email);
        return $this->db->get()->row_array();	
	}
	public  function update_profile_details($id,$data){
		$this->db->where('a_id',$id);
    	return $this->db->update("admin",$data);
	}
	public function get_adminpassword_details($admin_id){
		$this->db->select('admin.password')->from('admin');		
		$this->db->where('a_id', $admin_id);
		$this->db->where('status', 1);
        return $this->db->get()->row_array();	
	}
	
	
	
	
	

}