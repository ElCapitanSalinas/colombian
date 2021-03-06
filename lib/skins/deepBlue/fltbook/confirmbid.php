<style>
.sharp {
	border-radius: 0;
	margin-left: 3px;
	margin-right: 3px;
}
</style>
<div class="container-fluid">
    <div class="modal-header">
      <h4 class="modal-title"><strong>Confirmar agenda</strong></h4>
    </div>
    <div class="modal-body">
      <h3>Selecciona el registro de la aeronave</h3>
	<form action="<?php echo url('/Fltbook/addbid'); ?>" method="post">
		<select class="form-control" name="aircraftid" id="aircraftid">
			<option value="" selected disabled>Selecciona una aeronave para el vuelo</option>
			<?php
			$allaircraft = FltbookData::getAllAircraftFltbook($airline, $aicao);
			foreach($allaircraft as $aircraft) {
				# If Aircraft is disabled, remove it from the list
				if($settings['disabled_ac_allow_book'] == 1) {
					if($aircraft->enabled != 1) {
						continue;
					}
				}

				# If Aircraft has been locked to location
				if ($settings['lock_aircraft_location'] == 1) {
					$route = SchedulesData::getSchedule($routeid);
					if ($aircraft->location !== $route->depicao && $aircraft->location !== "") {
						continue;
					}
				}

				# If Aircraft is has been booked, remove it from the list
				if($settings['show_ac_if_booked'] == 0) {
					$acbidded = FltbookData::getBidByAircraft($aircraft->id);
					if($acbidded) { continue; }
				}

				$icaoairline = "{$aircraft->icao}{$airline}";
				if($aircraft->registration == $icaoairline) {
					echo '';
				} else {
					echo '<option value="'.$aircraft->id.'" '.$sel.'>'.$aircraft->registration.' - '.$aircraft->icao.' - '.$aircraft->name.'</option>';
				}
			}
			?>
		</select>
	      <hr />
	      <input type="hidden" name="routeid" value="<?php echo $routeid; ?>" />
	      <input type="submit" name="submit" class="btn btn-success" value="Agendar" />
	      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	</form>
  </div>
</div>
