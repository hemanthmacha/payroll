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
    	


<table class="table text-center" align="center" id="customers">
<tr>
      <th>Sno</th>  
      <th>Billed Month</th>
      <th>Billed Hours</th>

      <th>

        <?php if (!empty($sresult1)){ ?>
              <?php  foreach($sresult1 as $key=>$val){ $i++;?>
          
                <?php if($val->percentage!=0) { $temp=0; ?>
              <a href="<?=base_url()?>percentage/?var1=<?php echo$_GET['var1']; ?>"> PERCENTAGE</a>
           <?php } ?>

           <?php if($val->rate!=0) { $temp=1; ?>
               <a href="<?=base_url()?>percentage/?var1=<?php echo$_GET['var1']; ?>"> RATE</a>
                     <?php } ?>
                  

                  <?php break; } ?>
            <?php } ?>


            <?php if (empty($sresult1)){ ?>
              
                  <a href="<?=base_url()?>percentage/?var1=<?php echo$_GET['var1']; ?>"> SET RATE/PERCENTAGE</a>
 
            <?php } ?>





        </th>

      <th>Total Amount</th>
     <!--  <th>Expenses</th> -->
     <!--  <th >Balance</th> -->
</tr>
    <!-- <?php   $hour1=array();
          $hour2=array(); foreach($sresult1 as $key=>$val){ 

    
          array_push($hour1,"$val->hourstart");
          array_push($hour2,"$val->hourstop"); }

      ?>    -->


   <?php $i=0; foreach($sresult as $key=>$val){ $i++; ?>

	<tr>
     
     <td><?php echo $i; ?></td>
     <input type="hidden" id="sno" value="<?php echo $i; ?>">
      <input type="hidden" id="idd" value="<?=$val->id?>">
      <input type="hidden" id="mon" value="<?=$val->month?>">
      <input type="hidden" id="yea" value="<?=$val->year?>">
    <td><input type="text" id="billedmonth" name="month" value="<?php echo $val->month; echo "-"; echo $val->year; ?>"  disabled/></td>
    <td><input type="text" id="billedhours"  name="hours" class="miles" value="<?php echo $val->billedhours; ?>"/></td>

      
        <td> <input type="text" id="pct" class="pct" name="pct"  value="<?php echo $val->rate; ?>" disabled> </td>
           
 
    <td><input type="text" id="totalamount" name="total" value="<?php echo $val->mounthtotal; ?>"disabled/></td>
   <!-- <td><input type="text" id="expenses" name="expenses" value="<?php echo $val->expenses; ?>"/></td> -->
   <!--  <td><input type="text" id="balance" name="balance" value="<?php echo $val->balance; ?>"disabled/></td> -->
    <td ><button class="btn btn-primary buttonsave" id="save">Save</button></td>
	</tr>

 <?php } ?>
</table>
<div>
  <button  id="adddata">Add Data</button> <br><br>
<br>

 <form method="post" action="expense/?val1=<?=$val->id?>">
     <button  id="addexp">Add Expense</button>
  </form>
 </div> 

</div>
</div> </div>

<style type="text/css">
  .buttonsave{
    height: 23px;
    padding:0px 10px;

  }


</style>




<script type="text/javascript">




  $(document).ready(function () {

         var temp = <?php echo $temp; ?>;

         

        $("input.miles").each(function() {
        //add only if the value is number
             if(!isNaN(this.value) && this.value.length!=0) {
           
                     var thisRow = $(this).closest('tr');
                     var hourscheck=this.value;
        
                   <?php foreach ($sresult1 as $key => $val) { ?>
       
                      var h1 = <?php echo $val->hourstart;?>;
                      if(temp==0){
                      var percent =  <?php echo $val->percentage; ?>;
                    }

                    if(temp===1){
                      var percent =  <?php echo $val->rate; ?>;
                    }
                      if(h1<hourscheck) {

                         var tee=1;
                         var h2 = <?php echo $val->hourstop; ?>;
                         if(h2>hourscheck) {

                              $(this).parent('td').parent('tr').find('#pct').val(percent);
                            }   
                        }

                   <?php } ?>

                   }
            })

      


});




     


   // adding new data


    $(document).on("click", "#adddata", function() { 

       //var sno = $(this).last().parent('td').parent('tr').find('#sno').val();

       
        var sno='<?php  $i++; echo $i; ?>';
       
        markup = "<tr> <input type='hidden' id='idd1' value='<?=$val->id?>'><td> " + sno + "</td> <td><input id='newmonth1' type='month' name='month1' min='2017-01' max='2100-12'></td> <td><input type='text' id='billedhours1' class='billhours' name='hours'> </td>   <td><input type='text' id='pct1' name='pct' disabled> </td>  <td><input type='text' id='totalamount1' name='total'> </td> <td ><button class='btn btn-primary buttonsave' id='save1'>Save</button></td> </tr>";
        tableBody = $("table"); 
        tableBody.append(markup);





         /*$("#billedhours1, #rate1,#pct1,#expenses1").on("change", function() {
        

            var num1 = $(this).parent('td').parent('tr').find('#billedhours1').val();
            var num2 = $(this).parent('td').parent('tr').find('#rate1').val();
            var num3 = $(this).parent('td').parent('tr').find('#pct1').val();

            var result = parseInt(num1) * parseInt(num2) *parseInt(num3)*0.01 ;
            var totalamount = $(this).parent('td').parent('tr').find('#totalamount1').val();
             var result1 = parseInt(totalamount) - parseInt(exp);


            if (!isNaN(result)) {

             $(this).parent('td').parent('tr').find('#totalamount1').val(result);
             $(this).parent('td').parent('tr').find('#balance1').val(result1);

            }
            
        });
*/        


   
    $("input.billhours").on("change keyup", function() {
        
            var temp = <?php echo $temp; ?>;
            var hourscheck=$(this).parent('td').parent('tr').find('#billedhours1').val();
        
                   <?php foreach ($sresult1 as $key => $val) { ?>
       
                      var h1 = <?php echo $val->hourstart;?>;
                      if(temp==0){
                      var percent =  <?php echo $val->percentage; ?>;
                    }

                    if(temp===1){
                      var percent =  <?php echo $val->rate; ?>;
                    }
                      if(h1<hourscheck || h1==hourscheck ) {

                         var tee=1;
                         var h2 = <?php echo $val->hourstop; ?>;
                         if(h2>hourscheck || h2==hourscheck) {

                              $(this).parent('td').parent('tr').find('#pct1').val(percent);
                            }   
                        }

                   <?php } ?>


            var num1 = $(this).parent('td').parent('tr').find('#billedhours1').val();
            var num2 = $(this).parent('td').parent('tr').find('#pct1').val();

            if(temp==0){
            
            var totalamount =  parseInt(num1) * (parseInt(num2)/100);

          }
          if(temp==1){
            
            var totalamount =  parseInt(num1) * parseInt(num2);

          }

            if (!isNaN(totalamount)) {

             $(this).parent('td').parent('tr').find('#totalamount1').val(totalamount);
      
            }


            
        });

  });




    //this calculates values automatically 

///////////////////////////////

    //this calculates values automatically 
   
    $("input.miles").on("change keyup", function() {
        
            var temp = <?php echo $temp; ?>;
            var hourscheck=$(this).parent('td').parent('tr').find('#billedhours').val();
        
                   <?php foreach ($sresult1 as $key => $val) { ?>
       
                      var h1 = <?php echo $val->hourstart;?>;
                      if(temp==0){
                      var percent =  <?php echo $val->percentage; ?>;
                    }

                    if(temp===1){
                      var percent =  <?php echo $val->rate; ?>;
                    }
                      if(h1<hourscheck || h1==hourscheck) {

                         var tee=1;
                         var h2 = <?php echo $val->hourstop; ?>;
                         if(h2>hourscheck || h2==hourscheck) {

                              $(this).parent('td').parent('tr').find('#pct').val(percent);
                            }   
                        }

                   <?php } ?>


            var num1 = $(this).parent('td').parent('tr').find('#billedhours').val();
            var num2 = $(this).parent('td').parent('tr').find('#pct').val();

            if(temp==0){
            
            var totalamount =  parseInt(num1) * (parseInt(num2)/100);

          }
          if(temp==1){
            
            var totalamount =  parseInt(num1) * parseInt(num2);

          }

            if (!isNaN(totalamount)) {

             $(this).parent('td').parent('tr').find('#totalamount').val(totalamount);
      
            }


            
        });



// save data
$(document).on("click", "#save", function() { 
           
           var id = $(this).parent('td').parent('tr').find('#idd').val();
           var month= $(this).parent('td').parent('tr').find('#mon').val();
           var year= $(this).parent('td').parent('tr').find('#yea').val();
           var billedhours = $(this).parent('td').parent('tr').find('#billedhours').val();
           //var rate= $(this).parent('td').parent('tr').find('#rate').val();
           var pct = $(this).parent('td').parent('tr').find('#pct').val();
           var totalamount= $(this).parent('td').parent('tr').find('#totalamount').val();
           var expenses = $(this).parent('td').parent('tr').find('#expenses').val();
           var balance= $(this).parent('td').parent('tr').find('#balance').val();
        

          
          $.ajax({
           type: "post",
           url: "<?= base_url();?>updateemployee",
           cache: false,    
           data: {id:id, pct:pct, billedhours:billedhours, totalamount:totalamount, balance:balance, month:month, year:year},
           success: function(json){      
            alert('Payroll updated');
            location.reload();
          } 
          });
         });
        

  $(document).on("click", "#save1", function() { 

           
           var id = <?php echo$_GET['var1']; ?>;
           var billedhours = $(this).parent('td').parent('tr').find('#billedhours1').val();
           //var rate= $(this).parent('td').parent('tr').find('#rate1').val();
           var pct = $(this).parent('td').parent('tr').find('#pct1').val();
           var totalamount= $(this).parent('td').parent('tr').find('#totalamount1').val();
           //var expenses = $(this).parent('td').parent('tr').find('#expenses1').val();
           var balance= $(this).parent('td').parent('tr').find('#balance1').val();
           var mo= $(this).parent('td').parent('tr').find('#newmonth1').val();
      
        

          
          $.ajax({
           type: "post",
           url: "<?= base_url();?>addemployeedata",
           cache: false,    
           data: {id:id, pct:pct, billedhours:billedhours, totalamount:totalamount, balance:balance,mo:mo},
           success: function(json){      
            alert(json);
            location.reload();
          } 
          });
         });      




</script>




</body>
</html>