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

    /*public function index(){

        $id=$_GET['var1'];
         $this->load->view('header');
    	   $data['sresult'] = $this->Employe_model->getemploye($id);
         $this->autobalancecal(); 
           $this->load->view('employee_view',$data);	 
     }*/

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
         $tiz = $_POST['tiz'];
         $date = explode("-", $date);
         $month      = $date[0];
         $year  = $date[1];


      // $this->Payroll_sheet_model->insert_rate_percent($id,$month,$year,$pct,$billedhours); 
       $result['res'] = $this->Employe_model->insert_into_employee($id,$billedhours,$totalamount,$month,$year,$rate,$percentage1,$tiz);
        $this->autobalancecal(); 
         echo json_encode($result);

     }

       public function deleteemp()
     {
      
      $id=$_POST['id'];
      $month=$_POST['month'];
      $year=$_POST['year'];
      $delete['data']= $this->Employe_model->deleteemployee($id,$month,$year);

       $this->autobalancecal();
      echo json_encode($delete);
     }



     public function emplist(){


                $config = array();
                $config["base_url"] =base_url() . "employeelist";
                $config["per_page"] = 10;
                $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
                $config["total_rows"] = $this->Employe_model->getemp($config["per_page"],$page)
                      ['numRows'];
              
                $config["uri_segment"] = 2;
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
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["links"] = $this->pagination->create_links();
        $data['data'] = $this->Employe_model->getemp($config["per_page"], $page)['result'];
        $this->load->view('employee_list_view',$data);  

     }



     public function empdetails(){
    
         $id=$_GET['var1'];
         $this->session->set_userdata(firstname,$_GET['var2']);
         $this->session->set_userdata(lastname,$_GET['var3']);
         $name1=$_GET['var2'];
         $name2=$_GET['var3'];
         $this->load->view('header');
         $this->autobalancecal();
         $data['billedhou'] = $this->Employe_model->getbillhours($id);
         $data['sresult1'] = $this->Employe_model->getemployerate($id);
         //$data['summdata'] = $this->Employe_model->getemployersum($id);


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
    
         


                 $config = array();
                $config['page_query_string'] = TRUE;
                
                $config["base_url"] = base_url() ."list/?var1=$id&var2=$name1&var3=$name2";
                $config["per_page"] = 4;

                $page = $_GET['per_page'];
                if($per_page==0 || $per_page =''){

                  $per_page==0;
                }

                else{
                  $per_page = $_GET['page'];
                  //$per_page = explode('/', $page); 
                  
                }

               $config["total_rows"] = $this->Employe_model->getemploye($id,$config["per_page"], $page)['numRows'];
       
               // $config["uri_segment"] = 10;
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
        $data['summdata'] = $this->Employe_model->getemployersum($id);
      $data['sresult'] = $config["total_rows"] = $this->Employe_model->getemploye($id,$config["per_page"], $page)['result'];
    //$usersData['result'] = $this->Retrive_model->getUserDetails();  
     $this->load->view('employee_view',$data);

     }

     public function total(){
          $id= $_POST['id'];
          $sum = $this->Employe_model->getemployersum($id);
          echo json_encode($sum); 

     }

      public function empid(){
          // single employee
          $this->load->view('header');
          $id= $this->session->userdata('id');
          
          $data['billedhou'] = $this->Employe_model->getbillhours($id);
          $month1 = $this->Employe_model->getsingle_employe($id);
          $data['sresult11'] = $this->Employe_model->getemployerate($id);
          $data['summdata'] = $this->Employe_model->getemployersum($id);

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
 




                $config = array();
               // $config['page_query_string'] = TRUE;
                
                $config["base_url"] = base_url() ."employe";
                $config["per_page"] = 10;

                $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
                $config["total_rows"] = $this->Employe_model->getsingle_employedata($id,$config["per_page"], $page)['numRows'];
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
          $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["links"] = $this->pagination->create_links();
     $data['sresult'] = $config["total_rows"] = $this->Employe_model->getsingle_employedata($id,$config["per_page"], $page)['result'];
    //$usersData['result'] = $this->Retrive_model->getUserDetails();  
    $this->load->view('single_emp_view',$data);    




          //$this->load->view('single_emp_view',$data);    

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
        $this->autobalancecal();
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

      public function gettingmonth_not_in_data()
     {
      
      $id=$_POST['id'];
      $year=$_POST['year'];
      $months = array("Jan", "Feb", "Mar","Apr", "May", "Jun","Jul", "Aug", "Sep","Oct", "Nov", "Dec"); 
      $temp= $this->Employe_model->employe_month($id,$year);
      $month=array();
      $final_months=array();
          foreach ($temp as $key => $value) {
               array_push($month,"$value->month");
             }

             for($i=0;$i<count($months);$i++){
                 $temp1 = 0;
                for($j=0;$j<count($temp);$j++){
 
                  if($months[$i]==$month[$j]){
                    $temp1=$temp1+1;
                  }   
               }

               if($temp1==0){
                array_push($final_months,"$months[$i]");
               }
             }
            
      
      echo json_encode($final_months);
     }



     public function sample_cal()
     {
      $this->load->view('cal_view');
     }



     public function autobalancecal(){


      // auto update the balance

        $data=$this->Balance_model->getallids();
    
    foreach ($data as $key => $val) {
      
      $id=$val->id;
     
       $total1=$this->Balance_model->totalamount($id);

        $expenses1= $this->Balance_model->expenses($id);
        $balance1= $this->Balance_model->balance($id);
        $totalmonthlypay= $this->Balance_model->totalmonthlypay($id);
        $totalbilledhours= $this->Balance_model->totalbilledhours($id);
     

       foreach ($total1 as $key => $value) {

        $total =$value->tm;

       }
       foreach ($totalmonthlypay as $key => $value) {

        $totalmonpay =$value->totalmon;

       }
       foreach ($totalbilledhours as $key => $value) {

        $totalbillhours =$value->billhours;

       }
       foreach ($expenses1 as $key => $value) {

        $expenses =$value->te;

       }

       foreach ($balance1 as $key => $value) {

        $balance =$value->total;

       }


      $this->Balance_model->update_balance($id,$balance,$total,$expenses,$totalmonpay,$totalbillhours);

    }



        // auto update complete
     }





}
?>
