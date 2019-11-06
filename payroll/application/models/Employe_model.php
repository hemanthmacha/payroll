<?php

class Employe_model extends CI_Model 
{

	 public function getemploye($id){
 		
 		$response = array();
    $query=" SELECT `billedhours`, `mounthtotal`, `month`, `year`, `id`, `rate` FROM `tbl_employee` WHERE id='$id'  ORDER BY year ASC, field(month, 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec') ";
    $response= $this->db->query($query)->result();
    return $response;
			 
		
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

    public function insert_into_employee($id,$billedhours,$totalamount,$month,$year,$rate){
 		
 		
      $query1= "UPDATE `tbl_payrool_sheet` SET `rate_percent`='$rate',`hours`='$billedhours',`total`='$totalamount' WHERE id='$id' and year='$year' and month='$month'";

       $this->db->query($query1);
       

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

    




}
?>
