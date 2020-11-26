<section class="page-contents">
<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="container">
<br />
<div class="row">
  <div class="col-lg-12">
        <div class="card w-200">
        <h5 class="card-header" style="background-color: #0A1437;"><b><font color="#FFFFFF"><i class="fa fa-pencil" fa-lg style="color:#FFFFFF"></i> Editar perfil</font></b></h5>
        <div class="card-body">
		<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
		<form action="<?php echo url('/profile');?>" method="post" enctype="multipart/form-data">
<dl>
	<dt>Nombre</dt>
	<dd><?php echo $pilot->firstname . ' ' . $pilot->lastname;?></dd>
	
	<dt>Aerolínea</dt>
	<dd><?php echo $pilot->code?>
		<p>Para solicitar un cambio, contacte a un administrador para el cambio</p>
	</dd>
	
	<dt>Correo electronico</dt>
	<dd><input type="text" name="email" class="form-control" value="<?php echo $pilot->email;?>" />
		<?php
			if(isset($email_error) && $email_error == true)
				echo '<p class="error">Por favor ingrese un correo válido</p>';
		?>
	</dd>
	
	<dt>Ubicación</dt>
	<dd><select class="form-control" name="location">
		<?php
		foreach($countries as $countryCode=>$countryName)
		{
			if($pilot->location == $countryCode)
				$sel = 'selected="selected"';
			else	
				$sel = '';
			
			echo '<option value="'.$countryCode.'" '.$sel.'>'.$countryName.'</option>';
		}
		?>
		</select>
		<?php
			if(isset($location_error) &&  $location_error == true)
				echo '<p class="error">Por favor, ingrese su ubicación</p>';
		?>
	</dd>
	
	<dt>Fondo de la firma</dt>
	<dd><select name="bgimage" class="form-control">
		<?php
		foreach($bgimages as $image)
		{
			if($pilot->bgimage == $image)
				$sel = 'selected="selected"';
			else	
				$sel = '';
			
			echo '<option value="'.$image.'" '.$sel.'>'.$image.'</option>';
		}
		?>
		</select>
	</dd>
	
	<?php
	if($customfields) {
		foreach($customfields as $field) {
			echo '<dt>'.$field->title.'</dt>
				  <dd>';
			
			if($field->type == 'dropdown') {
				$field_values = SettingsData::GetField($field->fieldid);				
				$values = explode(',', $field_values->value);
				
				
				echo "<select name=\"{$field->fieldname}\">";
			
				if(is_array($values)) {		
				    
					foreach($values as $val) {
						$val = trim($val);
						
						if($val == $field->value)
							$sel = " selected ";
						else
							$sel = '';
						
						echo "<option value=\"{$val}\" {$sel}>{$val}</option>";
					}
				}
				
				echo '</select>';
			} elseif($field->type == 'textarea') {
				echo '<textarea class="customfield_textarea"></textarea>';
			} else {
				echo '<input type="text" name="'.$field->fieldname.'" value="'.$field->value.'" />';
			}
			
			echo '</dd>';
		}
	}
	?>
	
	<dt>Avatar:</dt>
	<dd><input type="hidden" name="MAX_FILE_SIZE" value="<?php echo Config::Get('AVATAR_FILE_SIZE');?>" />
		<input type="file" name="avatar" size="40"> 
		<p>La imagen tiene que tener <?php echo Config::Get('AVATAR_MAX_HEIGHT').'x'.Config::Get('AVATAR_MAX_WIDTH');?>px</p>
	</dd>
	<dt>Avatar actual:</dt>
	<dd><?php	
			if(!file_exists(SITE_ROOT.AVATAR_PATH.'/'.$pilotcode.'.png')) {
				echo 'None selected';
			} else {
		?>
			<img src="<?php	echo SITE_URL.AVATAR_PATH.'/'.$pilotcode.'.png';?>" /></dd>
		<?php
		}
		?>
	<dt></dt>
	<br />
	<dd><input type="hidden" name="action" value="saveprofile" />
		<input type="submit" class="btn btn-success" name="submit" value="Save Changes" /></dd>
</dl>
</form>
	<div class="col-sm-1">
  </div>
	</div>
</section>