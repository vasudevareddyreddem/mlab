<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lab_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	
	public  function save_seller($data){
		$this->db->insert('admin',$data);
		return $this->db->insert_id();
	}
	
	
	
	
	

}