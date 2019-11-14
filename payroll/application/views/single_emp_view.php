<?php if($this->session->userdata('role') == 'admin') { ?> 
<html>
<head>
<title>Employe Summary</title>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<style type="text/css">
  
  .hasTooltip span {
    display: none;
    color: #000;
    text-decoration: none;
    padding: 3px;
}

.hasTooltip:hover span {
    display: block;
    position: absolute;
    background-color: #FFF;
    border: 1px solid #CCC;
    margin: 2px 10px;
    width: 200px;
}

</style>

</head>

<body>

    <div class="content"> 
    <div class="row"> 
    <div class="col-sm-10">
      <?php 
      $changevalue1=array();
      $changevalue2=array();
      $changevalue3=array();
      $changevalue4=array();

      foreach ($sresult11 as $key => $val) { 
            array_push($changevalue1,"$val->hourstart");
            } 

            foreach ($sresult11 as $key => $val) { 
            array_push($changevalue2,"$val->hourstop");
            }

            foreach ($sresult11 as $key => $val) { 
            array_push($changevalue3,"$val->rate");
            }

            foreach ($sresult11 as $key => $val) { 
              if($val->percentage==0){
                array_push($changevalue4,100);
              }
              else{
               array_push($changevalue4,"$val->percentage");
             }

            }


      $expp= array();
      $i=0;
            foreach ($sum as $key => $value) {
                array_push($expp,"$value");
                $i=$i+1;

                $monthtotalpay=array();
            foreach ($monthpay as $key => $val) { 
            array_push($monthtotalpay,"$val->total");
            } 
      } ?>


    	
   <?php if(!empty($sresult)){ ?>

<table class="table text-center " align="center" id="customers">
<tr>
      <th>Sno</th>  
      <th>Billed Month</th>
      <th>Billed Hours</th>
      <th>Rate</th>
       <th>Hourly Rate</th>
      <th>Total Amount</th>
      <th></th>
      <th>Amount Paid to Individual</th>
      <th>Expenses</th>
      
</tr>


   <?php $i=0; $j=0;$abcd=0; $ttee=0;foreach($sresult as $key=>$val){ $i++; $ttee=$ttee+$val->billedhours; ?>
	<tr>
     
     <td><?php echo $i; ?></td>
      <input type="hidden" id="idd" value="<?=$val->id?>">
    <td><input type="text" id="billedmonth" name="month" value="<?php echo $val->month; echo $val->year; ?>"  disabled/></td>
    <td><input type="text" id="billedhours" size="5" name="hours" value="<?php echo $val->billedhours; ?>"disabled/></td>
    <td><input type="text" id="rate" size="5" name="rate" value="<?php echo $val->rate; ?>"disabled/></td>
    <?php if($val->percentage > 0){ ?>
      <td><input type="text" id="pct" size="5" name="pct" value="<?php echo ($val->rate*($val->percentage/100)); ?>"disabled /></td> 
     <?php } ?>

     <?php if($val->percentage == 0){ ?>
      <td><input type="text" id="pct" size="5" name="pct" value="<?php echo $val->rate; ?>"disabled /></td> 
     <?php } ?>
   
    <td><input type="text" id="totalamount" size="8" name="total" value="<?php echo $val->mounthtotal; ?>"disabled/></td>

    <?php  if($changevalue1[$abcd] <= $ttee) {

              if($changevalue2[$abcd] >= $ttee) { ?>
                <td>   </td>
              <?php }

              else{ 

                if ((sizeof($changevalue4)-1) <= $abcdtemp) { 
                  $abcd=$abcd+1; ?>
                <td>  </td>

                
                
             <?php }

                  if ($abcd>=1 && (sizeof($changevalue4)-1) > $abcd ){ $abcdtemp = $abcd+1;?>
                 
                <td><a href="#" class="hasTooltip">Calculation Change Here 
                    <span>Rate and Percentage are changed from <?php echo $changevalue3[($abcd)] ?> to <?php echo $changevalue3[$abcdtemp]; ?> and <?php echo $changevalue4[($abcd)]; ?> to <?php echo $changevalue4[$abcdtemp];?> </span>
                </a> </td>

                
                <?php $abcd=$abcd+1; 
              }

                  if ($abcd==0) { 
                  $abcd=$abcd+1; ?>
                <td><a href="#" class="hasTooltip">Calculation Change Here 
                    <span>Rate and Percentage are changed from <?php echo $changevalue3[(0)] ?> to <?php echo $changevalue3[1]; ?> and <?php echo $changevalue4[(0)]; ?> to <?php echo $changevalue4[1]; ?> </span>
                </a> </td>


                
             <?php }     

            }

          }
      ?>


    <td><input type="text" id="monthpay" size="8" name="total" value="<?php echo $monthtotalpay[$j];  ?>"disabled/></td>

    <td><input type="text" id="expenses" size="8" name="expenses" value="<?php echo $expp[$j]; ?>"disabled/>&nbsp;&nbsp;<a href="singleempexpenses/?val1=<?php echo $val->id;?>&val2=<?php echo $val->month;?>&val3=<?php echo $val->year;?>"> know expenses </a></td>
    


	</tr>

	  <?php $j = $j +1; } ?>

</table>
  <?php } ?>

 <?php if (!empty($sresult)){ ?>
  
 
<button class="btn btn-primary buttonsave" id="Link">click to know your total details</button>
 <?php foreach ($summdata as $key => $value) { ?>
  <div class="counts" style="display: none">
    <br>

      &emsp;&nbsp;&emsp;&nbsp;&emsp;&nbsp;&emsp;&nbsp;<td style="font-size:14;">  &emsp;Total Hours : <input type="text" size="6" style="border: none;" value="<?php echo $value->billedhours; ?>" readonly/>  </td>
      <td style="font-size:14;">&emsp;&nbsp;Total Amount : <input type="text" size="6"  style="border: none;" value="<?php echo $value->totalamount; ?>" readonly/></td>
       <td style="font-size:14;">Total Pay : <input type="text"  style="border: none;" size="6" value="<?php echo $value->totalmonthpay; ?>" readonly/></td>
        <td style="font-size:14;"> &emsp; Total Expenses: <input type="text"  size="6" style="border: none;" value="<?php echo $value->exp; ?>" readonly/></td>
        <td style="font-size:14;"> &emsp; Balance : <input type="text"   size="6" style="border: none;" value="<?php echo $value->balance; ?>" readonly/></td>
 
    </div>
 <?php } ?>
   <?php } ?> 


  <br>
  <br>
  <br>

  
</div>
</div> </div>


<style>

  .abc{
  position: absolute;
  bottom: 12px;
  right: 77px;
  border:none;
  

}
</style>

<script type="text/javascript">

  $(document).ready(function(){

      $('.counts').hide();
    }); 
  
   $("#Link").click(function(){
    $(".counts").toggle();


  });
</script>




</body>
</html>


<?php }  else {

  echo '<script>alert("Please Login");</script>';
             echo '<script>window.open("'.base_url().'","_self");</script>';

 } ?>