<!DOCTYPE>
<html>
<head>
	<script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">  </script> 
	<title></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<style type="text/css">
	
	.unstyled-button {
  border: none;
  padding: 0;
  background: none;
}
.unstyled-button1 {
  border: none;
  padding: 0;
  background: none;
}


</style>

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
				<th> 

					<?php if (!empty($rate)){ ?>
			        <?php  foreach($rate as $key=>$val){ $i++;?>
					
			          <?php if($val->percentage!=0) { $temp=0; ?>
							<input type="button" class="unstyled-button" id="per" value="Percentage"/>
					 <?php } ?>

					 <?php if($val->rate!=0) { $temp=1;?>
						   <input type="button" class="unstyled-button1" id="rate"  value="Rate"/>
                     <?php } ?>
                  

                  <?php break; } ?>
			      <?php } ?>



			      <?php if (empty($rate)){ $temp=2;?>
			      <input type="button" class="unstyled-button" id="per" value="Percentage"/>
			      <input type="button" class="unstyled-button" id="divi" value="-"/>
			      <input type="button" class="unstyled-button1" id="rate"  value="Rate"/>
			      <?php } ?>

                 </th>

                 
			</tr>
			</thead>
			 <tbody>
			 <?php $id=$_GET['var1']; ?>	
			<?php if (!empty($rate)){ ?>
			<?php $i=0; foreach($rate as $key=>$val){ $i++;?>

				<?php $id= $val->id1; ?>
			<tr>
				 
				<td> <input type="text" value="<?php echo $val->hourstart; ?>" disabled> </td>

				<td> <input type="text" id="test" class="length" name="test" value="<?php echo $val->hourstop; ?>" disabled></td>

                  <?php if($val->percentage!=0) { ?>
				<td> <input type="text"  value="<?php echo $val->percentage; ?>" disabled> </td>
				   <?php } ?>

				   <?php if($val->rate!=0) { ?>
				<td> <input type="text"  value="<?php echo $val->rate; ?>" disabled> </td>
				 <?php } ?>

			</tr>
			 <?php } ?>
			 <?php } ?>
			
		</tbody>
		</table>

		 
		 
		</form>
		<button class="add-row">  Add condition </button>

</div>
</div>
</div>
</div>

<script> 
     

$(document).ready(function () {

			var temp = <?php echo $temp; ?>;


		if(temp==0){

			 var per = $('#percentage tr:first'); 
             var calculation;
             window.calculation = $(per).find("th").find('input.unstyled-button').val();
             //console.log(window.calculation);

		}

		else if(temp==1){

			var rate = $('#percentage tr:first'); 
            var calculation;
            window.calculation = $(rate).find("th").find('input.unstyled-button1').val();
            //console.log(window.calculation);
              

		}


		else if(temp==2){

	      $("#per").click(function(){
             $("#rate").hide();
              $("#divi").hide();

             var per = $('#percentage tr:first'); 
             var calculation;
             window.calculation = $(per).find("th").find('input.unstyled-button').val();
             //console.log(window.calculation);
			});


			$("#rate").click(function(){
             $("#per").hide();
              $("#divi").hide();
               var rate = $('#percentage tr:first'); 
               var calculation;
               window.calculation = $(rate).find("th").find('input.unstyled-button1').val();
               //console.log(window.calculation);
              
			});
		}
		
	   var tr = $('#percentage tr:last'); 
       var hr = $(tr).find("td").find('input.length').val();

          if(hr == undefined){ 
              hr = 0;
       	    }
       	  else{
       		 hr++;
       	     }
         

            $(".add-row").click(function () { 
            	 
            	  markup = "<tr> <td> <input type='number' id='hour1' name='hour1' value="+hr+" disabled> </td> <td> <input type='integer' id='hour2' onkeypress='return event.charCode >= 48 && event.charCode <= 57' name='hour2'>   </td><td> <input type='text'   id='percentage'  onkeypress='return event.charCode >= 48 && event.charCode <= 57'  name='percentage'> </td><td><input class='btn btn-primary' type='button' id='save' value='Save'> </tr>";
                tableBody = $("table tbody"); 
                tableBody.append(markup); 



                  $("#hour2").on("change", function(){ 

            	var hou1 =$(this).parent('td').parent('tr').find('#hour1').val();
           		var hou2= $(this).parent('td').parent('tr').find('#hour2').val();


                if(hou2<hou1){
            		alert('hour2 is must be greater than hour1');
            		location.reload(true);
            	  }
                     });
                 
            }); 
            
           

            $(document).on("click", "#save", function() { 
           
           var hour1 =$(this).parent('td').parent('tr').find('#hour1').val();
           var hour2= $(this).parent('td').parent('tr').find('#hour2').val();
           
           var id= <?php echo $id; ?>;

           if(window.calculation=='Rate'){
           	   var rate = $(this).parent('td').parent('tr').find('#percentage').val();
           	    //alert('rate='+rate);
               }
            
            if(window.calculation=='Percentage'){
           	   var percentage = $(this).parent('td').parent('tr').find('#percentage').val();
           	   //alert('per='+percentage);
               }
           
         
          $.ajax({
           type: "post",
           url: "<?= base_url();?>percentageupdate",
           cache: false,    
           data: {id:id, hour1:hour1, hour2:hour2, percentage:percentage, rate:rate},
           success: function(json){      
            alert('Percentage saved');
            location.reload();
          } 
          });
         });
        });  





    </script>	
    

</body>
</html>
