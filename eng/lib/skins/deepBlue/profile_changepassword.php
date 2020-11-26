<section class="page-contents">
<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="container">
<br />
<div class="row">
  <div class="col-lg-12">
        <div class="card w-200">
        <h5 class="card-header" style="background-color: #0A1437;"><b><font color="#FFFFFF"><i class="fa fa-pencil" fa-lg style="color:#FFFFFF"></i> Cambiar la contraseña</font></b></h5>
        <div class="card-body">
		<form action="<?php echo url('/profile');?>" method="post">
			<dl>

				<dt>Ingresa tu nueva contraseña</dt>
				<dd><input type="password" class="form-control" id="password" name="password1" value="" /></dd>
				
				<dt>Repite tu nueva contraseña</dt>
				<dd><input type="password" class="form-control" name="password2" value="" /></dd>
				
				<dt>Ingresa tu anterior contraseña</dt>
				<dd><input type="password" class="form-control" name="oldpassword" /></dd>
				
				<dt></dt>
				<dd><input type="hidden" name="action" value="changepassword" />
					<input type="submit" name="submit" class="btn btn-success" value="Cambiar" />
				</dd>
			</dl>
			</form>		
	<div class="col-sm-1">
  </div>
	</div>
</section>