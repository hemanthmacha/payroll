<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



<nav class="navbar navbar-default" style="background-color:#e9edf0;">
  <div class="container-fluid">
  
    <div class="navbar-header">
       <?php if($this->session->userdata('role') == 'admin') { ?>  
    <a href="<?=base_url()?>payroll"><img class="nav navbar-nav navbar-left" src="<?= base_url();?>assests/images/logo.jpg" height="60" width="90" ></a>  <a class="navbar-brand"  style="color: black !important; font-family: ; font-size: 30px;" href="<?=base_url()?>payroll">&nbsp;&nbsp;&nbsp;&nbsp;PAYROLL SYSTEM</a> 
    <?php } ?>

       <?php if($this->session->userdata('role') == 'employee') { ?>  
    <a href="<?=base_url()?>employee"><img class="nav navbar-nav navbar-left" src="<?= base_url();?>assests/images/logo.jpg" height="60" width="90" ></a>  <a class="navbar-brand"  style="color: black !important; font-family: ; font-size: 30px;" href="<?=base_url()?>employee">&nbsp;&nbsp;&nbsp;&nbsp;PAYROLL SYSTEM</a> 
    <?php } ?>

    </div>
    <div class="logout"><a href="<?=base_url()?>"> Logout </a> </div>
   
  </div>
    </div>
    
  </div>
</nav>
<div class="navbar navbar-inverse sidebar" style="background-color:#e9edf0; border-color: white; ">
  <?php if($this->session->userdata('role') == 'admin') { ?>  
  <a href="<?= base_url();?>payroll" class="nav-link nav-toggle <?php if($this->uri->segment(1) == 'payroll'|| $this->uri->segment(1) == 'month' || $this->uri->segment(1) == 'updateemployee'|| $this->uri->segment(1) == 'update' || $this->uri->segment(1) == 'employee') { echo 'active'; } ?>" >Home<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a>
  
  <a href="<?= base_url();?>employeelist" class="nav-link nav-toggle  <?php if($this->uri->segment(1) == 'employeelist'  || $this->uri->segment(1) == 'list' || $this->uri->segment(1) == 'percentage') { echo 'active'; } ?>" >Employee<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>
  
  <a href="<?= base_url();?>addemp"  class="nav-link nav-toggle  <?php if($this->uri->segment(1) == 'addemp' )  { echo 'active'; } ?>">Addemployee<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-plus"></span></a>
 <?php } ?>

 <?php if($this->session->userdata('role') == 'employee') { ?>  
  <a href="<?= base_url();?>employe"  class="nav-link nav-toggle  <?php if($this->uri->segment(1) == 'employe' || $this->uri->segment(1) == 'addemployee')  { echo 'active'; } ?>">BalanceSheet<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-envelope"></span></a>
  <?php } ?>

</div>

<style type="text/css">

  .logout{
        padding-left: 1450px;
        padding-top: 20px;
    }


.navbar-inverse {
    
    border-color: white; 
}
  
.sidebar {
  margin: 0;
  padding: 0;
  width: 200px;
  background-color: blue;
  position: absolute;
  height: 100%;
  overflow: auto;
}

.sidebar a {
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
}
 
.sidebar a.active {
  background-color: #407cde;
  color: white;
}

.sidebar a:hover:not(.active) {
  background-color:#717885;
  color: white;
}
.sidebar a:hover{
  background-color: #717885;
  color: white;
}

div.content {
  margin-left: 200px;
  padding: 1px 16px;
  height: 1000px;
}

@media screen and (max-width: 700px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
}

@media screen and (max-width: 400px) {
  .sidebar a {
    text-align: center;
    float: none;
  }
}



#customers {
  font-family:Arial, Helvetica, sans-serif;
  font-size: 12px;
  width: 100%;
  text-align: left;
}
#customers td, #customers th {
  padding: 10px;
}
#customers tr:nth-child(even){background-color: ;}

#customers th {
  padding-top: 8px;
  padding-bottom: 8px;
  text-align: left;
 /* background-color: #99ccff ;*/
  color: black;
  style=width:2%;
}


table td ::hover{
  font-size: 15px;
}

</style>


