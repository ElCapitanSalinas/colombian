<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<br>
<!-- Start Downloads -->
<?php
         if(!Auth::LoggedIn())
         {
            // Show these if they haven't logged in yet
         ?>
         <?php
         }
         else
         {
            // Show these items only if they are logged in
         ?>
          <div class="alert alert-success" role="alert">
          Bienvenido de nuevo! <b><?php echo Auth::$userinfo->firstname?></b>, ¡Disfruta de otro nivel en simulación!.
          </div>
            <?php
         }
         ?>
         <!-- End Downloads -->
<br>
<div class="row">
  <div class="col-lg-9">
        <div class="card w-175">
        <h5 class="card-header" style="background-color: #D82F2F;"><b><font color="#FFFFFF">Noticias Relevantes</font></b></h5>
        <div class="card-body">
              <p class="card-text"><?php

          // Show the News module, call the function ShowNewsFront
          //  This is in the modules/Frontpage folder

          MainController::Run('News', 'ShowNewsFront', 1);
          ?></p>
        </div>
      </div>
  </div>
  <div class="col-sm-3">
    <div class="card w-100">
    <h5 class="card-header" style="background-color: #D82F2F;"><b><font color="#FFFFFF">Estadísticas</font></b></h5>
      <div class="card-body">
        <p class="card-text">Pilotos activos: <b><?php echo StatsData::PilotCount(); ?></b></p>
        <hr>
        <p class="card-text">Horas voladas: <b><?php echo StatsData::TotalHours(); ?></b></p>
        <hr>
        <p class="card-text">Vuelos hechos: <b><?php echo StatsData::TotalFlights(); ?></b></p>
        <hr>
        <p class="card-text">Millas voladas: <b><?php echo StatsData::TotalMilesFlown(); ?></b></p>
        <hr>
        <p class="card-text">Vuelos hechos hoy: <b><?php echo StatsData::TotalFlightsToday(); ?></b></p>
        <hr>
        <p class="card-text">Pilotos en línea: <b><?php echo count(StatsData::UsersOnline()); ?></b></p>
        <hr>
        <p class="card-text">Rutas totales: <b><?php echo StatsData::TotalSchedules(); ?></b></p>
      </div>
    </div>
  </div>
</div>
<br>
<br>
<div class="row">
  <div class="col-sm-3">
    <div class="card w-100">
    <h5 class="card-header" style="background-color: #0A1437;"><b><font color="#FFFFFF">Pilotos nuevos</font></b></h5>
      <div class="card-body">
      <?php MainController::Run('Pilots', 'RecentFrontPage', 5); ?>
      </div>
    </div>
  </div>
  <div class="col-lg-9">
        <div class="card w-175">
        <h5 class="card-header" style="background-color: #0A1437;"><b><font color="#FFFFFF">Mapa en vivo</font></b></h5>
        <div class="card-body">
        <div class="deepBlue-blockcontent"><p>
        <div class="row">
	<div class="col-lg-8 col-md-12 col-12 col-sm-12">
		<div class="card">
			<div class="card-header">
				<h4>Live Map</h4>
			</div>
			<div class="card-body p-0">
				
        <?php MainController::Run('ACARS', 'index'); ?>
			</div>
		</div>

		<?php
			$lastbids = SchedulesData::GetAllBids();
			$countBids = (is_array($lastbids) ? count($lastbids) : 0);
		?>
		<div class="card">
			<div class="card-header">
				<h4>Upcoming Departure</h4>
				<div class="card-header-action">
					<?php if(!$countBids) { ?>
					<a href="javascript::" class="btn btn-info">No Departures</a>
					<?php } else { ?>
					<a href="javascript::" class="btn btn-success">Upcoming</a>
					<?php } ?>
				</div>
			</div>
			<div class="card-body">
				<?php if(!$countBids) { ?>
				<div class="alert alert-danger">
					<div class="alert-title">Oops</div>
					Looks like there are no upcoming departures at the moment, do you feel like flying? Click <a href="<?php echo SITE_URL?>/index.php/fltbook">here</a> to bid a flight!
				</div>
				<?php } else { ?>
			<div class="table-responsive">
				<table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>
                                <div align="center">Flight #</div>
                            </th>
                            <th>
                                <div align="center">Pilot</div>
                            </th>
                            <th>
                                <div align="center">Slot added on</div>
                            </th>
                            <th>
                                <div align="center">Slot Expires on</div>
                            </th>
                            <th>
                                <div align="center">Departure</div>
                            </th>
                            <th>
                                <div align="center">Arrival</div>
                            </th>
                            <th>
                                <div align="center">Registration</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
							foreach($lastbids as $lastbid) {
								$flightid = $lastbid->id
						?>
						<tr>
							<td height="25" width="10%" align="center"><font face="Bauhaus"><span><?php echo $lastbid->code; ?><?php echo $lastbid->flightnum; ?></span></font></td>
							<?php
								$params = $lastbid->pilotid;

								$pilot = PilotData::GetPilotData($params);
								$pname = $pilot->firstname;
								$psurname = $pilot->lastname;
								$now = strtotime(date('d-m-Y',strtotime($lastbid->dateadded)));
								$date = date("d-m-Y", strtotime('+48 hours', $now));
							?>
							<td height="25" width="10%" align="center"><span><?php echo '<a class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="Click to view Pilot Information!" href="  '.SITE_URL.'/index.php/profile/view/'.$pilot->pilotid.'">'.$pname.'</a>';?></span></td>
							<td height="25" width="10%" align="center"><span class="text-success"><?php echo date('d-m-Y',strtotime($lastbid->dateadded)); ?></span></td>
							<td height="25" width="10%" align="center"><span class="text-danger"><?php echo $date; ?></span></td>
							<td height="25" width="10%" align="center"><span><font face=""><?php echo '<a class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="Click to view Airport Information!" href="  '.SITE_URL.'/index.php/airports/get_airport?icao='.$lastbid->depicao.'">'.$lastbid->depicao.'</a>';?></font></span></td>
							<td height="25" width="10%" align="center"><span><font face=""><?php echo '<a class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="Click to view Airport Information!" href="'.SITE_URL.'/index.php/airports/get_airport?icao='.$lastbid->arricao.'">'.$lastbid->arricao.'</a>';?></font></span></td>
							<td height="25" width="10%" align="center"><span><a class="btn btn- btn-sm" data-toggle="tooltip" data-placement="top" title="Click to view Aircraft Information!" href="<?php echo SITE_URL?>/index.php/Fleet/view/<?php echo '' . $lastbid->id . ''; ?>"><?php echo $lastbid->aircraft; ?></a></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
        <br></p></div>

              </p>
        </div>
      </div>
  </div>
</div>
