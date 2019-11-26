<?php if($this->session->userdata('role') == 'admin') { ?>  
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
				<th></th>
				<th>Date</th>
				<th>Description</th>
				<th>Amount</th>
			</tr>
			</thead>
			 <tbody> 


		    <?php $i=0;foreach($date1 as $key=>$val){ $i++; ?>
		    	<?php if(!empty($val->description)){?>
			 	<tr>
           <td><input type="checkbox" class= "chkBox" id="checkboxid" ></td>
			 		<input type="hidden" id="idddd" value="<?php echo $val->id1; ?>">
            	<td><input type="text" style="border: 0"  id="date" value="<?php echo $val->month; ?>-<?php echo $val->year; ?>"  readonly/></td>
				<td><input type="text"  style="border: 0"  id="des"  value="<?php echo $val->description; ?>"readonly/></td>
    			<td><input type="text"  style="border: 0"  id="amount" value="<?php echo $val->expenses; ?>" readonly/></td>
    			
    			
		
			    </tr>
			<?php } ?>
		    <?php } ?>	

			<tr>
        <td></td>

				<td>  <select style="width: 110px;"   id="date1" name="date" class="form-control dropdownselect">
            				<?php foreach($date2 as $row)
           					   { 
                        echo '<option value="" selected disabled hidden>Select here</option>';
              					echo '<option value="'.$row->month.'-'.$row->year.'">'.$row->month.'-'.$row->year.'</option>';
            					}
           					 ?>
            			</select>
            	</td>
				
				<!-- <td> <input type="month" id="date" name="date"> </td> -->
				<input type="hidden" id="idddd" value="<?php echo $val->id; ?>">
				<td>  <input type="text" id="des" name="des"></textarea>  </td>
				<td> <input type="text"  id="amount" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="amount"> </td>
				<td><input class="btn btn-primary buttondelete" type="submit" id="save" value="Save" disabled> </td>			
			</tr>
		</tbody>
		</table> 
		
		<!--  <button class=" btn btn-primary add-row buttondelete">  Add row </button> 
	     <a type="button" class="btn btn-primary buttondelete" href="javascript:window.history.go(-1);">Back</a> -->

        <button class=" btn btn-primary add-row buttondelete"><span class="glyphicon glyphicon-plus"></span> Add row </button>

     <button class="btn btn-primary buttondelete"id="delete" onclick="deleteCheckBox()"><i class="fa fa-trash-o"></i> Delete</button>
     
      <a type="button" class="btn btn-primary buttondelete" href="javascript:window.history.go(-1);"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
</div>
</div>
</div>
</div>
</div>

<style type="text/css">
  .buttondelete{
    height: 23px;
    padding:0px 10px;

  }
  </style>

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
           
           var id = <?php echo $_GET['val1']; ?> ;
           var des= $(this).parent('td').parent('tr').find('#des').val();
           var amount = $(this).parent('td').parent('tr').find('#amount').val();
           var date= $(this).parent('td').parent('tr').find('#date1').val();

          
         $.ajax({
           type: "post",
           url: "<?= base_url();?>newexpenses",
           cache: false,    
           data: {id:id, des:des, amount:amount, date:date},
           success: function(json){      
            alert("Expense added");
            location.reload();
          } 
          });
         });

        /* $(document).on("click", "#delete", function(){ 
           
           var id = $(this).parent('td').parent('tr').find('#idddd').val();
           var date1= $(this).parent('td').parent('tr').find('#date').val();
           var des= $(this).parent('td').parent('tr').find('#des').val();
           var amount = $(this).parent('td').parent('tr').find('#amount').val();
     
         $.ajax({
           type: "post",
           url: "<?= base_url();?>deleteexpenses", 
           data: {id:id, date:date1, des:des, amount:amount,},
           success: function(json){      
            alert('Expenses Delete');
            location.reload();
          } 
          });
         });*/



         $(".chkBox").click(function (){
  
           var id = $(this).parent('td').parent('tr').find('#idddd').val();
           var date1= $(this).parent('td').parent('tr').find('#date').val();
           var des= $(this).parent('td').parent('tr').find('#des').val();
           var amount = $(this).parent('td').parent('tr').find('#amount').val();
            var check1 = $('input[type="checkbox"]:checked').length;


           
             $(document).on("click", "#delete", function(){

              if ($('.chkBox:checked').length != 0) {
                 var check = $('input[type="checkbox"]:checked').length;

              $.ajax({
              type:'POST',
              url: "<?= base_url();?>deleteexpenses", 
              data: {id:id, date:date1, des:des, amount:amount,},
               success: function(json){
    
             }

           });
               if(check1==check){
           alert('Expenses Deleted');
           location.reload();
         }
       }
      }); 
    });

         $("#delete").click(function(){

           if($('.chkBox:checked').length == 0){
           alert("Please select atleast one row to delete");
}

});




         
    $(document).ready(function () {



         $(document).on('input change',"#amount,#des,#date1", function () {
         
            if (document.getElementById("date1").value != "" && document.getElementById("des").value != "" && document.getElementById("amount").value != "") {
                $(this).parent('td').parent('tr').find('#save').prop('disabled', false);
            }
            else {
                $(this).parent('td').parent('tr').find('#save').prop('disabled', true);
            }
             });

        


    });


    </script>
</body>
</html>

<?php }  else {

  echo '<script>alert("Please Login");</script>';
             echo '<script>window.open("'.base_url().'","_self");</script>';

 } ?>
