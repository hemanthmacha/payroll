<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Percentage extends CI_Controller {

	    public function __construct()
	{
		  parent::__construct();
          $this->load->model('Percentage_model');
          error_reporting(0);
        
    }


    public function index()
    {
    	  $id =$_GET['var1'];
    	  $data['rate']=$this->Percentage_model->gettingid($id);
		  $this->load->view('percentage_view',$data);

    }

    public function addpercent()
    {
        $id =$_POST['id'];
        $hour1 =$_POST['hour1'];
        $hour2 =$_POST['hour2'];
        $per =$_POST['percentage'];
        $rate =$_POST['rate'];
        $tiz =$_POST['tiz'];     
        $data['rate']=$this->Percentage_model->insertpercent($id,$hour1,$hour2,$per,$rate,$tiz);
        echo json_encode($data);

    }

    public function deletepercent()
    {
        $id =$_POST['id'];
      
        $data['rate']=$this->Percentage_model->deletepercent($id);
        echo json_encode($data);

    }
      
}
?>
