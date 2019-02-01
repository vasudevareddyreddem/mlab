<?php
/**
 *
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pickupboy_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
    $this->load->database("default");
  }
  public $table = 'admin';
  //insert
  public  function insert($post_data = ''){
		return $this->db->insert($this->table,$post_data);
	}
  //active and inactive records
  public function get_pickupboy()
  {
    return $this->db->get_where($this->table,array('role' => 4 ,'status' => 1))->result();
  }
  //accepted orders for Pickup
  public function accepted_orders_for_pickup()
  {
    $this->db->select('lab_orders.updated_at,lab_orders.created_at,lab_orders.payment_type,lab_order_items.order_item_id,lab_order_items.lab_status,lab_order_items.delivery_charge,lab_order_items.amount,lab_tests.test_name,lab_tests.test_duartion,test_packages.test_package_name,lab_patient_details.name as p_name,lab_patient_details.mobile,lab_patient_details.date,lab_patient_details.time,CONCAT(lab_patient_billing.address," ",lab_patient_billing.landmark," ",lab_patient_billing.locality," ",lab_patient_billing.pincode) as address')->from('lab_order_items');
		$this->db->join('lab_orders', 'lab_orders.r_id = lab_order_items.order_id', 'left');
		$this->db->join('lab_tests', 'lab_tests.l_id = lab_order_items.test_id', 'left');
		$this->db->join('test_packages', 'test_packages.l_t_p_id = lab_order_items.package_id', 'left');
		$this->db->join('lab_patient_details', 'lab_patient_details.l_t_a_id = lab_orders.patient_details_id', 'left');
		$this->db->join('lab_patient_billing', 'lab_patient_billing.l_t_b_id = lab_orders.billing_id', 'left');
		//$this->db->where('lab_order_items.l_id',$a_id);
		$this->db->where('lab_order_items.lab_status =',1);
    $this->db->or_where('lab_order_items.lab_status =',3);
    return $this->db->get()->result_array();
  }
  //on going pickup orders
  public function on_going_pickup_orders()
  {
    $this->db->select('lab_orders.updated_at,lab_orders.created_at,lab_orders.payment_type,lab_order_items.order_item_id,lab_order_items.lab_status,lab_order_items.delivery_charge,lab_order_items.amount,lab_tests.test_name,lab_tests.test_duartion,test_packages.test_package_name,lab_patient_details.name as p_name,lab_patient_details.mobile,lab_patient_details.date,lab_patient_details.time,CONCAT(lab_patient_billing.address," ",lab_patient_billing.landmark," ",lab_patient_billing.locality," ",lab_patient_billing.pincode) as address')->from('lab_order_items');
		$this->db->join('lab_orders', 'lab_orders.r_id = lab_order_items.order_id', 'left');
		$this->db->join('lab_tests', 'lab_tests.l_id = lab_order_items.test_id', 'left');
		$this->db->join('test_packages', 'test_packages.l_t_p_id = lab_order_items.package_id', 'left');
		$this->db->join('lab_patient_details', 'lab_patient_details.l_t_a_id = lab_orders.patient_details_id', 'left');
		$this->db->join('lab_patient_billing', 'lab_patient_billing.l_t_b_id = lab_orders.billing_id', 'left');
		//$this->db->where('lab_order_items.l_id',$a_id);
		$this->db->where('lab_order_items.lab_status =',4);
    return $this->db->get()->result_array();
  }
  //on going pickup orders
  public function completed_orders()
  {
    $this->db->select('lab_orders.updated_at,lab_orders.created_at,lab_orders.payment_type,lab_order_items.order_item_id,lab_order_items.lab_status,lab_order_items.delivery_charge,lab_order_items.amount,lab_tests.test_name,lab_tests.test_duartion,test_packages.test_package_name,lab_patient_details.name as p_name,lab_patient_details.mobile,lab_patient_details.date,lab_patient_details.time,CONCAT(lab_patient_billing.address," ",lab_patient_billing.landmark," ",lab_patient_billing.locality," ",lab_patient_billing.pincode) as address')->from('lab_order_items');
    $this->db->join('lab_orders', 'lab_orders.r_id = lab_order_items.order_id', 'left');
    $this->db->join('lab_tests', 'lab_tests.l_id = lab_order_items.test_id', 'left');
    $this->db->join('test_packages', 'test_packages.l_t_p_id = lab_order_items.package_id', 'left');
    $this->db->join('lab_patient_details', 'lab_patient_details.l_t_a_id = lab_orders.patient_details_id', 'left');
    $this->db->join('lab_patient_billing', 'lab_patient_billing.l_t_b_id = lab_orders.billing_id', 'left');
    //$this->db->where('lab_order_items.l_id',$a_id);
    $this->db->where('lab_order_items.lab_status =',5);
    return $this->db->get()->result_array();
  }

}
?>
