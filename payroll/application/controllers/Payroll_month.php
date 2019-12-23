<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll_month extends CI_Controller {


	public function __construct(){

		 parent::__construct();
		 error_reporting(0);
     $this->load->model('Balance_model');
	}

  public function index(){
    
    // calling auto update balance table
    $this->autoload_balance();
    $this->load->view('header');
    $this->load->view('payroll_year_view');

  }


  public function payrollmonth(){

       if(isset($_GET['var1'])){
       	$year['yea']=$_GET['var1'];
       $this->load->view('header');
       $this->load->view('payroll_month_view',$year);
       }

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
