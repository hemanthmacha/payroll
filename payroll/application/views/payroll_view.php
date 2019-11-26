<?php if($this->session->userdata('role') == 'admin') { ?> 
<html>
<head>
<title>Payroll Summary</title>
<link rel="stylesheet" href="<?=base_url('assests/css/payroll.css')?>">


</head>

<body>
  <div class="container-flud">
    <div class="content"> 
    <div class="row"> 
    <h3> Payroll Summary For <input type="text" id="monthdisplay" value="" style="border: none; width:auto;
height:auto; "> </h3>
   
    <div class="col-sm-12">
      
   <?php if(!empty($sresult)){ ?>

<table class="table text-center" align="center" id="customers">
<tr>
      <th>Sno</th>  
      <th>First Name</th>
      <th>Last Name</th>
      <th>Rate</th>
      <th>Percentage</th>
      <th>Tiz</th>

      <!-- <th>Hours</th> -->
      <th><input type="text" id="monthfirstpay" value=""  size="13" style="border: none" readonly></th>
      <th><input type="text" id="monthsecondpay" value=""  size="13" style="border: none" readonly></th>
      <th>Total</th>
     <!--  <th>Status</th> -->
      <th>Total Hours</th>
      <th>Balance</th>
      <th>Link</th>
</tr>


   <?php if(!$_GET['per_page']){
       
        $temp=0;
      }

      else{
        
        $temp=$_GET['per_page'];
      }


      $i=0;foreach($sresult as $key=>$val){ $i++; ?>
  <tr>
    <td><?php $temp=$temp+1; echo $temp; ?></td>
    <input type="hidden" style="border: 0" id="sno" value="<?=$i?>">
    <input type="hidden" id="idd" value="<?=$val->id?>">
    <input type="hidden" id="expences" value="<?=$val->expences?>">
    <input type="hidden" id="month" value="<?=$val->month?>">
    <input type="hidden" id="year" value="<?=$val->year?>">
    
    <td><input type="text" style="border: 0" id="fname"  value="<?php echo $val->firstname; ?>"  readonly/></td>
    <td><input type="text" style="border: 0" id="lname" value="<?php echo $val->lastname; ?>"readonly/></td>

    <?php if($val->hours==0) { ?>
    <td><input type="text" style="border: 0" id="rate" size="8" value="<?php echo $val->curent_rate; ?>" readonly/> </td>
    <?php if($val->percentage >0) { ?>
    <td><input type="text" style="border: 0" id="percent"  size="8" value="<?php echo $val->current_percent; ?>" readonly/></td>
    <?php } ?>

    <?php if($val->percentage ==0) { ?>
    <td><input type="text" style="border: 0" id="percent"  size="8" value="100" readonly/></td>
    <?php } } ?>

     <?php if($val->hours>0) { ?>
      <td><input type="text" style="border: 0" id="rate" size="8" value="<?php echo $val->rate_percent; ?>" readonly/> </td>
    <?php if($val->percentage >0) { ?>
    <td><input type="text" style="border: 0" id="percent"  size="8" value="<?php echo $val->percentage; ?>" readonly/></td>
    <?php } ?>

    <?php if($val->percentage ==0) { ?>
    <td><input type="text" style="border: 0" id="percent"  size="8" value="100" readonly/></td>
    <?php } } ?>

     <td><input type="text" style="border: 0" id="tiz_share" size="8" value="<?php echo $val->tiz_share; ?>" readonly/> </td>

    
    <!-- <td><input type="text" id="hours"  value="<?php echo $val->hours; ?>" disabled/></td> -->
  <!-- <td><input type="text" id="pct"  value="<?php echo $val->percentage; ?>" disabled/></td> -->
    <td><input type="text"  id="firsttpay" class="paychange" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php echo $val->onestpay; ?>"/></td>
    <td><input type="text"  id="secondpay"  class="paychange" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php echo $val->onefivethpay; ?>"/></td>
    <td><input type="text" style="border: 0" id="total" value="<?php echo $val->total; ?>" readonly/></td>
    <!-- <td>
      <select style="width: 90px;"   id="status"  class="form-control dropdownselect">
            <option value="Active" <?php if($val->status == 'Active') { echo 'selected'; } ?>>Active</option>
            <option value="Inactive" <?php if($val->status == 'Inactive') { echo 'selected'; } ?>>Inactive</option>
            <option value="Inhouse" <?php if($val->status == 'Inhouse') { echo 'selected'; } ?>>Inhouse</option>
             <option value="Miscellaneous"<?php if($val->status == 'Miscellaneous') { echo 'selected'; } ?>>Miscellaneous</option>
       </select>
    </td> -->

    <td><input type="text" style="border: 0" id="totalbilled" name="name" value="<?php echo $val->totalbilled_hours; ?>" readonly/></td>
    <td><input type="text" style="border: 0" id="balance" name="name" value="<?php echo $val->balance; ?>" readonly/></td>
    <td><a href="<?=base_url()?>list/?var1=<?=$val->id?>&var2=<?=$val->firstname?>&var3=<?=$val->lastname?>">See More</a></td>

      <td >
        
          <button class="btn btn-primary buttonsave" id="save" disabled>Save</button> 

        </td>


  </tr>

    <?php } ?>

          <td colspan="12" class="text-right" ><span class="pagination"><?=$links?></span></td></tr>
</table>
  <?php } ?>

  <button class="btn btn-primary buttonsave" id="total">Total</button>&nbsp; &nbsp; &nbsp; &nbsp; 


 <button type="button" id="back" class="btn btn-primary buttonsave" onclick="history.back()"> <span class="glyphicon glyphicon-arrow-left"></span> Back </button>&nbsp;&nbsp;
&nbsp; &nbsp;   <button class="btn btn-primary buttonsave" id="unpaid" >No. of Unpaid Employes</button> 
     
    <div class="counts" style="display: none">
       <br>
      <h4>  <?php foreach ($monthpay as $key => $value) { ?>
       Total Firstpay : &nbsp; <?php echo $value->firstsum; ?>;&nbsp;&nbsp; 
       Total Secondpay : &nbsp;<?php echo $value->secondsum; ?>;&nbsp;&nbsp; 
       Total Pay :&nbsp; <?php echo $value->totalmonthsum; ?>;&nbsp;&nbsp; 
       <?php break; } foreach($totalhours as $key => $value) {?>
        Total hours: &nbsp;<?php echo $value->totalhours; ?>;&nbsp;&nbsp; 

        <?php break; } foreach ($totalbalance as $key => $value) { ?>
        Total Balance : &nbsp;<?php echo $value->totalbalance; ?>
         <?php } ?> </h4> 
 
    </div>  

   <div class="remaining" style="display: none">
    <br>
        <h4>Total Employees worked on <?php echo $unpid[3]; echo " "; echo $unpid[4]; echo " :"; echo $unpid[2]; ?></h4>
        
        <h4>1st Pay Remaining Employees: <?php echo $unpid[0]; ?></h4>
        <h4>15th pay Remaining Employees: <?php echo $unpid[1]; ?> </h4>
    </div>

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



  $(document).on("click","#unpaid", function(){   
     $('.remaining').toggle();
});


$(document).on("click","#total", function(){
     $(".counts").toggle();
});


$(document).ready(function() {



    var monthdis1="<?php echo $this->uri->segment(2);?>";
    var yeardisplay = "<?php echo $_GET['var1']; ?>";
    

      if(monthdis1=="Jan") {
        document.getElementById("monthdisplay").value = "January "+yeardisplay;
        document.getElementById("monthfirstpay").value = "January 1st pay";
        document.getElementById("monthsecondpay").value = "January 15th pay";
      }

      if(monthdis1=="Feb"){
       document.getElementById("monthdisplay").value = "February "+yeardisplay;
       document.getElementById("monthfirstpay").value = "February 1st pay";
       document.getElementById("monthsecondpay").value = "February 15th pay";
      }

      if(monthdis1=="Mar"){
        document.getElementById("monthdisplay").value = "March "+yeardisplay;
        document.getElementById("monthfirstpay").value = "March 1st pay";
        document.getElementById("monthsecondpay").value = "March 15th pay";
      }  

      if(monthdis1=="Apr"){
        document.getElementById("monthdisplay").value = "April "+yeardisplay;
        document.getElementById("monthfirstpay").value = "April 1st pay";
        document.getElementById("monthsecondpay").value = "April 15th pay";
       } 
        
      if(monthdis1=="May") {
       document.getElementById("monthdisplay").value = "May "+yeardisplay;
       document.getElementById("monthfirstpay").value = "May 1st pay";
       document.getElementById("monthsecondpay").value = "May 15th pay";
      }

      if(monthdis1=="Jun"){
        document.getElementById("monthdisplay").value = "June "+yeardisplay;
        document.getElementById("monthfirstpay").value = "June 1st pay";
        document.getElementById("monthsecondpay").value = "June 15th pay";
      }

      if(monthdis1=="Jul"){
        document.getElementById("monthdisplay").value = "July "+yeardisplay;
        document.getElementById("monthfirstpay").value ="July 1st pay";
        document.getElementById("monthsecondpay").value = "July 15th pay";
      }

      if(monthdis1=="Aug"){
        document.getElementById("monthdisplay").value = "August "+yeardisplay;
        document.getElementById("monthfirstpay").value = "August 1st pay";
        document.getElementById("monthsecondpay").value = "August 15th pay";
      }

      if(monthdis1=="Sep"){
        document.getElementById("monthdisplay").value = "September "+yeardisplay;
        document.getElementById("monthfirstpay").value = "September 1st pay";
        document.getElementById("monthsecondpay").value = "September 15th pay";
      }

      if(monthdis1=="Oct"){
        document.getElementById("monthdisplay").value = "October "+yeardisplay;
        document.getElementById("monthfirstpay").value = "October 1st pay";
        document.getElementById("monthsecondpay").value = "October 15th pay";
      }

      if(monthdis1=="Nov"){
        document.getElementById("monthdisplay").value = "November "+yeardisplay;
        document.getElementById("monthfirstpay").value = "November 1st pay ";
        document.getElementById("monthsecondpay").value = "November 15th pay";
      }

      if(monthdis1=="Dec"){
        document.getElementById("monthdisplay").value = "December "+yeardisplay;
        document.getElementById("monthfirstpay").value = "December 1st pay";
        document.getElementById("monthsecondpay").value = "December 15th pay";
      }
});
  


    //this calculates values automatically 
    
   
    $("input.paychange").on("keyup", function() {

      var balancearray=[];
    <?php foreach($sresult as $key=>$val){  ?>
      balancearray.push(<?php echo $val->balance;?>);
    <?php } ?>

            var index = $(this).parent('td').parent('tr').find('#sno').val();
               index= parseInt(index)-1;
            var num1 = $(this).parent('td').parent('tr').find('#firsttpay').val();
            var num2 = $(this).parent('td').parent('tr').find('#secondpay').val();
            if(num2==''){

              num2=0;
            }

            if(num1==''){

              num1=0;
            }
            
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

$(document).ready(function () {
        $("#firsttpay,#secondpay").on('keyup', function () {
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
           var pct = $(this).parent('td').parent('tr').find('#percent').val();
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

<?php }  else {

  echo '<script>alert("Please Login");</script>';
             echo '<script>window.open("'.base_url().'","_self");</script>';

 } ?>
