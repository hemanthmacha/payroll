<?php

class Employe_model extends CI_Model 
{

	 public function getemploye($id){
 		
 		$response = array();
    $query=" SELECT `billedhours`, `mounthtotal`, `month`, `year`, `id`, `rate` FROM `tbl_employee` WHERE id='$id'  ORDER BY year ASC, field(month, 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec') ";
    $response= $this->db->query($query)->result();
    return $response;
    }

    public function getemploye_firstmonth($id){
    
    $response = array();
    $query=" SELECT `month` FROM `tbl_employee` WHERE id='$id'  ORDER BY year ASC, field(month, 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec') ";
    $response= $this->db->query($query)->result();
    return $response;
    }
    
     public function getemploye_totalmonthpay($id,$Jan,$Feb,$Mar,$Apr,$May, $Jun, $Jul, $Aug, $Sep, $Oct,$Nov, $Dec){
    
    $response = array();
    $query=" SELECT IFNULL(total,0) as total FROM `tbl_payrool_sheet` WHERE id='$id'  ORDER BY year ASC, field(month, '$Jan', '$Feb', '$Mar', '$Apr','$May', '$Jun', '$Jul','$Aug', '$Sep','$Oct', '$Nov', '$Dec') ";
    $response= $this->db->query($query)->result();
    return $response;
    }
    


    public function getsingle_employe($id){
    
    $response = array();


    $query="SELECT `tbl_employee`.`billedhours`, `tbl_employee`.`mounthtotal`, `tbl_employee`.`month`, `tbl_employee`.`year`, `tbl_employee`.`id`, `tbl_employee`.`rate`,`tbl_employee`.`percentage`,IFNULL(`tbl_payrool_sheet`.`total`,0) as total FROM `tbl_employee` join tbl_payrool_sheet on(`tbl_employee`.`id`=`tbl_payrool_sheet`.`id` and `tbl_employee`.`month`=`tbl_payrool_sheet`.`month` and `tbl_employee`.`year`=`tbl_payrool_sheet`.`year`)  WHERE tbl_employee.id='$id'  ORDER BY year ASC, field(`tbl_employee`.`month`, 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec') ";



    $response= $this->db->query($query)->result();

    return $response;
       
    
    }

    public function getsummonthpay($id,$month,$year){
    
    $response1 = array();
    $query1= "SELECT IFNULL (sum(expenses),0) AS sum from tbl_expenses where id1='$id' and month='$month' and year='$year'";
    $response1= $this->db->query($query1)->result();
    return $response1; 
    }

    public function getsingle_employe_balance($id){
    
    $response1 = array();
    $query1= "SELECT   `balance` FROM `tbl_balance` WHERE emp_id='$id'";
    $response1= $this->db->query($query1)->result();
    return $response1; 
    }




    public function monthlyexp($id,$month,$year){
    
    $response1 = array();
    $query1= "SELECT `month`, `year`, `description`, `expenses` FROM `tbl_expenses` WHERE id1='$id' and month='$month' and year='$year'";
    $response1= $this->db->query($query1)->result();
    return $response1; 
    }


    

    

    public function deleteemployee($id,$month,$year)
    {  
      $query1="DELETE FROM `tbl_payrool_sheet` WHERE id='$id' and month='$month' and year='$year'";
      $response= $this->db->query($query1);

      $query="DELETE FROM `tbl_employee` WHERE id='$id' and month='$month' and year='$year'";
      $response= $this->db->query($query);
 
    }
    public function getemployerate($id){
    
    $response = array();

    $query=" SELECT  `hourstart`, `hourstop`, `percentage`, `rate` FROM `tbl_percentage` WHERE id1='$id' ORDER BY  hourstart ASC ";
    $response= $this->db->query($query)->result();
    return $response;
     
    }

    public function insert_into_employee($id,$billedhours,$totalamount,$month,$year,$rate,$percentage){
 		
 		
      $query1= "UPDATE `tbl_payrool_sheet` SET `rate_percent`='$rate',`hours`='$billedhours',`percentage`='$percentage' WHERE id='$id' and year='$year' and month='$month'";

       $this->db->query($query1);
       

       $query= "UPDATE tbl_employee SET billedhours='$billedhours',mounthtotal='$totalamount',rate='$rate',`percentage`='$percentage' WHERE id='$id' and month='$month' and year='$year'";

       $this->db->query($query);
       
       return true;
    }


      public function insert_newdata_employee($id,$billedhours,$totalamount,$month,$year,$fname,$lname,$rate,$pct){
 		
 		
       

       $query= "INSERT INTO `tbl_payrool_sheet`(`month`, `year`, `id`,`firstname`, `lastname`) VALUES ('$month','$year','$id','$fname','$lname')";


       $this->db->query($query);

       $query1= "INSERT INTO `tbl_employee`(`billedhours`, `mounthtotal`, `month`, `year`, `id`,`rate`,`percentage`) VALUES ('$billedhours','$totalamount','$month','$year','$id','$rate','$pct')";



       $this->db->query($query1);
       
       return  $query;
    }

  /*  public function getemp(){
 		
 		$response = array();
 		
		$this->db->select(`firstname`, `lastname`, `id`);  
		$this->db->from('tbl_users');
     	$query = $this->db->get();
		$response = $query->result();
		 return $response;
    }*/


      public function getemp($perpage,$limit){
    
      $response = array();
    
    $this->db->select(`firstname`, `lastname`, `id`);  
    $this->db->from('tbl_users');
    $query = $this->db->get();
    $totalrecords = $query->num_rows();
    $lastQeuryUsers = $this->db->last_query();
    $paginationQuery = $this->db->select('firstname,lastname,id')->from('('.$lastQeuryUsers.') AS X')->limit($perpage,$limit)->get();
    $response['numRows'] = $totalrecords;
    $response['result'] = $paginationQuery->result();
    return $response;
}


    public function deleteemployeelist($id)
    {
      $query="DELETE FROM `tbl_users` WHERE id='$id'";
      $this->db->query($query);

       $query1 =" DELETE FROM `tbl_employee` WHERE id='$id'";
      $this->db->query($query1);

      $query2 =" DELETE FROM `tbl_payrool_sheet` WHERE id='$id'";
       $this->db->query($query2);

        $query3 =" DELETE FROM `tbl_balance` WHERE emp_id='$id'";
       $this->db->query($query3);

        $query4 =" DELETE FROM `tbl_admin` WHERE id='$id'";
       $this->db->query($query4);

        $query5 =" DELETE FROM `tbl_expenses` WHERE id1='$id'";
       $this->db->query($query5);

       $query6 =" DELETE FROM `tbl_percentage` WHERE id1='$id'";
       $this->db->query($query6);
       return true;
    }
   
   public function getemployersum($id){
    
    $response = array();
    $query=" SELECT  `tbl_balance`.`balance`, `tbl_balance`.`totalamount`, IFNULL(`tbl_balance`.`totalexpenses`,0) as exp, `tbl_balance`.`totalmonthpay` , sum(`tbl_employee`.`billedhours`) as billedhours FROM `tbl_balance` join tbl_employee on `tbl_balance`.`emp_id`= `tbl_employee`.`id` WHERE tbl_balance.emp_id='$id'";
    $response= $this->db->query($query)->result();
    return $response;
    }
    




}
?>
