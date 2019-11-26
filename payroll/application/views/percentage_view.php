<?php if($this->session->userdata('role') == 'admin') { ?> 
<!DOCTYPE>
<html>
<head>
<script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">  </script> 
<title></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<style type="text/css">
  .buttonsave{
    height: 28px;
    padding:0px 10px;
  }
  .buttonback{
    height: 28px;
    padding:0px 10px;
  }
  .buttondelete{
    height: 28px;
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
        <th> Tiz Share</th>
       
      </tr>

      </thead>
       <tbody>
       <?php $id=$_GET['var1']; ?>  
       <?php if (!empty($rate)){ ?>
       <?php $i=0; foreach($rate as $key=>$val){ $i++;?>

        <?php $id= $val->id1; ?>
         <?php $a= $val->percentage; ?>
         <?php $max= $val->hourstop; ?>
      <tr >
        <input type="hidden" id="sno" name="sno" value="<?php echo $i;?>"> 
        <td> <input type="text" id="firsthour<?php echo $i;?>" name= "firsthour" value="<?php echo $val->hourstart; ?>" disabled>  </td>
        
        <?php if($max != 0){ ?> 
        <td> <input type="text" id="secondhour<?php echo $i;?>" class="lasthour" name="hour2" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php echo $val->hourstop; ?>" disabled></td>
        <?php } ?>

        <?php if($max == 0){ ?> 
        <td> <input type="text" id="secondhour<?php echo $i;?>" class="lasthour" name="hour2" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="max" disabled>
        </td>
        <?php } ?>

        <td> <input type="text"  id="rate<?php echo $i; ?>" name="rate" class="ratee" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php echo $val->rate; ?>" disabled> </td>
<!-- 
        <td style="display: none"> <input  type="text"  class="percent11"  id="percent<?php echo $i; ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php echo $val->percentage; ?>"> </td> -->
       

        <?php if($a != 0){ ?>  
           <td>
         <input type="text" class="percent11" id="percent<?php echo $i; ?>" value="<?php echo $val->percentage; ?>" disabled>
          </td>  
         <?php } 
          if($a == 0){ ?>  
           <td >
           <input type="text" class="percent11" id="percent<?php echo $i; ?>" value="0" disabled>
          </td>  
         <?php } ?>


         <td>
         <input type="text"  class="tiz" id="tiz<?php echo $i;?>" value="<?php echo $val->tiz_share; ?>" disabled>
          </td>  

             

      </tr>
       <?php } ?>
       <?php } ?>
      
    </tbody>
    </table>

     
     
    </form>
    <input style="display: none" class="btn btn-primary buttonsave"  type="button" name="edit" id="edit" value="Edit"/>
    <input type="button" class="btn btn-primary buttonsave" style="display: none"  name="update" id="update" value="Update" />
    <input type="button" class="btn btn-primary buttonsave" style="display: none"  name="save" id="save" value="save" />
    <button class="btn btn-primary buttonsave add-row" id="addcondition" style="display: none" >  Add condition </button>
     <input type="button" class="btn btn-primary buttondelete" style="display: none"  name="delete" id="delete" value="Delete"/>
     <a type="button" class="btn btn-primary buttondelete" href="javascript:window.history.go(-1);">Back</a>




</div>
</div>
</div>
</div>

<script type="text/javascript">



$("input.percent11").on("keyup", function(){ 

     var sno =$(this).parent('td').parent('tr').find('#sno').val();
     var rate1 =$(this).parent('td').parent('tr').find('#rate'+sno).val();
     var percent1 =$(this).parent('td').parent('tr').find('#percent'+sno).val();
     var temp5 = rate1 * (percent1/100);
     
     var temp15 = rate1 - temp5;
       //console.log(temp15);

      
      if(temp5 > 0)
         $('#tiz'+(sno)).val(temp15);
      /*if(temp5==0) {
        $('#tiz'+(sno)).prop('disabled', false);
        $('#percent'+(sno)).prop('disabled', true);

       }*/
         
     


});




  $(document).ready(function () {

    <?php if (empty($rate)){ ?>

               $('#addcondition').show(); 
               $('#edit').hide();
               $('#update').hide();
               $('#save').hide(); 

    <?php } ?>  

    <?php if (!empty($rate)){ ?>

               $('#addcondition').hide(); 
               $('#edit').show();
               $('#update').hide();
               $('#save').hide(); 

    <?php } ?>  


       $(".add-row").click(function () { 


               $('#save').show(); 
               $('#addcondition').hide(); 
               var tr = $('#percentage tr:last');
               var nexthour = tr.find('input[name="hour2"]').val();

               var sno = tr.find('input[name="sno"]').val();

                if(nexthour == undefined || sno== undefined || nexthour == 'max'){ 
                  nexthour = 0;
                  sno=1;
                  }
                else{
                nexthour = parseInt(nexthour)+1;
                sno=parseInt(sno)+1;
                  }

               
                markup = "<tr> <input type='hidden' id='sno' name='sno' value="+sno+">  <td> <input type='text' id='firsthour"+sno+"' name='firsthour"+sno+"' value="+nexthour+" disabled> </td> <td> <input type='text' id='secondhour"+sno+"' onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='lasthour' name='hour2'>   </td> <td> <input type='text' id='rate"+sno+"' onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='rate11' name='rate'> </td>    <td> <input type='text'  id='percent"+sno+"' onkeypress='return event.charCode >= 48 && event.charCode <= 57' name='percent' class='percent'> </td>  <td> <input type='text'  id='tiz"+sno+"' onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='tiz' name='tiz'> </td> </tr>";
                tableBody = $("table tbody"); 
                tableBody.append(markup); 



          $("input.lasthour").on("change", function(){ 
   
                       var num = parseInt($(this).parent('td').parent('tr').find('#sno').val());
                       var num1 =$(this).parent('td').parent('tr').find('#firsthour'+num).val();
                       var num2= $(this).parent('td').parent('tr').find('#secondhour'+num).val();

                       if(num2=='max'){

                        num2=0;
                       }

                       var hou1=parseInt(num1);
                       var hou2=parseInt(num2);

                    if ((hou2) < (hou1)){
                      
                      alert('Ending hour must be greater than Starting hour');
                      location.reload(true);
                     }       
                     
                });


    $("input.tiz").on("keyup", function(){ 
   
                       var num = parseInt($(this).parent('td').parent('tr').find('#sno').val());
                       var temp =$(this).parent('td').parent('tr').find('#tiz'+num).val();
                       //console.log(temp);
                       //var num2= $(this).parent('td').parent('tr').find('#secondhour'+num).val();

                       if(temp != ''){

                       $('#percent'+num).hide(); 
                       }
                       if(temp == ''){

                       $('#percent'+num).show(); 
                       }        
                });

    $("input.percent").on("keyup", function(){ 
   
                       var num = parseInt($(this).parent('td').parent('tr').find('#sno').val());
                       var temp =$(this).parent('td').parent('tr').find('#percent'+num).val();
                       //console.log(temp);
                       //var num2= $(this).parent('td').parent('tr').find('#secondhour'+num).val();

                       if(temp != ''){

                       $('#tiz'+num).hide(); 
                       }
                       if(temp == ''){

                       $('#tiz'+num).show(); 
                       }        
                });

$("input.percent").on("keyup", function(){ 
          
     var num = parseInt($(this).parent('td').parent('tr').find('#sno').val());
     var rate1 =$(this).parent('td').parent('tr').find('#rate'+num).val();
     var percent1 =$(this).parent('td').parent('tr').find('#percent'+num).val();
     var temp5 = rate1 * (percent1/100);

    
      var temp15 = rate1 - temp5;
     
      if(temp5 > 0)
         $('#tiz'+(num)).val(temp15);
      /*if(temp5==0) {
        $('#tiz'+(num)).prop('disabled', false);
        $('#percent'+(num)).prop('disabled', true);

       }*/
         
     

});

          


           $("input.lasthour").on("input change keyup keydown", function(){ 

                  var tr1 = $('#percentage tr:last');
                  var nexthour1 = tr1.find('input[name="hour2"]').val();
                  if(nexthour1 == "" || nexthour1 == "max"){ 
                  
                  $('#addcondition').show();
                  $('#save').hide();  

                  }
                });
       

             });

});

$(document).on("click","#save", function(){


              var temp=0;
                $("table tbody tr").each(function () {
          
                var rate = $(this).find("td").eq(2).find(":text").val();
                if(rate==''){

                  temp=1; 
                 // console.log(window.amp);
                  alert('Please enter the rate');
                  return false;
                }

                  });

                

            if(temp==0) {


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

                if(hour2=='max'){

                  hour2='';
                }
                var rate = $(this).find("td").eq(2).find(":text").val();
                var percentage = $(this).find("td").eq(3).find(":text").val();
                var tiz = $(this).find("td").eq(4).find(":text").val();
                $.ajax({
                      type: "post",
                      url: "<?= base_url();?>percentageupdate",
                      cache: false,    
                      data: {id:id, hour1:hour1, hour2:hour2, percentage:percentage, rate:rate,tiz:tiz},
                   });
                
                })
                alert('Rate saved');
                location.reload();
              } 

          });
              
        }
  });

    $(document).on("click","#edit", function(){

                $('#percentage').find('input[type="text"]').prop('disabled', false);
                $("#percentage").css("border", "0");
                
                /*$('td:nth-child(5)').show();
                $('td:nth-child(6)').hide();*/
                $('#addcondition').show();
                $('#edit').hide();
                $('#save').hide();
                $('#addcondition').hide();
                $('#update').show();
                $('#delete').show();

            });



  $("input.lasthour").on("keydown", function(){ 

                        $('#save').hide(); 
                        $('#addcondition').show(); 

                   var tr12 = $('#percentage tr:last');
                   var nexthour12 = tr12.find('input[name="hour2"]').val();
                   
                   if(nexthour12 == ""||nexthour12 == "max"){ 
                  
                   $('#addcondition').hide();
                   $('#update').show();
                   $('#save').hide();  

                    }
                  else{

                    $('#update').hide();
                     $('#addcondition').show();
                      $('#save').hide(); 

                  }

                      
                       var num = parseInt($(this).parent('td').parent('tr').find('#sno').val());
                       var num1 =$(this).parent('td').parent('tr').find('#firsthour'+num).val();
                       var num2= $(this).parent('td').parent('tr').find('#secondhour'+num).val();

                        if(num2=='max'){

                        num2=0;
                       }

                       var num=parseInt(num);
                       var hou1=parseInt(num1);
                       var hou2=parseInt(num2);

                    if ((hou2) < (hou1)){
                      
                      alert('Ending hour must be greater than Starting hour');
                      location.reload(true);
                     }


              hou2++;
              var temphour=hou2;
              num++;
              
              $('#firsthour'+num).val(temphour);

   });
            
     $(document).on("click","#update", function(){



       var temp1=0;
                $("table tbody tr").each(function () {
          
                var rate = $(this).find("td").eq(2).find(":text").val();
                if(rate==''){

                  temp1=1; 
                 // console.log(window.amp);
                  alert('Please enter the rate');
                  return false;
                }

                  });

                if(temp1==0) {

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
                if(hour2=='max'){

                  hour2='';
                }
                var rate = $(this).find("td").eq(2).find(":text").val();
                var percentage = $(this).find("td").eq(3).find(":text").val();
                var tiz = $(this).find("td").eq(4).find(":text").val();
                
                    $.ajax({
                      type: "post",
                     url: "<?= base_url();?>percentageupdate",
                      cache: false,    
                      data: {id:id, hour1:hour1, hour2:hour2, percentage:percentage, rate:rate,tiz:tiz},
                      
                   });
                
                 })
             alert('Rate Updated');
            location.reload();
                      } 
                      
                   });     
                 }          
            });


 $("input.tiz").on("change", function(){ 
   
                       var num = parseInt($(this).parent('td').parent('tr').find('#sno').val());
                       var temp =$(this).parent('td').parent('tr').find('#tiz'+num).val();
                       //console.log(temp);
                       //var num2= $(this).parent('td').parent('tr').find('#secondhour'+num).val();

                       if(temp != ''){

                       $('#percent'+num).hide(); 
                       }
                       if(temp == ''){

                       $('#percent'+num).show(); 
                       }

                       
                     
                });

     $("input.percent11").on("keyup", function(){ 
   
                       var num = parseInt($(this).parent('td').parent('tr').find('#sno').val());
                       var temp =$(this).parent('td').parent('tr').find('#percent'+num).val();
                       //console.log(temp);
                       //var num2= $(this).parent('td').parent('tr').find('#secondhour'+num).val();

                       if(temp != ''){

                       $('#tiz'+num).hide(); 
                       }
                       if(temp == ''){

                       $('#tiz'+num).show(); 
                       }        
                });


     $(document).on("click","#delete",function(){

       var id= <?php echo $id; ?>;
                  $.ajax({
                      type: "post",
                      url: "<?= base_url();?>completepercentagedelete",
                      cache: false,    
                      data: {id:id},
                      success: function(json){  
                      alert('Percentage Deleted successfully');
                      location.reload();
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

