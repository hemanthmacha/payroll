<?php
class Special_model extends CI_Model

{
   public function addspecial($id,$month,$year,$first,$fifteen,$total,$comments)
	{
		$query="UPDATE `tbl_special` SET `first`='$first',`fifteen`='$fifteen',`total`='$total',`comments`='$comments' WHERE `id`='$id'and `month`='$month' and `year`='$year' ";
		$this->db->query($query);
        return $query;
	}

	public function getemp_special($id)
	{
		$this->db->select('id,month,year,first,fifteen,total,comments');  
		$this->db->from('tbl_special');
		$this->db->order_by("tbl_special.year", "asc");
        $this->db->order_by("field(tbl_special.month, 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec')");
		$query = $this->db->get();
		$response = $query->result();
/*
		print_r($response);
		die();*/
		return $response;
	}

}

?>