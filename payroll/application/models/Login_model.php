<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {


  public function login($user,$password){

  $this->db->select('tbl_admin.id,tbl_admin.role');
  $whereCondition = ['tbl_admin.username' =>$user,'tbl_admin.password'=>$password];
  $this->db->where($whereCondition);
  $where = '(tbl_users.status="Active" or tbl_users.status = "admin")';
  $this->db->where($where);
  $this->db->from('tbl_admin');
  $this->db->join('tbl_users as tbl_users','tbl_users.id=tbl_admin.id');
  $query = $this->db->get()->result();
  return $query;
 
  }

   public function name($uname,$pass){

   	$name=array();
   	$query= "SELECT `lastname`, `firstname` FROM `tbl_users` WHERE username='$uname' and password='$pass'";

     $name= $this->db->query($query)->result();
    return $name; 
 
  }

  public function emp_status($id){

    $status=array();
    $query= "SELECT `first_login_status` FROM `tbl_users` WHERE id='$id' ";
    $status= $this->db->query($query)->result();
    return $status; 
 
  }

  

}  
?>
