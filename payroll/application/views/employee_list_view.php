<?php if($this->session->userdata('role') == 'admin') { ?> 
<html>
<head>
<title>Employee List</title>
<link rel="stylesheet" href="<?=base_url('assests/css/payroll.css')?>">


</head>

<body>
  <?php require_once 'header.php'; ?>
  <div class="container-flud">
     <div class="ex1">     
      <a href="<?= base_url();?>addemp" style="color: white;"><button id="add">Add employee</button></a>
     </div>

    <div class="content"> 
    <div class="row"> 
    <div class="col-sm-6">
      
   <?php if(!empty($active) || !empty($inter) || !empty($complete) || !empty($inactive) || !empty($left)){ $act==0; $in==0; $leftc==0; $com=0; $inact=0;?>

<table class="table text-center" align="center" id="customers">
<tr>
      <th>Sno</th>  
      <th>First Name</th>
      <th>Last Name</th>
      <th>Category</th>
      <th></th>
</tr>


<?php $i=1; foreach($active as $key=>$val){?>
   
   <?php if($act==0){ $act=1; ?><tr> 
      <td><h4>Active</h4> 
   </tr>
  <?php } ?>

  <tr> 
      <input type="hidden" id="idd" value="<?=$val->id?>">
      <td><?= $i++;?></td>  
      <td><a href="<?=base_url()?>list/?var1=<?=$val->id?>&var2=<?=$val->firstname?>&var3=<?=$val->lastname?>"><?=$val->firstname?></a></td> 
      <td><?=$val->lastname?></td>
      <td>
        <select id="status" >
              <option value="Active" <?php if($val->status == 'Active') { echo 'selected'; } ?>>Active</option>
              <option value="Internal" <?php if($val->status == 'Internal') { echo 'selected'; } ?>>Internal</option>
              <option value="Project Completed" <?php if($val->status == 'Project Completed') { echo 'selected'; } ?>>Project Completed</option>
              <option value="Left Company" <?php if($val->status == 'Left Company') { echo 'selected'; } ?>>Left Company</option>
              <option value="Inactive" <?php if($val->status == 'Inactive') { echo 'selected'; } ?>>Inactive</option>
        </select>
      </td>
     <td> <button class="btn btn-primary buttonsave" id="save" >Save</button></td>


      <!-- <td> <button class="btn btn-primary buttonsave" id="delete" >Delete</button></td>  -->
  </tr>

    <?php } ?>




    <?php $i=1; foreach($inter as $key=>$val){?>
   
   <?php if($in==0){ $in=1; ?><tr> 
      <td><h4>Internal Employee</h4> 
   </tr>
  <?php } ?>

  <tr> 
      <input type="hidden" id="idd" value="<?=$val->id?>">
      <td><?= $i++;?></td>  
      <td><a href="<?=base_url()?>list/?var1=<?=$val->id?>&var2=<?=$val->firstname?>&var3=<?=$val->lastname?>"><?=$val->firstname?></a></td> 
      <td><?=$val->lastname?></td>
      <td>
        <select id="status" >
              <option value="Active" <?php if($val->status == 'Active') { echo 'selected'; } ?>>Active</option>
              <option value="Internal" <?php if($val->status == 'Internal') { echo 'selected'; } ?>>Internal</option>
              <option value="Project Completed" <?php if($val->status == 'Project Completed') { echo 'selected'; } ?>>Project Completed</option>
              <option value="Left Company" <?php if($val->status == 'Left Company') { echo 'selected'; } ?>>Left Company</option>
              <option value="Inactive" <?php if($val->status == 'Inactive') { echo 'selected'; } ?>>Inactive</option>
        </select>
      </td>
     <td> <button class="btn btn-primary buttonsave" id="save" >Save</button></td>


      <!-- <td> <button class="btn btn-primary buttonsave" id="delete" >Delete</button></td>  -->
  </tr>

    <?php } ?>




    <?php $i=1; foreach($complete as $key=>$val){?>
   
   <?php if($com==0){ $com=1; ?><tr> 
      <td><h4>Project Complete</h4> 
   </tr>
  <?php } ?>

  <tr> 
      <input type="hidden" id="idd" value="<?=$val->id?>">
      <td><?= $i++;?></td>  
      <td><a href="<?=base_url()?>list/?var1=<?=$val->id?>&var2=<?=$val->firstname?>&var3=<?=$val->lastname?>"><?=$val->firstname?></a></td> 
      <td><?=$val->lastname?></td>
      <td>
        <select id="status" >
              <option value="Active" <?php if($val->status == 'Active') { echo 'selected'; } ?>>Active</option>
              <option value="Internal" <?php if($val->status == 'Internal') { echo 'selected'; } ?>>Internal</option>
              <option value="Project Completed" <?php if($val->status == 'Project Completed') { echo 'selected'; } ?>>Project Completed</option>
              <option value="Left Company" <?php if($val->status == 'Left Company') { echo 'selected'; } ?>>Left Company</option>
              <option value="Inactive" <?php if($val->status == 'Inactive') { echo 'selected'; } ?>>Inactive</option>
        </select>
      </td>
     <td> <button class="btn btn-primary buttonsave" id="save" >Save</button></td>


      <!-- <td> <button class="btn btn-primary buttonsave" id="delete" >Delete</button></td>  -->
  </tr>

    <?php } ?>



    <?php $i=1; foreach($inactive as $key=>$val){?>
   
   <?php if($inact==0){ $inact=1; ?><tr> 
      <td><h4>Inactive</h4> 
   </tr>
  <?php } ?>

  <tr> 
      <input type="hidden" id="idd" value="<?=$val->id?>">
      <td><?= $i++;?></td>  
      <td><a href="<?=base_url()?>list/?var1=<?=$val->id?>&var2=<?=$val->firstname?>&var3=<?=$val->lastname?>"><?=$val->firstname?></a></td> 
      <td><?=$val->lastname?></td>
      <td>
        <select id="status" >
              <option value="Active" <?php if($val->status == 'Active') { echo 'selected'; } ?>>Active</option>
              <option value="Internal" <?php if($val->status == 'Internal') { echo 'selected'; } ?>>Internal</option>
              <option value="Project Completed" <?php if($val->status == 'Project Completed') { echo 'selected'; } ?>>Project Completed</option>
              <option value="Left Company" <?php if($val->status == 'Left Company') { echo 'selected'; } ?>>Left Company</option>
              <option value="Inactive" <?php if($val->status == 'Inactive') { echo 'selected'; } ?>>Inactive</option>
        </select>
      </td>
     <td> <button class="btn btn-primary buttonsave" id="save" >Save</button></td>


      <!-- <td> <button class="btn btn-primary buttonsave" id="delete" >Delete</button></td>  -->
  </tr>

    <?php } ?>





   
<?php $i=1; foreach($left as $key=>$val){?>
  
  <?php if($leftc==0){ $leftc=1; ?><tr> 
      <td><h4>Left Company</h4> 
   </tr>
  <?php } ?>
   <tr>     
      <input type="hidden" id="idd" value="<?=$val->id?>">
      <td><?= $i++;?></td>  
      <td><a href="<?=base_url()?>list/?var1=<?=$val->id?>&var2=<?=$val->firstname?>&var3=<?=$val->lastname?>"><?=$val->firstname?></a></td> 
      <td><?=$val->lastname?></td>
      <td>
        <select id="status" >
              <option value="Active" <?php if($val->status == 'Active') { echo 'selected'; } ?>>Active</option>
              <option value="Internal" <?php if($val->status == 'Internal') { echo 'selected'; } ?>>Internal</option>
              <option value="Project Completed" <?php if($val->status == 'Project Completed') { echo 'selected'; } ?>>Project Completed</option>
              <option value="Left Company" <?php if($val->status == 'Left Company') { echo 'selected'; } ?>>Left Company</option>
              <option value="Inactive" <?php if($val->status == 'Inactive') { echo 'selected'; } ?>>Inactive</option>
        </select>
      </td>
     <td> <button class="btn btn-primary buttonsave" id="save" >Save</button></td>


      <!-- <td> <button class="btn btn-primary buttonsave" id="delete" >Delete</button></td>  -->
  </tr>

    <?php } ?>




    <!-- <tr><td colspan="6" class="text-right"><span class="pagination"><?=$links?></span></td></tr> -->
</table>
  <?php } ?>
</div>
</div> </div>
</div>

<style type="text/css">
  .buttonsave{
    height: 23px;
    padding:0px 9px;
  }

  #add{
    background-color: #3486eb;
    height:30px;
    padding:0px 9px;
  }
  .ex1 {
  
  padding-left: 80%;
}

</style>



<script type="text/javascript">

  $(document).on("click","#save",function(){

     var id = $(this).parent('td').parent('tr').find('#idd').val();
     var status= $(this).parent('td').parent('tr').find('#status').val();
     /*console.log(id);
     console.log(status);*/

     $.ajax({
      type:'POST',
      url:"<?= base_url();?>saveemployeelist",
      data:{id:id , status:status},

       success: function(json){
          alert("status updated");
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
