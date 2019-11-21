<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Expenses_model extends CI_Model
{
	

    public function getmonth($id)
	{   
		$response = array();
        $query="SELECT tbl_expenses.month,tbl_expenses.year,tbl_expenses.description,tbl_expenses.expenses , tbl_expenses.id1 FROM tbl_expenses  where id1='$id' ORDER BY year ASC, field(tbl_expenses.month, 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec')";
  
        $response = $this->db->query($query)->result();
		 return $response;

   }



    /* public function month1($id){
          $tem1 = array();
          $query = "SELECT month FROM tbl_expenses where id1='$id' and month= 'Jan' HAVING COUNT('Jan') >2 ";
          $tem1 = $this->db->query($query)->result();
          return $tem1;
     }

      public function month2($id){
          $tem1 = array();
          $query = "SELECT month FROM tbl_expenses where id1='$id' and month= 'Feb' HAVING COUNT('Feb') >2";
          $tem1 = $this->db->query($query)->result();
          return $tem1;
     }
      public function month3($id){
          $tem1 = array();
          $query = "SELECT month FROM tbl_expenses where id1='$id' and month= 'Mar' HAVING COUNT('Mar') >2";
          $tem1 = $this->db->query($query)->result();
          return $tem1;
     }
      public function month4($id){
          $tem1 = array();
          $query = "SELECT month FROM tbl_expenses where id1='$id' and month= 'Apr' HAVING COUNT('Apr') >2";
          $tem1 = $this->db->query($query)->result();
          return $tem1;
     }
      public function month5($id){
          $tem1 = array();
          $query = "SELECT month FROM tbl_expenses where id1='$id' and month= 'May' HAVING COUNT('May') >2";
          $tem1 = $this->db->query($query)->result();
          return $tem1;
     }
     public function month6($id){
          $tem1 = array();
          $query = "SELECT month FROM tbl_expenses where id1='$id' and month= 'Jun' HAVING COUNT('Jun') >2";
          $tem1 = $this->db->query($query)->result();
          return $tem1;
     }

      public function month7($id){
          $tem1 = array();
          $query = "SELECT month FROM tbl_expenses where id1='$id' and month= 'Jul' HAVING COUNT('Jul') >2";
          $tem1 = $this->db->query($query)->result();
          return $tem1;
     }
      public function month8($id){
          $tem1 = array();
          $query = "SELECT month FROM tbl_expenses where id1='$id' and month= 'Aug'  HAVING COUNT('Aug') >2";
          $tem1 = $this->db->query($query)->result();
          return $tem1;
     }
      public function month9($id){
          $tem1 = array();
          $query = "SELECT month FROM tbl_expenses where id1='$id' and month= 'Sep' HAVING COUNT('Sep') >2";
          $tem1 = $this->db->query($query)->result();
          return $tem1;
     }
      public function month10($id){
          $tem1 = array();
          $query = "SELECT month FROM tbl_expenses where id1='$id' and month= 'Oct' HAVING COUNT('Oct') >2 ";
          $tem1 = $this->db->query($query)->result();
          return $tem1;
     }
     public function month11($id){
          $tem1 = array();
          $query = "SELECT month FROM tbl_expenses where id1='$id' and month= 'Nov' HAVING COUNT('Nov') >2";
          $tem1 = $this->db->query($query)->result();
          return $tem1;
     }
      public function month12($id){
          $tem1 = array();
          $query = "SELECT month FROM tbl_expenses where id1='$id' and month= 'Dec' HAVING COUNT('Dec') >2";
          $tem1 = $this->db->query($query)->result();
          return $tem1;
     }*/



    public function getmonthfromemployee($id)
	{   
		$response1 = array();
         $query=" SELECT `month`, `year` FROM `tbl_employee` WHERE id='$id' ORDER BY year ASC, field(month, 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec') ";
         $response1= $this->db->query($query)->result();
        /* print_r($query);
         die();*/
        return $response1;

   }
 
	public function update_employee_exp($id,$month,$year,$description,$expenses)
	{
		$query="INSERT INTO `tbl_expenses`(`id1`, `month`, `year`, `description`, `expenses`) VALUES ('$id','$month','$year','$description','$expenses')";
		$this->db->query($query);
		return true;
    ;

	}

	 public function delete_expenses($id,$month,$year,$des,$exp)
  {
    $query="DELETE FROM `tbl_expenses` WHERE id1='$id'and month='$month'and year='$year'and expenses='$exp'and description='$des'";
    $response= $this->db->query($query);
     return $query;
  }



}
