<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<style>
    pre {
        display: block;
        padding: 9.5px;
        margin: 0 0 10px;
        font-size: 13px;
        line-height: 1.4;
        word-break: break-all;
        color: #333;
        background-color: #f5f5f5;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    
    .comments p {
        display: inline;
    }
</style>
<br>
<div class="row">
    <?php
        $bids = FltbookData::getBidsForPilot(Auth::$userinfo->pilotid);
        if(!$bids) {
            echo '<div class="col-md-12"><div class="alert alert-danger">No tienes agenda en ningún vuelo</div></div>';
        } else {
            foreach($bids as $bid) {
                $depAirport = OperationsData::getAirportInfo($bid->depicao);
                $arrAirport = OperationsData::getAirportInfo($bid->arricao);
    ?>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header" style="background-color: #0A1437;">
                <h4><font color="#ffffff"><strong>Información del vuelo</strong></font></h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li>
                                <strong>Salida:</strong>
                                <a href="javascript::" data-toggle="tooltip" data-placement="bottom" title="<?php echo $depAirport->name; ?>"><?php echo $bid->depicao; ?></a>
                            </li>
                            <li>
                                <strong>Callsign:</strong>
                                <?php echo $bid->code . $bid->flightnum; ?>
                            </li>
                            <li>
                                <strong>Nivel de vuelo:</strong>
                                <?php echo $bid->flightlevel;?>
                            </li>
                            <li>
                                <strong>Distancia:</strong>
                                <?php echo $bid->distance;?>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li>
                                <strong>Llegada:</strong>
                                <a href="javascript::" data-toggle="tooltip" data-placement="bottom" title="<?php echo $arrAirport->name; ?>"><?php echo $bid->arricao; ?></a>
                            </li>
                            <li>
                                <strong>Aeronave:</strong>
                                <?php echo $bid->aircraft; ?> (<?php echo $bid->registration?>)
                            </li>
                            <li>
                                <strong>Precio:</strong>
                                <?php echo $bid->price; ?>
                            </li>
                            <li>
                                <strong>Longitud del vuelo:</strong>
                                <?php echo date("H:i", strtotime($bid->flighttime));?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
		<br>
        <div class="card">
            <div class="card-header" style="background-color: #0A1437;">
                <h4><font color="#ffffff"><strong>Opciones del vuelo</strong></font></h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <a href="<?php echo url('/schedules/brief/'.$bid->id);?>" class="btn btn-dark" style="width: 100%">Simbrief</a>
                        <br/><br/>
                        <a href="<?php echo url('/pireps/filepirep/'.$bid->bidid);?>" class="btn btn-warning" style="width: 100%">Reportar manual</a>
                    </div>
                    <div class="col-md-6">
                        <?php $aircraft = OperationsData::getAircraftByReg($bid->registration); ?>
                        <a target="_blank" href="http://www.vatsim.net/fp/index.php?fpc=&amp;2=<?php echo $bid->code . $bid->flightnum; ?>&amp;3=<?php echo $aircraft->icao; ?>&amp;5=<?php echo $bid->depicao; ?>&amp;7=<?php echo $bid->flightlevel;?>&amp;8=<?php echo $bid->route; ?>&amp;9=KATL&amp;11=<?php echo $bid->registration; ?> OPR/<?php echo preg_replace('#^https?://#', '', SITE_URL); ?>&amp;14=<?php echo Auth::$userinfo->firstname.' '.Auth::$userinfo->lastname; ?>" class="btn btn-primary" style="width: 100%">Plan de vuelo VATSIM</a>
                        <br/><br/>
						<!-- Button trigger modal -->
						<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
						Cancelar Reserva
						</button>

						<!-- Modal -->
						<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"><b>Error!</b></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
							<div class="card text-white bg-danger mb-3">
								<div class="card-body">
									<h5 class="card-title"><strong>La función se encuentra deshabilitada.</strong></h5>
									<p class="card-text">Contacta a un administrador para que elimimine la reserva.</p>
								</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
							</div>
							</div>
						</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
		<div class="card-header" style="background-color: #0A1437;">
                <h4><font color="#ffffff"><strong>Ruta</strong></font></h4>
            </div>
            <div class="card-body">
                <blockquote>
                    <?php 
                        if(!$bid->route) {
                            echo 'Este vuelo no tiene una ruta';
                        } else {
                            echo $bid->route;
                        }  
                    ?>
                </blockquote>
            </div>
        </div>
    <?php } } ?>
                        <?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
                    <h3>My Flight Bids</h3>
                    <?php
                    if(!$bids)
                    {
                        echo '<p align="center">You have not bid on any flights</p>';
                        return;
                    }
                    ?>
                    <table id="tabledlist" class="tablesorter">
                    <thead>
                    <tr>
                        <th>Flight Number</th>
                        <th>Route</th>
                        <th>Aircraft</th>
                        <th>Departure Time</th>
                        <th>Arrival Time</th>
                        <th>Distance</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($bids as $bid)
                    {
                    ?>
                    <tr id="bid<?php echo $bid->bidid ?>">
                        <td><?php echo $bid->code . $bid->flightnum; ?></td>
                        <td align="center"><?php echo $bid->depicao; ?> to <?php echo $bid->arricao; ?></td>
                        <td align="center"><?php echo $bid->aircraft; ?> (<?php echo $bid->registration?>)</td>
                        <td><?php echo $bid->deptime;?></td>
                        <td><?php echo $bid->arrtime;?></td>
                        <td><?php echo $bid->distance;?></td>
                        <td><a href="<?php echo url('/pireps/filepirep/'.$bid->bidid);?>">File PIREP</a><br />
                            <a id="<?php echo $bid->bidid; ?>" class="deleteitem" href="<?php echo url('/schedules/removebid');?>">Remove Bid *</a><br />
                            <a href="<?php echo url('/schedules/brief/'.$bid->id);?>">Pilot Brief</a><br />
                            <a href="<?php echo url('/schedules/boardingpass/'.$bid->id);?>" />Boarding Pass</a>
                            
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                    </table>
                    <p align="right">* - double click</p>
                    <hr>
    
</div>

<!-- REMOVE BIDS HELPER - START -->
<script>
    $('.deleteitem').on('click', function() {
        var bid_id = $(this).attr("id");
        console.log(bid_id);
        $.ajax({
            type: "POST",
            url: "<?= url('/schedules/removebid') ?>",
            data:{
                id: bid_id
            },
            success:function(response) {
                $('#bid'+bid_id).fadeOut( "slow" );
                Swal.fire({
                    title: 'Success!', 
                    html: "Reservation removed successfully!", 
                    icon: "success"
                }).then(function() {
                    window.location = "<?php echo SITE_URL; ?>";
                });
            },
            error:function(){
                Swal.fire({
                    title: 'Oopsss!', 
                    html: "There was an error removing your reservation, if you think this is an error, contact an administrator.", 
                    icon: "error"
                }).then(function() {
                    window.location = "<?php echo SITE_URL; ?>";
                });
            }
        });
        
        return false;
    });
</script>
<!-- REMOVE BIDS HELPER - END -->
