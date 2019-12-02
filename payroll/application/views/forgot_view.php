
<!Doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="css/style.css">

    <link rel="icon" href="Favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
     <link rel="stylesheet" href="<?=base_url('assests/css/login.css')?>">
</style>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

    <title>Forgot Password</title>
</head>
<body>

<div id="viewport">
<div id="content">    

<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            
            <div class="col-sm-4" style="padding-top: 30px;">
                <div class="card">
                    <div class="card-header" style="background-color: #250d0d14;;">Forgot Password</div>
                    <div class="card-body">
                        <form action="reset" method="POST">
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right" style="font-family: unset;">UserName</label>
                                <div class="col-md-6">
                                    <input type="text" id="username"  placeholder="User Name" class="form-control" name="username" required autofocus> 
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right"style="font-family: unset;">Email Id</label>
                                <div class="col-md-6">
                                    <input type="text" id="email"  placeholder="Email Id" class="form-control" name="email" required>
                                </div>
                            </div>


                            <div class="col-md-6 offset-md-4">
                                <button type="submit" id="submit" class="btn btn-primary">
                                  Submit
                                </button>
                                 <button class="btn btn-primary" style="display: none" type="submit1" id="submit1">
                                            <i class="fa fa-circle-o-notch fa-spin"></i>Please wait
                                </button>
                                <button type="button" id="back" class="btn btn-primary buttonsave" onclick="history.back()"> <span class="glyphicon glyphicon-arrow-left"></span> Back </button>
                            </div>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
    </div>

</main>
</div></div>

<script>


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
           $("#login")[0].submit(); 
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
           $("#login")[0].submit(); 
       };
    });




</script>



</body>
</html>




