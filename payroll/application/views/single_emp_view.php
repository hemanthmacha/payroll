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
      <th>PCT</th>
      <th>Total Amount</th>
      <th>Expenses</th>
      <th >Balance</th>
</tr>


   <?php $i=0; foreach($sresult as $key=>$val){ $i++;?>
	<tr>
     
     <td><?php echo $i; ?></td>
      <input type="hidden" id="idd" value="<?=$val->id?>">
    <td><input type="text" id="billedmonth" name="month" value="<?php echo $val->month; echo $val->year; ?>"  disabled/></td>
    <td><input type="text" id="billedhours" name="hours" value="<?php echo $val->billedhours; ?>"disabled/></td>
    <td><input type="text" id="rate" name="rate" value="<?php echo $val->rate; ?>"disabled/></td>
    <td><input type="text" id="pct" name="pct" value="<?php echo $val->percentamount; ?>"disabled /></td>
    <td><input type="text" id="totalamount" name="total" value="<?php echo $val->totalamount; ?>"disabled/></td>
    <td><input type="text" id="expenses" name="expenses" value="<?php echo $val->expenses; ?>"disabled/></td>
    <td><input type="text" id="balance" name="balance" value="<?php echo $val->balance; ?>"disabled/></td>
	</tr>

	  <?php } ?>
</table>
  <?php } ?>
</div>
</div> </div>






</body>
</html>