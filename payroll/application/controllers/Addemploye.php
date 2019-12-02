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
       //$this->load->library('encrypt');
       $this->load->library('email');
 
    }

    public function ademployee()
    {
    	$fname=$_POST['fname'];
    	$lname=$_POST['lname'];
        $password=$_POST['pass'];
        $uname=$_POST['uname'];
    	$status=$_POST['status'];
        $email=$_POST['email'];

        $usernameexists=$this->Addemp_model->selectusers();

         foreach ($usernameexists as $key => $value) {

            $username=$value->username;
            if($username==$uname){

                echo '<script>alert("Username Already Exists");</script>';
                echo '<script>window.open("'.base_url().'addemp","_self");</script>';
            }

        }


        $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'machahemanth16@gmail.com',
            'smtp_pass' => 'M@cha  2010',
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
        );
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");
        $htmlContent = '<h1>Hi,</h1>'.$fname .$lname;
        $htmlContent .= '<p>Your user name and password for login to your payroll details are given below.</p>';
        $htmlContent .= '<p>URL :http://payrol.codetru.org/</p>';
        $htmlContent .= '<p>USERNAME: </p>'.$uname;
        $htmlContent .= '<p>PASSWORD: </p>'.$password;
        $htmlContent .= '<p>NOTE: Please change your password after login </p>';
        $htmlContent .= '<p>If u had any doughts call back to our office. Contact Number:+919999999999</p>';
        $this->email->to($email);
        $this->email->from('machahemanth16@gmail.com','macha_hemanth');
        $this->email->subject('Your Account Username and Password ');
        $this->email->message($htmlContent);
       /* $this->email->send();*/
         if($this->email->send()){

         $data = $this->Addemp_model->addemp($fname,$lname,$password,$status,$uname,$email);

        foreach ($data as $key => $value) {

            $username=$value->username;
            $pass=$value->password;
            $id=$value->id;
            $this->Addemp_model->add_id_balance($id);
            $data1['sresult'] = $this->Addemp_model->addadmin($id,$username,$pass);
         }

        if(!empty($data1)){

            echo '<script>alert("Employee Added and login details send to the Employe");</script>';
            $this->load->view('addemp_view');
            
   }

        }

        else{
            echo '<script>alert("Something went wrong try again later");</script>';
            $this->load->view('addemp_view');

        }
    
    	
        /*$config = array(
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'machahemanth16@gmail.com',
            'smtp_pass' => 'M@cha  2010',
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
        );
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");
        $htmlContent = '<h1>Hi,</h1>'.$fname .$lname;
        $htmlContent .= '<p>Your user name and password for login to your payroll details are given below.</p>';
        $htmlContent .= '<p>URL :http://payrol.codetru.org/</p>';
        $htmlContent .= '<p>USERNAME: </p>'.$uname;
        $htmlContent .= '<p>PASSWORD: </p>'.$password;
        $htmlContent .= '<p>NOTE: Please change your password after login </p>';
        $htmlContent .= '<p>If u had any doughts call back to our office. Contact Number:+919999999999</p>';
        $this->email->to($email);
        $this->email->from('machahemanth16@gmail.com','macha_hemanth');
        $this->email->subject('Your Account Username and Password ');
        $this->email->message($htmlContent);
        $this->email->send();*/
/*
        if(!empty($data1)){

            echo '<script>alert("Employee Added and login details send to the Employe");</script>';
            $this->load->view('addemp_view');
            
   }*/
        }	
		
    }



?>
