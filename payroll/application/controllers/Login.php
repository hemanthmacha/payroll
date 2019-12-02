<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {


	public function __construct(){

		parent::__construct();
		$this->load->model('Login_model');
		 error_reporting(0);
	}

	
	public function index()
	{
		$this->load->view('login_view');
	}


	public function loginuser(){

      $user=$this->input->post('username');
      $password=$this->input->post('password');
      $result = $this->Login_model->login($user,$password);
      $name = $this->Login_model->name($user,$password);



  if(!empty($result)){

      foreach ($result as $key => $value) {
      	$this->session->set_userdata(id,$value->id);
      	$this->session->set_userdata(role,$value->role);
      }

      if($this->session->userdata('role') == 'employee'){

        $id= $this->session->userdata('id');
       $get_status = $this->Login_model->emp_status($id);

        foreach ($get_status as $key => $value) {
           $status = $value->first_login_status;
           }
           

        if($status==1){
           //$this->Login_model->update_status($id);
           $this->load->view('change_password');
          }

         if($status==0){
           
           foreach ($name as $key => $value) {
          $this->session->set_userdata(fname,$value->firstname);
          $this->session->set_userdata(lname,$value->lastname);
           }

          $this->load->view('header'); 
         } 

      }


      if($this->session->userdata('role') == 'admin'){

       // $id= echo ($this->session->userdata('id'));
        //$get_status = $this->Login_model->emp_status($id); 

          foreach ($name as $key => $value) {
          $this->session->set_userdata(fname,$value->firstname);
          $this->session->set_userdata(lname,$value->lastname);
           }
          $this->load->view('header'); 
         } 

      }


       else{
  
             echo '<script>alert("Please enter correct username or password");</script>';
             echo '<script>window.open("'.base_url().'","_self");</script>';
   }

   }


}
?>




  
  

