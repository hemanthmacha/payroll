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


   <?php $i=1; foreach($data as $key=>$val){?>
  <tr>
      <td><?= $i++;?></td>  
      <td><a href="<?=base_url()?>list/?var1=<?=$val->id?>&var2=<?=$val->firstname?>&var3=<?=$val->lastname?>"><?=$val->firstname?></a></td> 
      <td><?=$val->lastname?></td> 
  </tr>

    <?php } ?>
</table>
  <?php } ?>
</div>
</div> </div>
</div>


</body>
</html>