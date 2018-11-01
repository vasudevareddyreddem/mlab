<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pharmacy_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	
	public  function save_pharmacy($data){
		$this->db->insert('admin',$data);
		return $this->db->insert_id();
	}
	
	
	public  function get_all_pharmacy_details($a_id){
		$this->db->select('a_id,role,name,email,mobile,altmobile,address1,address2,city,state,country,zipcode,profile_pic,created_at,status')->from('admin');
		$this->db->where('created_by',$a_id);
		$this->db->where('status !=',2);
		$this->db->where('role',3);
		return $this->db->get()->result_array();
	}
	public  function update_seller_pharmacy_details($a_id,$data){
		$this->db->where('a_id',$a_id);
		return $this->db->update('admin',$data);
	}
	public  function get_pharmacy_details($a_id){
		$this->db->select('*')->from('admin');
		$this->db->where('a_id',$a_id);
		return $this->db->get()->row_array();
	}
	
	
	
	

}