<?php if($this->session->userdata('role') == 'admin') { ?> 

	<?php

$curYear = date('Y'); 
?>
<!DOCTYPE>
<html>
<head>
<style type="text/css">

.current{

color: #0b73f5;

	}
</style>	


</head>

<body>
<div class="container" >
<div class="container-fluid">
<div class="col-sm-6">

	<table> 

<tr><td>  <a href="<?=base_url()?>month/?var1=<?=$curYear+1?>"><font size="5">Payroll for the year <?= $curYear+1 ?></font> </a> <br><br> </td></tr>
 <tr><td>  <a href="<?=base_url()?>month/?var1=<?=$curYear+2?>"><font size="5">Payroll for the year <?= $curYear+2 ?></font> </a><br><br> </td></tr>

<tr><td > <a class="current" href="<?=base_url()?>month/?var1=<?=$curYear?>"><font size="5"> Payroll for the year <?= $curYear ?></font> </a> <br><br> </td> </tr>


<tr><td>     <a href="<?=base_url()?>month/?var1=<?=$curYear-1?>"><font size="5">Payroll for the year <?= $curYear-1 ?></font> </a> <br><br> </td></tr>
 <tr><td>  <a href="<?=base_url()?>month/?var1=<?=$curYear-2?>"><font size="5">Payroll for the year <?= $curYear-2 ?></font> </a> </td> </tr>
 

</table>

</div>
</div>
</div>
</body>
</html>
<?php }  else {

  echo '<script>alert("Please Login");</script>';
             echo '<script>window.open("'.base_url().'","_self");</script>';

 } ?>
