<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<?php
if(!$bids)
{
	echo '<div class="col-md-12"><div class="alert alert-danger">No tienes agenda en ningún vuelo</div></div>';
	return;
}
?>
<section class="page-contents">
<div class="container">
<br />
<div class="row">
  <div class="col-lg-12">
        <div class="card w-175">
        <h5 class="card-header" style="background-color: #0A1437;"><b><font color="#FFFFFF"><i class="fa fa-star" fa-lg style="color:#FFFFFF"></i> Mis agendas</font></b></h5>
			<div class="card-body">
			<table id="tabledlist" class="table table-striped table-bordered">
				<thead class="thead-dark">
				<tr>
					<th>No. de vuelo</th>
					<th>Ruta</th>
					<th>Aeronave</th>
					<th>Hora de salida</th>
					<th>Hora de llegada</th>
					<th>Distancia</th>
					<th>Opciones</th>
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
					<td>
					<a href="<?php echo url('/schedules/brief/'.$bid->id);?>" class="btn btn-dark" style="width: 100%; font-size: 12px;">Simbrief</a>
					<a href="<?php echo url('/pireps/filepirep/'.$bid->bidid);?>" class="btn btn-warning" style="width: 100%; font-size: 12px;">Manual RPRT</a>
					<a href="<?php echo url('/pireps/filepirep/'.$bid->bidid);?>">File PIREP</a><br />
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
			</div>
		</div>
	</div>
</section>

<p align="right">* - double click</p>
<hr>