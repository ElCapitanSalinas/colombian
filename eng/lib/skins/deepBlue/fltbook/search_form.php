<?php
$pilotid        = Auth::$userinfo->pilotid;
$last_location  = FltbookData::getLocation($pilotid);
$last_name      = OperationsData::getAirportInfo($last_location->arricao);
if(!$last_location) {
  FltbookData::updatePilotLocation($pilotid, Auth::$userinfo->hub);
}
?>

<section class="page-contents">
<div class="container">
<br />
<div class="row">
  <div class="col-lg-12">
        <div class="card w-200">
        <h5 class="card-header" style="background-color: #0A1437;"><b><font color="#FFFFFF"><i class="fa fa-star" fa-lg style="color:#FFFFFF"></i> Buscar </font></b></h5>
        <div class="card-body">
        <br>
        <form action="<?php echo url('/Fltbook');?>" method="post">
        Estas en: <b><?php if($settings['search_from_current_location'] == 1) { ?>
                      <button type="button" class="btn btn-lg btn-warning" active style="font-size: 12px;"> <input id="depicao" name="depicao" type="hidden" value="<?php echo $last_location->arricao; ?>"><?php echo $last_location->arricao; ?> - <?php echo $last_name->name; ?>
                      <?php } else { ?>
                        <strong><?php echo $last_location->arricao; ?> - <?php echo $last_name->name; ?></font></strong>
                      <?php } ?></button><b>
                      <hr>
                      Selecciona una filial:
                      <select class="form-control form-control-sm" name="airline">
                      <option value="">Seleccionar</option>
                          <?php
                            foreach ($airlines as $airline) {
                              echo '<option value="'.$airline->code.'">'.$airline->name.'</option>';
                            }
                          ?>
                    </select>
                    <br>
                     Selecciona una aeronave:
                      <select class="form-control form-control-sm" name="aircraft">
                      <option value="" selected>Seleccionar</option>
                      <?php
                      if($settings['search_from_current_location'] == 1) {
                        $airc = FltbookData::routeaircraft($last_location->arricao);
                        if(!$airc) {
                              echo '<option>No hay aeronaves disponibles!</option>';
                              } else {
                              foreach ($airc as $air) {
                          $ai = FltbookData::getaircraftbyID($air->aircraft);
                          echo '<option value="'.$ai->icao.'">'.$ai->name.'</option>';
                              }
                              }
                                  } else {
                                    $airc = FltbookData::routeaircraft_depnothing();
                                    if(!$airc) {
                          echo '<option>No hay aeronaves disponibles!</option>';
                              } else {
                                      foreach($airc as $ai) {
                                        echo '<option value="'.$ai->icao.'">'.$ai->name.'</option>';
                                      }
                                    }
                                  }
                            ?>
                    </select>
                    <br>
                    Selecciona un aeropuerto de destino:
                      <select class="form-control form-control-sm" name="arricao">
                      <option value="">Seleccionar</option>
                      <?php
                          if($settings['search_from_current_location'] == 1) {
                            $airs = FltbookData::arrivalairport($last_location->arricao);
                            if(!$airs) {
                              echo '<option>No hay aeropuertos disponibles!</option>';
                            } else {
                              foreach ($airs as $air) {
                                $nam = OperationsData::getAirportInfo($air->arricao);
                                echo '<option value="'.$air->arricao.'">'.$air->arricao.' - '.$nam->name.'</option>';
                              }
                            }
                          } else {
                            foreach($airports as $airport) {
                              echo '<option value="'.$airport->icao.'">'.$airport->icao.' - '.$airport->name.'</option>';
                            }
                          }
                          ?>
                    </select>
                    <br>
                    <center><input type="hidden" name="action" value="search" />
                  <a href="<?php echo url('/Fltbook/bids'); ?>"><input type="button" class="btn btn-warning" style="font-size: 12px;" value="Ver/Remover Agendas"></a>
                  <input border="0" type="submit" name="submit" class="btn btn-info" style="font-size: 12px;" value="Buscar"></center>
        </form>
        </div>
      </div>
    </div>
</section>

