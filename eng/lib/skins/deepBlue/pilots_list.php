<section class="page-contents">
<div class="container">
<br />
<div class="row">
  <div class="col-sm-1">
  </div>
  <div class="col-lg-12">
        <div class="card w-175">
        <h5 class="card-header" style="background-color: #0A1437;"><b><font color="#FFFFFF"><i class="fa fa-users" fa-lg style="color:#FFFFFF"></i><?php echo $title; ?></font></b></h5>
        <div class="card-body">
            <?php
            if(!$pilot_list) {
                echo '<div class="alert alert-danger"><div class="alert-title"><b>No se han encontrado pilotos</b></div>No hay pilotos asignados a este HUB, contacta al staff para más información!.</div></div></div></div></div>';
                return;
            }
        ?>
        <table class="table table-bordered">
			<thead>
                        <tr>
                            <th>ID del piloto</th>
                            <th>Nombre</th>
                            <th>Rango</th>
                            <th>Vuelos</th>
                            <th>Horas</th>
                            <th>Hub</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($pilot_list as $pilot) { ?>
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
                            <td><?php echo $pilot->hub; ?></td>
                            <td>
                                <?php
                                if($pilot->retired == 0) {
                                    echo '<span class="label label-success">Activo</span>';
                                } elseif($pilot->retired == 1) {
                                    echo '<span class="label label-danger">Inactivo</span>';
                                } else {
                                    echo '<span class="label label-primary">En vacaciones</span>';
                                }
                                ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
	</table>
	</div>
	</div>
	</div>
	</div>
</section>
