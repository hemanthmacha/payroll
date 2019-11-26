<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Percentage_model extends CI_Model
{
	public function gettingid($id)

	{    
		$response = array();
		$query="SELECT `id1`, `hourstart`, `hourstop`, `percentage`, `rate`, `tiz_share` FROM `tbl_percentage` WHERE id1='$id' ORDER BY  hourstart ASC ";
        $response = $this->db->query($query)->result();
		return $response;

	}

	public function insertpercent($id,$hour1,$hour2,$per,$rate,$tiz)
	{    
		$query="INSERT INTO `tbl_percentage`(`id1`, `hourstart`, `hourstop`, `percentage`, `rate`,`tiz_share`) VALUES ('$id','$hour1','$hour2','$per','$rate','$tiz')";
       $this->db->query($query);
		return true;

	}

	public function deletepercent($id)
	{    
		$query="DELETE FROM `tbl_percentage` WHERE id1='$id'";
        $this->db->query($query);
		return true;

	}

}
?>
