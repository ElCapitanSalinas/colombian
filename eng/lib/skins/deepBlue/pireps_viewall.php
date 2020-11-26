<p><?php if(isset($descrip)) { echo $descrip; }?></p>
			<?php
			if(!$pirep_list) {
				echo '<br />';
			echo '<div align="center">';
			echo '<div class="alert alert-danger"><strong>No se han encontrado reportes!. Trabajen, vagos!</strong></div>';
			echo '<div>';
				return;
			}
			?>
			<script type="text/javascript">
$(document).ready(function() {
    oTable = $('#deepBlue_View_All_PIREPS').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers"
    });
} );

</script>

<section class="page-contents">
<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="container">
<br />
<div class="row">
  <div class="col-lg-12">
        <div class="card w-175">
        <h5 class="card-header" style="background-color: #0A1437;"><b><font color="#FFFFFF"><i class="fa fa-plane" fa-lg style="color:#FFFFFF"></i> Lista de PIREPs ( Aprobados: <?php echo $userinfo->totalflights?>)</font></b></h5>
        <div class="card-body">
		<table class="table table-bordered">
		<thead>
			<tr>
				<th>Número de vuelo</th>
				<th>Salida</th>
				<th>llegada</th>
				<th>Aeronave</th>
				<th>Tiempo en vuelo</th>
				<th>Enviado</th>
				<th>Estado</th>
				<?php
				// Only show this column if they're logged in, and the pilot viewing is the
				//	owner/submitter of the PIREPs
				if(Auth::LoggedIn() && Auth::$pilot->pilotid == $pilot->pilotid) {
					echo '<th>Opciones</th>';
				}
				?>
			</tr>
			</thead>
			<tbody>
			<?php
			foreach($pirep_list as $pirep) {
			?>
			<tr>
				<td align="center">
					<a href="<?php echo url('/pireps/view/'.$pirep->pirepid);?>"><?php echo $pirep->code . $pirep->flightnum; ?></a>
				</td>
				<td align="center"><?php echo $pirep->depicao; ?></td>
				<td align="center"><?php echo $pirep->arricao; ?></td>
				<td align="center"><?php echo $pirep->aircraft . " ($pirep->registration)"; ?></td>
				<td align="center"><?php echo $pirep->flighttime; ?></td>
				<td align="center"><?php echo date(DATE_FORMAT, $pirep->submitdate); ?></td>
				<td align="center">
					<?php
					
					if($pirep->accepted == PIREP_ACCEPTED) {
						echo '<button type="button" class="btn btn-success"><i class="fa fa-check-square" aria-hidden="true"></i> Aprobado</button>';
					} elseif($pirep->accepted == PIREP_REJECTED) {
						echo '<button type="button"  class="btn btn-danger"><i class="fa fa-minus-circle" aria-hidden="true"></i> Rechazado</button>';
					} elseif($pirep->accepted == PIREP_PENDING) {
						echo '<button type="button" class="btn btn-warning"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Pendiente</button>';
					} elseif($pirep->accepted == PIREP_INPROGRESS) {
						echo '<button type="button" class="btn btn-info">En vuelo</button>';
					}
						
					
					?>
				</td>
				<?php
				// Only show this column if they're logged in, and the pilot viewing is the
				//	owner/submitter of the PIREPs
				if(Auth::LoggedIn() && Auth::$pilot->pilotid == $pirep->pilotid) {
					?>
				<td align="right">
					<a href="<?php echo url('/pireps/addcomment?id='.$pirep->pirepid);?>"><button type="button" style="font-size: 12px;" class="btn btn-dark"><i class="fa fa-commenting" aria-hidden="true"></i> Añadir comentarios</button></a><br />
					<br>
					<a href="<?php echo url('/pireps/editpirep?id='.$pirep->pirepid);?>"><button type="button" style="font-size: 12px;" class="btn btn-dark"><i class="fa fa-pencil-square" aria-hidden="true"></i> Editar PIREP</button></a><br />
				</td>
				<?php
				}
				?>
			</tr>
			<?php
			}
			?>
			</tbody>
			</table>
		</div>
	</div>

</section>
