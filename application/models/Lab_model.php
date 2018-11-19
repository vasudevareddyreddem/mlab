<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lab_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	
	public  function save_labtest($data){
		$this->db->insert('lab_tests',$data);
		return $this->db->insert_id();
	}
	
	public  function check_lab_check_ornot($type,$name){
		$this->db->select('l_id')->from('lab_tests');
		$this->db->where('test_type',$type);
		$this->db->where('test_name',$name);
		return $this->db->get()->row_array();
	}
	public  function get_test_list($a_id){
		$this->db->select('*')->from('lab_tests');
		$this->db->where('status !=',2);
		$this->db->where('created_by',$a_id);
		return $this->db->get()->result_array();
	}
	public  function update_testname_details($a_id,$data){
		$this->db->where('l_id',$a_id);
		return $this->db->update('lab_tests',$data);
	}
	
	public  function get_lab_test_name_details($l_id){
		$this->db->select('*')->from('lab_tests');
		$this->db->where('l_id',$l_id);
		return $this->db->get()->row_array();
	}
	public  function get_lab_test_name_list($a_id){
		$this->db->select('test_name,l_id')->from('lab_tests');
		$this->db->where('status ',1);
		$this->db->where('created_by',$a_id);
		return $this->db->get()->result_array();
	}
	
	public  function check_package_name_exist($pack_name,$l_id){
		$this->db->select('*')->from('test_packages');
		$this->db->where('test_package_name',$pack_name);
		$this->db->where('lab_id',$l_id);
		return $this->db->get()->row_array();
	}
	public  function save_package($data){
		$this->db->insert('test_packages',$data);
		return $this->db->insert_id();
	}
	public  function save_package_test_names($data){
		$this->db->insert('packages_test_list',$data);
		return $this->db->insert_id();
	}
	
	public function get_packages_test_lists($a_id){
		$this->db->select('*')->from('test_packages');
		$this->db->where('status !=',2);
		$this->db->where('created_by',$a_id);
		$return=$this->db->get()->result_array();
		foreach($return as $lis){
			$test_list=$this->get_package_test_name($lis['l_t_p_id']);
			//echo $this->db->last_query();
			//echo '<pre>';print_r($test_list);exit;
			$data[$lis['l_t_p_id']]=$lis;
			$data[$lis['l_t_p_id']]['package_test_list']=$test_list;
		}
		if(!empty($data)){
			return $data;
			
		}
	}
	
	public  function get_package_test_name($package_name){
		$this->db->select('packages_test_list.*,lab_tests.test_name,lab_tests.test_type,lab_tests.test_duartion')->from('packages_test_list');
		$this->db->join('lab_tests', 'lab_tests.l_id = packages_test_list.test_id', 'left');
		$this->db->where('packages_test_list.status !=',2);
		$this->db->where('packages_test_list.l_t_p_id',$package_name);
		return $this->db->get()->result_array();
	}
	
	public  function update_package_test_details($l_t_p_id,$data){
		$this->db->where('l_t_p_id',$l_t_p_id);
		return $this->db->update('test_packages',$data);
	}
	
	public  function get_package_test_list($l_t_p_id){
		$this->db->select('*')->from('packages_test_list');
		$this->db->where('packages_test_list.status !=',2);
		$this->db->where('packages_test_list.l_t_p_id',$l_t_p_id);
		return $this->db->get()->result_array();
	}
	
	public  function update_package_test_name_details($l_t_p_id,$data){
		$this->db->where('p_t_id',$l_t_p_id);
		return $this->db->update('packages_test_list',$data);
	}
	
	public  function get_packages_test_details($l_t_p_id){
		$this->db->select('*')->from('test_packages');
		$this->db->where('l_t_p_id',$l_t_p_id);
		$return=$this->db->get()->row_array();
		$test_list=$this->get_package_test_name($return['l_t_p_id']);
		$data=$return;
		$data['package_test_list']=$test_list;
		if(!empty($data)){
			return $data;
			
		}
	}
	
	
	public  function update_package_test_names($l_t_p_id,$test_id,$data){
		$this->db->where('p_t_id',$l_t_p_id);
		$this->db->where('test_id',$test_id);
		return $this->db->update('packages_test_list',$data);
	}
	
	/*  lab  orders purpose*/
	public  function get_all_lab_orders_list(){
		$this->db->select('lab_orders.created_at,lab_orders.payment_type,lab_order_items.delivery_charge,lab_order_items.amount,lab_tests.test_name,lab_tests.test_duartion,test_packages.test_package_name,lab_patient_details.name as p_name,lab_patient_details.mobile,admin.name')->from('lab_order_items');
		$this->db->join('admin', 'admin.a_id = lab_order_items.l_id', 'left');
		$this->db->join('lab_orders', 'lab_orders.r_id = lab_order_items.order_id', 'left');
		$this->db->join('lab_tests', 'lab_tests.l_id = lab_order_items.test_id', 'left');
		$this->db->join('test_packages', 'test_packages.l_t_p_id = lab_order_items.package_id', 'left');
		$this->db->join('lab_patient_details', 'lab_patient_details.l_t_a_id = lab_orders.patient_details_id', 'left');
		//$this->db->where('lab_order_items.l_id',$a_id);		
        return $this->db->get()->result_array();
	}
	/*  lab  orders purpose*/
	
	
	
	
	
	
	

}