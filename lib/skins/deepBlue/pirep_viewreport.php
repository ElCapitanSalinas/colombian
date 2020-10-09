<section class="page-contents">
<div class="container">
<br />
	<div class="row">
		<div class="col-lg-12">
				<div class="card w-175">
				<h5 class="card-header" style="background-color: #0A1437;"><b><font color="#FFFFFF"><i class="fa fa-plane" fa-lg style="color:#FFFFFF"></i> Vuelo No. <?php echo $pirep->code . $pirep->flightnum; ?></font></b></h5>
				<div class="card-body">
				<table class="table table-bordered">
				<tr>
								<td width="50%">
								<ul>
									<li><strong>Enviado por: </strong><a href="<?php echo SITE_URL.'/index.php/profile/view/'.$pirep->pilotid?>">
											<?php echo $pirep->firstname.' '.$pirep->lastname?></a></li>
									<li><strong>Aeropuerto de salida: </strong><?php echo $pirep->depname?> (<?php echo $pirep->depicao; ?>)</li>
									<li><strong>Aeropuerto de llegada: </strong><?php echo $pirep->arrname?> (<?php echo $pirep->arricao; ?>)</li>
									<li><strong>Aeronave: </strong><?php echo $pirep->aircraft . " ($pirep->registration)"?></li>
									<li><strong>Tiempo en vuelo: </strong> <?php echo $pirep->flighttime; ?></li>
									<li><strong>Envíado en: </strong> <?php echo date(DATE_FORMAT, $pirep->submitdate);?></li>
									<?php
									if($pirep->route != '')
									{
										echo "<li><strong>Ruta: </strong>{$pirep->route}</li>";
									}
									?>
									<li><strong>Estado: </strong>
										<?php
										if($pirep->accepted == PIREP_ACCEPTED) {
											echo '<button type="button" class="btn btn-success"><i class="fa fa-check-square" aria-hidden="true"></i> Aprobado</button>';
										} elseif($pirep->accepted == PIREP_REJECTED) {
											echo '<button type="button"  class="btn btn-danger"><i class="fa fa-minus-circle" aria-hidden="true"></i> Rechazado</button>';
										} elseif($pirep->accepted == PIREP_PENDING) {
											echo '<button type="button" class="btn btn-warning"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Pendiente</button>';
										} elseif($pirep->accepted == PIREP_INPROGRESS) {
											echo '<button type="button" class="btn btn-info">En vuelo</button>';
										}?>
									</li>
								</ul>
								</td>
								<td width="50%" valign="top" align="right">
								<table class="balancesheet" cellpadding="0" cellspacing="0" width="100%">

									<tr class="balancesheet_header">
										<td align="" colspan="2"><i class="fa fa-plane" aria-hidden="true" style="color:#ffffff"></i> Detalles del vuelo</td>
									</tr>
									<tr>
										<td align="right">Ingresos totales: <br /> 
											(<?php echo $pirep->load;?> carga / <?php echo FinanceData::FormatMoney($pirep->price);?> por unidad  <br />
										<td align="right" valign="top"><?php echo FinanceData::FormatMoney($pirep->load * $pirep->price);?></td>
									</tr>
									<tr>
										<td align="right">Costo del combustible: <br />
											(<?php echo $pirep->fuelused;?> Lbs @ <?php echo $pirep->fuelunitcost?> / unidad)<br />
										<td align="right" valign="top"><?php echo FinanceData::FormatMoney($pirep->fuelused * $pirep->fuelunitcost);?></td>
									</tr>
									</table>
								</td>
								</tr>
			</table>
			<hr>
			</thead>
			<?php
				if($comments)
				{
				echo '			<table class="table table-bordered">
				<thead>
				<tr>
				<th scope="col"><i class="fa fa-commenting" aria-hidden="true"></i> Comentarios</th>
				</tr>
				</thead>
				<tbody>
						<tr>
				<td align="center"><strong>Comentado por</strong></td>
				<td align="center"><strong>Comentario</strong></td>
				</tr>
							<tr>

				</tr>
';

				foreach($comments as $comment)
				{
				?>
				<tr>
					<td width="15%" nowrap><strong><?php echo $comment->firstname . ' ' .$comment->lastname?></strong></td>
					<td align="left"><?php echo $comment->comment?></td>
				</tr>
				<?php
				}

				echo '</tbody></table>';
				}
				?>
			<hr>
			<?php
				if($fields)
				{
				?>
				<h3>Detalles del vuelo</h3>			
				<ul>
					<?php
					foreach ($fields as $field)
					{
						if($field->value == '')
						{
							$field->value = '-';
						}
					?>		
						<li><strong><?php echo $field->title ?>: </strong><?php echo $field->value ?></li>
				<?php
					}
					?>
				</ul>	
				<?php
				}
				?>
				<?php
				if($pirep->log != '')
				{
				?>
				<hr>
				<h3>Información adicional:</h3>
				<p>
					<?php
					/* If it's FSFK, don't show the toggle. We want all the details and pretty
						images showing up by default */
					if($pirep->source != 'fsfk')
					{
						?>
					<p><a href="#" onclick="$('#log').toggle(); return false;">Ver log</a></p>
					<p id="log" style="display: none;">
					<?php
					}
					else
					{
						echo '<p>';
					}
					?>
						<div>
						<?php
						# Simple, each line of the log ends with *
						# Just explode and loop.
						$log = explode('*', $pirep->log);
						foreach($log as $line)
						{
							echo $line .'<br />';
						}
						?>
						</div>
					</p>
				</p>
				<?php
				}
				?>
			</div>
		</div>
		<div class="col-sm-1">

  		</div>
	</div>
</div>
</section>
<br />
