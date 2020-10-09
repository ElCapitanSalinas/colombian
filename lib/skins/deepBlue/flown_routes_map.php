<section class="page-contents">
<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="container">
<br />
<div class="row">
  <div class="col-lg-12">
        <div class="card w-200">
        <h5 class="card-header" style="background-color: #0A1437;"><b><font color="#FFFFFF"><i class="fa fa-map" fa-lg style="color:#FFFFFF"></i> Mapa de vuelos</font></b></h5>
        <div class="card-body">
		<div class="mapcenter" align="center">
						<div id="routemap" style="width: 1100px; height: 600px;"></div>
					</div>

					<script type="text/javascript">
					var options = {
						mapTypeId: google.maps.MapTypeId.ROADMAP
					}

					var styles = [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#131313"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#094981"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#0C336E"},{"visibility":"on"}]}]

					// Create a new StyledMapType object, passing it the array of styles,
					// as well as the name to be displayed on the map type control.
					var styledMap = new google.maps.StyledMapType(styles,
					{name: "Flight Map"});
					// Create a map object, and include the MapTypeId to add
					// to the map type control.
					var mapOptions = {
					zoom: 11,
					center: new google.maps.LatLng(55.6468, 37.581),
					mapTypeControlOptions: {
							mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
					}
					};
					var map = new google.maps.Map(document.getElementById('routemap'),
					mapOptions);

					//Associate the styled map with the MapTypeId and set it to display.
					map.mapTypes.set('map_style', styledMap);
					map.setMapTypeId('map_style');var flightMarkers = [];

					<?php 
					$shown = array();
					foreach($pirep_list as $pirep) {	
						// Dont show repeated routes		
						if(in_array($pirep->code.$pirep->flightnum, $shown))
							continue;
						else
							$shown[] = $pirep->code.$pirep->flightnum;
						
						if(empty($pirep->arrlat) || empty($pirep->arrlng)
							|| empty($pirep->deplat) || empty($pirep->deplng))
						{
							continue;
						}
					?>
						dep_location = new google.maps.LatLng(<?php echo $pirep->deplat?>, <?php echo $pirep->deplng?>);
						arr_location = new google.maps.LatLng(<?php echo $pirep->arrlat?>, <?php echo $pirep->arrlng?>);

						flightMarkers[flightMarkers.length] = new google.maps.Marker({
							position: dep_location,
							map: map,
							title: "<?php echo "$pirep->depname ($pirep->depicao)";?>"
						});

						flightMarkers[flightMarkers.length] = new google.maps.Marker({
							position: arr_location,
							map: map,
							title: "<?php echo "$pirep->arrname ($pirep->arricao)";?>"
						});

						var flightPath = new google.maps.Polyline({
							path: [dep_location, arr_location],
							strokeColor: "#FF0000", strokeOpacity: 1.0, strokeWeight: 2
						}).setMap(map);
					<?php
					}
					?>

					if(flightMarkers.length > 0)
					{
						var bounds = new google.maps.LatLngBounds();
						for(var i = 0; i < flightMarkers.length; i++) {
							bounds.extend(flightMarkers[i].position);
						}
					}

					map.fitBounds(bounds); 
					</script>		
	<div class="col-sm-1">
  </div>
	</div>
</section>