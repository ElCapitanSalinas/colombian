<section class="page-contents">
<div class="container">
<br />
<div class="row">
  <div class="col-sm-1">
  </div>
  <div class="col-lg-10">
        <div class="card w-175">
        <h5 class="card-header" style="background-color: #0A1437;"><b><font color="#FFFFFF"><i class="fa fa-users" fa-lg style="color:#FFFFFF"></i> Pilotos</font></b></h5>
        <div class="card-body">
        <table class="table table-bordered">
			<thead>
				<tr>
				<th scope="col">ID</th>
				<th scope="col">Nombre</th>
				<th scope="col">Rango</th>
				<th scope="col">Vuelos</th>
				<th scope="col">Horas</th>
				</tr>
			</thead>
			<tbody>
			<?php
foreach($pilot_list as $pilot)
{
	/* 
		To include a custom field, use the following example:

		<td>
			<?php echo PilotData::GetFieldValue($pilot->pilotid, 'VATSIM ID'); ?>
		</td>

		For instance, if you added a field called "IVAO Callsign":

			echo PilotData::GetFieldValue($pilot->pilotid, 'IVAO Callsign');		
	 */
	 
	 // To skip a retired pilot, uncomment the next line:
	 //if($pilot->retired == 1) { continue; }
?>
<tr>
			<td width="1%" nowrap><a href="<?php echo url('/profile/view/'.$pilot->pilotid);?>">
					<?php echo PilotData::GetPilotCode($pilot->code, $pilot->pilotid)?></a>
			</td>
			<td>
				<img src="<?php echo Countries::getCountryImage($pilot->location);?>" 
					alt="<?php echo Countries::getCountryName($pilot->location);?>" />
					
				<?php echo $pilot->firstname.' '.$pilot->lastname?>
			</td>
			<td><img src="<?php echo $pilot->rankimage?>" alt="<?php echo $pilot->rank;?>" /></td>
			<td><?php echo $pilot->totalflights?></td>
			<td><?php echo Util::AddTime($pilot->totalhours, $pilot->transferhours); ?></td>
		<?php
		}
		?>
	</tbody>
	</table>
	</div>
</section>
