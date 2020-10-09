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
<?php Template::Show('frontpage_acars.php'); ?>
        <br></p></div>

              </p>
        </div>
      </div>
  </div>
</div>
