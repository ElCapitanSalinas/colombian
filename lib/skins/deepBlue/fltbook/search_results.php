<?php
$pilotid = Auth::$userinfo->pilotid;
$last_location 	= FltbookData::getLocation($pilotid);
$last_name = OperationsData::getAirportInfo($last_location->arricao);
?>
<!-- Bootstrap - Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Pagination => Enable it via the module settings -->

<style>
div.dataTables_paginate {
  float: right;
	margin-top: -25px;
}
div.dataTables_length {
    float: left;
    margin: 0;
}
div.dataTables_filter {
    float: right;
    margin: 0;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script type="text/javascript" src="<?php echo fileurl('/lib/js/jquery.dataTables.js');?>"></script>
<script type="text/javascript" src="<?php echo fileurl('/lib/js/datatables.js');?>"></script>
<script type="text/javascript" src="<?php echo fileurl('/lib/js/dataTables.bootstrap.min.js');?>"></script>
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
  $('schedules_table').dataTable( {
  "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]
} )});
</script>
<!-- Latest compiled and minified JavaScript - Modified to clear modal on data-dismiss -->
<script type="text/javascript" src="<?php echo SITE_URL; ?>/lib/js/bootstrap.js"></script>

<br />
<section class="page-contents">
<div class="container">
<br />
<div class="row">
  <div class="col-lg-12">
        <div class="card w-200">
        <h5 class="card-header" style="background-color: #0A1437;"><b><font color="#FFFFFF"><i class="fa fa-star" fa-lg style="color:#FFFFFF"></i> Buscar </font></b></h5>
        <div class="card-body">
        <br>
        <table id="schedules_table" class="table table-striped table-bordered table-hover" width="100%">
<?php
if(!$allroutes) {
	echo '<tr><td align="center">No flights found!</td></tr>';
} else {
?>
<thead>
	<tr id="tablehead">
	    <th>Aerolinea</th>
	    <th>Numero de vuelo</th>
	    <th>Origen</th>
	    <th>Destino</th>
	    <th>Aeronave</th>
	    <th>Opciones</th>
	    <?php if($settings['show_details_button'] == 1) { ?>
	    <th style="display: none;">Detalles</th>
	    <?php } ?>
	</tr>
</thead>
<tbody>
<?php
foreach($allroutes as $route) {
	if($settings['disabled_ac_sched_show'] == 0) {
		# Disable 'fake' aircraft to get hide a lot of schedules at once
		$aircraft = FltbookData::getAircraftByID($route->aircraftid);
		if($aircraft->enabled != 1) {
			continue;
		}
	}

	if(Config::Get('RESTRICT_AIRCRAFT_RANKS') == 1 && Auth::LoggedIn()) {
		if($route->aircraftlevel > Auth::$userinfo->ranklevel) {
			continue;
		}
	}
?>
<tr style="height: 12px; font-size: 14px; font-weight: normal;">
	<td width="16.5%" valign="middle"><img src="<?php echo SITE_URL; ?>/lib/images/airlinelogos/<?php echo $route->code;?>.png" alt="<?php echo $route->code;?>"></td>
	<td width="16.5%" align="center" valign="middle"><?php echo $route->code . $route->flightnum?></td>
	<td width="16.5%" align="center" valign="middle"><?php echo $route->depicao ;?></td>
	<td width="16.5%" align="center" valign="middle"><?php echo $route->arricao ;?></td>
	<td width="16.5%" valign="middle"><?php echo $route->aircraft ;?>
    	<div class="vertical-align-text pull-right" style="padding-left: 6px;">
        <div class="font-small pull-right"><?php echo $route->flighttime; ?>h</div>
        <div class="font-small"><?php echo round($route->distance, 0, PHP_ROUND_HALF_UP); ?>nm</div>
    </div>
  </td>
  <td width="16.5%" align="center" valign="middle">
	 <?php if($settings['show_details_button'] == 1) { ?>
	 <input type="button" value="Detalles" class="btn btn-warning" onclick="$('#details_<?php echo $route->flightnum;?>').toggle()">
	 <?php } ?>
	 <?php
	 $aircraft = OperationsData::getAircraftInfo($route->aircraftid);
	 $acbidded = FltbookData::getBidByAircraft($aircraft->id);
	 $check    = SchedulesData::getBidWithRoute(Auth::$userinfo->pilotid, $route->code, $route->flightnum);

	if(Config::Get('DISABLE_SCHED_ON_BID') == true && $route->bidid != 0) {
		 echo '<div class="btn btn-danger btn-sm disabled">Agendado</div>';
	 } elseif($check) {
		 echo '<div class="btn btn-danger btn-sm disabled">Agendado</div>';
	 } else {
		 echo '<a data-toggle="modal" href="'.SITE_URL.'/action.php/Fltbook/confirm?id='.$route->id.'&airline='.$route->code.'&aicao='.$route->aircrafticao.'" data-target="#confirm" class="btn btn-success btn-md">Agendar</a>';
	 }
	 ?>
  </td>
<?php if($settings['show_details_button'] == 1) { ?>
<td colspan="6" id="details_<?php echo $route->flightnum; ?>" style="display: none;" width="100%">
	<table class="table table-striped">
		<tr>
			<th align="center" bgcolor="black" colspan="6"><font color="white">Planeación del vuelo</font></th>
		</tr>
		<tr>
			<td>Salida:</td>
			<td colspan="2"><strong>
				<?php
				$name = OperationsData::getAirportInfo($route->depicao);
				echo "{$name->name}";
				?></strong>
			</td>
			<td>Llegada:</td>
			<td colspan="2"><strong>
				<?php
				$name = OperationsData::getAirportInfo($route->arricao);
				echo "{$name->name}";
				?></strong>
			</td>
		</tr>
		<tr>
			<td>Aeronave</td>
			<td colspan="2"><strong>
				<?php
				$plane = OperationsData::getAircraftByName($route->aircraft);
				echo $plane->fullname;
				?></strong>
			</td>
			<td>Distancia:</td>
			<td colspan="2"><strong><?php echo $route->distance.Config::Get('UNITS'); ?></strong></td>
		</tr>
		<tr>
			<td>Hora de salida:</td>
			<td colspan="2"><strong><font color="red"><?php echo $route->deptime?> UTC</font></strong></td>
			<td>Hora de llegada:</td>
			<td colspan="2"><strong><font color="red"><?php echo $route->arrtime?> UTC</font></strong></td>
		</tr>
		<tr>
			<td>Altitud:</td>
			<td colspan="2"><strong><?php echo $route->flightlevel; ?> ft</strong></td>
			<td>Duración:</td>
			<td colspan="2">
				<font color="red">
				<strong>
				<?php
				$dist = $route->distance;
				$speed = 440;
				$app = $speed / 60;
				$flttime = round($dist / $app,0) + 20;
				$hours = intval($flttime / 60);
				$minutes = (($flttime / 60) - $hours) * 60;

				if($hours > "9" AND $minutes > "9") {
					echo $hours.':'.$minutes ;
				} else {
					echo '0'.$hours.':0'.$minutes ;
				}
				?> Hrs
				</strong>
			</font>
			</td>
		</tr>
		<tr>
			<td>Días:</td>
			<td colspan="2"><strong><?php echo Util::GetDaysLong($route->daysofweek); ?></strong></td>
			<td>Precio del tiquete:</td>
			<td colspan="2"><strong>$<?php echo $route->price ;?>.00</strong></td>
		</tr>
		<tr>
			<td>Tipo de vuelo:</td>
			<td colspan="2"><strong>
			<?php
			if($route->flighttype == "P") {
				echo 'Pasajeros';
			} elseif($route->flighttype == "C") {
				echo 'Carga';
			} elseif($route->flighttype == "H") {
				echo 'Charter';
			} else {
				echo 'Pasajeros';
			}
			?>
			</strong></td>
			<td>Veces volado</td>
			<td colspan="2"><strong><?php echo $route->timesflown ;?></strong></td>
		</tr>
		 <tr>
			<th align="center" bgcolor="black" colspan="6"><font color="white">Mapa</font></th>
		 </tr>
		 <tr>
			<td width="100%" colspan="6">
			<?php
			$string = "";
			$string = $string.$route->depicao.'+-+'.$route->arricao.',+';
			?>
			<img width="100%" src="http://www.gcmap.com/map?P=<?php echo $string ?>&amp;MS=bm&amp;MR=240&amp;MX=680x200&amp;PM=pemr:diamond7:red%2b%22%25I%22:red&amp;PC=%230000ff" />
		</tr>
	</table>
</td>
<?php } ?>
</tr>
<div class="modal fade" id="confirm">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>
<?php
/* END OF ONE TABLE ROW */
}
}
?>
</tbody>
</table>
</div>
<hr>
<center><a href="<?php echo url('/Fltbook') ;?>"><input type="submit" class="btn btn-primary" name="submit" value="Back to Flight Booking" ></a></center></div>
<br />
        </div>
      </div>
    </div>
</section>


