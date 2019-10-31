<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Addemploye extends CI_Controller {



	    public function __construct()
	{
		parent::__construct();//call CodeIgniter's default Constructor
        $this->load->model('Addemp_model');//load Model
        error_reporting(0);
        
    }

    public function add()
    {  
        
       $this->load->view('addemp_view');
 
    }

    public function ademployee()
    {
    	$fname=$_POST['fname'];
    	$lname=$_POST['lname'];
        $pass=$_POST['pass'];
        $uname=$_POST['uname'];
    	$status=$_POST['status'];

        $usernameexists=$this->Addemp_model->selectusers();

         foreach ($usernameexists as $key => $value) {

            $username=$value->username;
            if($username==$uname){

                echo '<script>alert("Username Already Exists");</script>';
                echo '<script>window.open("'.base_url().'addemp","_self");</script>';
            }

        }
    
    	$data = $this->Addemp_model->addemp($fname,$lname,$pass,$status,$uname);

        foreach ($data as $key => $value) {

            $username=$value->username;
            $pass=$value->password;
            $id=$value->id;
            $this->Addemp_model->add_id_balance($id);
            $data1['sresult'] = $this->Addemp_model->addadmin($id,$username,$pass);
        }

        if(!empty($data1)){

            echo '<script>alert("Employee Added");</script>';
            $this->load->view('addemp_view');
            
   }
        }	
		
    }



?>