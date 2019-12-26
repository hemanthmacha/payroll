<?php if($this->session->userdata('role') == 'admin') { ?> 
<html>
<head>
<title>Payroll Summary</title>
<link rel="stylesheet" href="<?=base_url('assests/css/payroll.css')?>">
<img src="https://img.icons8.com/officexs/16/000000/data-recovery.png">

<style type="text/css">
  #monthdisplay{
    padding-right: 10px;
  }

h4 {
    font-family: sans-serif;
    font-weight: 50;
    width: 10;
}
</style>


</head>

<body>
  <div class="container-flud">
    <div class="content"> 

    <div class="row"> 
       <h3> Payroll Summary For <input type="text" id="monthdisplay" value="" style="border: none; width:auto;
height:auto; " readonly> </h3>
   
    <div class="col-sm-12">
   
      
   <?php if(!empty($active) || !empty($internal) || !empty($complete) || !empty($left) || !empty($inactive)){ $act==0; $in==0; $leftc==0; $com=0; $inact=0;$i=0;?>

<table class="table text-center" align="center" id="customers">
<tr style="background-color: gainsboro;">
  <th></th>
      <th>Sno</th>  
      <th>First Name</th>
      <th>Last Name</th>
      <th>Rate</th>
      <th>Percentage</th>
      <th>Tiz</th>

      <!-- <th>Hours</th> -->
      <th><input type="text" id="monthfirstpay" value=""  size="13" style="border: none;background-color: gainsboro;" readonly></th>
      <th><input type="text" id="monthsecondpay" value=""  size="13" style="border: none;background-color: gainsboro;" readonly></th>
      <th>Total</th>
     <!--  <th>Status</th> -->
      <th>Total Hours</th>
      <th>Balance</th>
      <th>Link</th>
      <th>Save</th>
</tr>

<!-- looping starts -->
   <?php   $j=0;foreach($active as $key=>$val){ $j++; $i++;?>

    <?php if($act==0){ $act=1; ?>
      <td><h4>Active&nbsp;Employees</h4></td> 
  <?php } ?>

  <tr>
    <td style="border: none"></td>
    <td><?php echo $j; ?></td>
    <input type="hidden" style="border: 0" id="sno" value="<?=$i?>">
    <input type="hidden" id="idd" value="<?=$val->id?>">
    <input type="hidden" id="expences" value="<?=$val->expences?>">
    <input type="hidden" id="month<?php echo $i; ?>" value="<?=$val->month?>">
    <input type="hidden" id="year<?php echo $i; ?>" value="<?=$val->year?>">
    
    <td><input type="text" style="border: 0" size= "10" id="fname<?php echo $i; ?>"  value="<?php echo $val->firstname; ?>"  readonly/></td>
    <td><input type="text" style="border: 0" size= "10" id="lname<?php echo $i; ?>" value="<?php echo $val->lastname; ?>"readonly/></td>

    <?php if($val->hours==0) { ?>
    <td><input type="text" style="border: 0" id="rate<?php echo $i; ?>" size="5" value="<?php echo $val->curent_rate; ?>" readonly/> </td>
    <?php if($val->percentage >0) { ?>
    <td><input type="text" style="border: 0" id="percent<?php echo $i; ?>"  size="5" value="<?php echo $val->current_percent; ?>" readonly/></td>
    <?php } ?>

    <?php if($val->percentage ==0) { ?>
    <td><input type="text" style="border: 0" id="percent<?php echo $i; ?>"  size="5" value="100" readonly/></td>
    <?php } } ?>

     <?php if($val->hours>0) { ?>
      <td><input type="text" style="border: 0" id="rate<?php echo $i; ?>" size="5" value="<?php echo $val->rate_percent; ?>" readonly/> </td>

    <?php if($val->percentage >0) { ?>
    <td><input type="text" style="border: 0" id="percent<?php echo $i; ?>"  size="5" value="<?php echo $val->percentage; ?>" readonly/></td>
    <?php } ?>

    <?php if($val->percentage ==0) { ?>
    <td><input type="text" style="border: 0" id="percent<?php echo $i; ?>"  size="5" value="100" readonly/></td>
    <?php } } ?>


    <?php if($val->tiz_share >0) { ?>
      <td><input type="text" style="border: 0" id="tiz_share<?php echo $i; ?>" size="5" value="<?php echo $val->tiz_share; ?>" readonly/> </td>
    <?php } ?>

    <?php if($val->tiz_share ==0) { ?>
    <td><input type="text" style="border: 0" id="tiz_share<?php echo $i; ?>" size="5" value="<?php echo $val->current_tez; ?>" readonly/> </td>
    <?php } ?>


    <td><input type="text"  id="firsttpay<?php echo $i; ?>" size="8"  class="paychange" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php echo "$"; echo $val->onestpay; ?>"/> <input type="image" id="lastmonthfirstpay" src="<?= base_url();?>assests/images/add_data.jpg" style="height: 15;"></td>

    <td><input type="text" size="10"   id="secondpay<?php echo $i; ?>"  class="paychange" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php  echo "$"; echo $val->onefivethpay; ?>"/> <input type="image" id="lastmonthsecondpay" src="<?= base_url();?>assests/images/add_data.jpg" style="height: 15;"></td>

    <td><input type="text" size="8"  style="border: 0" id="total<?php echo $i; ?>" value="<?php echo "$";echo $val->total; ?>" readonly/></td>

    <td><input type="text" style="border: 0" size="10" id="totalbilled<?php echo $i; ?>" name="name" value="<?php echo $val->totalbilled_hours; ?>" readonly/></td>

    <td><input type="text" style="border: 0" size="10" id="balance<?php echo $i; ?>" name="name" value="<?php  echo "$"; echo $val->balance; ?>" readonly/></td>

    <td><a href="<?=base_url()?>list/?var1=<?=$val->id?>&var2=<?=$val->firstname?>&var3=<?=$val->lastname?>" target="_blank" >See More</a></td>

      <td >
        
          <button class="btn btn-primary buttonsave" id="save" disabled>Save</button> 

        </td>


  </tr>

    <?php } ?>


    <?php   $j=0;foreach($internal as $key=>$val){ $j++; $i++;?>

      <?php if($in==0){ $in=1; ?> 
      <td style="border: none"><h4>Internal&nbsp;Employees</h4> </td>
   
  <?php } ?>
  <tr>
    <td style="border: none"></td>
    <td><?php echo $j; ?></td>
    <input type="hidden" style="border: 0" id="sno" value="<?=$i?>">
    <input type="hidden" id="idd" value="<?=$val->id?>">
    <input type="hidden" id="expences" value="<?=$val->expences?>">
    <input type="hidden" id="month<?php echo $i; ?>" value="<?=$val->month?>">
    <input type="hidden" id="year<?php echo $i; ?>" value="<?=$val->year?>">
    
    <td><input type="text" style="border: 0" size= "10" id="fname<?php echo $i; ?>"  value="<?php echo $val->firstname; ?>"  readonly/></td>
    <td><input type="text" style="border: 0" size= "10" id="lname<?php echo $i; ?>" value="<?php echo $val->lastname; ?>"readonly/></td>

    <?php if($val->hours==0) { ?>
    <td><input type="text" style="border: 0" id="rate<?php echo $i; ?>" size="5" value="<?php echo $val->curent_rate; ?>" readonly/> </td>
    <?php if($val->percentage >0) { ?>
    <td><input type="text" style="border: 0" id="percent<?php echo $i; ?>"  size="5" value="<?php echo $val->current_percent; ?>" readonly/></td>
    <?php } ?>

    <?php if($val->percentage ==0) { ?>
    <td><input type="text" style="border: 0" id="percent<?php echo $i; ?>"  size="5" value="100" readonly/></td>
    <?php } } ?>

     <?php if($val->hours>0) { ?>
      <td><input type="text" style="border: 0" id="rate<?php echo $i; ?>" size="5" value="<?php echo $val->rate_percent; ?>" readonly/> </td>
    <?php if($val->percentage >0) { ?>
    <td><input type="text" style="border: 0" id="percent<?php echo $i; ?>"  size="5" value="<?php echo $val->percentage; ?>" readonly/></td>
    <?php } ?>

    <?php if($val->percentage ==0) { ?>
    <td><input type="text" style="border: 0" id="percent<?php echo $i; ?>"  size="5" value="100" readonly/></td>
    <?php } } ?>

     <?php if($val->tiz_share >0) { ?>
      <td><input type="text" style="border: 0" id="tiz_share<?php echo $i; ?>" size="5" value="<?php echo $val->tiz_share; ?>" readonly/> </td>
    <?php } ?>

    <?php if($val->tiz_share ==0) { ?>
    <td><input type="text" style="border: 0" id="tiz_share<?php echo $i; ?>" size="5" value="<?php echo $val->current_tez; ?>" readonly/> </td>
    <?php } ?>

    <td><input type="text"  id="firsttpay<?php echo $i; ?>" size="8"  class="paychange" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php echo "$"; echo $val->onestpay; ?>"/> <input type="image" id="lastmonthfirstpay" src="<?= base_url();?>assests/images/add_data.jpg" style="height: 15;"></td>

    <td><input type="text" size="10"   id="secondpay<?php echo $i; ?>"  class="paychange" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php  echo "$"; echo $val->onefivethpay; ?>"/> <input type="image" id="lastmonthsecondpay" src="<?= base_url();?>assests/images/add_data.jpg" style="height: 15;"></td>

    <td><input type="text" size="8"  style="border: 0" id="total<?php echo $i; ?>" value="<?php echo "$";echo $val->total; ?>" readonly/></td>
   
    <td><input type="text" style="border: 0" size="10" id="totalbilled<?php echo $i; ?>" name="name" value="<?php echo $val->totalbilled_hours; ?>" readonly/></td>
    <td><input type="text" style="border: 0" size="10" id="balance<?php echo $i; ?>" name="name" value="<?php  echo "$"; echo $val->balance; ?>" readonly/></td>
    <td><a href="<?=base_url()?>list/?var1=<?=$val->id?>&var2=<?=$val->firstname?>&var3=<?=$val->lastname?>" target="_blank" >See More</a></td>

      <td >
        
          <button class="btn btn-primary buttonsave" id="save" disabled>Save</button> 

        </td>


  </tr>

    <?php } ?>


    <?php   $j=0;foreach($complete as $key=>$val){ $j++;$i++; ?>

      <?php if($com==0){ $com=1; ?> 
      <td style="border: none"><h4>Project&nbsp;Complete</h4> 
   
  <?php } ?>

  <tr>
    <td style="border: none"></td>
    <td><?php echo $j; ?></td>
    <input type="hidden" style="border: 0" id="sno" value="<?=$i?>">
    <input type="hidden" id="idd" value="<?=$val->id?>">
    <input type="hidden" id="expences" value="<?=$val->expences?>">
    <input type="hidden" id="month<?php echo $i; ?>" value="<?=$val->month?>">
    <input type="hidden" id="year<?php echo $i; ?>" value="<?=$val->year?>">
    
    <td><input type="text" style="border: 0" size= "10" id="fname<?php echo $i; ?>"  value="<?php echo $val->firstname; ?>"  readonly/></td>
    <td><input type="text" style="border: 0" size= "10" id="lname<?php echo $i; ?>" value="<?php echo $val->lastname; ?>"readonly/></td>

    <?php if($val->hours==0) { ?>
    <td><input type="text" style="border: 0" id="rate<?php echo $i; ?>" size="5" value="<?php echo $val->curent_rate; ?>" readonly/> </td>
    <?php if($val->percentage >0) { ?>
    <td><input type="text" style="border: 0" id="percent<?php echo $i; ?>"  size="5" value="<?php echo $val->current_percent; ?>" readonly/></td>
    <?php } ?>

    <?php if($val->percentage ==0) { ?>
    <td><input type="text" style="border: 0" id="percent<?php echo $i; ?>"  size="5" value="100" readonly/></td>
    <?php } } ?>

     <?php if($val->hours>0) { ?>
      <td><input type="text" style="border: 0" id="rate<?php echo $i; ?>" size="5" value="<?php echo $val->rate_percent; ?>" readonly/> </td>
    <?php if($val->percentage >0) { ?>
    <td><input type="text" style="border: 0" id="percent<?php echo $i; ?>"  size="5" value="<?php echo $val->percentage; ?>" readonly/></td>
    <?php } ?>

    <?php if($val->percentage ==0) { ?>
    <td><input type="text" style="border: 0" id="percent<?php echo $i; ?>"  size="5" value="100" readonly/></td>
    <?php } } ?>

     <?php if($val->tiz_share >0) { ?>
      <td><input type="text" style="border: 0" id="tiz_share<?php echo $i; ?>" size="5" value="<?php echo $val->tiz_share; ?>" readonly/> </td>
    <?php } ?>

    <?php if($val->tiz_share ==0) { ?>
    <td><input type="text" style="border: 0" id="tiz_share<?php echo $i; ?>" size="5" value="<?php echo $val->current_tez; ?>" readonly/> </td>
    <?php } ?>

    <td><input type="text"  id="firsttpay<?php echo $i; ?>" size="8"  class="paychange" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php echo "$"; echo $val->onestpay; ?>"/> <input type="image" id="lastmonthfirstpay" src="<?= base_url();?>assests/images/add_data.jpg" style="height: 15;"></td>

    <td><input type="text" size="10"   id="secondpay<?php echo $i; ?>"  class="paychange" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php  echo "$"; echo $val->onefivethpay; ?>"/> <input type="image" id="lastmonthsecondpay" src="<?= base_url();?>assests/images/add_data.jpg" style="height: 15;"></td>

    <td><input type="text" size="8"  style="border: 0" id="total<?php echo $i; ?>" value="<?php echo "$";echo $val->total; ?>" readonly/></td>

    <td><input type="text" style="border: 0" size="10" id="totalbilled<?php echo $i; ?>" name="name" value="<?php echo $val->totalbilled_hours; ?>" readonly/></td>
    <td><input type="text" style="border: 0" size="10" id="balance<?php echo $i; ?>" name="name" value="<?php  echo "$"; echo $val->balance; ?>" readonly/></td>
    <td><a href="<?=base_url()?>list/?var1=<?=$val->id?>&var2=<?=$val->firstname?>&var3=<?=$val->lastname?>" target="_blank" >See More</a></td>

      <td >
        
          <button class="btn btn-primary buttonsave" id="save" disabled>Save</button> 

        </td>


  </tr>

    <?php } ?>


    <?php   $j=0;foreach($inactive as $key=>$val){ $j++;$i++;?>

       <?php if($inact==0){ $inact=1; ?>
      <td style="border: none"><h4>Inactive&nbsp;Employees</h4> 
  <?php } ?>

  <tr>
    <td style="border: none"></td>
    <td><?php echo $j; ?></td>
    <input type="hidden" style="border: 0" id="sno" value="<?=$i?>">
    <input type="hidden" id="idd" value="<?=$val->id?>">
    <input type="hidden" id="expences" value="<?=$val->expences?>">
    <input type="hidden" id="month<?php echo $i; ?>" value="<?=$val->month?>">
    <input type="hidden" id="year<?php echo $i; ?>" value="<?=$val->year?>">
    
    <td><input type="text" style="border: 0" size= "10" id="fname<?php echo $i; ?>"  value="<?php echo $val->firstname; ?>"  readonly/></td>
    <td><input type="text" style="border: 0" size= "10" id="lname<?php echo $i; ?>" value="<?php echo $val->lastname; ?>"readonly/></td>

    <?php if($val->hours==0) { ?>
    <td><input type="text" style="border: 0" id="rate<?php echo $i; ?>" size="5" value="<?php echo $val->curent_rate; ?>" readonly/> </td>
    <?php if($val->percentage >0) { ?>
    <td><input type="text" style="border: 0" id="percent<?php echo $i; ?>"  size="5" value="<?php echo $val->current_percent; ?>" readonly/></td>
    <?php } ?>

    <?php if($val->percentage ==0) { ?>
    <td><input type="text" style="border: 0" id="percent<?php echo $i; ?>"  size="5" value="100" readonly/></td>
    <?php } } ?>

     <?php if($val->hours>0) { ?>
      <td><input type="text" style="border: 0" id="rate<?php echo $i; ?>" size="5" value="<?php echo $val->rate_percent; ?>" readonly/> </td>
    <?php if($val->percentage >0) { ?>
    <td><input type="text" style="border: 0" id="percent<?php echo $i; ?>"  size="5" value="<?php echo $val->percentage; ?>" readonly/></td>
    <?php } ?>

    <?php if($val->percentage ==0) { ?>
    <td><input type="text" style="border: 0" id="percent<?php echo $i; ?>"  size="5" value="100" readonly/></td>
    <?php } } ?>

     <?php if($val->tiz_share >0) { ?>
      <td><input type="text" style="border: 0" id="tiz_share<?php echo $i; ?>" size="5" value="<?php echo $val->tiz_share; ?>" readonly/> </td>
    <?php } ?>

    <?php if($val->tiz_share ==0) { ?>
    <td><input type="text" style="border: 0" id="tiz_share<?php echo $i; ?>" size="5" value="<?php echo $val->current_tez; ?>" readonly/> </td>
    <?php } ?>

    <td><input type="text"  id="firsttpay<?php echo $i; ?>" size="8"  class="paychange" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php echo "$"; echo $val->onestpay; ?>"/> <input type="image" id="lastmonthfirstpay" src="<?= base_url();?>assests/images/add_data.jpg" style="height: 15;"></td>

    <td><input type="text" size="10"   id="secondpay<?php echo $i; ?>"  class="paychange" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php  echo "$"; echo $val->onefivethpay; ?>"/> <input type="image" id="lastmonthsecondpay" src="<?= base_url();?>assests/images/add_data.jpg" style="height: 15;"></td>

    <td><input type="text" size="8"  style="border: 0" id="total<?php echo $i; ?>" value="<?php echo "$";echo $val->total; ?>" readonly/></td>

    <td><input type="text" style="border: 0" size="10" id="totalbilled<?php echo $i; ?>" name="name" value="<?php echo $val->totalbilled_hours; ?>" readonly/></td>
    <td><input type="text" style="border: 0" size="10" id="balance<?php echo $i; ?>" name="name" value="<?php  echo "$"; echo $val->balance; ?>" readonly/></td>
    <td><a href="<?=base_url()?>list/?var1=<?=$val->id?>&var2=<?=$val->firstname?>&var3=<?=$val->lastname?>" target="_blank" >See More</a></td>

      <td >    
          <button class="btn btn-primary buttonsave" id="save" disabled>Save</button> 
        </td>
  </tr>

    <?php } ?>


    <?php   $j=0;foreach($left as $key=>$val){ $j++;$i++; ?>

      <?php if($leftc==0){ $leftc=1; ?> 
      <td style="border: none"><h4>Left&nbsp;Company</h4></td> 
  <?php } ?>
  <tr>
    <td style="border: none"></td>
    <td><?php echo $j; ?></td>
    <input type="hidden" style="border: 0" id="sno" value="<?=$i?>">
    <input type="hidden" id="idd" value="<?=$val->id?>">
    <input type="hidden" id="expences" value="<?=$val->expences?>">
    <input type="hidden" id="month<?php echo $i; ?>" value="<?=$val->month?>">
    <input type="hidden" id="year<?php echo $i; ?>" value="<?=$val->year?>">
    
    <td><input type="text" style="border: 0" size= "10" id="fname<?php echo $i; ?>"  value="<?php echo $val->firstname; ?>"  readonly/></td>
    <td><input type="text" style="border: 0" size= "10" id="lname<?php echo $i; ?>" value="<?php echo $val->lastname; ?>"readonly/></td>

    <?php if($val->hours==0) { ?>
    <td><input type="text" style="border: 0" id="rate<?php echo $i; ?>" size="5" value="<?php echo $val->curent_rate; ?>" readonly/> </td>
    <?php if($val->percentage >0) { ?>
    <td><input type="text" style="border: 0" id="percent<?php echo $i; ?>"  size="5" value="<?php echo $val->current_percent; ?>" readonly/></td>
    <?php } ?>

    <?php if($val->percentage ==0) { ?>
    <td><input type="text" style="border: 0" id="percent<?php echo $i; ?>"  size="5" value="100" readonly/></td>
    <?php } } ?>

     <?php if($val->hours>0) { ?>
      <td><input type="text" style="border: 0" id="rate<?php echo $i; ?>" size="5" value="<?php echo $val->rate_percent; ?>" readonly/> </td>
    <?php if($val->percentage >0) { ?>
    <td><input type="text" style="border: 0" id="percent<?php echo $i; ?>"  size="5" value="<?php echo $val->percentage; ?>" readonly/></td>
    <?php } ?>

    <?php if($val->percentage ==0) { ?>
    <td><input type="text" style="border: 0" id="percent<?php echo $i; ?>"  size="5" value="100" readonly/></td>
    <?php } } ?>

    <?php if($val->tiz_share >0) { ?>
      <td><input type="text" style="border: 0" id="tiz_share<?php echo $i; ?>" size="5" value="<?php echo $val->tiz_share; ?>" readonly/> </td>
    <?php } ?>

    <?php if($val->tiz_share ==0) { ?>
    <td><input type="text" style="border: 0" id="tiz_share<?php echo $i; ?>" size="5" value="<?php echo $val->current_tez; ?>" readonly/> </td>
    <?php } ?>

    <td><input type="text"  id="firsttpay<?php echo $i; ?>" size="8"  class="paychange" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php echo "$"; echo $val->onestpay; ?>"/> <input type="image" id="lastmonthfirstpay" src="<?= base_url();?>assests/images/add_data.jpg" style="height: 15;"></td>

    <td><input type="text" size="10"   id="secondpay<?php echo $i; ?>"  class="paychange" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php  echo "$"; echo $val->onefivethpay; ?>"/> <input type="image" id="lastmonthsecondpay" src="<?= base_url();?>assests/images/add_data.jpg" style="height: 15;"></td>

    <td><input type="text" size="8"  style="border: 0" id="total<?php echo $i; ?>" value="<?php echo "$";echo $val->total; ?>" readonly/></td>
  
    <td><input type="text" style="border: 0" size="10" id="totalbilled<?php echo $i; ?>" name="name" value="<?php echo $val->totalbilled_hours; ?>" readonly/></td>
    <td><input type="text" style="border: 0" size="10" id="balance<?php echo $i; ?>" name="name" value="<?php  echo "$"; echo $val->balance; ?>" readonly/></td>
    <td><a href="<?=base_url()?>list/?var1=<?=$val->id?>&var2=<?=$val->firstname?>&var3=<?=$val->lastname?>" target="_blank" >See More</a></td>

      <td >
        
          <button class="btn btn-primary buttonsave" id="save" disabled>Save</button> 

        </td>


  </tr>

    <?php } ?>

<!-- looping ends -->
          <!-- <td colspan="12" class="text-right" ><span class="pagination"><?=$links?></span></td></tr> -->
</table>
  <?php } ?>




  <button class="btn btn-primary buttonsave" id="total">Total</button>&nbsp; &nbsp; &nbsp; &nbsp; 
 
 <button type="button" id="back" class="btn btn-primary buttonsave" onclick="history.back()"> <span class="glyphicon glyphicon-arrow-left"></span> Back </button>&nbsp;&nbsp;
&nbsp; &nbsp;   <button class="btn btn-primary buttonsave" id="unpaid" >No. of Unpaid Employes</button> &nbsp;&nbsp;
<button class="btn btn-primary buttonsave" id="mislenous_show">Show Miscellaneous</button>

<button class="btn btn-primary buttonsave" id="mislenous_add" style="display: none">Add Miscellaneous</button>

 <button type="button" id="back" class="btn btn-primary buttonsave" onclick="history.back()"> <span class="glyphicon glyphicon-arrow-left"></span> Back </button>&nbsp;&nbsp;
&nbsp; &nbsp;   <button class="btn btn-primary buttonsave" id="unpaid" >No. of Unpaid Employes</button> 
     
    <div class="counts" style="display: none">
      
       <table class="col-sm-2">
        <br>
      <h4>  <?php foreach ($monthpay as $key => $value) { ?>
         <tr> <td> Total Firstpay    </td> <td><?php  echo "$";echo $value->firstsum; ?> </td> </tr> 
         <tr> <td>Total Secondpay  </td> <td><?php  echo "$";echo $value->secondsum; ?> </td> </tr>  
         <tr> <td> Total Pay        </td> <td><?php  echo "$";echo $value->totalmonthsum; ?> </td> </tr>  
       <?php break; } foreach($totalhours as $key => $value) {?>
        <tr> <td>Total hours     </td> <td><?php echo $value->totalhours; echo" " ;echo "Hrs";?> </td> </tr>  

        <?php break; } foreach ($totalbalance as $key => $value) { ?>
         <tr> <td> Total Balance   </td> <td><?php  echo "$";echo $value->totalbalance ?> </td> </tr> 
        <?php } ?> </table> </h4> 
 
    </div>  

   <div class="remaining" style="display: none">
    <table class="col-sm-3">
    <br>
        <h4><tr> <td>Total Employees worked on <?php echo $unpid[3]; echo " "; echo $unpid[4]; ?> </td> <td><?php echo $unpid[2]; ?></td> </tr> </h4>
        
        <h4><tr> <td>1st Pay Remaining Employees </td> <td> <?php $temp =$unpid[2]-$unpid[0]; echo $temp; ?></td> </tr> </h4>
        <h4><tr> <td>15th pay Remaining Employees </td> <td> <?php $temp1 =$unpid[2]-$unpid[1]; echo $temp1; ?> </td> </tr> </h4>
    </table> 
    </div>
  
  <br>
  <div id="aaaa" style="display: none">
    <table id = "mislenous" class="col-sm-4" >
    <br><br>
        <h4>Miscellaneous&nbsp;Data</h4>
        <tr> 
        <th></th><th></th>
        <th></th><th></th>        
        <th>Name</th>
        <th>1st Pay</th>
        <th> 15th Pay </th>
        <th>Total </th>
        </tr>
        
        <?php $k=0; foreach($mislenous as $key=>$vall) { $k++; ?>
           <tr>
            <td><input type="hidden" id="mis_sno" value="<?php echo $k;?>"/></td>
            <td><input type="hidden" id="mis_id" value="<?php echo $vall->mis_id; ?>" name="">
             <td><input type="hidden" id="mis_month" value="<?php echo $vall->month;?>"/></td>
             <td><input type="hidden" id="mis_year" value="<?php echo $vall->year;?>"/></td>
             <td><input type="text" id="misname<?php echo $k; ?>" value="<?php echo $vall->mis_name;?> "/> </td>
             <td><input type="text" id="misfirst<?php echo $k; ?>" class="mis_pay" value="<?php echo $vall->mis_first;?>"/> </td>
             <td><input type="text" id="missecond<?php echo $k; ?>" class="mis_pay" value="<?php echo $vall->mis_second;?>"/> </td>
             <td><input type="text" id="mistotal<?php echo $k; ?>" value="<?php echo $vall->mis_total;?>" readonly/> </td>
             <td> <button class='btn btn-primary buttonsave' style="display:none" id='mislenous_update'>update</button> <br> </td>
             <td><button class='btn btn-primary buttonsave'   id='mislenous_delete'>Delete</button></td>
           </tr> 
        <?php } ?> 
          
    </table> 
</td>
 

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
      $(".counts").hide();
});



  $(document).on("click","#mislenous_show", function(){   
     
     $('#mislenous_add').show();
     $('#mislenous_show').hide();
     $('#aaaa').show();

});



$(document).on("click","#total", function(){
     $(".counts").toggle();
     $('.remaining').hide();
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
              <?php foreach($balance_single as $key=>$val){  ?>
                balancearray.push(<?php echo $val->balance;?>);
              <?php } ?>
            var sno = $(this).parent('td').parent('tr').find('#sno').val(); 
            var num1 = $(this).parent('td').parent('tr').find('#firsttpay'+sno).val();
            var num2 = $(this).parent('td').parent('tr').find('#secondpay'+sno).val();
            var index = $(this).parent('td').parent('tr').find('#sno').val();
               index= parseInt(index)-1;
     
            var num1=num1.replace('$','');
            var num2=num2.replace('$','');
  
            var result = parseFloat(num1) + parseFloat(num2);

        

            if (!isNaN(result)) {

              $(this).parent('td').parent('tr').find('#total'+sno).val('$'+result);
              var bal = balancearray[index];
              var result1 = parseFloat(bal)-parseFloat(result);

              console.log(result1);
              $(this).parent('td').parent('tr').find('#balance'+sno).val('$'+result1);

        
            }
        });

$(document).ready(function () {
        $(".paychange").on('keyup', function () {
            if ($(this).val() != '') {
                $(this).parent('td').parent('tr').find('#save').prop('disabled', false);
            }
            else {
                $(this).parent('td').parent('tr').find('#save').prop('disabled', true);
            }
        });
    });
   


   $(document).on("click", "#save", function() { 
           
           var sno = $(this).parent('td').parent('tr').find('#sno').val();
           var id = $(this).parent('td').parent('tr').find('#idd').val();
           var fname= $(this).parent('td').parent('tr').find('#fname'+sno).val();
           var lname = $(this).parent('td').parent('tr').find('#lname'+sno).val();
           var rate= $(this).parent('td').parent('tr').find('#rate'+sno).val();
           var pct = $(this).parent('td').parent('tr').find('#percent'+sno).val();
           var pay11= $(this).parent('td').parent('tr').find('#firsttpay'+sno).val();
           var pay22 = $(this).parent('td').parent('tr').find('#secondpay'+sno).val();
           var total1= $(this).parent('td').parent('tr').find('#total'+sno).val();
           var status= $(this).parent('td').parent('tr').find('#status'+sno).val();
           var hours = $(this).parent('td').parent('tr').find('#hours'+sno).val();
           var balance1= $(this).parent('td').parent('tr').find('#balance'+sno).val();
           var month = $(this).parent('td').parent('tr').find('#month'+sno).val();
           var year= $(this).parent('td').parent('tr').find('#year'+sno).val();

          /* console.log(sno);
           console.log(id);
           console.log(rate);
           console.log(id);
*/
          var pay1=pay11.replace('$','');
          var pay2=pay22.replace('$','');
          var total=total1.replace('$','');
          var balance=balance1.replace('$','');
           
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

$(document).on("click","#lastmonthsecondpay",function(){

             var sno = $(this).parent('td').parent('tr').find('#sno').val();
             var id = $(this).parent('td').parent('tr').find('#idd').val();
             var month = $(this).parent('td').parent('tr').find('#month'+sno).val();
             var year= $(this).parent('td').parent('tr').find('#year'+sno).val();
             var fp1= $(this).parent('td').parent('tr').find('#firsttpay'+sno).val();
             var FP= fp1.replace('$','');
              FP= parseInt(FP);
             $(this).parent('td').parent('tr').find('#save').prop('disabled', false);


             /*console.log(month);
             console.log(year);
             console.log(id);*/
            $.ajax({
            type: "post",
            url:"<?=base_url();?>recentpay",
            cache: false,
            dataType:"json",
            data:{id:id,month:month, year:year},

            success: function(json)
            {
           /*   //console.log(json);
              console.log(json[0].onestpay);
              console.log(json[0].onefivethpay);*/
             
             $('#secondpay'+sno).val('$'+parseInt(json[0].onefivethpay));
             var temp11=parseInt(json[0].onefivethpay)+FP;
             $('#total'+sno).val('$'+temp11);
             
            }
         });
        });



$(document).on("click","#lastmonthfirstpay",function(){

             var sno = $(this).parent('td').parent('tr').find('#sno').val();
             var id = $(this).parent('td').parent('tr').find('#idd').val();
             var month = $(this).parent('td').parent('tr').find('#month'+sno).val();
             var year= $(this).parent('td').parent('tr').find('#year'+sno).val();

             var fp1= $(this).parent('td').parent('tr').find('#secondpay'+sno).val();
             var FP= fp1.replace('$','');
              FP= parseInt(FP);
              if(FP==''){
                FP=0;
              }


             $(this).parent('td').parent('tr').find('#save').prop('disabled', false);


             /*console.log(month);
             console.log(year);
             console.log(id);*/
            $.ajax({
            type: "post",
            url:"<?=base_url();?>recentpay",
            cache: false,
            dataType:"json",
            data:{id:id,month:month, year:year},

            success: function(json)
            {
           /*   //console.log(json);
              console.log(json[0].onestpay);
              console.log(json[0].onefivethpay);*/

              $('#firsttpay'+sno).val('$'+parseInt(json[0].onestpay));
             var temp12=parseInt(json[0].onestpay)+FP;
             $('#total'+sno).val('$'+temp12);


            /* 
             $('#firsttpay'+sno).val('$'+json[0].onestpay);
             $('#total'+sno).val('$'+json[0].onestpay);*/
             
            }
         });
        });

        $(document).on("click", "#mislenous_add", function() { 

          $('#mislenous_add').hide();
          mis_markup="<tr> <td></td> <td></td><<td></td>t<td></td> <td><input type='text' id='misname' /> </td> <td><input type='text' id='misfirst' class='mislenous' value='0'/> </td> <td><input type='text' id='missecond' class='mislenous' value='0' /> </td> <td><input type='text' id='mistotal' value='0' readonly/> </td> <td> <button class='btn btn-primary buttonsave' id='mislenous_save'>save</button> </td> </tr>";
          $('#mislenous').append('<br>');
         $('#mislenous').append(mis_markup);


         $("input.mislenous").on("keyup", function() {

          var mis_first = $(this).parent('td').parent('tr').find('#misfirst').val();
          var mis_second = $(this).parent('td').parent('tr').find('#missecond').val();

          var result = parseFloat(mis_first) + parseFloat(mis_second);

          if (!isNaN(result)) {

              $('#mistotal').val(result);
    
            }

         })

        });    


           $(document).on("click", "#mislenous_save", function() { 


           var mis_month="<?php echo $this->uri->segment(2);?>";
           var mis_yesr = "<?php echo $_GET['var1']; ?>";
           var mis_name = $(this).parent('td').parent('tr').find('#misname').val();
           var mis_first = $(this).parent('td').parent('tr').find('#misfirst').val();
           var mis_second= $(this).parent('td').parent('tr').find('#missecond').val();
           var mis_totalamount= $(this).parent('td').parent('tr').find('#mistotal').val();
           
              

          $.ajax({
           type: "post",
           url: "<?= base_url();?>mislenous",
           cache: false,    
           data: {first:mis_first, second:mis_second, totalamount:mis_totalamount, month:mis_month, year:mis_yesr,name:mis_name},
           success: function(json){    
            alert('Saved Miscellaneous');
            location.reload();
          } 
          });
         
         });



      $("input.mis_pay").on("keyup", function() {

           $('#mislenous_update').show(); 
           var num = $(this).parent('td').parent('tr').find('#mis_sno').val();
           var mis_first = $(this).parent('td').parent('tr').find('#misfirst'+num).val();
           var mis_second= $(this).parent('td').parent('tr').find('#missecond'+num).val();
 
          var result = parseFloat(mis_first) + parseFloat(mis_second);

          if (!isNaN(result)) {

              $('#mistotal'+num).val(result);
    
            }

         })




   $(document).on("click", "#mislenous_update", function() { 


           var mis_month="<?php echo $this->uri->segment(2);?>";
           var mis_yesr = "<?php echo $_GET['var1']; ?>";
           var num = $(this).parent('td').parent('tr').find('#mis_sno').val();
           var id = $(this).parent('td').parent('tr').find('#mis_id').val();
           var mis_name = $(this).parent('td').parent('tr').find('#misname'+num).val();
           var mis_first = $(this).parent('td').parent('tr').find('#misfirst'+num).val();
           var mis_second= $(this).parent('td').parent('tr').find('#missecond'+num).val();
           var mis_totalamount= $(this).parent('td').parent('tr').find('#mistotal'+num).val();
           
          $.ajax({
           type: "post",
           url: "<?= base_url();?>mislenous_update",
           cache: false,    
           data: {id:id,first:mis_first, second:mis_second, totalamount:mis_totalamount, month:mis_month, year:mis_yesr,name:mis_name},
           success: function(json){    
            alert('Updated Miscellaneous');
            location.reload();
          } 
          });
         
         });

   $(document).on("click", "#mislenous_delete", function() { 

           
           var id = $(this).parent('td').parent('tr').find('#mis_id').val();
         
           
          $.ajax({
           type: "post",
           url: "<?= base_url();?>delete_mislenous",
           cache: false,    
           data: {id:id},
           success: function(json){    
            alert('Deleted Miscellaneous');

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
