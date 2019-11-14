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
         $percentage1      = $_POST['percentage1'];
         $rate  = $_POST['rate'];
         $totalamount      = $_POST['totalamount'];
         //$expenses  = $_POST['expenses'];
         //$balance      = $_POST['balance'];
         $date = $_POST['mon'];
         $date = explode("-", $date);
         $month      = $date[0];
         $year  = $date[1];


      // $this->Payroll_sheet_model->insert_rate_percent($id,$month,$year,$pct,$billedhours); 
       $result['res'] = $this->Employe_model->insert_into_employee($id,$billedhours,$totalamount,$month,$year,$rate,$percentage1); 
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


         $startmonth = $this->Employe_model->getemploye_firstmonth($id);
         foreach ($startmonth as $key => $value) {
           $month = $value->month;
           break;
         }

         if($month=='Jan'){
          $data['monthpay']  = $this->Employe_model->getemploye_totalmonthpay($id,'Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
         }
         if($month=='Feb'){
          $data['monthpay']  = $this->Employe_model->getemploye_totalmonthpay($id,'Feb','Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec','Jan');
         }
         if($month=='Mar'){
          $data['monthpay']  = $this->Employe_model->getemploye_totalmonthpay($id,'Mar','Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec','Jan','Feb');
         }
         if($month=='Apr'){
          $data['monthpay']  = $this->Employe_model->getemploye_totalmonthpay($id,'Apr','May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec','Jan','Feb', 'Mar');
         }
         if($month=='May'){
          $data['monthpay']  = $this->Employe_model->getemploye_totalmonthpay($id,'May','Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec','Jan','Feb', 'Mar', 'Apr', 'May');
         }
         if($month=='Jun'){
          $data['monthpay']  = $this->Employe_model->getemploye_totalmonthpay($id,'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec','Jan','Feb', 'Mar', 'Apr', 'May');
         }
         if($month=='Jul'){
          $data['monthpay']  = $this->Employe_model->getemploye_totalmonthpay($id,'Jul','Aug', 'Sep', 'Oct', 'Nov', 'Dec','Jan','Feb', 'Mar', 'Apr', 'May', 'Jun');
         }
         if($month=='Aug'){
          $data['monthpay']  = $this->Employe_model->getemploye_totalmonthpay($id,'Aug','Sep', 'Oct', 'Nov', 'Dec','Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul');
         }
         if($month=='Sep'){
          $data['monthpay']  = $this->Employe_model->getemploye_totalmonthpay($id,'Sep','Oct', 'Nov', 'Dec','Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug');
         }
         if($month=='Oct'){
          $data['monthpay']  = $this->Employe_model->getemploye_totalmonthpay($id,'Oct','Nov', 'Dec','Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep');
         }
         if($month=='Nov'){
          $data['monthpay']  = $this->Employe_model->getemploye_totalmonthpay($id,'Nov','Dec','Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct');
         }
         if($month=='Dec'){
          $data['monthpay']  = $this->Employe_model->getemploye_totalmonthpay($id,'Dec','Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov');
         }
    
         

         $this->load->view('employee_view',$data);    

     }

      public function empid(){


          $id= $this->session->userdata('id');
          $this->load->view('header');
          $data['sresult'] = $this->Employe_model->getsingle_employe($id);
          $month1 = $this->Employe_model->getsingle_employe($id);
          $data['sresult11'] = $this->Employe_model->getemployerate($id);

           $exp=array();
          foreach ($month1 as $key => $value) {

             $month= $value->month;
             $year = $value->year;
             $summ = $this->Employe_model->getsummonthpay($id,$month,$year);
             
             //print_r($summ);
             foreach ($summ as $key => $value) {
               array_push($exp,"$value->sum");

             }
            
          }


          $startmonth = $this->Employe_model->getemploye_firstmonth($id);
         foreach ($startmonth as $key => $value) {
           $month = $value->month;
           break;
         }

         if($month=='Jan'){
          $data['monthpay']  = $this->Employe_model->getemploye_totalmonthpay($id,'Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
         }
         if($month=='Feb'){
          $data['monthpay']  = $this->Employe_model->getemploye_totalmonthpay($id,'Feb','Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec','Jan');
         }
         if($month=='Mar'){
          $data['monthpay']  = $this->Employe_model->getemploye_totalmonthpay($id,'Mar','Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec','Jan','Feb');
         }
         if($month=='Apr'){
          $data['monthpay']  = $this->Employe_model->getemploye_totalmonthpay($id,'Apr','May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec','Jan','Feb', 'Mar');
         }
         if($month=='May'){
          $data['monthpay']  = $this->Employe_model->getemploye_totalmonthpay($id,'May','Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec','Jan','Feb', 'Mar', 'Apr', 'May');
         }
         if($month=='Jun'){
          $data['monthpay']  = $this->Employe_model->getemploye_totalmonthpay($id,'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec','Jan','Feb', 'Mar', 'Apr', 'May');
         }
         if($month=='Jul'){
          $data['monthpay']  = $this->Employe_model->getemploye_totalmonthpay($id,'Jul','Aug', 'Sep', 'Oct', 'Nov', 'Dec','Jan','Feb', 'Mar', 'Apr', 'May', 'Jun');
         }
         if($month=='Aug'){
          $data['monthpay']  = $this->Employe_model->getemploye_totalmonthpay($id,'Aug','Sep', 'Oct', 'Nov', 'Dec','Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul');
         }
         if($month=='Sep'){
          $data['monthpay']  = $this->Employe_model->getemploye_totalmonthpay($id,'Sep','Oct', 'Nov', 'Dec','Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug');
         }
         if($month=='Oct'){
          $data['monthpay']  = $this->Employe_model->getemploye_totalmonthpay($id,'Oct','Nov', 'Dec','Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep');
         }
         if($month=='Nov'){
          $data['monthpay']  = $this->Employe_model->getemploye_totalmonthpay($id,'Nov','Dec','Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct');
         }
         if($month=='Dec'){
          $data['monthpay']  = $this->Employe_model->getemploye_totalmonthpay($id,'Dec','Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov');
         }
    

          $data['sum']=$exp;
 
          //$data['sresult1'] = $this->Employe_model->getsingle_employe_balance($id);
          $this->load->view('single_emp_view',$data);    

     }

      public function newdata_emp(){

         $id  = $_POST['id'];
         $billedhours  = $_POST['billedhours'];
         $percent      = $_POST['pct'];
         $rate  = $_POST['rate'];
         $totalamount      = $_POST['totalamount'];
         //$expenses  = $_POST['expenses'];
         //$balance      = $_POST['balance'];
        
         $year  = $_POST['year'];
         $month = $_POST['month'];
          

        $fname=$this->session->userdata('firstname');
        $lname=$this->session->userdata('lastname');  
        
        //$this->Balance_model->updatebalance($id,$balance);
        $result['res'] = $this->Employe_model->insert_newdata_employee($id,$billedhours,$totalamount,$month,$year,$fname,$lname,$rate,$percent); 
        //$this->Payroll_sheet_model->insert_rate_percent($id,$month,$year,$rate,$billedhours,$percent); 

         echo json_encode($result);

     
     }


    public function deleteemplist() {

      $id=$_POST['id'];
      $deletlist['data11']=$this->Employe_model->deleteemployeelist($id);
      echo json_encode($deletlist);   
     }


     public function singleempmonthexp() {

      $id=$_GET['val1'];
      $month=$_GET['val2'];
      $year=$_GET['val3'];

      $monthlyexp['description']=$this->Employe_model->monthlyexp($id,$month,$year);
      $this->load->view('singleemp_monthexp',$monthlyexp);
     }




     public function sample_cal()
     {
      $this->load->view('cal_view');
     }





}
?>
