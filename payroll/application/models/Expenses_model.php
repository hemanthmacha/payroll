<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Expenses_model extends CI_Model
{
	

    public function getmonth($id)
	{   
		$response = array();
        $query="SELECT tbl_employee.month,tbl_employee.year,tbl_expenses.description,tbl_expenses.expenses , tbl_employee.id FROM tbl_employee LEFT JOIN tbl_expenses on (tbl_employee.id=tbl_expenses.id1 and tbl_employee.month=tbl_expenses.month and tbl_employee.year=tbl_expenses.year) where id='$id' ORDER BY year ASC, field(tbl_employee.month, 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec')";
        $response = $this->db->query($query)->result();
		 return $response;

   }
    public function getmonthfromemployee($id)
	{   
		$response1 = array();
         $query=" SELECT `month`, `year` FROM `tbl_employee` WHERE id='$id'  ORDER BY year ASC, field(month, 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec') ";
         $response1= $this->db->query($query)->result();
        return $response1;

   }
 
	public function update_employee_exp($id,$month,$year,$description,$expenses)
	{
		$query="INSERT INTO `tbl_expenses`(`id1`, `month`, `year`, `description`, `expenses`) VALUES ('$id','$month','$year','$description','$expenses')";
		$this->db->query($query);
		return true;

	}



}
