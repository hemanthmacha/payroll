<!DOCTYPE html>
<html>
<head>
	<script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">  </script> 
	<title></title>

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
			 <thead> 
			<tr>
				
				<th>Date</th>
				<th>Description</th>
				<th>Amount</th>
			</tr>
			</thead>
			 <tbody> 


		    <?php $i=0;foreach($date1 as $key=>$val){ $i++; ?>
		    	<?php if(!empty($val->description)){?>
			 	<tr>

            	<td><input type="text"  value="<?php echo $val->month; ?>-<?php echo $val->year; ?>"  disabled/></td>
				<td><input type="text"  value="<?php echo $val->description; ?>"disabled/></td>
    			<td><input type="text"  value="<?php echo $val->expenses; ?>" disabled/></td>
		
			    </tr>
			<?php } ?>
		    <?php } ?>	

			<tr>

				<td>  <select style="width: 110px;"   id="date" name="date" class="form-control dropdownselect">
            				<?php foreach($date2 as $row)
           					   { 
              					echo '<option value="'.$row->month.'-'.$row->year.'">'.$row->month.'-'.$row->year.'</option>';
            					}
           					 ?>
            			</select>
            	</td>
				
				<!-- <td> <input type="month" id="date" name="date"> </td> -->
				<input type="hidden" id="idddd" value="<?php echo $val->id; ?>">
				<td>  <input type="text" id="des" name="des"></textarea>  </td>
				<td> <input type="text"  id="amount" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="amount"> </td>
				<td><input class="btn btn-primary" type="submit" id="save" value="Save"> </td>
			</tr>
		</tbody>
		</table> 
		
		<button class="add-row">  Add row </button> 
</div>
</div>
</div>
</div>
</div>

<script> 
       // let lineNo = 1; 
        $(document).ready(function () { 
            $(".add-row").click(function () { 

             var rowToAdd = $("#customers tbody tr:last td").clone();
   			$(rowToAdd).find('td').each(function(){
      		$(this).text('');
   				});
   			$("#customers tbody").append(rowToAdd);

            }); 
        });  




        $(document).on("click", "#save", function() { 
           
           var id = $(this).parent('td').parent('tr').find('#idddd').val();
           var des= $(this).parent('td').parent('tr').find('#des').val();
           var amount = $(this).parent('td').parent('tr').find('#amount').val();
           var date= $(this).parent('td').parent('tr').find('#date').val();

          
         $.ajax({
           type: "post",
           url: "<?= base_url();?>newexpenses",
           cache: false,    
           data: {id:id, des:des, amount:amount, date:date},
           success: function(json){      
            alert('Expenses Updated');
            location.reload();
          } 
          });
         });
    </script>
</body>
</html>
