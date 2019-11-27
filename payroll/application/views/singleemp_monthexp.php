<?php if($this->session->userdata('role') == 'employee') { ?> 
<!DOCTYPE html>
<html>
<head>
	<script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">  </script> 
	<title></title>

	<style>
		
		 .dropdownselect{
    height: 21px !important;
    padding: 0px 0px !important;
    font-size: 13px !important;
}

    .buttondelete{
    height: 30px;
    padding:0px 10px;
  }
  .back{
  	height: 30px;
    padding:0px 10px;

  }
  .add-row{
  	height: 30px;
    padding:0px 10px;

  }
    .buttondelete{
    height: 23px;
    padding:0px 10px;

  }

	</style>

</head>



<body>
	<?php require_once 'header.php'; ?>
	<div class="container-flud">
    <div class="content"> 
    <div class="row"> 
    <div class="col-sm-4">
	<div class="wrapper">

		<div class="page-header">
		<h3>Expenses </h3>  
	</div>


	  
		<table  class="table text-center" align="center" id="customers">
			 <thead style="background-color: gainsboro;"> 
			<tr>
				
				<th>Date</th>
				<th>Description</th>
				<th>Amount</th>
			</tr>
			</thead>
			 <tbody> 


		    <?php $i=0;foreach($description as $key=>$val){ $i++; ?>
		    	<?php if(!empty($val->description)){?>
			 	<tr>
			 		
        	      <td> <input type="text" style="border: 0" id="date" value="<?php echo $val->month; ?>-<?php echo $val->year; ?>"  readonly/></td>
				  <td><input type="text" style="border: 0"  id="des"  value="<?php echo $val->description; ?>"readonly/></td>
    			<td><input type="text" style="border: 0"  id="amount" value="<?php echo $val->expenses; ?>" readonly/></td>
    		
         
    			
		
			    </tr>
			<?php } ?>
		    <?php } ?>	

		</tbody>
		</table> 
		
	
	  <!--  <a type="button" class="btn btn-primary buttondelete" href="javascript:window.history.go(-1);" style="padding: 1px 12px;">Back</a> -->
	    <button type="button" id="back" class="btn btn-primary buttonsave" onclick="history.back()"> <span class="glyphicon glyphicon-arrow-left"></span> Back </button>
</div>
</div>
</div>
</div>


</body>
</html>

<?php }  else {

  echo '<script>alert("Please Login");</script>';
             echo '<script>window.open("'.base_url().'","_self");</script>';

 } ?>

