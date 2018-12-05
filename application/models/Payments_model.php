<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payments_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	
	
/* get order item details */
	public  function get_lab_payments_list($l_id){
		$this->db->select('DATE_FORMAT(crerated_at, "%Y") as current_year')->from('lab_order_items');
		$this->db->where('lab_order_items.l_id',$l_id);
		$this->db->group_by('DATE_FORMAT(crerated_at, "%Y")');
		$this->db->order_by('order_item_id',"asc");
		return $this->db->get()->result_array();
		
	}
	public  function get_inbween_week_orders_list($form_date,$to_date,$l_id){
		$this->db->select('lab_order_items.order_item_id,lab_order_items.order_id,lab_order_items.total_amt,lab_orders.payment_type')->from('lab_order_items');
		$this->db->join('lab_orders', 'lab_orders.r_id = lab_order_items.order_id', 'left');
		$this->db->where("DATE_FORMAT(crerated_at,'%Y-%m-%d') >=",$form_date);
		$this->db->where("DATE_FORMAT(crerated_at,'%Y-%m-%d') <=",$to_date);
		$this->db->where('lab_order_items.l_id',$l_id);
		$this->db->where('lab_order_items.status',1);
		$this->db->where('lab_order_items.lab_status',1);
		return $this->db->get()->result_array();
	}
	public  function get_inbween_week_cash_ondelivery_orders_orders_list($form_date,$to_date,$l_id){
		$this->db->select('SUM(total_amt) as cash_amount')->from('lab_order_items');
		$this->db->join('lab_orders', 'lab_orders.r_id = lab_order_items.order_id', 'left');

		$this->db->where("DATE_FORMAT(crerated_at,'%Y-%m-%d') >=",$form_date);
		$this->db->where("DATE_FORMAT(crerated_at,'%Y-%m-%d') <=",$to_date);
		$this->db->where('lab_order_items.l_id',$l_id);
		$this->db->where('lab_order_items.status',1);
		$this->db->where('lab_order_items.lab_status',1);
		$this->db->where('lab_orders.payment_type !=',1);
		return $this->db->get()->row_array();
	}
	public  function get_inbween_week_online_orders_orders_list($form_date,$to_date,$l_id){
		$this->db->select('SUM(total_amt) as online_amount')->from('lab_order_items');
		$this->db->join('lab_orders', 'lab_orders.r_id = lab_order_items.order_id', 'left');

		$this->db->where("DATE_FORMAT(crerated_at,'%Y-%m-%d') >=",$form_date);
		$this->db->where("DATE_FORMAT(crerated_at,'%Y-%m-%d') <=",$to_date);
		$this->db->where('lab_order_items.l_id',$l_id);
		$this->db->where('lab_order_items.status',1);
		$this->db->where('lab_order_items.lab_status',1);
		$this->db->where('lab_orders.payment_type',1);
		return $this->db->get()->row_array();
	}
	public  function get_inbween_week_online_orders_commision_org_amt_orders_list($form_date,$to_date,$l_id){
		$this->db->select('SUM(amount) as online_amount')->from('lab_order_items');
		$this->db->join('lab_orders', 'lab_orders.r_id = lab_order_items.order_id', 'left');

		$this->db->where("DATE_FORMAT(crerated_at,'%Y-%m-%d') >=",$form_date);
		$this->db->where("DATE_FORMAT(crerated_at,'%Y-%m-%d') <=",$to_date);
		$this->db->where('lab_order_items.l_id',$l_id);
		$this->db->where('lab_order_items.status',1);
		$this->db->where('lab_order_items.lab_status',1);
		$this->db->where('lab_orders.payment_type',1);
		return $this->db->get()->row_array();
	}
	public  function get_inbween_week_cash_commision_org_amt_ondelivery_orders_orders_list($form_date,$to_date,$l_id){
		$this->db->select('SUM(amount) as cash_amount')->from('lab_order_items');
		$this->db->join('lab_orders', 'lab_orders.r_id = lab_order_items.order_id', 'left');

		$this->db->where("DATE_FORMAT(crerated_at,'%Y-%m-%d') >=",$form_date);
		$this->db->where("DATE_FORMAT(crerated_at,'%Y-%m-%d') <=",$to_date);
		$this->db->where('lab_order_items.l_id',$l_id);
		$this->db->where('lab_order_items.status',1);
		$this->db->where('lab_order_items.lab_status',1);
		$this->db->where('lab_orders.payment_type !=',1);
		return $this->db->get()->row_array();
	}
	/* lab details */
	public  function get_lab_details($a_id){
		$this->db->select('a_id,role,name,commission_amt')->from('admin');
		$this->db->where('admin.a_id',$a_id);
		return $this->db->get()->row_array();
	}
	
	
	
	
	

}