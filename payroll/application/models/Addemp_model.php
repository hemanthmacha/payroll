<?php
class Addemp_model extends CI_Model

{

	public function addemp($fname,$lname,$pass,$status,$uname,$email)
	{
		$query="INSERT INTO `tbl_users`(`firstname`,`lastname`,`status`,`password`,`username`,`email`,`first_login_status
`) VALUES('$fname','$lname','$status','$pass','$uname','$email','1')";
		$this->db->query($query);

		$this->db->select('id,username,password');  
		$this->db->from('tbl_users');
		$this->db->where('username',$uname);
	
		$query = $this->db->get();
		$response = $query->result();
		 return $response;
	}

	public function addadmin($id,$username,$pass)
	{
		$query="INSERT INTO `tbl_admin`(`username`,`password`,`id`,`role`) VALUES('$username','$pass','$id','employee')";
		$this->db->query($query);
        return array();
	}

	public function add_id_balance($id)
	{
		$query="INSERT INTO `tbl_balance`(`emp_id`) VALUES('$id')";
		$this->db->query($query);
        
	}


	public function selectusers()
	{
		$query="SELECT `username`  FROM `tbl_users` ";
		$user=$this->db->query($query)->result();
        return $user;
	}
}

?>
