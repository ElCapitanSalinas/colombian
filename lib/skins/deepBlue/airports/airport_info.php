<!-- This airport info table and it's functionality was created by Adamm, and modified by Stuart Boardman-->
<!-- Licensed under Creative Commons Attribution Non-commercial Share Alike, more info here: 
http://creativecommons.org/licenses/by-nc-sa/3.0/-->
<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
				<table class="table mb-0">
                    <tr>
                        <th>ICAO:</th>
                        <td><?php echo $name->icao; ?></td>
                        <th>País:</th>
                        <td><?php echo $name->country; ?></td>
                    </tr>

                    <tr>
                        <th>Latitud:</th>
                        <td><?php echo $name->lat; ?></td>
                        <th>Longitud:</th>
                        <td><?php echo $name->lng; ?></td>
                    </tr>

                    <tr>
                        <th>Llegadas totales:</th>
                        <td><?php echo AirportData::getarrflights($name->icao); ?></td>

                        <th>Salidas totales:</th>
                        <td><?php echo AirportData::getdeptflights($name->icao); ?></td>
                    </tr>

                    <?php 
                        $icao = $name->icao;
                        $params = array(
                            'depicao'   => $icao,
                            'accepted'  => '1'
                            );
                        $pireps = PIREPData::findPIREPS($params, 1);
                        $deppirep = $pireps[0];
                        $params = array(
                            'arricao'   => $icao,
                            'accepted'  => '1'
                            );
                        $pireps = PIREPData::findPIREPS($params, 1);
                        $arrpirep = $pireps[0];

                        $initialdep = substr($deppirep->firstname,0,1);
                        $initialarr = substr($arrpirep->firstname,0,1);
                    ?>
                    <tr>
                        <th>Latest Arrival:</th>
                        <td><a href="<?php echo SITE_URL?>/index.php/pireps/viewreport/<?php echo $arrpirep->pirepid;?>"><?php echo $arrpirep->code.$arrpirep->flightnum.' ('.$arrpirep->depicao.'-'.$arrpirep->arricao.')</a> - '.$arrpirep->firstname.' '.$arrpirep->lastname?></td>
                        <th>Latest Departure:</th>
                        <td><a href="<?php echo SITE_URL?>/index.php/pireps/viewreport/<?php echo $deppirep->pirepid;?>"><?php echo $deppirep->code.$deppirep->flightnum.' ('.$deppirep->depicao.'-'.$deppirep->arricao.')</a> - '.$deppirep->firstname.' '.$deppirep->lastname?></td>
                    </tr>
                    
				</table>
			</div>
		</div>

        <div class="card">
            <div class="card-body p-0">
                <?php require('../acarsmap.php'); ?>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo SITE_URL?>/lib/js/base_map.js"></script>
<script type="text/javascript">
	const map = createMap ({
		render_elem: 'airportmap',
		provider: '<?php echo Config::Get("MAP_TYPE"); ?>',
		zoom: 14,
		center: L.latLng("<?php echo $name->lat; ?>", "<?php echo $name->lng; ?>")
	});

	L.marker(["<?php echo $name->lat; ?>", "<?php echo $name->lng; ?>"]).addTo(map)
</script>