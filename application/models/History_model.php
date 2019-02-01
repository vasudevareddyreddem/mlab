<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class History_model extends CI_Model

{
	function __construct()
	{
		parent::__construct();
		$this->load->database("default");
	}

	public  function get_lab_orders_list($a_id){
		$this->db->select('lab_orders.created_at,lab_orders.payment_type,lab_order_items.lab_status,lab_order_items.delivery_charge,lab_order_items.amount,lab_tests.test_name,lab_tests.test_duartion,test_packages.test_package_name,lab_patient_details.name as p_name,lab_patient_details.mobile,lab_patient_details.date,lab_patient_details.time,CONCAT(lab_patient_billing.address," ",lab_patient_billing.landmark," ",lab_patient_billing.locality," ",lab_patient_billing.pincode) as address')->from('lab_order_items');
		$this->db->join('lab_orders', 'lab_orders.r_id = lab_order_items.order_id', 'left');
		$this->db->join('lab_tests', 'lab_tests.l_id = lab_order_items.test_id', 'left');
		$this->db->join('test_packages', 'test_packages.l_t_p_id = lab_order_items.package_id', 'left');
		$this->db->join('lab_patient_details', 'lab_patient_details.l_t_a_id = lab_orders.patient_details_id', 'left');
		$this->db->join('lab_patient_billing', 'lab_patient_billing.l_t_b_id = lab_orders.billing_id', 'left');
		$this->db->where('lab_order_items.l_id',$a_id);
		$this->db->where('lab_order_items.lab_status !=',0);
        return $this->db->get()->result_array();
	}






}
