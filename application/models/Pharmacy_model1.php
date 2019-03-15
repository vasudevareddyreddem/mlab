<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pharmacy_model1 extends CI_Model

{
	function __construct()
	{
		parent::__construct();
		$this->load->database("default");
  $this->db->query("SET time_zone='+5:30'");
  $this->db2 = $this->load->database('another', TRUE);
	}
  public function ins_medicine($data){
    $this->db->insert_batch('medicine_tab',$data);
    return $this->db->affected_rows()?1:0;

  }
  public function get_medicines($id){
    $this->db->select('*')->from('medicine_tab')->where('status',1)->where('created_by',$id);
    return $this->db->get()->result_array();
  }
  public function get_medicine_det($id){
    $this->db->select('*')->from('medicine_tab')->where('status',1)->where('id',$id);
    return $this->db->get()->row_array();

  }
  public function save_edit_medicine($id,$data){
    $this->db->where('id',$id);
    $this->db->update('medicine_tab',$data);
    return $this->db->affected_rows()?1:0;

  }
	public function get_user_orders($id){
		$this->db2->select('a.a_u_id,a.name,a.mobile')->from('appointment_users a')->where('status',1);
		$res1 =  $this->db2->get()->result_array();
		$this->db->select('c.*')->from('cust_orders_tab c')->where('status',1)->where('phar_id',$id);
		$res2=$this->db->get()->result_array();
			foreach($res2 as $key2=>$val2){
				foreach($res1 as $key1=>$val1){
					if($val1['a_u_id']==$val2['cust_id']){
						$res2[$key2]['name']=$val1['name'];
						$res2[$key2]['mobile']=$val1['mobile'];
						$res2[$key2]['a_u_id']=$val1['a_u_id'];
						break;
					}
				}
			}
		return $res2;
	}
	public function medicine_list($pid){
		$this->db->select('id,medicine_name,(mrp/quantity) smrp')->from('medicine_tab')->where('status',1);
		return $this->db->get()->result_array();

	}
	public function accept_order($data){
		$this->db->trans_begin();
		$this->db->insert_batch('pharmacy_orders',$data);

	 return $this->db->affected_rows()?1:0;

	}
	public function user_order_accept($data1,$id){
		$this->db->where('id',$id);
		$this->db->update('cust_orders_tab',$data1);
		if($this->db->affected_rows()>0){
			$this->db->trans_commit();
			return 1;
		}
		else{
			$this->db->trans_rollback();
			return 0;

		}
	}
	public function delete_medicine($data,$id){
		$this->db->where('id',$id);
		$this->db->update('medicine_tab',$data);
		 return $this->db->affected_rows()?1:0;
	}
	public function ready_to_dispatch($phid){


				$this->db2->select('a.a_u_id,a.name,a.mobile')->from('appointment_users a')->where('status',1);
		$res1 =  $this->db2->get()->result_array();

			$this->db->select('p.cust_order_id,c.cust_id,sum(p.total) final,avg(p.discount) discount,sum(p.quantity*unit_price) aprice,group_concat(m.medicine_name) mlist')->from('cust_orders_tab c')->join('pharmacy_orders p','p.cust_order_id=c.id')->join('medicine_tab m','m.id=p.med_id')->
			where('p.status',1)->where('c.phar_id',$phid)->group_by('p.cust_order_id,c.cust_id')->
			having('final >',0);

		$res2=$this->db->get()->result_array();


//echo $this->db->last_query();exit;

		foreach($res2 as $key2=>$val2){
			foreach($res1 as $key1=>$val1){
				if($val1['a_u_id']==$val2['cust_id']){
		            $res2[$key2]['name']=$val1['name'];
		            $res2[$key2]['mobile']=$val1['mobile'];
								  $res2[$key2]['a_u_id']=$val1['a_u_id'];
								break;
				}

			}
	}
	return $res2;
}
public  function login_details($data){
		$this->db->select('*')->from('admin');
		$this->db->where('email', $data['email']);
		$this->db->where('password',$data['password']);
		$this->db->where('status', 1);
			$this->db->where('role', 3);
        return $this->db->get()->row_array();
	}

	public  function get_admin_details($id){
		$this->db->select('*')->from('admin');
		$this->db->where('a_id',$id);
        return $this->db->get()->row_array();
	}
	public function dispatch_order($data,$id){
		$this->db->where('cust_order_id',$id);
		$this->db->update('pharmacy_orders',$data);
return $this->db->affected_rows()?1:0;
	}
	public function check_medicine($mname,$dos){
		$this->db->select('1')->from('medicine_tab')->where('medicine_name',$mname)->where('dosage',$dos)->where('status',1);
return		$this->db->get()->result_array();

	}
	public function check_email_exits($email){
		$this->db->select('*')->from('admin');
		$this->db->where('email', $email);
		$this->db->where('status !=', 2);
        return $this->db->get()->row_array();
	}
	public function history($phid){
		$this->db2->select('a.a_u_id,a.name,a.mobile')->from('appointment_users a')->where('status',1);
$res1 =  $this->db2->get()->result_array();

	$this->db->select('p.cust_order_id,c.cust_id,sum(p.total) final,avg(p.discount) discount,sum(p.quantity*unit_price) aprice,group_concat(m.medicine_name) mlist,p.status')->from('cust_orders_tab c')->join('pharmacy_orders p','p.cust_order_id=c.id')->join('medicine_tab m','m.id=p.med_id')->
where('c.phar_id',$phid)->group_by('p.cust_order_id,c.cust_id')->
	having('final >',0);

$res2=$this->db->get()->result_array();


//echo $this->db->last_query();exit;

foreach($res2 as $key2=>$val2){
	foreach($res1 as $key1=>$val1){
		if($val1['a_u_id']==$val2['cust_id']){
						$res2[$key2]['name']=$val1['name'];
						$res2[$key2]['mobile']=$val1['mobile'];
							$res2[$key2]['a_u_id']=$val1['a_u_id'];
						break;
		}

	}
}
return $res2;
	}
	public function no_of_orders($id){
		$mon=date('m');
		//echo $mon;exit;
		$this->db->select('*')->from('cust_orders_tab')->group_start()->
		where('status',1)->or_where('status',2)->or_where('status',3)->group_end()->where('phar_id',$id)->where('month(created_date)',$mon);

		return $this->db->get()->result_array();
	}
	public function orders_dispatched($id){
          	$mon=date('m');
		$this->db->select('count(med_id)')->from('pharmacy_orders p')->join('cust_orders_tab c','c.id=p.cust_order_id')->where('phar_id',$id)->where('p.status',2)->where("month(p.updated_date)",$mon)->group_by('p.cust_order_id');

		return $this->db->get()->result_array();

	}
	public function total_amount($id){
						$mon=date('m');
		$this->db->select('sum(total) tot')->from('pharmacy_orders p')->join('cust_orders_tab c','c.id=p.cust_order_id')->where('c.phar_id',$id)->where('p.status',2)->where("month(p.updated_date)",$mon);


		return $this->db->get()->row_array();

	}
	public function check_order($id){
		$this->db->select('*')->from('cust_orders_tab')->where('id',$id)->where('status',1);
		return $this->db->get()->result_array();

	}
}
