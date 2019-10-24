<?php

$curYear = date('Y'); 
?>

<div class="container" >
<div class="container-fluid">
<div class="col-sm-9">

	<table> 

	
<tr><td>  <a href="<?=base_url()?>month/?var1=<?=$curYear?>"><font size="5"> Payroll for the year <?= $curYear ?></font> </a> <br><br> </td></tr>
<tr><td>     <a href="<?=base_url()?>month/?var1=<?=$curYear-1?>"><font size="5">Payroll for the year <?= $curYear-1 ?></font> </a> <br><br> </td></tr>
 <tr><td>  <a href="<?=base_url()?>month/?var1=<?=$curYear-2?>"><font size="5">Payroll for the year <?= $curYear-2 ?></font> </a> </td></tr>

</table>

</div>
</div>
</div>