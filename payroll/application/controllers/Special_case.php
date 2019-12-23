<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Special_case extends CI_Controller {


 public function __construct()
    {
        parent::__construct();
        $this->load->model('Special_model');
        $this->load->model('Balance_model');
        //$this->load->model('Balance_model');
        error_reporting(0);
        
    }

    public function index()
      {
          $id=$_POST['id'];
          $month=$_POST['month'];
          $year=$_POST['year'];
          $first=$_POST['first'];
          $second=$_POST['second'];
          $total=$_POST['totalamount'];
          $comments=$_POST['comments'];

          $data1 = $this->Special_model->get_balance_($id);
         foreach ($data1 as $key => $value) {
            $balance = $value->balance;
          }
          $temp = $balance - $total;
          $this->Balance_model->update_balance_payroll_special($id,$temp,$total);
          $data = $this->Special_model->addspecial($id,$month,$year,$first,$second,$total,$comments);
          echo json_encode($data1);
      }



}

?>
