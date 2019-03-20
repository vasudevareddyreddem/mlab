<?php
/**
 *
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pharmacypickupboy_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
    $this->load->database("default");
	$this->db2 = $this->load->database('another', TRUE);
  }
   public  function insert($data){
	   $this->db->insert('admin',$data);
	   return $this->db->insert_id();
	}
	public  function get_pickupboy($a_id){
	return $this->db->get_where('admin',array('role' => 5 ,'status !=' => 2,'created_by' => $a_id))->result();	
	}
	public  function update_pickupboy_details($a_id,$data){
		$this->db->where('a_id',$a_id);
		return $this->db->update('admin',$data);
	}
	public  function get_pickupboy_details($a_id){
		$this->db->select('*')->from('admin');	
		$this->db->where('a_id',$a_id);
		return $this->db->get()->row_array();
	}
	public function accepted_orders_for_pickup($phar_id)
	{
		$this->db->select('po.cust_order_id,cot.med_img,cot.phar_id,cot.address,cot.cust_id,po.status')->from('pharmacy_orders as po');
		$this->db->join('cust_orders_tab as cot', 'cot.id = po.cust_order_id', 'left');
		$this->db->where('cot.phar_id',$phar_id);
		$this->db->where('po.status!=',3);
		$this->db->group_by('po.cust_order_id');
		return $this->db->get()->result_array();
	}
	public function completed_orders($phar_id)
	{
		$this->db->select('po.cust_order_id,po.updated_date,cot.med_img,cot.phar_id,cot.address,cot.cust_id,po.status')->from('pharmacy_orders as po');
		$this->db->join('cust_orders_tab as cot', 'cot.id = po.cust_order_id', 'left');
		$this->db->where('cot.phar_id',$phar_id);
		$this->db->where('po.status',3);
		$this->db->group_by('po.cust_order_id');
		return $this->db->get()->result_array();
	}
	
	public  function get_customer_details($cust_id){
		$this->db2->select('name,email,mobile')->from('appointment_users');	
		$this->db2->where('a_u_id',$cust_id);
		return $this->db2->get()->row_array();
	}
	public  function update_order_details($order_id,$data){
		$this->db->where('cust_order_id',$order_id);
		return $this->db->update('pharmacy_orders',$data);
	}
	
}
?>
