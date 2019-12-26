<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll_sheet extends CI_Controller {

      public function __construct()
  {
    parent::__construct();//call CodeIgniter's default Constructor
        $this->load->model('Payroll_sheet_model');
        $this->load->model('Employe_model');
        $this->load->model('Balance_model');//load Model
        error_reporting(0);

    }

     public function index(){ 
        $this->load->view('header');
        $month= $this->uri->segment(2);
        $year= $_GET['var1'];
        $data['monthpay']=$this->Payroll_sheet_model->getting_month_total($month,$year);
        $data['totalhours']=$this->Payroll_sheet_model->getting_total_hours();
        $data['totalbalance']=$this->Payroll_sheet_model->getting_total_balance();

        // auto add all employes when click on the month start

        $users=$this->Payroll_sheet_model->getting_users();

            foreach ($users as $key => $value) {
               $id=$value->id;
               $check =  $this->Payroll_sheet_model->getting_users_not_in_this_month($id,$year,$month);

               if(empty($check)){

               $first=$value->firstname;
               $last=$value->lastname;
               $id=$value->id;
               $this->Payroll_sheet_model->addusers_payroll($first, $last,$id,$year,$month);
              
              }
              
           } 

        // auto add all employes complete   


        // unpaid employes data             
        $data['unpid'] = $this->unpaid_emp($month,$year);
       
        // update current rate and percentage    
           
        $this->update_rate();
        $data['active'] = $this->Payroll_sheet_model->getpayrolls($month,$year,'Active');
        $data['internal'] = $this->Payroll_sheet_model->getpayrolls($month,$year,'Internal');
        $data['complete'] = $this->Payroll_sheet_model->getpayrolls($month,$year,'Project Completed');
        $data['left'] = $this->Payroll_sheet_model->getpayrolls($month,$year,'Left Company');
        $data['inactive'] = $this->Payroll_sheet_model->getpayrolls($month,$year,'Inactive');
        $data['balance_single'] = $this->Payroll_sheet_model->getpayrolls_balance($month,$year);
        $data['mislenous'] = $this->Payroll_sheet_model->getpayrolls_mislineous($month,$year);    
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

        // calling auto update balance table
        $this->autoload_balance();
        echo json_encode($result);

     }

  // getting paid and unpaid employee details

     public function unpaid_emp($month,$year){

           $details=array(); 
           $month=$month;
           $year = $year;
           $one=  $this->Payroll_sheet_model->getting_unpaid_emp_firstpay($month,$year);
           foreach ($one as $key => $value) {
                  $first= $value->one;
            }
           array_push($details,"$first");
           
           $two=$this->Payroll_sheet_model->getting_unpaid_emp_secondpay($month,$year);
           foreach ($two as $key => $value) {
                  $second= $value->two;
            }
           array_push($details,"$second");
          
           $yea1 = $year;
           $yea=$year-1;

            if($month=='Jan'){

              $mon1='Dec';
              $yea1=$yea;
            }

            if($month=='Feb'){

              $mon1='Jan';
            }

            if($month=='Mar'){

              $mon1='Feb';
            }

            if($month=='Apr'){

              $mon1='Mar';
            }

            if($month=='May'){

              $mon1='Apr';
            }

            if($month=='Jun'){

              $mon1='May';
            }

            if($month=='Jul'){

              $mon1='Jun';
            }

            if($month=='Aug'){

              $mon1='Jul';
            }

            if($month=='Sep'){

              $mon1='Aug';
            }

            if($month=='Oct'){

              $mon1='Sep';
            }

            if($month=='Nov'){

              $mon1='Oct';
            }

            if($month=='Dec'){

              $mon1='Nov';
            }

            $worked= $this->Payroll_sheet_model->getting_previous_month_emp($mon1,$yea1);
            foreach ($worked as $key => $value) {
                  $work= $value->worked;
            }
            array_push($details,"$work");
            array_push($details,"$mon1");
            array_push($details,"$yea1");       
            return $details;

     }


public function autoload_balance(){

    $data=$this->Balance_model->getallids();
    
    foreach ($data as $key => $val) {
      
       $id=$val->id;
       $total1=$this->Balance_model->totalamount($id);
       $expenses1= $this->Balance_model->expenses($id);
       $balance1= $this->Balance_model->balance($id);
       $totalmonthlypay= $this->Balance_model->totalmonthlypay($id);
       $totalbilledhours= $this->Balance_model->totalbilledhours($id);
       $special_total= $this->Balance_model->special_total($id);

        foreach ($totalbilledhours as $key => $value) {
          $totalbillhours =$value->billhours;
        }    
         foreach ($special_total as $key => $value) {
        $specialtotal =$value->st;
       }
 

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

        $balance1 =$value->total;

       }

      $balance = $balance1 - $specialtotal;

      $this->Balance_model->update_balance($id,$balance,$total,$expenses,$totalmonpay,$totalbillhours,$specialtotal);


    }

  }
     
  // updating current running rate and percentage of an employe

     public function update_rate(){

        
        $hour=$this->Payroll_sheet_model->getting_total_hours_by_order();

        foreach ($hour as $key => $value) {
          
          $id = $value->emp_id;
          $sresult1 = $this->Employe_model->getemployerate($id);
          $changevalue1=array();
          $changevalue2=array();
          $changevalue3=array();
          $changevalue4=array();
          $tez_sharee = array();

            foreach ($sresult1 as $key => $val) { 
            array_push($changevalue1,"$val->hourstart");
            } 

            foreach ($sresult1 as $key => $val) { 

              if($val->hourstop==0){
                array_push($changevalue2,100000);
              }
              else{
               array_push($changevalue2,"$val->hourstop");
              }
            
            }

            foreach ($sresult1 as $key => $val) { 
            array_push($changevalue3,"$val->rate");
            }

            foreach ($sresult1 as $key => $val) { 
            array_push($tez_sharee,"$val->tiz_share");
            }



            foreach ($sresult1 as $key => $val) { 
              if($val->percentage==0){
                array_push($changevalue4,100);
              }
              else{
               array_push($changevalue4,"$val->percentage");
              }
            }

          $totalhour = $value->totalbilled_hours;


        for($i=0; $i<count($changevalue1);$i++){

          if($changevalue1[$i]< $totalhour || $changevalue1[$i] == $totalhour){

           if($changevalue2[$i]>$totalhour || $changevalue2[$i] == $totalhour){

            $rate11=$changevalue3[$i];
            $percent11=$changevalue4[$i];
            $ctez=$tez_sharee[$i];                    
             }
          }
        }

      $this->Balance_model->update_rate_percentage($id,$rate11,$percent11,$ctez);
      }
   }


    public function recentpay()
     {
       $id= $_POST['id'];
       $month=$_POST['month'];
       $year=$_POST['year'];

        $yea1 = $year;
        $yea=$year-1;


       if($month=='Jan'){

              $mon1='Dec';
              $yea1=$yea;
            }

            if($month=='Feb'){

              $mon1='Jan';
            }

            if($month=='Mar'){

              $mon1='Feb';
            }

            if($month=='Apr'){

              $mon1='Mar';
            }

            if($month=='May'){

              $mon1='Apr';
            }

            if($month=='Jun'){

              $mon1='May';
            }

            if($month=='Jul'){

              $mon1='Jun';
            }

            if($month=='Aug'){

              $mon1='Jul';
            }

            if($month=='Sep'){

              $mon1='Aug';
            }

            if($month=='Oct'){

              $mon1='Sep';
            }

            if($month=='Nov'){

              $mon1='Oct';
            }

            if($month=='Dec'){

              $mon1='Nov';
            }

      $result = $this->Payroll_sheet_model->lastmonthpay($id,$yea1,$mon1);
      echo json_encode($result);

     }

     public function add_mislenous(){

         $name      = $_POST['name'];
         $pay1      = $_POST['first'];
         $pay2  = $_POST['second'];
         $total      = $_POST['totalamount'];
         $month      = $_POST['month'];
         $year      = $_POST['year'];


         //$this->Balance_model->update_balance_payroll($id,$balance);

         $result['res'] = $this->Payroll_sheet_model->insert_into_payroll_mislenous($name,$pay1,$pay2,$total,$month,$year); 

        // calling auto update balance table
      //  $this->autoload_balance();
        echo json_encode($result);

     }

     public function update_mislenous(){

         $id = $_POST['id'];
         $name      = $_POST['name'];
         $pay1      = $_POST['first'];
         $pay2  = $_POST['second'];
         $total      = $_POST['totalamount'];
         $month      = $_POST['month'];
         $year      = $_POST['year'];

         $result['res'] = $this->Payroll_sheet_model->update_into_payroll_mislenous($name,$pay1,$pay2,$total,$month,$year,$id);

         echo json_encode($result);

     }

     public function delete_mislenous(){

         $id = $_POST['id'];
         $result['res'] = $this->Payroll_sheet_model->delete_payroll_mislenous($id);

         echo json_encode($result);

     }




}
?>
