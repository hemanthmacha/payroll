<html>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="<?=base_url('assests/css/login.css')?>">


  <div class="wrapper">
    <form action="login" method="post" class="form-signin">       
      <h2 class="form-signin-heading">Please login</h2> <br>
      <label> User Name </label><input type="text" class="form-control" name="username" placeholder="username" required="" autofocus="" /> <br>
      <label> Password </label><input type="password" class="form-control" name="password" placeholder="Password" required=""/> <br>   
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>   
    </form>
  </div>

</html>
