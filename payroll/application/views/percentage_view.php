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
        <td> <input type="text" id="secondhour<?php echo $i;?>" class="lasthour" name="hour2" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="" disabled></td>
        <?php } ?>

        <td> <input type="text"  id="rate<?php echo $i; ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php echo $val->rate; ?>" disabled> </td>

        <td style="display: none"> <input  type="text"  id="percent<?php echo $i; ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php echo $val->percentage; ?>"> </td>
       

        <?php if($a != 0){ ?>  
           <td>
         <input type="text"  id="percent<?php echo $i; ?>" value="<?php echo $val->percentage; ?>" disabled>
          </td>  
         <?php } ?>

             

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
    <input type="button" class="btn btn-primary buttonback" value="Back" onclick="history.back()">
   



</div>
</div>
</div>
</div>

<script type="text/javascript">
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

                if(nexthour == undefined || sno== undefined){ 
                  nexthour = 0;
                  sno=1;
                  }
                else{
                nexthour = parseInt(nexthour)+1;
                sno=parseInt(sno)+1;
                  }

               
                markup = "<tr> <input type='hidden' id='sno' name='sno' value="+sno+">  <td> <input type='text' id='firsthour"+sno+"' name='firsthour"+sno+"' value="+nexthour+" disabled> </td> <td> <input type='text' id='secondhour"+sno+"' onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='lasthour' name='hour2'>   </td> <td> <input type='text' id='rate"+sno+"' onkeypress='return event.charCode >= 48 && event.charCode <= 57' name='rate'> </td>    <td> <input type='text'  id='percent"+sno+"' onkeypress='return event.charCode >= 48 && event.charCode <= 57' name='percent'> </td>  <td> </tr>";
                tableBody = $("table tbody"); 
                tableBody.append(markup); 




          $("input.lasthour").on("change", function(){ 

                      $('#addcondition').show();
                      $('#save').hide();    
                       var num = parseInt($(this).parent('td').parent('tr').find('#sno').val());
                       var num1 =$(this).parent('td').parent('tr').find('#firsthour'+num).val();
                       var num2= $(this).parent('td').parent('tr').find('#secondhour'+num).val();

                       var hou1=parseInt(num1);
                       var hou2=parseInt(num2);

                    if ((hou2) < (hou1)){
                      
                      alert('Ending hour must be greater than Starting hour');
                      location.reload(true);
                     }       
                     
                });


           $("input.lasthour").on("keyup keydown", function(){ 

                  var tr1 = $('#percentage tr:last');
                  var nexthour1 = tr1.find('input[name="hour2"]').val();
                  if(nexthour1 == ""){ 
                  
                  $('#addcondition').show();
                  $('#save').hide();  

                  }
                });
       

             });  

});


$(document).on("click","#save", function(){

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
        
      });

    $(document).on("click","#edit", function(){

                $('#percentage').find('input[type="text"]').prop('disabled', false);
                $('td:nth-child(5)').show();
                $('td:nth-child(6)').hide();
                $('#addcondition').show();
                $('#edit').hide();
                $('#save').hide();
                $('#addcondition').hide();
                $('#update').show();
                $('#delete').show();

            });


  $("input.lasthour").on("change", function(){ 

                        $('#save').hide(); 
                        $('#addcondition').show(); 

                   var tr12 = $('#percentage tr:last');
                   var nexthour12 = tr12.find('input[name="hour2"]').val();
                   
                   if(nexthour12 == ""){ 
                  
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
                
                    $.ajax({
                      type: "post",
                     url: "<?= base_url();?>percentageupdate",
                      cache: false,    
                      data: {id:id, hour1:hour1, hour2:hour2, percentage:percentage, rate:rate},
                      
                   });
                
                 })
             alert('Rate Updated');
            location.reload();
                      } 
                      
                   });             
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
