<?php

class Payroll_sheet_model extends CI_Model 
{

	public function getpayrolls($month,$year,$perpage,$limit){

      $response = array();
      $this->db->select('sno,id,firstname,lastname,onestpay,onefivethpay,rate_percent,percentage,hours,IFNULL(total,0) as total,balance, month,year,totalbilled_hours,`tbl_balance`.`current_percent`,`tbl_balance`.`curent_rate`,`tbl_payrool_sheet`.`tiz_share`');
      $this->db->from('tbl_payrool_sheet');
      $this->db->join('tbl_balance AS tbl_balance','tbl_payrool_sheet.id=tbl_balance.emp_id');
      $this->db->where('month', $month);
      $this->db->where('year', $year);
      $query = $this->db->get();
    $totalrecords = $query->num_rows();
    $lastQeuryUsers = $this->db->last_query();
    $paginationQuery = $this->db->select('*')->from('('.$lastQeuryUsers.') AS X')->limit($perpage,$limit)->get();
    $responsex['numRows'] = $totalrecords;
    $responsex['result'] = $paginationQuery->result();
    return $responsex;



    }

    public function checking_month($month,$year){

        $this->db->select('firstname','lastname');
		$this->db->from('tbl_payrool_sheet');
		$this->db->where('year',$year);
		$this->db->where('month',$month);
		$query = $this->db->get();
		$response = $query->result();
		return $response;

    }




public function getting_last_id($month,$year){


        $query="SELECT MAX(id) id FROM tbl_payrool_sheet where month='$month' and year='$year'";
        $response = $this->db->query($query)->result();
		return $response;

}

    public function getting_users(){

    	$this->db->select(`firstname`, `lastname`,`status`, `id`);  
		$this->db->from('tbl_users');
		$query = $this->db->get();
		$response = $query->result();
		return $response;

    }



   public function getting_users_not_in_this_month($id,$year,$month){

    $response= array();
    $this->db->select(`id`);  
		$this->db->from('tbl_payrool_sheet');
		$this->db->where('id ',$id);
    $this->db->where('month ',$month);
    $this->db->where('year ',$year);
		$query = $this->db->get();
    $response = $query->result();
    return $response;
   
		

    }

    public function addusers_payroll($firstname, $lastname,$id,$year,$month){

        $query="INSERT INTO `tbl_payrool_sheet`(`firstname`, `lastname`,`id`, `year`, `month`) VALUES('$firstname', '$lastname','$id','$year','$month')";
 
		$this->db->query($query); 
     
		$query="INSERT INTO `tbl_employee`(`id`, `year`, `month`) VALUES('$id','$year','$month')";
		$this->db->query($query);

    }


      public function insert_into_payroll($id,$firstname,$lastname,$pay1,$pay2,$total,$status,$month,$year){
 		
 		
       $query= "UPDATE tbl_payrool_sheet SET firstname='$firstname', lastname='$lastname',onestpay='$pay1', onefivethpay='$pay2' ,total='$total', status='$status' WHERE id='$id' and month='$month' and year='$year'";

       $this->db->query($query);

       
       return true;
    }

      public function insert_rate_percent($id,$month,$year,$rate,$billedhours,$percent){
 		
 		   
       $query= "UPDATE tbl_payrool_sheet SET `rate_percent`='$rate' `percentage`='$percent' , `hours`='$billedhours'WHERE id='$id' and month='$month' and year='$year'";

       $this->db->query($query);


      
    }

    public function getting_previous_month_emp($month1,$year1){
      $query="SELECT COUNT(billedhours) as worked FROM `tbl_employee` where billedhours>0 and month='$month1' and year='$year1'";
      $response = $this->db->query($query)->result();
      return $response;
    }


    public function getting_unpaid_emp_firstpay($month,$year){
      
      $query="SELECT  COUNT(onestpay) as one FROM `tbl_payrool_sheet` where onestpay>0 and month='$month' and year='$year'";
      $response = $this->db->query($query)->result();
      return $response;

    }


     public function getting_unpaid_emp_secondpay($month,$year){
      
      $query="SELECT  COUNT(onefivethpay) as two FROM `tbl_payrool_sheet` where onefivethpay>0 and month='$month' and year='$year'";
      $response = $this->db->query($query)->result();
      return $response;

    }

    public function getting_month_total($month,$year){
      
      $query="SELECT  IFNULL(SUM(onestpay),0) as firstsum, SUM(onefivethpay) as secondsum, SUM(total) as totalmonthsum FROM `tbl_payrool_sheet` where month='$month' and year='$year'";
      $response = $this->db->query($query)->result();
      return $response;

    }

     public function getting_total_hours(){
      
      $query="SELECT  SUM(hours) as totalhours  FROM `tbl_payrool_sheet`";
      $response = $this->db->query($query)->result();
      return $response;

    }

    public function getting_total_balance(){
      
      $query="SELECT  SUM(balance) as totalbalance  FROM `tbl_balance`";
      $response = $this->db->query($query)->result();
      return $response;

    }

     public function getting_total_hours_by_order(){
      
      $query="SELECT  emp_id,totalbilled_hours FROM `tbl_balance`";
      $response = $this->db->query($query)->result();
      return $response;

    }








}
?>
