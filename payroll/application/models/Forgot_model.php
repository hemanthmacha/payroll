<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot_model extends CI_Model {


public function check_exists($username,$mail){

	$result=array();
	$query = "SELECT `username`, `lastname`, `id`, `firstname`, `email` FROM `tbl_users` WHERE username='$username' and email='$mail' ";
	$result = $this->db->query($query)->result();
	/* print_r($query);
	die()*/;
	return $result;

}

public function updatepassword($username,$password){

	$query1 = "UPDATE `tbl_users` SET `password`='$password',`first_login_status`='1' WHERE username='$username' ";
    $this->db->query($query1);
	
	$query2= " UPDATE `tbl_admin` SET `password`='$password' WHERE username='$username' ";
	$this->db->query($query2);

}

   public function update_status($id,$pass){

    
    $query1 = "UPDATE `tbl_users` SET `first_login_status`='0',`password`='$pass' WHERE id='$id'";
    $this->db->query($query1);
    

    $query= "UPDATE `tbl_admin` SET `password`='$pass' WHERE id='$id'";
    $this->db->query($query);
    //return $status; 
 
  }


}
?>