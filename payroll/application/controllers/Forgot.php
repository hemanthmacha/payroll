<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot extends CI_Controller {

	public function __construct()
	{
		parent::__construct();//call CodeIgniter's default Constructor
        error_reporting(0);
        $this->load->model('Forgot_model');

    }
	public function index(){

		$this->load->view('forgot_view');
	}

	public function reset_password(){

		//$this->load->view('forgot_view');

		$mail = $_POST['email'];
		$username = $_POST['username'];
		// generate temperory password
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    	$charactersLength = strlen($characters);
    	$password = '';
    	for ($i = 0; $i < 10; $i++) {
        $password .= $characters[rand(0, $charactersLength - 1)];
    	}

		$temp = $this->Forgot_model->check_exists($username,$mail);
		/*print_r($temp);
		die();*/
		
		
		if(!empty($temp)){

			foreach ($temp as $key => $value) {
			   $fname = $value->firstname;
			   $lname = $value->lastname;
			   $email = $value->email;
			   //$fname = $value->firstname;
			}

			$this->Forgot_model->updatepassword($username,$password);

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
        $htmlContent = '<h4>Hi,</h4>'.$fname .$lname;
        $htmlContent .= '<p>Your user name and password for login to your payroll details are given below.</p>';
        $htmlContent .= '<p>URL :http://payrol.codetru.org/</p>';
        $htmlContent .= '<p>USERNAME: </p>'.$username;
        $htmlContent .= '<p>PASSWORD: </p>'.$password;
        $htmlContent .= '<p>NOTE: Please change your password after login </p>';
        $htmlContent .= '<p>If u had any queries call back to us. Contact Number:+919999999999</p>';
        $this->email->to($email);
        $this->email->from('machahemanth16@gmail.com','macha_hemanth');
        $this->email->subject('Tekinvaderz Account Username and Password ');
        $this->email->message($htmlContent);
        $this->email->send();
        echo '<script>alert("Password sent to your mail");</script>';
        echo '<script>window.open("'.base_url().'","_self");</script>'; 

		}

		else{

			       echo '<script>alert("Please enter correct username or maild");</script>';
             echo '<script>window.open("'.base_url().'","_self");</script>';
		}
	
	}



	  public function change_password(){

      $password = $_POST['password2'];

      $id= $this->session->userdata('id');

      $this->Forgot_model->update_status($id,$password);
    
      //$this->session->unset_userdata('role');
      echo '<script>alert("Password changed successfully");</script>';
      echo '<script>alert("Please login again");</script>';
      echo '<script>window.open("'.base_url().'","_self");</script>';

  }



}

?>