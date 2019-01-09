<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/Back_end.php');

class Pickupboy extends Back_end {
	
    public  function index(){
		
            $this->load->view('lab/add_pickupboy');
            $this->load->view('admin/footer');
	}  
	
}
