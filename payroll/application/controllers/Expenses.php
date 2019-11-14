<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expenses extends CI_Controller {

        public function __construct()
    {
        parent::__construct();//call CodeIgniter's default Constructor
       $this->load->model('Expenses_model');
       $this->load->model('Balance_model');

        error_reporting(0);
        
    }

    public function index()
    {
          $id1=$_GET['val1'];
          
          /*$mon1 = $this->Expenses_model->month1($id1);
          foreach ($mon1 as $key => $value) {
            $month1 = $value->month;
          }

          $mon2 = $this->Expenses_model->month2($id1);
          foreach ($mon2 as $key => $value) {
            $month2 = $value->month;
          }

          $mon3 = $this->Expenses_model->month3($id1);
          foreach ($mon3 as $key => $value) {
            $month3 = $value->month;
          }

          $mon4 = $this->Expenses_model->month4($id1);
          foreach ($mon4 as $key => $value) {
            $month4 = $value->month;
          }

          $mon5 = $this->Expenses_model->month5($id1);
          foreach ($mon5 as $key => $value) {
            $month5 = $value->month;
          }

          $mon6 = $this->Expenses_model->month6($id1);
          foreach ($mon6 as $key => $value) {
            $month6 = $value->month;
          }

          $mon7 = $this->Expenses_model->month7($id1);
          foreach ($mon7 as $key => $value) {
            $month7 = $value->month;
          }

          $mon8 = $this->Expenses_model->month8($id1);
          foreach ($mon8 as $key => $value) {
            $month8 = $value->month;
          }

          $mon9 = $this->Expenses_model->month9($id1);
          foreach ($mon9 as $key => $value) {
            $month9 = $value->month;
          }

          $mon10 = $this->Expenses_model->month10($id1);
          foreach ($mon10 as $key => $value) {
            $month10 = $value->month;
          }

          $mon11 = $this->Expenses_model->month11($id1);
          foreach ($mon11 as $key => $value) {
            $month11 = $value->month;
          }

          $mon12 = $this->Expenses_model->month12($id1);
          foreach ($mon12 as $key => $value) {
            $month12 = $value->month;
          }*/
       

          $date['date1']= $this->Expenses_model->getmonth($id1);
         $date['date2']= $this->Expenses_model->getmonthfromemployee($id1,$month1,$month2,$month3,$month4,$month5,$month6,$month7,$month8,$month9,$month10,$month11,$month12);

          $this->load->view('expenses_view',$date);

    }
      public function addexp()
      {
     

         $expenses=$_POST['amount'];
         $date=$_POST['date'];
         $id=$_POST['id'];
         $description=$_POST['des'];

          $date = explode('-', $date);
          $month = $date[0];
          $year  = $date[1];
          

        $data=$this->Expenses_model->update_employee_exp($id,$month,$year,$description,$expenses);

            // auto update the balance

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



        // auto update complete

        echo json_encode($data);

      }


      public function deleteexp()
      {   
          $id=$_POST['id'];
          $date=$_POST['date'];

           $date = explode('-', $date);
          $month = $date[0];
          $year  = $date[1];
          $des=$_POST['des'];
           $exp=$_POST['amount'];

          $delete=$this->Expenses_model->delete_expenses($id,$month,$year,$des,$exp);

              // auto update the balance

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



        // auto update complete
    
          echo json_encode($delete);
      }
      
}
?>
