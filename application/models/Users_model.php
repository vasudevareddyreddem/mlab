<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model 

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
	
	/* prview  purpose*/
	public  function get_logo_details(){
		$this->db->select('*')->from('logo');
		$this->db->where('status',1);
		return $this->db->get()->row_array();
	}public  function get_slider_details(){
		$this->db->select('s_id,text,image')->from('slider');
		$this->db->where('status',1);
		return $this->db->get()->result_array();
	}public  function get_aboutus_details(){
		$this->db->select('*')->from('aboutus');
		$this->db->where('status',1);
		return $this->db->get()->row_array();
	}public  function get_services_details(){
		$this->db->select('*')->from('services');
		$this->db->where('status',1);
		return $this->db->get()->row_array();
	}
	public  function get_gallery_details(){
		$this->db->select('*')->from('gallery');
		$this->db->where('status',1);
		return $this->db->get()->result_array();
	}public  function get_testimonials_details(){
		$this->db->select('*')->from('testimonial');
		$this->db->where('status',1);
		return $this->db->get()->result_array();
	}public  function get_contactus_details(){
		$this->db->select('*')->from('contactform');
		return $this->db->get()->row_array();
	}
		/* home  purpose*/
	public  function get_home_logo_details(){
		$this->db->select('*')->from('logo');
		$this->db->where('status',1);
		$this->db->where('homepage_preview',1);
		return $this->db->get()->row_array();
	}
	public  function get_home_slider_details(){
		$this->db->select('s_id,text,image')->from('slider');
		$this->db->where('status',1);
		$this->db->where('homepage_preview',1);
		return $this->db->get()->result_array();
	}
	public  function get_home_aboutus_details(){
		$this->db->select('*')->from('aboutus');
		$this->db->where('homepage_preview',1);
		$this->db->where('status',1);
		return $this->db->get()->row_array();
	}
	public  function get_home_services_details(){
		$this->db->select('*')->from('services');
		$this->db->where('homepage_preview',1);
		$this->db->where('status',1);
		return $this->db->get()->row_array();
	}
	public  function get_home_gallery_details(){
		$this->db->select('*')->from('gallery');
		$this->db->where('homepage_preview',1);
		$this->db->where('status',1);
		return $this->db->get()->result_array();
	}
	public  function get_home_testimonials_details(){
		$this->db->select('*')->from('testimonial');
		$this->db->where('status',1);
		$this->db->where('homepage_preview',1);
		return $this->db->get()->result_array();
	}
	public  function get_home_contactus_details(){
		$this->db->select('*')->from('contactform');
		$this->db->where('homepage_preview',1);
		return $this->db->get()->row_array();
	}
	
	/* update home  page  preview  status*/
	public  function update_home_page_preview_status($s_id,$data){
		$this->db->where('s_id',$s_id);
		return $this->db->update('slider',$data);
		
	}
	public  function update_home_page_gallery_preview_status($g_id,$data){
		$this->db->where('g_id',$g_id);
		return $this->db->update('gallery',$data);
	}
	public  function update_home_page_estimonials_preview_status($g_id,$data){
		$this->db->where('t_id',$g_id);
		return $this->db->update('testimonial',$data);
	}
	public  function update_home_page_about_us_preview_status($a_id,$data){
		$this->db->where('a_id',$a_id);
		return $this->db->update('aboutus',$data);
	}
	public  function update_home_page_services_preview_status($s_id,$data){
		$this->db->where('s_id',$s_id);
		return $this->db->update('services',$data);
	}
	public  function update_home_page_contactus_details_preview_status($c_id,$data){
		$this->db->where('c_id',$c_id);
		return $this->db->update('contactform',$data);
	}
	
	
	

}