<html>
<head>
<title>Employe Summary</title>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>

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
              <a href="<?=base_url()?>percentage/?var1=<?php echo$_GET['var1']; ?>"> RATE-PERCENTAGE</a>
        <?php } ?>

        <?php if (empty($sresult1)){ ?>
               <a href="<?=base_url()?>percentage/?var1=<?php echo$_GET['var1']; ?>"> SET RATE-PERCENTAGE</a>
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
    <td><input type="text" id="billedhours"  name="hours" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="miles" value="<?php echo $val->billedhours; ?>"/></td>
    <td> <input type="text" id="pct" class="pct" name="pct"  value="<?php echo $val->rate; ?>" disabled> </td>
    <td><input type="text" id="totalamount" name="total" value="<?php echo $val->mounthtotal; ?>"disabled/><p id="alert" style="display: none" >The total amount may vary because the total amount <br> calculations based on the range of hours with respect <br> to their rate and percentage. </p></td>
    <td ><button class="btn btn-primary buttonsave" id="save">Save</button></td>
      <td> <button class="btn btn-primary buttonsave" id="delete" >Delete</button></td>
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


 $("p").hide(); 
     
        $("input.miles").each(function() {
        //add only if the value is number
             if(!isNaN(this.value) && this.value.length!=0) {
           
                     var thisRow = $(this).closest('tr');
                     var hourscheck=this.value;
        
                   <?php foreach ($sresult1 as $key => $val) { ?>

       
                      var h1 = <?php echo $val->hourstart;?>;
                   
                      var rate =  <?php echo $val->rate; ?>;
                    
                      if(h1<hourscheck || h1==hourscheck ) {

                         var h2 = <?php echo $val->hourstop; ?>;
                         if(h2>hourscheck || h2==hourscheck || h2==0) {

                              $(this).parent('td').parent('tr').find('#pct').val(rate);
                            }   
                        }

                   <?php } ?>


                   }
            })

      


}); 
////// automatic calculations


$(document).ready(function(){

  
             var hourstartarray=[];
             var hourstoparray=[];
             var ratearray=[];
             var percentagearray=[];
             var hours = [];

             

      <?php foreach ($sresult as $key => $val) { ?>
           hours.push(<?php echo $val->billedhours; ?>);
      <?php } ?>


     <?php foreach ($sresult1 as $key => $val) { ?>

          hourstartarray.push(<?php echo $val->hourstart;?>);
          if(<?php echo $val->hourstop;?> == 0){
             hourstoparray.push(1000000);
            }
           else{
              hourstoparray.push(<?php echo $val->hourstop;?>);
            } 
                       // hourstoparray.push(<?php echo $val->hourstop;?>);
                        ratearray.push(<?php echo $val->rate;?>);
                         percentagearray.push(<?php echo $val->percentage;?>);

     <?php } ?>

     var temp = 0;
     var temp1 = 0;
     var abc=0;
     for(var i = 0; i <hours.length;i++ ){
      var cal=0;
      var temp3=0;
      var temp6=0;
      var temp7=0;
      var temp5=0;

       temp = hours[i];
       temp1 = temp1 + hours[i];

       for(var j = 0; j<hourstartarray.length;j++){

          if(abc == 0){

              if(temp >= hourstartarray[j]){

                if(temp <= hourstoparray[j]){


                  if(i != 0){

                    temp3 = temp - hourstoparray[j-1];
                    cal = cal + temp3 * ratearray[j];

                    for(var k= j-1,p=j-2; k>=0 ; k--){

                      if( k == 0){

                        temp3 = hourstoparray[0]- hourstartarray[0];
                        cal = cal + temp3 * ratearray[0];
                      }

                      if(p>=0){

                        temp3 = hourstoparray[k]- hourstoparray[p];
                        cal = cal + temp3 * ratearray[k];

                      }


                    }


                  }

                  else{

                    cal = cal + temp *ratearray[i];
                  }

                }

abc++;
              }

          

          }

         else{

           if(temp1 >= hourstartarray[j]){

            if(temp1 <= hourstoparray[j]){

             temp5 = temp1 - hourstoparray[j-1];
            
             temp6 = temp - temp5; 
             if(temp6<=0){
              cal = cal + temp * ratearray[j];
             }
             if(temp6>0){
              cal = cal + temp5 * ratearray[j];
            
              

             for(var k=j-1, p=j-2; k>=0; k--, p--){
              
               if(p<0){
                p=0;
               }
              temp7 = hourstoparray[k] - hourstoparray[p];

              if(temp7 >= temp6 && temp6!=0){

                cal = cal+ temp6 * ratearray[k];
                temp6 = 0;


              }

              if(temp7 <= temp6){

                cal = cal+ temp7 * ratearray[k];
                temp6 = temp6 - temp7;
              }
              
              if(temp7==0){

                  cal = cal+ temp6 * ratearray[k];

              }



             }
               }

            }
           }



         }

       }

   console.log(cal);
     }

     
       

      
});




     


   // adding new data


    $(document).on("click", "#adddata", function() { 

       //var sno = $(this).last().parent('td').parent('tr').find('#sno').val();

       
        var sno='<?php  $i++; echo $i; ?>';
        <?php  $abc= date("Y"); 
               $yearArray = range(2015, 2100);
               $monthArray = range(1, 12);
        ?>
       
        markup = "<tr> <input type='hidden' id='idd1' value='<?=$val->id?>'><td> " + sno + "</td><td> <select id='year' name='year'> <option value=''>Select Year</option> <?php foreach ($yearArray as $year) {
         $selected = ($year == $abc) ? 'selected' : '';
        echo '<option '.$selected.' value="'.$year.'">'.$year.'</option>';
        }
    ?></select> <select id='month' name='month'> <option value=''>Select Month</option> <?php
    foreach ($monthArray as $month) {
        $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
        $fdate = date("F", strtotime("2015-$monthPadding-01"));
        echo '<option value="'.$monthPadding.'">'.$fdate.'</option>';
    }
    ?>
</select> </td>  <td><input type='text' id='billedhours1' class='billhours' name='hours'> </td>   <td><input type='text' id='pct1' name='pct' disabled> </td>  <td><input type='text' id='totalamount1' name='total'> </td> <td ><button class='btn btn-primary buttonsave' id='save1'>Save</button></td> </tr>";
        tableBody = $("table"); 
        tableBody.append(markup);



$("input.billhours").on("change ", function() {
        
           
            var hourscheck=$(this).parent('td').parent('tr').find('#billedhours1').val();
               hourscheck = parseInt(hourscheck);
             var hourstartarray=[];
             var hourstoparray=[];
             var ratearray=[];
             var percentagearray=[];
        
                   <?php foreach ($sresult1 as $key => $val) { ?>
       
                      var h1 = <?php echo $val->hourstart;?>;
                      var percent =  <?php echo $val->rate; ?>;
                   
                      if(h1<hourscheck || h1==hourscheck) {

                         var tee=1;
                         var h2 = <?php echo $val->hourstop; ?>;
                         if(h2>hourscheck || h2==hourscheck || h2==0) {

                              $(this).parent('td').parent('tr').find('#pct1').val(percent);
                            }   
                        }

                       
                        
                        hourstartarray.push(<?php echo $val->hourstart;?>);
                        hourstoparray.push(<?php echo $val->hourstop;?>);
                        ratearray.push(<?php echo $val->rate;?>);
                         percentagearray.push(<?php echo $val->percentage;?>);

                   <?php } ?>
                   var j=0;
                   var cal = 0;
                   var diff=0;
                   var h=0;
                   for (var  i = 0; i < hourstartarray.length; i++) { 

                      if(hourstartarray[i] < hourscheck){
                         
                         if(j==0){

                          if(hourstoparray[i] < hourscheck){

                              diff = hourscheck - hourstoparray[i];
                              temp = hourstoparray[i] 
                               
                                if(percentagearray[i]==0){
                                     cal = cal+temp*ratearray[i];
                                }
                                if(percentagearray[i]>0){
                                     cal = cal+temp*ratearray[i]*(percentagearray[i]/100);
                                }

                              j++;
                             }

                             else{


                             if(percentagearray[i]==0){
                                     cal = cal+hourscheck*ratearray[i];
                                }
                                if(percentagearray[i]>0){
                                     cal = cal+hourscheck*ratearray[i]*(percentagearray[i]/100);
                                }

                             } 

                            }

                          else{

                            h=i-1;

                            if(hourstoparray[i] < hourscheck && hourstoparray[i]!=0 ){

                              diff = hourscheck - hourstoparray[i];
                              temp = hourstoparray[i] - hourstoparray[h];
                             if(percentagearray[i]==0){
                                     cal = cal+temp*ratearray[i];
                                }
                                if(percentagearray[i]>0){
                                     cal = cal+temp*ratearray[i]*(percentagearray[i]/100);
                                }
                             } 


                             else{

                                if(percentagearray[i]==0){
                                     temp = hourscheck - hourstoparray[h];
                                     cal = cal+temp*ratearray[i];
                                }
                                if(percentagearray[i]>0){
                                  temp = hourscheck - hourstoparray[h];
                                     cal = cal+temp*ratearray[i]*(percentagearray[i]/100);
                                }
                             } 



                          }  
                     }
                         

                  }
              if (!isNaN(cal)) {

                  $(this).parent('td').parent('tr').find('#totalamount1').val(cal);
            }
       });
  });








    //this calculates values automatically 
  /*
    $("input.miles").on("change ", function() {
        
           
            var hourscheck=$(this).parent('td').parent('tr').find('#billedhours').val();
               hourscheck = parseInt(hourscheck);
             var hourstartarray=[];
             var hourstoparray=[];
             var ratearray=[];
             var percentagearray=[];
        
                   <?php foreach ($sresult1 as $key => $val) { ?>
       
                      var h1 = <?php echo $val->hourstart;?>;
                      var percent =  <?php echo $val->rate; ?>;
                   
                      if(h1<hourscheck || h1==hourscheck) {

                         var tee=1;
                         var h2 = <?php echo $val->hourstop; ?>;
                         if(h2>hourscheck || h2==hourscheck) {

                              $(this).parent('td').parent('tr').find('#pct').val(percent);
                            }   
                        }

                       
                        
                        hourstartarray.push(<?php echo $val->hourstart;?>);
                        hourstoparray.push(<?php echo $val->hourstop;?>);
                        ratearray.push(<?php echo $val->rate;?>);
                         percentagearray.push(<?php echo $val->percentage;?>);

                   <?php } ?>
                   var j=0;
                   var cal = 0;
                   var diff=0;
                   var h=0;
                   for (var  i = 0; i < hourstartarray.length; i++) { 

                      if(hourstartarray[i] < hourscheck){
                         
                         if(j==0){

                          if(hourstoparray[i] < hourscheck){

                              diff = hourscheck - hourstoparray[i];
                              temp = hourstoparray[i] 
                               
                                if(percentagearray[i]==0){
                                     cal = cal+temp*ratearray[i];
                                }
                                if(percentagearray[i]>0){
                                     cal = cal+temp*ratearray[i]*(percentagearray[i]/100);
                                }

                              j++;
                             }

                             else{


                             if(percentagearray[i]==0){
                                     cal = cal+hourscheck*ratearray[i];
                                }
                                if(percentagearray[i]>0){
                                     cal = cal+hourscheck*ratearray[i]*(percentagearray[i]/100);
                                }

                             } 

                            }

                          else{

                            h=i-1;

                            if(hourstoparray[i] < hourscheck && hourstoparray[i]!=0 ){

                              diff = hourscheck - hourstoparray[i];
                              temp = hourstoparray[i] - hourstoparray[h];
                             if(percentagearray[i]==0){
                                     cal = cal+temp*ratearray[i];
                                }
                                if(percentagearray[i]>0){
                                     cal = cal+temp*ratearray[i]*(percentagearray[i]/100);
                                }
                             } 


                             else{

                                if(percentagearray[i]==0){
                                     temp = hourscheck - hourstoparray[h];
                                     cal = cal+temp*ratearray[i];
                                }
                                if(percentagearray[i]>0){
                                  temp = hourscheck - hourstoparray[h];
                                     cal = cal+temp*ratearray[i]*(percentagearray[i]/100);
                                }
                             } 



                           }  

                        }
                   }

              if (!isNaN(cal)) {
                 $(this).parent('td').parent('tr').find('#totalamount').val(cal);
                }
  
     }); */



           $(document).ready(function(){


              $("input.miles").on("change ", function() {

             var hourscheck=$(this).parent('td').parent('tr').find('#billedhours').val();
               hourscheck = parseInt(hourscheck);

            <?php foreach ($sresult1 as $key => $val) { ?>
                   var hhh = <?php echo $val->hourstop; ?>; 

                           if(hhh<hourscheck){

                         $(this).parent('td').parent('tr').find('#alert').show();

                           }
                           

                     <?php break;} ?>


                 });

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
          // var expenses = $(this).parent('td').parent('tr').find('#expenses').val();
           //var balance= $(this).parent('td').parent('tr').find('#balance').val();
        

          
          $.ajax({
           type: "post",
           url: "<?= base_url();?>updateemployee",
           cache: false,    
           data: {id:id, pct:pct, billedhours:billedhours, totalamount:totalamount, month:month, year:year},
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
           data: {id:id, pct:pct, billedhours:billedhours, totalamount:totalamount,mo:mo},
           success: function(json){      
            alert(json);
            location.reload();
          } 
          });
         });      




  $(document).on("click", "#delete", function(){

     var id = $(this).parent('td').parent('tr').find('#idd').val();
     var month=$(this).parent('td').parent('tr').find('#mon').val();
     var year=$(this).parent('td').parent('tr').find('#yea').val();
   

     $.ajax({
    type:'POST',
    url:"<?= base_url();?>deleteemployee",
    data:{month:month, year:year,id:id },
    success: function(json){
          alert('Payroll Deleted');
           location.reload();
       }

       });
      });




</script>




</body>
</html>