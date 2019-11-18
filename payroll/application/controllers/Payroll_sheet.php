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

                $config = array();
                $config['page_query_string'] = TRUE;
                $config["base_url"] = base_url() . "month/$month/?var1=$year";
                $config["per_page"] = 4;

                $page = $_GET['per_page'];
                if($per_page==0 || $per_page =''){

                  $per_page==0;
                }

                else{
                  $per_page = $_GET['page'];
                  //$per_page = explode('/', $page); 
                  
                }
              $config["total_rows"] = $this->Payroll_sheet_model->getpayrolls($month,$year,$config["per_page"], $page)['numRows'];
       
               // $config["uri_segment"] = 4;
                $config['full_tag_open'] = "<ul class='pagination'>";
                $config['full_tag_close'] = '</ul>';
                $config['num_tag_open'] = '<li>';
                $config['num_tag_close'] = '</li>';
                $config['cur_tag_open'] = '<li class="active"><a href="#">';
                $config['cur_tag_close'] = '</a></li>';
                $config['prev_tag_open'] = '<li>';
                $config['prev_tag_close'] = '</li>';
                $config['first_tag_open'] = '<li>';
                $config['first_tag_close'] = '</li>';
                $config['last_tag_open'] = '<li>';
                $config['last_tag_close'] = '</li>';

                $config['next_link'] = 'Next Page';
                $config['next_tag_open'] = '<li>';
                $config['next_tag_close'] = '</li>';

                $config['prev_link'] = 'Previous Page';
                $config['prev_tag_open'] = '<li>';
                $config['prev_tag_close'] = '</li>';

        $this->pagination->initialize($config);
             
            $per_page = $_GET['per_page'];
                if($per_page==0 || $per_page =''){

                  $per_page==0;
                }

                else{
                  $page = $_GET['per_page'];
                   //$page = explode('/', $page);
                    
                }


        $data["links"] = $this->pagination->create_links();
      $data['sresult'] = $config["total_rows"] = $this->Payroll_sheet_model->getpayrolls($month,$year,$config["per_page"], $page)['result'];
    //$usersData['result'] = $this->Retrive_model->getUserDetails();  
     $this->load->view('payroll_view',$data);





      // pagenation ends

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

        ////updating balance

         $data=$this->Balance_model->getallids();
    
    foreach ($data as $key => $val) {
      
      $id=$val->id;
     
      $total1=$this->Balance_model->totalamount($id);

       $expenses1= $this->Balance_model->expenses($id);
        $balance1= $this->Balance_model->balance($id);
        $totalmonthlypay= $this->Balance_model->totalmonthlypay($id);
     

       foreach ($total1 as $key => $value) {

        $total =$value->tm;

       }
       foreach ($totalmonthlypay as $key => $value) {

        $totalmonpay =$value->totalmon;

       }
       foreach ($expenses1 as $key => $value) {

        $expenses =$value->te;

       }

       foreach ($balance1 as $key => $value) {

        $balance =$value->total;

       }


      $this->Balance_model->update_balance($id,$balance,$total,$expenses,$totalmonpay);

    }
         echo json_encode($result);

     }


}
?>
