<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seller_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	
	public  function save_contactus($data){
		$this->db->insert('contactus',$data);
		return $this->db->insert_id();
	}
	
	
	public  function update_contact_details($c_id,$data){
		$this->db->where('c_id',$u_id);
		return $this->db->update('contactform',$data);
	}
	
	public  function get_contact_details($c_id){
		$this->db->select('*')->from('contactform');
		$this->db->where('c_id',$c_id);
		return $this->db->get()->row_array();
	}
	
	
	
	

}