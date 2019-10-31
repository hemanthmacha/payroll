<!DOCTYPE>
<html>
<head>
<script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">  </script> 
<title></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>

</head>



<body>
	 <?php require_once 'header.php'; ?>
	
	<div class="container-flud">
    <div class="content"> 	
    <div class="row"> 
    <div class="col-sm-4">
	
`
	<form class="form-signin">
		<div class="page-header">
		<h3>Conditions </h3>
	    </div>      
	
		<table  class="table text-center" align="center" id="percentage">
			 <thead> 

			<tr>
				<th>Start Hour</th>
				<th>Ending Hour</th>
				<th> Rate </th>
				<th> Percentage </th>
       
			</tr>

			</thead>
			 <tbody>
			 <?php $id=$_GET['var1']; ?>	
			 <?php if (!empty($rate)){ ?>
			 <?php $i=0; foreach($rate as $key=>$val){ $i++;?>

				<?php $id= $val->id1; ?>
         <?php $a= $val->percentage; ?>
         <?php $a= $val->hourstop; ?>
			<tr >
				<input type="hidden" id="sno" value="<?php echo $i;?>"> 
				<td> <input type="text" id="firsthour<?php echo $i;?>" value="<?php echo $val->hourstart; ?>" disabled>  </td>
				<td> <input type="text" id="secondhour<?php echo $i;?>" class="lasthour" name="test" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php echo $val->hourstop; ?>" disabled></td>
				<td> <input type="text"  id="rate<?php echo $i; ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php echo $val->rate; ?>" disabled> </td>
        <td style="display: none"> <input  type="text"  id="percent<?php echo $i; ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php echo $val->percentage; ?>"> </td>
        <td>
        <?php if($a != 0){ ?>  
         <input type="text"  id="percent<?php echo $i; ?>" value="<?php echo $val->percentage; ?>" disabled>
         <?php } ?>
        </td> 	     

			</tr>
			 <?php } ?>
			 <?php } ?>
			
		</tbody>
		</table>

		 
		 
		</form>
    <?php if (!empty($rate)){ ?>
		<input type="button" name="edit" id="edit" value="Edit"/>
		<input type="button" name="save1" id="save1" value="Update" disabled />
  <?php } ?>

		<button class="add-row" id="addcondition">  Add condition </button>

</div>
</div>
</div>
</div>

<script> 
     

$(document).ready(function () {

 
	$("input.lasthour").on("change", function(){ 

            	var sn =$(this).parent('td').parent('tr').find('#sno').val();
            	var hourchange =$(this).parent('td').parent('tr').find('#secondhour'+sn).val();
            	hourchange++;
            	var temphour=hourchange;
            	sn++;
            	var tempsn=sn;
            	 $('#firsthour'+tempsn).val(temphour);


            });

	});

	
$(document).ready(function () {
	   var tr = $('#percentage tr:last'); 
       var hr = $(tr).find("td").find('input.lasthour').val();

          if(hr == undefined){ 
              hr = 0;
       	    }
       	  else{
       		 hr++;
       	     }
         
       

            $(".add-row").click(function () { 
            	 
            	  markup = "<tr> <td> <input type='text' id='hour1' name='hour1' value="+hr+" disabled> </td> <td> <input type='text' id='hour2' onkeypress='return event.charCode >= 48 && event.charCode <= 57' name='hour2'>   </td> <td> <input type='text' id='rate1' onkeypress='return event.charCode >= 48 && event.charCode <= 57' name='rate1'> </td>    <td> <input style= 'display: none' type='text'   id='percent12' onkeypress='return event.charCode >= 48 && event.charCode <= 57' name='percent1'> </td>  <td><input class='btn btn-primary' type='button' id='save' value='Save'> <td> <input  type='button'   id='showpercent' name='showpercent' class='shoupercent' value='Add Percentage'> </td> </tr>";
                tableBody = $("table tbody"); 
                tableBody.append(markup); 

                $("input.shoupercent").on("click", function(){ 

                  $( "#percent12" ).toggle();
                  $( "#showpercent" ).toggle();

                });

                 $("#hour2").on("change", function(){ 

            	var num1 =$(this).parent('td').parent('tr').find('#hour1').val();
           		var num2= $(this).parent('td').parent('tr').find('#hour2').val();

           		var hou1=parseInt(num1);
           		var hou2=parseInt(num2)

                if ((hou2) < (hou1)){

            		alert('Ending hour must be greater than Starting hour');
            		location.reload(true);
            	  }
                     });
                 
            });

       });    


     $(document).on("click", "#save", function() { 

           var id= <?php echo $id; ?>;
           var hour1 =$(this).parent('td').parent('tr').find('#hour1').val();
           var hour2= $(this).parent('td').parent('tr').find('#hour2').val();
           var percentage =$(this).parent('td').parent('tr').find('#percent12').val();
           var rate =$(this).parent('td').parent('tr').find('#rate1').val();
          

          					$.ajax({
           						type: "post",
           						url: "<?= base_url();?>percentageupdate",
          						cache: false,    
           						data: {id:id, hour1:hour1, hour2:hour2, percentage:percentage, rate:rate},
          						success: function(json){      
            					alert('Rate saved');
            					location.reload();
          						} 
         					 });
            
           
        
         });





        $(document).on("click","#edit", function(){

                $('#edit').prop('disabled', true);
                $('#save1').prop('disabled', false);
                $('#percentage').find('input,button,textarea,select').prop('disabled', false);
                $('td:nth-child(5)').show();
                $('td:nth-child(6)').hide();
                $('#addcondition').hide();
                 $('#edit').hide();


                

            });


             $(document).on("click","#save1", function(){

             	var id= <?php echo $id; ?>;
             	    $.ajax({
           						type: "post",
           						url: "<?= base_url();?>percentagedelete",
          						cache: false,    
           						data: {id:id},
                      success: function(json){      
                    
            $("table tbody tr").each(function () {
              var id= <?php echo $id; ?>;
                var hour1 = $(this).find("td").eq(0).find(":text").val();
                var hour2 = $(this).find("td").eq(1).find(":text").val();
                var rate = $(this).find("td").eq(2).find(":text").val();
                var percentage = $(this).find("td").eq(3).find(":text").val();
               /* alert(hour1);
                alert(hour2);
                alert(rate);
                alert(percentage);*/
                
                    $.ajax({
                      type: "post",
                     url: "<?= base_url();?>percentageupdate",
                      cache: false,    
                      data: {id:id, hour1:hour1, hour2:hour2, percentage:percentage, rate:rate},
                      
                   });
                
                 })
             alert('Rate saved');
            location.reload();
                      } 


          						
         					 });
        
             	

  		  /*  var test= 0;
            $("table tbody tr").each(function () {
            	var id= <?php echo $id; ?>;
                var hour1 = $(this).find("td").eq(0).find(":text").val();
                var hour2 = $(this).find("td").eq(1).find(":text").val();
                var rate = $(this).find("td").eq(2).find(":text").val();
                var percentage = $(this).find("td").eq(3).find(":text").val();
                alert(hour1);
                alert(hour2);
                alert(rate);
                alert(percentage);
                
                    $.ajax({
           						type: "post",
           					 url: "<?= base_url();?>percentageupdate",
          						cache: false,    
           						data: {id:id, hour1:hour1, hour2:hour2, percentage:percentage, rate:rate},
          						success: function(json){      
            					window.test=1;
          						} 
         					 });
                
                 })*/

           

            });







    </script>	
    

</body>
</html>
