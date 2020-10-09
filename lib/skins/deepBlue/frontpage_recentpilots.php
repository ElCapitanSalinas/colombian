<table class="deepBlue_table"width="100%" cellspacing="0" cellpadding="1px">

 <tbody>
<?php

foreach($pilots as $pilot)
{
?>


<tr>
<td><a href="<?php echo url('/profile/view/'.$pilot->pilotid);?>"><?php echo PilotData::GetPilotCode($pilot->code, $pilot->pilotid);?> <a href="<?php echo url('/profile/view/'.$pilot->pilotid);?>"><b><?php echo $pilot->firstname . ' ' . $pilot->lastname?></b></a>
	</td>
	<td>
<img src="<?php echo SITE_URL;?>/lib/images/countries/<?php echo strtolower($pilot->location);?>.png" alt="" />
</td>
</tr>
<?php
}
?>
 </tbody>
</table>
<!--  Begin Application Open -->
<?php 
if(Auth::LoggedIn() == false)
{
?>
<div align="center">
<div class="alert alert-success">
  Aplicaciones: <strong>ABIERTAS</strong><br />
<a href="<?php echo SITE_URL ?>/index.php/Join"><strong>Unete hoy!</strong></a>
</div>
</div>

<!--  End Application Open -->

<!--  Begin Application Closed -->
<!--
<div align="center">
<div class="alert alert-danger">
  Aplicaciones: <strong>Cerradas</strong><br />
</div>
</div>

<!--  End Application Closed -->
    <?php
  }
 ?>