<?php if($this->session->userdata('role') == 'admin') { ?> 
<html>
<head>
	<title>Add Employee</title>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="<?=base_url('assests/css/addemp.css')?>">

</head>	

<?php require_once 'header.php'; ?>
  <div class="wrapper">

    <form action="addemployee" method="post" class="form-signin"> 

    <div> 
    <h2>Enter Employee Details</h2>      
      <div>
		<label for="fname">First Name:</label>
		 <input type="text" class="form-control" id="fname" placeholder="Enter First name" name="fname" required>
        </div>
    <div>
		 <label for="lname">Last Name:</label>
		 <input type="text" class="form-control" id="fname" placeholder="Enter Last name" name="lname" required>
		</div>

    <div>
     <label for="lname">User Name:</label>
     <input type="text" class="form-control" id="uname" placeholder="Enter User name" name="uname" required>
    </div>

    <div>
     <label for="lname">Password:</label>
     <input type="password" class="form-control" id="pass" placeholder="Enter Password" name="pass" required> 
    </div>

		<div>
		 <label for="status">Status:</label>
		 <select  class="form-control" id="status" name="status" >
                     <option value="Active">Active</option>
                     <option value="Inactive">Inactive</option>
                     <option value="Inhouse">Inhouse</option>
                     <option value="miscellaneous">Miscellaneous</option>
          </select>           
		</div> 

		<div>
         <br><input class="btn btn-primary" type="submit" value="Submit"> 
         <input class="btn btn-primary" type="reset" value="Reset">
     </div>
    </form>
  </div>

</html>

<?php }  else {

  echo '<script>alert("Please Login");</script>';
             echo '<script>window.open("'.base_url().'","_self");</script>';

 } ?>


