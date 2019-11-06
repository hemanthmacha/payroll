<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employe extends CI_Controller {

	    public function __construct()
	{
		    parent::__construct();//call CodeIgniter's default Constructor
		    $this->load->database();//load database libray manually
        $this->load->model('Employe_model');//load Model
        $this->load->model('Balance_model');
          $this->load->model('Payroll_sheet_model');
        error_reporting(0);

    }

    public function index(){

        $id=$_GET['var1'];
         $this->load->view('header');
     	   $data['sresult'] = $this->Employe_model->getemploye($id);
		    $this->load->view('employee_view',$data);	 
     }

     public function updateemp(){


         $id  = $_POST['id'];
        //$billedmonth      = $_POST['billedmonth'];
         $billedhours  = $_POST['billedhours'];
         //$rate      = $_POST['rate'];
         $rate  = $_POST['rate'];
         $totalamount      = $_POST['totalamount'];
         //$expenses  = $_POST['expenses'];
         //$balance      = $_POST['balance'];
         $date = $_POST['mon'];
         $date = explode("-", $date);
         $month      = $date[0];
         $year  = $date[1];


      // $this->Payroll_sheet_model->insert_rate_percent($id,$month,$year,$pct,$billedhours); 
       $result['res'] = $this->Employe_model->insert_into_employee($id,$billedhours,$totalamount,$month,$year,$rate); 
         echo json_encode($result);

     }

       public function deleteemp()
     {
      
      $id=$_POST['id'];
      $month=$_POST['month'];
      $year=$_POST['year'];
      $delete['data']= $this->Employe_model->deleteemployee($id,$month,$year);
      echo json_encode($delete);
     }



     public function emplist(){
    
        $employe['data'] = $this->Employe_model->getemp();
        $this->load->view('employee_list_view',$employe);
     }



     public function empdetails(){
    
         $id=$_GET['var1'];
         $this->session->set_userdata(firstname,$_GET['var2']);
         $this->session->set_userdata(lastname,$_GET['var3']);
         $this->load->view('header');
         $data['sresult'] = $this->Employe_model->getemploye($id);
          $data['sresult1'] = $this->Employe_model->getemployerate($id);

         $this->load->view('employee_view',$data);    

     }

      public function empid(){


          $id= $this->session->userdata('id');
          $this->load->view('header');
          $data['sresult'] = $this->Employe_model->getemploye($id);
          $this->load->view('single_emp_view',$data);    

     }

      public function newdata_emp(){

         $id  = $_POST['id'];
         $billedhours  = $_POST['billedhours'];
         //$rate      = $_POST['rate'];
         $pct  = $_POST['pct'];
         $totalamount      = $_POST['totalamount'];
         //$expenses  = $_POST['expenses'];
         //$balance      = $_POST['balance'];
        
         $year  = $_POST['year'];
         $month = $_POST['month'];
          

        $fname=$this->session->userdata('firstname');
        $lname=$this->session->userdata('lastname');  
        
        //$this->Balance_model->updatebalance($id,$balance);
        $result['res'] = $this->Employe_model->insert_newdata_employee($id,$billedhours,$totalamount,$month,$year,$fname,$lname,$pct); 
        $this->Payroll_sheet_model->insert_rate_percent($id,$month,$year,$pct,$billedhours); 

         echo json_encode($result);

     
     }


    public function deleteemplist() {

      $id=$_POST['id'];
      $deletlist['data11']=$this->Employe_model->deleteemployeelist($id);
      echo json_encode($deletlist);
      
     }





}
?>
