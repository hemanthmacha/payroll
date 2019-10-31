<html>
<head>
<title>Employee List</title>
<link rel="stylesheet" href="<?=base_url('assests/css/payroll.css')?>">


</head>

<body>
  <?php require_once 'header.php'; ?>
  <div class="container-flud">
    <div class="content"> 
    <div class="row"> 
    <div class="col-sm-4">
      
   <?php if(!empty($data)){ ?>

<table class="table text-center" align="center" id="customers">
<tr>
      <th>Sno</th>  
      <th>First Name</th>
      <th>Last Name</th>
</tr>


   <?php $i=0; foreach($data as $key=>$val){ $i++;?>
  <tr>
      <input type="hidden" id="idd" value="<?=$val->id?>">
      <td><?php echo $i; ?></td>  
      <td id="firstname"><a href="<?=base_url()?>list/?var1=<?=$val->id?>&var2=<?=$val->firstname?>&var3=<?=$val->lastname?>"><?=$val->firstname?></a></td> 
      <td id="lastname"><?=$val->lastname?></td> 
       <td> <button class="btn btn-primary buttonsave" id="Delete" >Delete</button></td>
  </tr>

    <?php } ?>
</table>
  <?php } ?>

  <style type="text/css">
  .buttonsave{
    height: 23px;
    padding:0px 9px;

  }
</style>

<script type="text/javascript">

  $(document).on("click", "#Delete", function(){

     var id = $(this).parent('td').parent('tr').find('#idd').val();

     $.ajax({
    type:'POST',
    url:"<?= base_url();?>deleteemployeelist",
    data:{id:id},
    success: function(json){
          alert('Employee Deleted ');
           location.reload();
       }

       });

  });
  



</script>


</div>
</div> 
</div>
</div>


</body>
</html>
