<?php if($this->session->userdata('role') == 'employee') { ?> 
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
      $billedhoursarray=array();

      foreach ($sresult11 as $key => $val) { 
            array_push($changevalue1,"$val->hourstart");
            } 

            foreach ($sresult11 as $key => $val) { 

              if($val->hourstop==0){
                array_push($changevalue2,100000);
              }
              else{
               array_push($changevalue2,"$val->hourstop");
             }

            
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


            foreach($billedhou as $key=>$val){
              array_push($billedhoursarray,"$val->billedhours");
            }
            
            if(!$this->uri->segment(2)){
              $billsum=0;
            }

            else{
              $billsum=$this->uri->segment(2);
            }
              $hourssum=0;
            for($i=0; $i<$billsum;$i++){

              $hourssum = $hourssum + $billedhoursarray[$i];
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


   <?php $snonum=$billsum; $i=0; 
     if(!$this->uri->segment(2)){
        $mp=0;
        $temp=0;
      }

      else{
        $mp=$this->uri->segment(2);
        $temp=$this->uri->segment(2);
      }

      $abcd=0; $ttee=$hourssum; foreach($sresult as $key=>$val){ $snonum++; $i++; ?>
	<tr>
     
     <td><?php $temp=$temp+1; echo $temp; ?></td>
      <input type="hidden" id="idd" value="<?=$val->id?>">
    <td><input type="text" style="border:0"  id="billedmonth" name="month" value="<?php echo $val->month; echo $val->year; ?>"  readonly/></td>
    <td><input type="text" style="border:0"  id="billedhours" size="5" name="hours" value="<?php echo $val->billedhours; ?>"readonly/></td>
    <td><input type="text" style="border:0"  id="rate" size="5" name="rate" value="<?php echo $val->rate; ?>"readonly/></td>
    <?php if($val->percentage > 0){ ?>
      <td><input type="text" style="border:0"  id="pct" size="5" name="pct" value="<?php echo ($val->rate*($val->percentage/100)); ?>"readonly /></td> 
     <?php } ?>

     <?php if($val->percentage == 0){ ?>
      <td><input type="text" style="border:0"  id="pct" size="5" name="pct" value="<?php echo $val->rate; ?>"readonly /></td> 
     <?php } ?>
   
    <td><input type="text" style="border:0" id="totalamount" size="8" name="total" value="<?php echo $val->mounthtotal; ?>"readonly/></td>

    <!-- change alert start-->

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
      <!-- change alert ends-->


    <td><input type="text" style="border:0"  id="monthpay" size="8" name="total" value="<?php echo $monthtotalpay[$mp];  ?>"readonly/></td>

    <td><input type="text" style="border:0"  id="expenses" size="8" name="expenses" value="<?php echo $expp[$mp]; ?>"readonly />&nbsp;&nbsp;<a href="singleempexpenses/?val1=<?php echo $val->id;?>&val2=<?php echo $val->month;?>&val3=<?php echo $val->year;?>"> know expenses </a></td>
    


	</tr>

	  <?php $j = $j +1; } ?>

       <tr><td colspan="6" class="text-right"><span class="pagination"><?=$links?></span></td></tr>

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
