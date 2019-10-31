<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll_sheet extends CI_Controller {

	    public function __construct()
	{
		parent::__construct();//call CodeIgniter's default Constructor
        $this->load->model('Payroll_sheet_model');
        $this->load->model('Balance_model');//load Model
        error_reporting(0);

    }

     public function index(){	
        $this->load->view('header');
        $month= date('M');
        $year= date('Y');

        $data=$this->Payroll_sheet_model->checking_month($month,$year);

         if(empty($data)){

          $users=$this->Payroll_sheet_model->getting_users(); 

               foreach ($users as $key => $value) {
               
               $first=$value->firstname;
               $last=$value->lastname;
               $id=$value->id;
               //$pct=$value->pct;
               $this->Payroll_sheet_model->addusers_payroll($first, $last,$id,$year,$month);
           } 
         }




         else{

                $data=$this->Payroll_sheet_model->getting_last_id($month,$year);


                 foreach ($data as $key => $value) {
                       $lastid=$value->id;
                    }

                 $users=$this->Payroll_sheet_model->getting_last_users($lastid); 
                 foreach ($users as $key => $value) {
               
                          $first=$value->firstname;
                          $last=$value->lastname;
                          $id=$value->id;
                          //$pct=$value->pct;
                         $this->Payroll_sheet_model->addusers_payroll($first, $last,$id,$year,$month);
           } 
       

         }
        
        $month=$this->uri->segment(2);
        $year=$_GET['var1'];
        $data['sresult'] = $this->Payroll_sheet_model->getpayrolls($month,$year);
		    $this->load->view('payroll_view',$data);	
     }

     public function update_payroll(){

         $id  = $_POST['id'];
         $firstname      = $_POST['fname'];
         $lastname  = $_POST['lname'];
         //$rate      = $_POST['rate'];
         //$pct  = $_POST['pct'];
         $pay1      = $_POST['pay1'];
         $pay2  = $_POST['pay2'];
         $total      = $_POST['total'];
         $status  = $_POST['status'];
         //$hours      = $_POST['hours'];
         $balance      = $_POST['balance'];
          $month      = $_POST['month'];
         $year      = $_POST['year'];

         $this->Balance_model->update_balance_payroll($id,$balance);

        $result['res'] = $this->Payroll_sheet_model->insert_into_payroll($id,$firstname,$lastname,$pay1,$pay2,$total,$status,$month,$year); 
         echo json_encode($result);

     }


}
?>