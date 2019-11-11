<html>
<head>
<title>Payroll Summary</title>
<link rel="stylesheet" href="<?=base_url('assests/css/payroll.css')?>">


</head>

<body>
  <div class="container-flud">
    <div class="content"> 
    <div class="row"> 
    <div class="col-sm-12">
      
   <?php if(!empty($sresult)){ ?>

<table class="table text-center" align="center" id="customers">
<tr>
      <th>Sno</th>  
      <th>First Name</th>
      <th>Last Name</th>
      <th>Rate/Percent</th>
      <th>Hours</th>
      <th>1ST Pat</th>
      <th>15TH Pay</th>
      <th>Total</th>
     <!--  <th>Status</th> -->
      
      <th>Balance</th>
      <th>Link</th>
</tr>


   <?php $i=0;foreach($sresult as $key=>$val){ $i++; ?>
  <tr>
    <td><?=$i?></td>
    <input type="hidden" id="sno" value="<?=$i?>">
    <input type="hidden" id="idd" value="<?=$val->id?>">
    <input type="hidden" id="expences" value="<?=$val->expences?>">
    <input type="hidden" id="month" value="<?=$val->month?>">
    <input type="hidden" id="year" value="<?=$val->year?>">
    
    <td><input type="text" id="fname"  value="<?php echo $val->firstname; ?>"  disabled/></td>
    <td><input type="text" id="lname" value="<?php echo $val->lastname; ?>"disabled/></td>
    <td><input type="text" id="rate" value="<?php echo $val->rate_percent; ?>" disabled/></td>
    <td><input type="text" id="hours"  value="<?php echo $val->hours; ?>" disabled/></td>
    <!-- <td><input type="text" id="pct"  value="<?php echo $val->pct; ?>" disabled/></td> -->
    <td><input type="text" id="firsttpay" class="paychange" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php echo $val->onestpay; ?>"/></td>
    <td><input type="text" id="secondpay"  class="paychange" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php echo $val->onefivethpay; ?>"/></td>
    <td><input type="text" id="total" value="<?php echo $val->total; ?>" disabled/></td>
    <!-- <td>
      <select style="width: 90px;"   id="status"  class="form-control dropdownselect">
            <option value="Active" <?php if($val->status == 'Active') { echo 'selected'; } ?>>Active</option>
            <option value="Inactive" <?php if($val->status == 'Inactive') { echo 'selected'; } ?>>Inactive</option>
            <option value="Inhouse" <?php if($val->status == 'Inhouse') { echo 'selected'; } ?>>Inhouse</option>
             <option value="Miscellaneous"<?php if($val->status == 'Miscellaneous') { echo 'selected'; } ?>>Miscellaneous</option>
       </select>
    </td> -->

    
    <td><input type="text" id="balance" name="name" value="<?php echo $val->balance; ?>" disabled/></td>
    <td><a href="<?=base_url()?>list/?var1=<?=$val->id?>&var2=<?=$val->firstname?>&var3=<?=$val->lastname?>">See More</a></td>

      <td >
        
          <button class="btn btn-primary buttonsave" id="save" disabled>Save</button>  
        </td>

  </tr>

    <?php } ?>
</table>
  <?php } ?>
  <input type="button" class="btn btn-primary buttonsave" value="Back" onclick="history.back()">
</div>
</div> </div>
</div>
<style type="text/css">
  .buttonsave{
    height: 23px;
    padding:0px 10px;

  }


</style>

<script type="text/javascript">
  /*$(document).ready(function () {
        $('select[id="status"]').on('input change', function () {
            if ($(this).val() != '') {
                $(this).parent('td').parent('tr').find('#save').prop('disabled', false);
            }
            else {
                $(this).parent('td').parent('tr').find('#save').prop('disabled', true);
            }
        });
    });
*/

$(document).ready(function() {
    //this calculates values automatically 
    
   
    $("input.paychange").on("change", function() {

      var balancearray=[];
    <?php foreach($sresult as $key=>$val){  ?>
      balancearray.push(<?php echo $val->balance;?>);
    <?php } ?>

            var index = $(this).parent('td').parent('tr').find('#sno').val();
               index= parseInt(index)-1;
            var num1 = $(this).parent('td').parent('tr').find('#firsttpay').val();
            var num2 = $(this).parent('td').parent('tr').find('#secondpay').val();
            //var bal = $(this).parent('td').parent('tr').find('#balance').val();
            var result = parseFloat(num1) + parseFloat(num2);
            //var result1 = parseFloat(bal)-parseFloat(result);  

            if (!isNaN(result)) {

              $(this).parent('td').parent('tr').find('#total').val(result);
              var bal = balancearray[index];
              var result1 = parseFloat(bal)-parseFloat(result);
              $(this).parent('td').parent('tr').find('#balance').val(result1);

        
            }
        });
});
$(document).ready(function () {
        $("input.paychange").on('change', function () {
            if ($(this).val() != '') {
                $(this).parent('td').parent('tr').find('#save').prop('disabled', false);
            }
            else {
                $(this).parent('td').parent('tr').find('#save').prop('disabled', true);
            }
        });
    });
   


$(document).on("click", "#save", function() { 
           
           var id = $(this).parent('td').parent('tr').find('#idd').val();
           var fname= $(this).parent('td').parent('tr').find('#fname').val();
           var lname = $(this).parent('td').parent('tr').find('#lname').val();
           var rate= $(this).parent('td').parent('tr').find('#rate').val();
           var pct = $(this).parent('td').parent('tr').find('#pct').val();
           var pay1= $(this).parent('td').parent('tr').find('#firsttpay').val();
           var pay2 = $(this).parent('td').parent('tr').find('#secondpay').val();
           var total= $(this).parent('td').parent('tr').find('#total').val();
           var status= $(this).parent('td').parent('tr').find('#status').val();
           var hours = $(this).parent('td').parent('tr').find('#hours').val();
           var balance= $(this).parent('td').parent('tr').find('#balance').val();
           var month = $(this).parent('td').parent('tr').find('#month').val();
           var year= $(this).parent('td').parent('tr').find('#year').val();
           console.log(year);


           console.log(id);
          
          $.ajax({
           type: "post",
           url: "<?= base_url();?>update",
           cache: false,    
           data: {id:id, fname:fname,lname:lname, rate:rate, pct:pct, pay1:pay1, pay2:pay2, total:total, status:status,hours:hours, balance:balance, month:month, year:year},
           success: function(json){      
            alert("payroll updated");
            location.reload();
          } 
          });
         });
        




</script>

</body>
</html>
