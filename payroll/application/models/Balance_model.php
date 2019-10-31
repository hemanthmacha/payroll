<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Balance_model extends CI_Model {


  public function getallids(){

  $this->db->select('id');
  $this->db->from('tbl_users');
  $query = $this->db->get()->result();
  return $query;
 
  }

  public function totalamount($id){

  	     $query1="SELECT SUM(mounthtotal) as tm FROM tbl_employee where id='$id'";
		     $tm=$this->db->query($query1)->result();
         return $tm;
       }

   
   
    public function expenses($id){


		$query2="SELECT SUM(expenses) as te FROM tbl_expenses where id1='$id' ";
		$te=$this->db->query($query2)->result();
    return $te;
  }

   

 public function balance($id){


		$query3="SELECT (sum(mounthtotal) - (SELECT IFNULL(sum(expenses),0) FROM tbl_expenses WHERE id1 = '$id')) AS total FROM tbl_employee WHERE id = '$id'";
    $bal=$this->db->query($query3)->result();
      return $bal;
}


      
 public function update_balance($id,$balance,$totalamount,$totalexpenses){


        $query=" UPDATE `tbl_balance` SET `balance`='$balance',`totalamount`='$totalamount',`totalexpenses`='$totalexpenses' WHERE emp_id='$id' ";
       
        $this->db->query($query);
 
 

 }

 public function update_balance_payroll($id,$balance){


        $query=" UPDATE `tbl_balance` SET `balance`='$balance' WHERE emp_id='$id' ";
       
        $this->db->query($query);
 
 

 }
  

}  
?>


