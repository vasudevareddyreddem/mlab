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
		$this->db->where('status !=', 2);
        return $this->db->get()->row_array();	
	}
	public function active_check_email_exits($email){
		$this->db->select('email,org_password')->from('admin');		
		$this->db->where('email', $email);
		$this->db->where('status', 1);
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
	
	public  function get_lab_total_list($a_id){
		$this->db->select('COUNT(a_id) as cnt')->from('admin');		
		$this->db->where('created_by', $a_id);
		$this->db->where('status', 1);
		$this->db->where('role', 2);
        return $this->db->get()->row_array();
	}
	public  function get_all_lab_total_list($a_id){
		$this->db->select('a_id,created_at')->from('admin');		
		$this->db->where('created_by', $a_id);
		$this->db->where('status', 1);
		$this->db->where('role', 2);
        return $this->db->get()->result_array();
	}
	public  function get_all_pharmacy_total_list($a_id){
		$this->db->select('a_id,created_at')->from('admin');		
		$this->db->where('created_by', $a_id);
		$this->db->where('status', 1);
		$this->db->where('role', 3);
        return $this->db->get()->result_array();
	}
	public  function get_pharmacy_total_list($a_id){
		$this->db->select('COUNT(a_id) as cnt')->from('admin');		
		$this->db->where('created_by', $a_id);
		$this->db->where('status', 1);
		$this->db->where('role', 3);
        return $this->db->get()->row_array();
	}
	
	
	
	
	

}