<?php

class Employe_model extends CI_Model 
{

	 public function getemploye($id){
 		
 		$response = array();

    /*$query=" SELECT tbl_employee.id, tbl_employee.month, tbl_employee.year, tbl_employee.billedhours, tbl_percentage.rate, tbl_percentage.percentage, tbl_percentage.hourstart,tbl_percentage.hourstop,tbl_employee.mounthtotal, tbl_balance.balance from tbl_employee JOIN tbl_percentage ON tbl_employee.id = tbl_percentage.id1  JOIN tbl_balance ON tbl_employee.id= tbl_balance.emp_id WHERE id='$id'";*/


    $query=" SELECT `billedhours`, `mounthtotal`, `month`, `year`, `id`, `rate` FROM `tbl_employee` WHERE id='$id' ";
    $response= $this->db->query($query)->result();
    return $response;
			 
		/*$this->db->select('id,month,year,billedhours,rate,percentamount,totalamount,balance');  
		$this->db->from('tbl_employee');
		$this->db->where('id',$id);
	
		$query = $this->db->get();
		$response = $query->result();
		 return $response;*/
		
		 /*$response = array();
		$query = $this->db->where('id',$sno)->get('tbl_payrollsummary');
        $response = $query->result();
	 	return $response;*/
    }


    public function getemployerate($id){
    
    $response = array();

    $query=" SELECT  `hourstart`, `hourstop`, `percentage`, `rate` FROM `tbl_percentage` WHERE id1='$id' ";
    $response= $this->db->query($query)->result();
    return $response;
     
    }

    public function insert_into_employee($id,$billedhours,$totalamount,$month,$year,$rate){
 		
 		

       $query= "UPDATE tbl_employee SET billedhours='$billedhours',mounthtotal='$totalamount',rate='$rate' WHERE id='$id' and month='$month' and year='$year'";

       $this->db->query($query);
       
       return true;
    }


      public function insert_newdata_employee($id,$billedhours,$totalamount,$month,$year,$fname,$lname,$pct){
 		
 		
       

       $query= "INSERT INTO `tbl_payrool_sheet`(`month`, `year`, `id`,`firstname`, `lastname`) VALUES ('$month','$year','$id','$fname','$lname')";


       $this->db->query($query);

       $query= "INSERT INTO `tbl_employee`(`billedhours`, `mounthtotal`, `month`, `year`, `id`,`rate`) VALUES ('$billedhours','$totalamount','$month','$year','$id','$pct')";



       $this->db->query($query);
       
       return  $query;
    }

    public function getemp(){
 		
 		$response = array();
 		
		$this->db->select(`firstname`, `lastname`, `id`);  
		$this->db->from('tbl_users');
     	$query = $this->db->get();
		$response = $query->result();
		 return $response;
    }



}
?>