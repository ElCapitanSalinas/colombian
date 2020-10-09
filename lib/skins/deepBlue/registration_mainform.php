<section class="page-contents">
<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="container">
<br />
<div class="row">
  <div class="col-lg-12">
        <div class="card w-200">
        <h5 class="card-header" style="background-color: #0A1437;"><b><font color="#FFFFFF"><i class="fa fa-user" fa-lg style="color:#FFFFFF"></i> Registro</font></b></h5>
        <div class="card-body">
		<p align="center">
		<p>Welcome to the registration form for <?php echo SITE_NAME; ?>. After you register, you will be notified by a staff member about your membership.</p>
			<form method="post" action="<?php echo url('/registration');?>">
			<dl>
				<dt>Nombre: *</dt>
				<dd><input type="text" class="form-control" name="firstname" value="<?php echo Vars::POST('firstname');?>" />
					<?php
						if($firstname_error == true)
							echo '<p class="error">Por favor, ingrese un nombre</p>';
					?>
				</dd>

				<dt>Apellido: *</dt>
				<dd><input type="text" name="lastname" class="form-control" value="<?php echo Vars::POST('lastname');?>" />
					<?php
						if($lastname_error == true)
							echo '<p class="error">Por favor, ingrese un apellido</p>';
					?>
				</dd>

				<dt>Correo: *</dt>
				<dd><input type="text" name="email" class="form-control" value="<?php echo Vars::POST('email');?>" />
					<?php
						if($email_error == true)
							echo '<p class="error">Por favor, ingrese un email</p>';
					?>
				</dd>

				<dt>Selecciona Filial: *</dt>
				<dd>
					<select name="code" class="form-control" id="code">
					<?php
					foreach($airline_list as $airline) {
						echo '<option value="'.$airline->code.'">'.$airline->code.' - '.$airline->name.'</option>';
					}
					?>
					</select>
				</dd>

				<dt>Hub: *</dt>
				<dd>
					<select name="hub" class="form-control" id="hub">
					<?php
					foreach($hub_list as $hub) {
						echo '<option value="'.$hub->icao.'">'.$hub->icao.' - ' . $hub->name .'</option>';
					}
					?>
					</select>
				</dd>

				<dt>Ubicación: *</dt>
				<dd><select class="form-control" name="location">
					<?php
						foreach($country_list as $countryCode=>$countryName) {
							if(Vars::POST('location') == $countryCode) {
								$sel = 'selected="selected"';
							} else {
								$sel = '';
							}

							echo '<option value="'.$countryCode.'" '.$sel.'>'.$countryName.'</option>';
						}
					?>
					</select>
					<?php
						if($location_error == true) {
							echo '<p class="error">Por favor, ingrese una ubicación</p>';
						}
					?>
				</dd>

				<dt>Contraseña: *</dt>
				<dd><input id="password" class="form-control" type="password" name="password1" value="" /></dd>

				<dt>Introduce la contraseña de nuevo: *</dt>
				<dd><input type="password" class="form-control" name="password2" value="" />
					<?php
						if($password_error != '')
							echo '<p class="error">'.$password_error.'</p>';
					?>
				</dd>

				<?php

				//Put this in a seperate template. Shows the Custom Fields for registration
				Template::Show('registration_customfields.tpl');

				?>

				<dt>reCaptcha</dt>
				<dd>
						<?php if(isset($captcha_error)){echo '<p class="error">'.$captcha_error.'</p>';} ?>
						<div class="g-recaptcha" data-sitekey="<?php echo $sitekey;?>"></div>
						<script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=<?php echo $lang;?>">
						</script>
				</dd>

				<dt></dt>
				<dd><p>By clicking register, you're agreeing to the terms and conditions</p></dd>
				<dt></dt>
				<dd><input type="submit" name="submit" class="btn btn-success" value="Registrar" /></dd>
			</dl>
			</form>
		
	<div class="col-sm-1">
  </div>
	</div>
</section>


<section class="page-contents">
<div class="container">
<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<h3>Registration</h3>
</div>
</section>

