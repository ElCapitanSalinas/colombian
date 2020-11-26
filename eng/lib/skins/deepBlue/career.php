<section class="page-contents">
<div class="container">
<br />
<div class="row">
  <div class="col-sm-1">
  </div>
  <div class="col-lg-10">
        <div class="card w-175">
        <h5 class="card-header" style="background-color: #0A1437;"><b><font color="#FFFFFF"><i class="fa fa-university" fa-lg style="color:#FFFFFF"></i> Rangos</font></b></h5>
        <div class="card-body">
        <table class="table table-bordered">
			<thead>
				<tr>
				<th scope="col">Titulo</th>
				<th scope="col">Horas Mínimas</th>
				<th scope="col">Pago por hora</th>
				<th scope="col">Aeronaves disponibles</th>
				<th scope="col">Imagen</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($ranks as $rank) { ?>
						<tr>
							<td><?php echo $rank->rank; ?></td>
							<td><?php echo $rank->minhours; ?></td>
							<td>$<?php echo $rank->payrate; ?>/hr</td>
							<td> 
								<?php $rankai = CareerData::getaircrafts($rank->rankid); 
								if(!$rankai) {echo 'Todas las aeronaves';}
								else {
									$i = 0;
									foreach($rankai as $ran) {
										$i++;
										if($i > 1) echo ', ';
										echo $ran->icao;
									} 
								} ?></td>
							<td><img src="<?php echo $rank->rankimage; ?>" title="<?php echo $rank->rank; ?>" /></td>
						</tr>
						<?php } ?>
	</tbody>
	</table>
	</div>
</section>