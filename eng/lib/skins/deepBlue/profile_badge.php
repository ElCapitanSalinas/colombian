<section class="page-contents">
<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="container">
<br />
<div class="row">
  <div class="col-lg-12">
        <div class="card w-200">
        <h5 class="card-header" style="background-color: #0A1437;"><b><font color="#FFFFFF"><i class="fa fa-certificate" fa-lg style="color:#FFFFFF"></i> Firma del piloto</font></b></h5>
        <div class="card-body">
		<p align="center">
	<img src="<?php echo $badge_url ?>" />
		</p>
		<p>
			<strong>Link directo:</strong>
			<input onclick="this.select()" type="text" class="form-control" value="<?php echo $badge_url ?>" style="width: 100%" />
			<br />
			<strong>Link de imagen:</strong>
			<input onclick="this.select()" type="text" class="form-control" value='<img src="<?php echo $badge_url ?>" />' style="width: 100%" />
			<br />
			<strong>BBCode:</strong>
			<input onclick="this.select()" type="text" class="form-control" value='[img]<?php echo $badge_url ?>[/img]' style="width: 100%" />
		</p>		
	<div class="col-sm-1">
  </div>
	</div>
</section>
