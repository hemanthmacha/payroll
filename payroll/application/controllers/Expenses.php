<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expenses extends CI_Controller {

        public function __construct()
    {
        parent::__construct();
        $this->load->model('Expenses_model');
        $this->load->model('Balance_model');
        error_reporting(0);
        
    }

    public function index()
    {
          $id1=$_GET['val1'];
          $date['date1']= $this->Expenses_model->getmonth($id1);
          $date['date2']= $this->Expenses_model->getmonthfromemployee($id1);
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

          // calling auto update balance table
          $this->autoload_balance();
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

          // calling auto update balance table
          $this->autoload_balance();
          echo json_encode($delete);
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
      
}
?>
