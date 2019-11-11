<html>
<head>
<title>Employe Summary</title>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>

<body>

    <div class="content"> 
    <div class="row"> 
    <div class="col-sm-10">
    	
   <?php if(!empty($sresult)){ ?>

<table class="table text-center" align="center" id="customers">
<tr>
      <th>Sno</th>  
      <th>Billed Month</th>
      <th>Billed Hours</th>
      <th>Rate</th>
      <th>Monthly Pay</th>
      <th>Expenses</th>
      
</tr>


   <?php $i=0; foreach($sresult as $key=>$val){ $i++;?>
	<tr>
     
     <td><?php echo $i; ?></td>
      <input type="hidden" id="idd" value="<?=$val->id?>">
    <td><input type="text" id="billedmonth" name="month" value="<?php echo $val->month; echo $val->year; ?>"  disabled/></td>
    <td><input type="text" id="billedhours" name="hours" value="<?php echo $val->hours; ?>"disabled/></td>
    <td><input type="text" id="rate" name="rate" value="<?php echo $val->rate_percent; ?>"disabled/></td>
   <!-- // <td><input type="text" id="pct" name="pct" value="<?php echo $val->rate_percent; ?>"disabled /></td> -->
    <td><input type="text" id="totalamount" name="total" value="<?php echo $val->total; ?>"disabled/></td>
    <td><input type="text" id="expenses" name="expenses" value="<?php echo $val->expenses; ?>"disabled/></td>

	</tr>

	  <?php } ?>

</table>
  <?php } ?>

  <?php foreach($sresult1 as $key=>$val){?>
  
  <div class="abc">
   Total Balance To Be Paid :<?php echo $val->balance; ?>
 </div>

  <?php } ?>
  <br>
  <br>
  <br>

  
</div>
</div> </div>


<style>

  .abc{
  position: absolute;
  bottom: 12px;
  right: 77px;
  border:none;
  

}
</style>




</body>
</html>
