<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?=base_url('assests/css/changepassword.css')?>">
<script>
function myFunction() {
 var x = document.getElementById("password1");
 if (x.type === "password") {
   x.type = "text";
 } else {
   x.type = "password";
 }
}


function checkPassword(form) { 
                password1 = form.password1.value; 
                password2 = form.password2.value; 
  
               
                 if (password1 != password2) { 
                    alert ("Password did not match...") ;
                    return false; 
                } 
               
            } 
</script>
</head>
<body>
<div id="viewport">
<h2>Reset Password</h2>

<form action="changepassword" method="POST" onSubmit = "return checkPassword(this)">

 <div class="container">
  <div>
   <label><b>Password</b></label>
   <input type="password" placeholder="Enter new Password" name="password1" id="password1" required>
 </div>

   <div>
   <label><b>Reenter Password</b></label>
   <input type="password" placeholder=" Reenter Password" name="password2" id="password2" required>
   </div>   

    <input type="checkbox" onclick="myFunction()"> Show password
      
   <button type="submit">Submit</button>
   <label>
     </label>
 </div>

 
</form>
</div>
</body>
</html>