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


		$query3="SELECT (sum(mounthtotal) - (SELECT IFNULL(sum(expenses),0)  FROM tbl_expenses WHERE id1 = '$id')-(select (IFNULL(sum(onestpay),0) + (SELECT IFNULL(SUM(onefivethpay),0) from tbl_payrool_sheet WHERE id='$id')) from tbl_payrool_sheet where id='$id')) AS total FROM tbl_employee WHERE id = '$id'";
    $bal=$this->db->query($query3)->result();
      return $bal;
} 

  public function totalmonthlypay($id){


    $query4="SELECT (IFNULL(sum(onestpay),0) + (SELECT IFNULL(SUM(onefivethpay),0) from tbl_payrool_sheet WHERE id='$id'))  as totalmon from tbl_payrool_sheet where id='$id'";
    $totalpay=$this->db->query($query4)->result();
      return $totalpay;
}

  public function totalbilledhours($id){


    $query5="SELECT IFNULL(sum(billedhours),0) as billhours from tbl_employee WHERE id='$id'";
    $totalbill=$this->db->query($query5)->result();
      return $totalbill;
}

      
 public function update_balance($id,$balance,$totalamount,$totalexpenses,$totalmonthpay,$totalbillhours){


        $query=" UPDATE `tbl_balance` SET `balance`='$balance',`totalamount`='$totalamount',`totalexpenses`='$totalexpenses', `totalmonthpay`='$totalmonthpay',`totalbilled_hours`='$totalbillhours' WHERE emp_id='$id' ";
       
        $this->db->query($query);
 
 

 }

 public function update_balance_payroll($id,$balance){
        $query=" UPDATE `tbl_balance` SET `balance`='$balance' WHERE emp_id='$id' ";
         $this->db->query($query);
 }

 public function update_rate_percentage($id,$rate,$percent){
        $query=" UPDATE `tbl_balance` SET `curent_rate`='$rate',`current_percent`='$percent' WHERE emp_id='$id' ";
         $this->db->query($query);
 }
  

}  
?>


