<?php if($this->session->userdata('role') == 'admin') { ?>  
<html>
<head>
<title>Employe Summary</title>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?=base_url('assests/css/empview.css')?>">


</head>

<body>

    <div class="content"> 
    <div class="row"> 
   
    <div class="col-sm-12">
       <h3>Payroll Sheet of <?php echo $_GET['var2']; echo "  "; echo $_GET['var3']; ?></h3>
      

<?php $abc=array();
      $changevalue1=array();
      $changevalue2=array();
      $changevalue3=array();
      $changevalue4=array();
      $billedhoursarray=array();
      $specialdata_first = array();
      $specialdata_second = array();
      $specialdata_total = array();
      $specialdata_comments = array();
       $specialdata_month = array();
      $specialdata_year = array();

            /*foreach ($sresult as $key => $val) { 
            array_push($changevalue1,"$val->billedhours");
            } 
*/
            foreach ($special as $key => $val) { 
            array_push($specialdata_first,"$val->first");
            array_push($specialdata_second,"$val->fifteen");
            array_push($specialdata_total,"$val->total");
            array_push($specialdata_comments,"$val->comments");
            array_push($specialdata_month,"$val->month");
            array_push($specialdata_year,"$val->year");
            } 

            foreach ($sresult1 as $key => $val) { 
            array_push($changevalue1,"$val->hourstart");
            } 

            foreach ($sresult1 as $key => $val) { 

              if($val->hourstop==0){
                array_push($changevalue2,100000);
              }
              else{
               array_push($changevalue2,"$val->hourstop");
             }

            
            }

            foreach ($sresult1 as $key => $val) { 
            array_push($changevalue3,"$val->rate");
            }

            foreach ($sresult1 as $key => $val) { 
              if($val->percentage==0){
                array_push($changevalue4,100);
              }
              else{
               array_push($changevalue4,"$val->percentage");
             }

            }

            foreach($billedhou as $key=>$val){
              array_push($billedhoursarray,"$val->billedhours");
            }
            if(!$_GET['per_page']){
              $billsum=0;
            }

            else{
              $billsum=$_GET['per_page'];
            }
              $hourssum=0;
            for($i=0; $i<$billsum;$i++){

              $hourssum = $hourssum + $billedhoursarray[$i];
            }

            // total month pay logic array
            $monthtotalpay=array();
            foreach ($monthpay as $key => $val) { 
            array_push($monthtotalpay,"$val->total");
            } 


            ?>

<table class="table text-center" align="center" id="customers">
  <thead style="background-color: gainsboro;">
<tr>
      <?php $id=0; ?>
      <th></th>
      <th>Sno</th> 
      <th></th> 
      <th>Billed Month</th>
      <th></th>
      <th>Billed Hours</th>

      <th>

        <?php if (!empty($sresult1)){ ?>
              <a href="<?=base_url()?>percentage/?var1=<?php echo$_GET['var1']; ?>&var2=<?php echo$_GET['var2']; ?>&var3=<?php echo$_GET['var3']; ?>"> RATE</a>
        <?php } ?>

        <?php if (empty($sresult1)){ ?>
               <a href="<?=base_url()?>percentage/?var1=<?php echo$_GET['var1']; ?>&var2=<?php echo$_GET['var2']; ?>&var3=<?php echo$_GET['var3']; ?>"> SET RATE-PERCENTAGE</a>
        <?php } ?>

       </th>
      <th><?php if (!empty($sresult1)){ ?>
              Percentage
        <?php } ?>
      </th>
      <th>Total Amount</th>
        <th>1st Pay</th>
        <th>15th Pay</th>
       <th>Amount Paid to individual</th>
      <th>Comments</th>
      <th></th>
      <th></th>
       
     <!--  <th>Expenses</th> -->
     <!--  <th >Balance</th> -->
     </thead>
</tr>
     
  <tbody>
   <?php $snonum=$billsum; $i=0; 
    if(!$_GET['per_page']){
        $mp=0;
      }

      else{
        $mp=$_GET['per_page'];
      }

        $mp=0;   $abcd=0; $ttee=$hourssum; foreach($sresult as $key=>$val){ $snonum++; $i++; ?>

    <tr>
     <td><input type="checkbox" class= "chkBox" id="checkboxid" value="<?php echo $snonum; ?>" ></td> 
     <td><?php echo $snonum; ?></td>
      <input type="hidden" id="sno" value="<?php echo $snonum; ?>">
      <input type="hidden" id="idd" value="<?=$val->id?>">
      <input type="hidden" id="mon<?php echo $i;?>" value="<?=$val->month?>">
      <input type="hidden" id="yea<?php echo $i;?>" value="<?=$val->year?>">
      <td style="display:none"><input type="text" id="tiz11<?php echo $i;?>" /></td>
    <td><input type="text" style="border: 0" size= "13" id="billedmonth<?php echo $i;?>" name="month" value="<?php echo $val->month; echo "-"; echo $val->year; ?>"  readonly/> </td> 

    <td> <?php if($specialdata_total[$mp]==0) { ?> <input type="button"  class="addRow" id="addrow" value="Add special" /> <?php } ?></td>

    <td><input type="text" size= "8" id="billedhours<?php echo $i;?>"  name="hours" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="miles" value="<?php echo $val->billedhours;?>"/></td>

    <td><input type="text" style="border: 0" size= "8" id="rate<?php echo $i;?>" class="rate" name="rate"  value="" readonly> </td>

    <td><input type="text" style="border: 0" size= "8" id="percent<?php echo $i;?>" class="percent" name="percent"  value="" readonly> </td>

    <td> <?php echo"$"; ?><input type="text"style="border: 0" size= "8" id="totalamount<?php echo $i;?>" name="total" value="<?php echo $val->mounthtotal; ?>" readonly/></td>

    <td> <?php echo"$"; ?> <input type="text"style="border: 0" size= "8" id="onestpay<?php echo $i;?>" name="total" value="<?php echo $val->onestpay; ?>" readonly/></td>

    <td> <?php echo"$"; ?> <input type="text"style="border: 0" size= "8" id="onefivethpay<?php echo $i;?>" name="total" value="<?php echo $val->onefivethpay; ?>" readonly/></td>

    <td> <?php echo"$"; ?> <input type="text"style="border: 0"  size= "8" id="monthtotalpay<?php echo $i;?>" name="total" value="<?php echo $monthtotalpay[$mp]; ?>" readonly/></td>

    <!-- change rate alert display start -->

 

  <?php for($p=$abcd; $p<count($changevalue1); $p++){ if($changevalue1[$abcd]<=$ttee){


          if($changevalue2[$abcd]>=$ttee){

            $test = $abcd+1;
            $ttee=$ttee+$val->billedhours;

            if($changevalue1[$test] <= $ttee){

              if($changevalue2[$test]>=$ttee){  

                  if($changevalue4[$test]==$changevalue4[$abcd]) {?>

                      <td><a href="#" class="hasTooltip">Calculation Change Here 
                    <span>Rate was changed from <?php echo $changevalue3[($abcd)] ?> to <?php echo $changevalue3[$test]; ?>  </span>
                </a> </td>

               <?php   } 

              if($changevalue3[$test]==$changevalue3[$abcd] ) {  ?>

                <td><a href="#" class="hasTooltip">Calculation Change Here 
                    <span>Percentage was changed from <?php echo $changevalue4[($abcd)]; ?> to <?php echo $changevalue4[$test];?> </span>
                </a> </td> 

              <?php  } 


              if($changevalue3[($abcd)]!=$changevalue3[$test] && $changevalue4[($abcd)]!=$changevalue4[$test] ) { ?>

                <td><a href="#" class="hasTooltip">Calculation Change Here 
                    <span>Rate and Percentage are changed from <?php echo $changevalue3[($abcd)] ?> to <?php echo $changevalue3[$test]; ?> and <?php echo $changevalue4[($abcd)]; ?> to <?php echo $changevalue4[$test];?> </span>
                </a> </td> 

             <?php } $abcd++; $p=count($changevalue1);}


            }

            else{ ?>

              <td> </td>
          <?php  $p=count($changevalue1);}
          }

          else{

            $abcd++;
            
          }
  } }
      ?>

     
    <!-- change rate alert display end  --> 



     <!-- <td><button class="btn btn-primary buttonsave" id="save"><i class="fa fa-save"></i>Save</button></td> -->
    <!-- <td><button class="btn btn-primary buttonsave"id="delete" ><i class="fa fa-trash-o"></i> Delete</button></td> -->
   
   <!--  <td> <button class="btn btn-primary buttonsave" id="delete" >Delete</button></td> -->
  </tr>

<?php $test = $i-1; if(!empty($specialdata_total[$test])) { ?>
  <tr >
    <td style="border: none"></td>
     <td style="border: none"></td>
      <td style="border: none"> <h5> <?php echo $specialdata_year[$test]; echo " "; echo $specialdata_month[$test]; echo " ";echo "special"; ?> </h5></td>
       <td style="border: none"> </td>
        <td style="border: none"></td>

    <td style="border: none"><input type="hidden" id="num" value="<?php echo $i;?>"></td>
    <td style="border: none"><input type="hidden" id="specialdata_month<?php echo $i;?>" value="<?php echo $specialdata_month[$test]; ?>"></td>
    <td style="border: none"><input type="hidden" id="specialdata_year<?php echo $i;?>" value="<?php echo $specialdata_year[$test]; ?>"></td>
    <td style="border: none"> <?php echo"$"; ?> <input type="text"style="border: 0"  size= "8" id="specialdata_first<?php echo $i;?>" class="special" value="<?php echo $specialdata_first[$test]; ?>" /></td>
    <td style="border: none"> <?php echo"$"; ?> <input type="text"style="border: 0"  size= "8" id="specialdata_second<?php echo $i;?>"  class="special" value="<?php echo $specialdata_second[$test]; ?>" /></td>
    <td style="border: none">  <?php echo"$"; ?> <input type="text"style="border: 0"  size= "8" id="specialdata_total<?php echo $i;?>" value="<?php echo $specialdata_total[$test]; ?>" readonly/></td>
    

 <!--    <td style="border: none"> <input type="text"style="border: 0"  size= "8" id="specialdata_comments<?php echo $i;?>"  value="<?php echo $specialdata_comments[$test]; ?>" /></td> -->


    <td style="border: none"> <textarea style="border: 0" id="specialdata_comments<?php echo $i;?>" > <?php echo $specialdata_comments[$test]; ?> </textarea></td>



    <td style="border: none"> <button class="btn btn-primary buttonsave" id="updatespecial"><i class="fa fa-save"></i>Update</button></td>
  </tr>
<?php } ?>

 <?php $mp= $mp +1 ;} ?>
 </tbody>

    

</table>

<!-- <div align="right"> <td colspan="6"><span class="pagination"><?=$links?></span></td> </div> -->

 
<button class="btn btn-primary buttonsave" id="Link">Total</button>

  <div class="counts" style="display: none">
    <br>

      <td style="font-size:14; display: none;">  &emsp;Total Hours : <input id= "th" type="text" size="6" style="border: none;" value="" readonly/>  </td>
      <td style="font-size:14;">&emsp;&nbsp;Total Amount : <input type="text" id="ta" size="6" style="border: none;" value="" readonly /></td>
       <td style="font-size:14;">Total Pay : <input type="text"  id="tp" style="border: none;" size="6" value="" readonly/></td>

       <td style="font-size:14;"> &emsp; Total special pay : <input type="text"  id="tsp" size="6" style="border: none;" value="" readonly /></td>
      
        <td style="font-size:14;"> &emsp; Total Expenses: <input type="text" id="te" size="6" style="border: none;" value="" readonly/></td>
        <td style="font-size:14;"> &emsp; Balance : <input type="text"  id="b" size="6" style="border: none;" value="" readonly /></td> 

    </div>





 
   
   <br>  <br>
   
  <button  class="btn btn-primary buttonsave" id="adddata"><span class="glyphicon glyphicon-plus"></span>Add Data</button> 
  
 <!-- <a type="button" class="btn btn-primary buttondelete" href="javascript:window.history.go(-1);" style="padding: 1px 12px;">Back</a>
 <input type="button" class="btn btn-primary buttondelete" style="display: none"  name="delete" id="delete" value="Delete"/> -->

  <a type="button" class="btn btn-primary buttonsave" id="addexp" href="<?= base_url();?>expense/?val1=<?php echo $_GET['var1'];?>&val2=<?php echo $_GET['var2'];?>&val3=<?php echo $_GET['var3'];?>"><span class="glyphicon glyphicon-plus"></span>Add Expense</a>

  <button class="btn btn-primary buttonsave" id="save"><i class="fa fa-save"></i>Save</button>
 <button class="btn btn-primary buttonsave"id="delete" ><i class="fa fa-trash-o"></i> Delete</button>
 <button type="button" id="back" class="btn btn-primary buttonsave" onclick="history.back()"> <span class="glyphicon glyphicon-arrow-left"></span> Back </button>



   

  
 </div> 

</div>
</div> </div>



<script type="text/javascript">

//tooltip

/*$(document).on("click", "#adddata", function() { 



});
*/

 $("#Link").click(function(){
   
    var id = <?php echo $_GET['var1']; ?>;
    console.log(id);
      $.ajax({
           type: "post",
           url: "<?= base_url();?>test",
           cache: false,
           data: {id:id},
           dataType: "json",   
           success: function(json){ 
            //alert(json[0].balance);
              $('#b').val('$'+json[0].balance);
              $('#ta').val('$'+json[0].totalamount);
              $('#te').val('$'+json[0].exp);
              $('#tp').val('$'+json[0].totalmonthpay);
              $('#th').val(json[0].billedhours);
              $('#tsp').val(json[0].special_amount);

             } 
        });

       $(".counts").toggle();
  });
                                

$(document).ready(function(){

     $('.counts').hide();
             var hourstartarray=[];
             var hourstoparray=[];
             var ratearray=[];
             var percentagearray=[];
             var hours = [];
              var tizzing = [];

             

      <?php foreach ($billedhou as $key => $val) { ?>
           hours.push(<?php echo $val->billedhours; ?>);
      <?php } ?>


     <?php foreach ($sresult1 as $key => $val) { ?>

          hourstartarray.push(<?php echo $val->hourstart;?>);
          if(<?php echo $val->hourstop;?> == 0){
             hourstoparray.push(10000000);
            }
           else{
              hourstoparray.push(<?php echo $val->hourstop;?>);
            } 
                       // hourstoparray.push(<?php echo $val->hourstop;?>);
            ratearray.push(<?php echo $val->rate;?>);
            percentagearray.push(<?php echo $val->percentage;?>);
            tizzing.push(<?php echo $val->tiz_share;?>);

     <?php } ?>
     var storeid = 1;
     var temp = 0;
     var temp1 = <?php echo $hourssum; ?>;
     var variable= <?php echo $billsum; ?>;
     var abc=0;

     for(var i = 0, m=variable ; m <hours.length;i++ , m++ ){
      var cal=0;
      var temp3=0;
      var temp6=0;
      var temp7=0;
      var temp5=0;

       temp = hours[m];
       temp1 = temp1 + hours[m];

       for(var j = 0; j<hourstartarray.length;j++){

          if(abc == 0 && m==0){

              if(temp >= hourstartarray[j] ){

                if(temp <= hourstoparray[j]){


                  if(i != 0 && i!=m ){

                    temp3 = temp - hourstoparray[j-1];
                    if(percentagearray[j]==0){

                      cal = cal + temp3 * ratearray[j];

                    }  
                    if(percentagearray[j]>0){

                      cal = cal + temp3 * ratearray[j]*(percentagearray[j]/100);
                      
                    }
                   

                    for(var k= j-1,p=j-2; k>=0 ; k--){

                      if( k == 0){

                        temp3 = hourstoparray[0]- hourstartarray[0];

                        if(percentagearray[0]==0){
                        cal = cal + temp3 * ratearray[0];
                          }

                        if(percentagearray[0]>0){
                        cal = cal + temp3 * ratearray[0]*(percentagearray[0]/100);
                          }
                      }

                      if(p>=0){

                        temp3 = hourstoparray[k]- hourstoparray[p];

                        if(percentagearray[k]==0){
                        cal = cal + temp3 * ratearray[k];
                         } 

                         if(percentagearray[k]>0){
                        cal = cal + temp3 * ratearray[k]*(percentagearray[k]/100);
                         } 

                      }


                    }


                  }

                  else{

                    if(percentagearray[i]==0){
                      cal = cal + temp *ratearray[i];
                    }
                    if(percentagearray[i]>0){
                      cal = cal + temp *ratearray[i]*(percentagearray[i]/100);
                    }

                  }

                }

abc++;
              }

          

          }

         else{

           if(temp1 >= hourstartarray[j]){

            if(temp1 <= hourstoparray[j]){


              if(j==0){

                if(percentagearray[j]==0){
                      cal = cal + temp *ratearray[j];
                    }
                    if(percentagearray[j]>0){
                      cal = cal + temp *ratearray[j]*(percentagearray[j]/100);
                    }

              }

             else{ 

             temp5 = temp1 - hourstoparray[j-1];
            
             temp6 = temp - temp5; 
             if(temp6<=0){
                 if(percentagearray[j]==0){
                 cal = cal + temp * ratearray[j];
                }
                if(percentagearray[j]>0){
                 cal = cal + temp * ratearray[j]*(percentagearray[j]/100);
                }
             }
             if(temp6>0){ 

              if(percentagearray[j]==0){
                 cal = cal + temp5 * ratearray[j];
                }
                if(percentagearray[j]>0){
                 cal = cal + temp5 * ratearray[j]*(percentagearray[j]/100);
                }

             for(var k=j-1, p=j-2; k>=0; k--, p--){
              
               if(p<0){
                p=0;
               }
              temp7 = hourstoparray[k] - hourstoparray[p];

              if(temp7 >= temp6 && temp6!=0){


                if(percentagearray[k]==0){
                 cal = cal+ temp6 * ratearray[k];
                 temp6 = 0;
                }

                if(percentagearray[k]>0){
                 cal = cal+ temp6 * ratearray[k]*(percentagearray[k]/100);
                 temp6 = 0;
                }

              }

              if(temp7 <= temp6){


                 if(percentagearray[k]==0){
                 cal = cal+ temp7 * ratearray[k];
                 temp6 = temp6 - temp7;
                }

                 if(percentagearray[k]>0){
                 cal = cal+ temp7 * ratearray[k]*(percentagearray[k]/100);
                 temp6 = temp6 - temp7;
                }

                
              }
              
              if(temp7==0){


                if(percentagearray[k]==0){
                 cal = cal+ temp6 * ratearray[k];
                 
                }

                 if(percentagearray[k]>0){
                 cal = cal+ temp6 * ratearray[k]*(percentagearray[k]/100);
                
                }

              }



             }
               }

            }

          }

           }



         }

       }
      
      for(var q=0; q<hourstartarray.length;q++){

        if(hourstartarray[q]<temp1 || hourstartarray[q]==temp1){

           if(hourstoparray[q]>temp1 || hourstoparray[q]==temp1){


            $('#rate'+(storeid)).val(ratearray[q]); 
            $('#tiz11'+(storeid)).val(tizzing[q]);

            if(percentagearray[q]>0){
            $('#percent'+(storeid)).val(percentagearray[q]); 
             }

             else{
            $('#percent'+(storeid)).val(100); 
             }
            
        }



      }

    }

    $('#totalamount'+(storeid)).val(cal.toFixed(2));

                var id = <?php echo $_GET['var1'];  ?>;
                //var sno = $('#sno').val();
                var tiz = $('#tiz11'+storeid).val();
                var mon = $('#billedmonth'+storeid).val();
                var billedhours = $('#billedhours'+storeid).val();
                var rate = $('#rate'+storeid).val();
                var percentage1 = $('#percent'+storeid).val();
                var totalamount = $('#totalamount'+storeid).val();

                console.log(tiz);

                  $.ajax({
                    type: "post",
                    url: "<?= base_url();?>updateemployee",
                    cache: false,    
                    data: {id:id, rate:rate, billedhours:billedhours, totalamount:totalamount, mon:mon,percentage1:percentage1,tiz:tiz},
                    success: function(json){  
                      
                   } 
                });

             storeid = storeid +1; 

           }          
});





     


   // adding new data


   $(document).on("click", "#adddata", function() { 
      $('.counts ').hide();
      $('#Link').hide();
      $('#theLink').hide();
      $('#adddata').hide();
      $('#save').hide();
      $('#addexp').hide();
       
        var sno='<?php  $i++; echo $i; ?>';
        <?php  $abc= date("Y"); 
               //$abc=2019;
               $yearArray = range($abc-2,$abc+2);
              
        ?>
       //'.$selected.'
        markup = "<tr> <input type='hidden' id='idd1' value='<?=$val->id?>'> <td></td> <td> " + sno + "</td> <td> <select id='year'  name='year'> <option value=''>Year</option> <?php foreach ($yearArray as $year) {
         $selected = ($year == $abc) ? 'selected' : '';
        echo '<option value='.$year.'>'.$year.'</option>';
        }
    ?></select> <select id='month' name='month' disabled> <option value=''>Month</option> </select> </td> <td></td><td><input type='text' size='8' id='billedhours1'onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='billhours' name='hours'> </td>   <td><input type='text' size='8' id='rate1' name='rate1' disabled> </td>  <td><input type='text'size='8' id='pct1' name='pct1' disabled> </td>  <td><input type='text' size='8' id='totalamount1' name='total' disabled> </td><td><input type='text' size='8' disabled> </td><td><input type='text' size='8' disabled> </td><td><input type='text' size='8' disabled> </td> <td></td><td><button class='btn btn-primary buttonsaveone' id='save1' disabled>Add</button></td> </tr>";
        tableBody = $("table"); 
        tableBody.append(markup);




         $(document).on('input change',"#year,#billedhours1", function () {

          
            if (document.getElementById("billedhours1").value != "" && document.getElementById("month").value != "" && document.getElementById("year").value != "") {
                $(this).parent('td').parent('tr').find('#save1').prop('disabled', false);
            }
            else {
                $(this).parent('td').parent('tr').find('#save1').prop('disabled', true);
            }
             });


         $(document).on('change', "#year", function (){

          var year = $(this).parent('td').parent('tr').find('#year').val();
          var id = <?php echo $_GET['var1']; ?>;
          $(this).parent('td').parent('tr').find('#month').prop('disabled', false);
          /*console.log(year);
          console.log(id);*/
          $('#month').empty();

             $.ajax({
                    type: "post",
                    url: "<?= base_url();?>gettingmonth",
                    cache: false,  
                    dataType: 'JSON',
                    data: {id:id, year:year},
                    success: function(json){  
                      var formoption = ""; 
                       for (i in json) {
                         formoption += "<option value='"+json[i]+"'>"+json[i]+"</option>";
                       }
                       $('#month').append(formoption);
                    }

                });



         });


  });



// save data

$(document).on("click", "#save", function() { 

            var limit = <?php echo $snonum; ?>;
             
             for (var i = 1; i <=limit; i++) {
              
                var id = <?php echo $_GET['var1'];  ?>; 
                var tiz = $('#tiz'+i).val();
                var mon = $('#billedmonth'+i).val();
                var billedhours = $('#billedhours'+i).val();
                var rate = $('#rate'+i).val();
                var percentage1 = $('#percent'+i).val();
                var totalamount = $('#totalamount'+i).val();
                
                    $.ajax({
                    type: "post",
                    url: "<?= base_url();?>updateemployee",
                    cache: false,    
                    data: {id:id, rate:rate, billedhours:billedhours, totalamount:totalamount, mon:mon,percet11:percentage1,tiz:tiz},
                    success: function(json){  
                      
                   } 
                });

             }
               alert("updated succesfully");
               location.reload();         
                    
        });               

               


  $(document).on("click", "#save1", function() { 


           var id = <?php echo$_GET['var1']; ?>;
           var billedhours = $(this).parent('td').parent('tr').find('#billedhours1').val();
           var month = $(this).parent('td').parent('tr').find('#month').val();
           var year = $(this).parent('td').parent('tr').find('#year').val();
           var rate = $(this).parent('td').parent('tr').find('#rate1').val();
           var pct= $(this).parent('td').parent('tr').find('#pct1').val();
           var totalamount= $(this).parent('td').parent('tr').find('#totalamount1').val();
           //var expenses = $(this).parent('td').parent('tr').find('#expenses1').val();
           var balance= $(this).parent('td').parent('tr').find('#balance1').val();

           console.log(month);
           console.log(year);
           console.log(totalamount);

  
          
          $.ajax({
           type: "post",
           url: "<?= base_url();?>addemployeedata",
           cache: false,    
           data: {id:id, rate:rate, billedhours:billedhours, totalamount:totalamount, month:month, year:year, pct:pct },
           success: function(json){    

            alert("Data Saved");
            location.reload();
          } 
          });
          $(this).attr('class','btn btn-primary buttonsaveone');
          $(this).attr('disabled',true);
        
         });      




 



  
  // adding special case

 $(document).ready(function () {
        //var counter = 0;

        $(document).on("click",".addRow", function () {
             /*console.log('clicked');
            var counter = $('#customers tr').length - 2;*/
            //
            $('.addRow').hide();
            var sno = $(this).parent('td').parent('tr').find('#sno').val();
            var month = $(this).parent('td').parent('tr').find('#mon'+sno).val();
            var year = $(this).parent('td').parent('tr').find('#yea'+sno).val();
            var specialmsg = month +' ' +year+' ' + 'Special';
            console.log(specialmsg);
            var newRow = $("<tr>");
            var cols = " <td><input type='hidden' id='month' value="+month+"></td> <td><input type='hidden' id='year' value="+year+"></td> <td><h5>"+specialmsg+"</h5></td> <td></td> <td></td> <td></td> <td></td> <td></td><td><input type='text' size='8' id='first' onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='spe' name='first' value='0'> </td>   <td><input type='text' size='8' id='second' name='second' onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='spe' name='second' value='0'> </td> <td><input type='text' size='8' id='totals'onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='totals' name='totals' readonly> </td> <td><input type='text' size='8' id='comment' class='comment' name='comment'> </td> <td><button class='btn btn-primary buttonsaveone' id='update' >save</button></td>";
           
            newRow.append(cols);
            newRow.insertAfter($(this).parents().closest('tr'));
            //$("table.order-list").append(newRow);
            //counter++;
        


        $("#first,#second").on("keyup", function() {

      
            //var sno = $(this).parent('td').parent('tr').find('#num').val(); 
            var num1 = $(this).parent('td').parent('tr').find('#first').val();
            var num2 = $(this).parent('td').parent('tr').find('#second').val();


            var num1=num1.replace('$','');
            var num2=num2.replace('$','');
            
            var result = parseFloat(num1) + parseFloat(num2);

   /*       console.log(num1);
          console.log(num2);
*/
            if (!isNaN(result)) {

              $('#totals').val(result);
    
            }
        });




   $(document).on("click", "#update", function() { 


           var id = <?php echo$_GET['var1']; ?>;
          // var billedhours = $(this).parent('td').parent('tr').find('#billedhours1').val();
           var month = $(this).parent('td').parent('tr').find('#month').val();
           var year = $(this).parent('td').parent('tr').find('#year').val();
           var first = $(this).parent('td').parent('tr').find('#first').val();
           var second= $(this).parent('td').parent('tr').find('#second').val();
           var totalamount= $(this).parent('td').parent('tr').find('#totals').val();
           //var expenses = $(this).parent('td').parent('tr').find('#expenses1').val();
           var comments= $(this).parent('td').parent('tr').find('#comment').val();            

          $.ajax({
           type: "post",
           url: "<?= base_url();?>special_case",
           cache: false,    
           data: {id:id, first:first, second:second, totalamount:totalamount, month:month, year:year, comments:comments },
           success: function(json){    
            alert(json);
            location.reload();
          } 
          });
         
         });



      });
           
    });


      

    
  


      
$(document).on("click", "#updatespecial", function() { 


           var id = <?php echo$_GET['var1']; ?>;
          // var billedhours = $(this).parent('td').parent('tr').find('#billedhours1').val();
           var num = $(this).parent('td').parent('tr').find('#num').val();
           var month = $(this).parent('td').parent('tr').find('#specialdata_month'+num).val();
           var year = $(this).parent('td').parent('tr').find('#specialdata_year'+num).val();
           var first = $(this).parent('td').parent('tr').find('#specialdata_first'+num).val();
           var second= $(this).parent('td').parent('tr').find('#specialdata_second'+num).val();
           var totalamount= $(this).parent('td').parent('tr').find('#specialdata_total'+num).val();
           var comments= $(this).parent('td').parent('tr').find('#specialdata_comments'+num).val();

          $.ajax({
           type: "post",
           url: "<?= base_url();?>special_case",
           cache: false,    
           data: {id:id, first:first, second:second, totalamount:totalamount, month:month, year:year, comments:comments },
           success: function(json){    
            alert("special data Saved");
            location.reload();
          } 
          });
         
         }); 
  
 
$("input.special").on("keyup", function() {

            var sno = $(this).parent('td').parent('tr').find('#num').val(); 
            var num1 = $(this).parent('td').parent('tr').find('#specialdata_first'+sno).val();
            var num2 = $(this).parent('td').parent('tr').find('#specialdata_second'+sno).val();
     
            var num1=num1.replace('$','');
            var num2=num2.replace('$','');
            
           
            var result = parseFloat(num1) + parseFloat(num2);

        

            if (!isNaN(result)) {

              $(this).parent('td').parent('tr').find('#specialdata_total'+sno).val(result);
    
            }
        });




       


// delete function


$(document).ready(function(){

  $('#delete').click(function(){

    $('#customers input[type=checkbox]').each(function() {
      if (jQuery(this).is(":checked")) {

       var num = $(this).parent('td').parent('tr').find('#checkboxid').val();
       var id = $('#idd').val();
       var month=$('#mon'+num).val(); 
       var year=$('#yea'+num).val();
      if ($('.chkBox:checked').length == 1) {
            $.ajax({
                    type:'POST',
                    url:"<?= base_url();?>deleteemployee",
                    data:{month:month, year:year,id:id },
                    success: function(json){
                     alert('Deleted');
                     location.reload();
                     }

                  });
           }
     if ($('.chkBox:checked').length ==0 || $('.chkBox:checked').length >1) {

           alert('please select only one row to delete');
           return false;

          } 
      }
    });
 
  });
 
});




</script>
</body>
</html>
<?php }  else {

  echo '<script>alert("Please Login");</script>';
             echo '<script>window.open("'.base_url().'","_self");</script>';

 } ?>

