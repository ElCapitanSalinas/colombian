<section class="page-contents">
<div class="container">
<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<br />
<div class="row">
  <div class="col-sm-1">
  </div>
  <div class="col-lg-10">
        <div class="card w-175">
        <h5 class="card-header" style="background-color: #0A1437;"><b><font color="#FFFFFF"><i class="fa fa-book" fa-lg style="color:#FFFFFF"></i> Enviar un reporte</font></b></h5>
        <div class="card-body">
		<?php
if(isset($message))
	echo '<div id="error">'.$message.'</div>';
?>
<form action="<?php echo url('/pireps/mine');?>" method="post">
<dl>
	<dt>Piloto:</dt>
	<dd><strong><?php echo Auth::$pilot->firstname . ' ' . Auth::$pilot->lastname;?></strong></dd>

	<dt>Seleccionar Filial:</dt>
	<dd>
		<select name="code"  class="form-control" id="code">
			<option value="">Seleccione su filial</option>
		<?php
		foreach($airline_list as $airline) {
			$sel = ($_POST['code'] == $airline->code || $bid->code == $airline->code)?'selected':'';
			echo '<option value="'.$airline->code.'" '.$sel.'>'.$airline->code.' - '.$airline->name.'</option>';
		}
		?>
		</select>
	</dd>

	<dt>Número de vuelo:</dt>
	<dd><input type="text" class="form-control" name="flightnum" value="<?php if(isset($bid->flightnum)) { echo $bid->flightnum; }?><?php if(isset($_POST['flightnum'])) { echo $_POST['flightnum'];} ?>" /></dd>

	<dt>Selecciona el aeropuerto de salida:</dt>
	<dd>
		<div id="depairport">
		<select id="depicao" class="form-control" name="depicao">
			<option value="">Selecciona un aeropuerto de salida</option>
			<?php
			foreach($airport_list as $airport) {
				$sel = ($_POST['depicao'] == $airport->icao || $bid->depicao == $airport->icao)?'selected':'';
				echo '<option value="'.$airport->icao.'" '.$sel.'>'.$airport->icao . ' - '.$airport->name .'</option>';
			}
			?>
		</select>
		</div>
	</dd>

	<dt>Selecciona el aeropuerto de llegada:</dt>
	<dd>
		<div id="arrairport">
		<select id="arricao" class="form-control" name="arricao">
			<option value="">Selecciona un aeropuerto de llegada</option>
			<?php
			foreach($airport_list as $airport) {
				$sel = ($_POST['arricao'] == $airport->icao || $bid->arricao == $airport->icao)?'selected':'';
				echo '<option value="'.$airport->icao.'" '.$sel.'>'.$airport->icao . ' - '.$airport->name .'</option>';
			}
			?>
		</select>
		</div>
	</dd>

	<dt>Selecciona la aeronave:</dt>
	<dd>
		<select name="aircraft" class="form-control" id="aircraft">
			<option value="">Selecciona la aeronave que utilizaste para este vuelo</option>
		<?php

		foreach($aircraft_list as $aircraft)
		{
			$sel = ($_POST['aircraft'] == $aircraft->name || $bid->registration == $aircraft->registration)?'selected':'';
			echo '<option value="'.$aircraft->id.'" '.$sel.'>'.$aircraft->name.' - '.$aircraft->registration.'</option>';
		}
		?>
		</select>
	</dd>

	<?php
	// List all of the custom PIREP fields
	if(!$pirepfields) $pirepfields = array();
	foreach($pirepfields as $field)
	{
	?>
		<dt><?php echo $field->title ?></dt>
		<dd>
		<?php

		// Determine field by the type

		if($field->type == '' || $field->type == 'text') {
		?>
			<input type="text" name="<?php echo $field->name ?>" value="<?php echo $_POST[$field->name] ?>" />
		<?php
		}  elseif($field->type == 'textarea') {
			echo '<textarea name="'.$field->name.'">'.$field->values.'</textarea>';
		} elseif($field->type == 'dropdown') {
			$values = explode(',', $field->options);

			echo '<select class="form-control" name="'.$field->name.'">';
			foreach($values as $value) {
				$value = trim($value);
				echo '<option value="'.$value.'">'.$value.'</option>';
			}
			echo '</select>';
		}
		?>

		</dd>
	<?php
	}
	?>

	<dt>Combustible Utilizado:</dt>
	<dd><input type="text" class="form-control" name="fuelused" value="<?php echo $_POST['fuelused']; ?>" />
		<p>Combustible utilizado en <?php echo Config::Get('LIQUID_UNIT_NAMES', Config::Get('LiquidUnit'))?></p></dd>

	<dt>Tiempo de vuelo</dt>
	<dd><input type="text" class="form-control" name="flighttime" value="<?php echo $_POST['flighttime'] ?>" />
		<p>Ingresar en horas - "5.30" son 5 horas y 30 minutos</p></dd>

	<dt>Ruta</dt>
	<dd><textarea name="route" class="form-control" style="width: 100%"><?php echo (!isset($_POST['route'])) ? $bid->route : $_POST['route']; ?></textarea>
		<p>Ingresa la ruta volada, se agregará automaticamente la del itinerario</p></dd>

	<dt>Comentarios:</dt>
	<dd><textarea name="comment" class="form-control" style="width: 100%"><?php echo $_POST['comment'] ?></textarea></dd>

	<dt></dt>
	<dd><?php $bidid = ( isset($bid) )? $bid->bidid:$_POST['bid']; ?>
		<input type="hidden" name="bid" value="<?php echo $bidid ?>" />
		<input type="submit" class="deepBlue-button" name="submit_pirep" value="File Flight Report" /></dd>
</dl>

</form>
	</div>
</section>