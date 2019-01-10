<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pickupboy extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('email');
        $this->load->library('user_agent');
        $this->load->helper('directory');
        $this->load->helper('cookie');
        $this->load->helper('security');
        $this->load->model('Admin_model');
        $this->load->model('Users_model');
        $this->load->model('Pickupboy_model');
    }
    public function index(){
        if($this->session->userdata('pb_det')) {
            $pbid=$this->session->userdata('pb_det');
            $data['pb_data']=$this->Pickupboy_model->get_lab_of_pb($pbid);

            $data['order_list']=$this->Pickupboy_model->get_lab_order_list( $data['pb_data']->lab_id);

            $this->load->view('pickup-boy/header');
            $this->load->view('pickup-boy/sidebar');
            $this->load->view('pickup-boy/index',$data);
            $this->load->view('pickup-boy/footer');
        }
        else{
            redirect('pickupboy/regestration');

        }

    }
    public function pickup_orders(){
        $this->load->view('pickup-boy/header');
        $this->load->view('pickup-boy/sidebar');
        $this->load->view('pickup-boy/pickup_orders');
        $this->load->view('pickup-boy/footer');

    }
    public function regestration(){
        $data['lab_list']=$this->Pickupboy_model->get_all_labs();

        $this->load->view('pickup-boy/register',$data);

    }
    public function registerpost(){
        if(!$this->session->userdata('pb_det')){

           $flag= $this->Pickupboy_model->check_pickupboy($this->input->post('email'));
           if($flag==1){
               $this->session->set_flashdata('error','Email exited');
               redirect('pickupboy/regestration');
           }
           $data=array('role'=>4,
               'name'=>$this->input->post('username'),
               'email'=>$this->input->post('email'),
               'mobile'=>$this->input->post('mobile'),
               'password'=>md5($this->input->post('password')),
               'org_password'=>$this->input->post('password'),
               'created_at'=>date('Y-m-d H:i:s'),
               'updated_at'=>date('Y-m-d H:i:s'),
                'status'=>1,
               'lab_id'=>$this->input->post('lab_id')
               );
           $insert_id=$this->Pickupboy_model->save_pickupboy($data);

            $this->session->set_userdata('pb_det',$insert_id);
            redirect('pickupboy');
        }
        else{
            redirect('pickupboy/regestration');
        }

    }
}