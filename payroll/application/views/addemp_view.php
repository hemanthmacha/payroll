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
		 <input type="text" class="form-control" id="lname" placeholder="Enter Last name" name="lname" required>
		</div>

    <div> <table style="border-collapse: separate;">
     <label for="lname">User Name:</label>
    <tr> <td><input type="text" style="width: 498px;" class="form-control" id="uname" placeholder="Enter User name" name="uname" required> </td>
         <td style="padding: 7px;">  <input type="button" class="button" value="Generate Password" onClick="randomPassword();" tabindex="2"></td>
    </tr>
     </table>
    </div>

    <div>
     <label for="lname">Password:</label>
     <input type="password" class="form-control" id="pass" placeholder="Enter Password" name="pass" required readonly> 
    </div>

    <div>
     <label for="lname">Email:</label>
     <input type="text" class="form-control" id="email" placeholder="Enter MailID" name="email" required> 
    </div>

		<!-- <div>
		 <label for="status">Status:</label>
		 <select  class="form-control" id="status" name="status" >
                     <option value="Active">Active</option>
                     <option value="Inactive">Inactive</option>
                     <option value="Inhouse">Inhouse</option>
                     <option value="miscellaneous">Miscellaneous</option>
          </select>           
		</div>  -->

		<div>
         <br><input class="btn btn-primary" type="submit" id="submit" value="Submit" disabled>
          <button class="btn btn-primary" style="display: none" type="submit" id="submit1">
            <i class="fa fa-circle-o-notch fa-spin"></i>Please Wait
    </button> 
         <input class="btn btn-primary" type="reset" value="Reset">
     </div>

    
    </form>
  </div>

  <script type="text/javascript">
   
function randomPassword() {
    var chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOP1234567890";
    var pass = "";
    for (var x = 0; x < 10; x++) {
        var i = Math.floor(Math.random() * chars.length);
        pass += chars.charAt(i);
    }
    
    $('#pass').val(pass);
}


$(document).ready(function () {
    $("#submit").click(function () {
        $(".form-signin").prop('disabled', false);

        return true;
    });
});


// then do something with "isValid"


 var isValid = true;
     $('input,textarea,select').filter('[required]:visible').each(function() {
      if ( $(this).val() === '' )
         isValid = false;
    });

    if( isValid ) {
       $('#submit').prop('disabled', false);

    } else {
       $('#submit').prop('disabled', true);

    };

    $('#submit').click(function() {
        var isValid = true;
         $('input,textarea,select').filter('[required]:visible').each(function() {
          if ( $(this).val() === '' )
             isValid = false;
        });
        if( isValid ) {
            $('#submit').hide();
            $('#submit1').show();
            $('#submit1').prop('disabled', true);
           $("#addemployee")[0].submit(); 
       };

    });

    //When a input is changed check all the inputs and if all are filled, enable the button
     $('input,textarea,select').keyup(function() {
        var isValid = true;
         $('input,textarea,select').filter('[required]:visible').each(function() {
          if ( $(this).val() === '' )
             isValid = false;
        });
        if( isValid ) {
           $('#submit').prop('disabled', false);
        } else {
           $('#submit').prop('disabled', true);
        };
    });

    //In case the user edits the button with firebug and removes disabled, check
    $('#submit11').click(function() {
         var isValid = true;
         $('input,textarea,select').filter('[required]:visible').each(function() {
          if ( $(this).val() === '' )
             isValid = false;
        });
        if( isValid ) {
            $('#submit').hide();
            $('#submit1').show();
            $('#submit1').prop('disabled', true);
           $("#addemployee")[0].submit(); 
       };
    });






  </script>

</html>

<?php }  else {

  echo '<script>alert("Please Login");</script>';
             echo '<script>window.open("'.base_url().'","_self");</script>';

 } ?>


