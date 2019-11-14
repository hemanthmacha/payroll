<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {


  public function login($user,$password){

  $this->db->select('id,role');
  $whereCondition = ['username' =>$user,'password'=>$password];
  $this->db->where($whereCondition);
  $this->db->from('tbl_admin');
  $query = $this->db->get()->result();
  return $query;
 
  }

   public function name($uname,$pass){

   	$name=array();
   	$query= "SELECT `lastname`, `firstname` FROM `tbl_users` WHERE username='$uname' and password='$pass'";

     $name= $this->db->query($query)->result();
    return $name; 
 
  }

  

}  
