<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expenses extends CI_Controller {

        public function __construct()
    {
        parent::__construct();//call CodeIgniter's default Constructor
       $this->load->model('Expenses_model');

        error_reporting(0);
        
    }

    public function index()
    {
          $id1=$_GET['val1'];
          $date['date1']= $this->Expenses_model->getmonth($id1);
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

        echo json_encode($data);

      }
}
?>