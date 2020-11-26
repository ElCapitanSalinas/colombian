<?php 
/**
 * These are some options for the ACARS map, you can change here
 * 
 * By default, the zoom level and center are ignored, and the map 
 * will try to fit the all the flights in. If you want to manually set
 * the zoom level and center, set "autozoom" to false.
 * 
 * You can use these MapTypeId's:
 * http://code.google.com/apis/maps/documentation/v3/reference.html#MapTypeId
 * 
 * Change the "TERRAIN" to the "Constant" listed there - they are case-sensitive
 * 
 * Also, how to style the acars pilot list table. You can use these style selectors:
 * 
 * table.acarsmap { }
 * table.acarsmap thead { }
 * table.acarsmap tbody { }
 * table.acarsmap tbody tr.even { }
 * table.acarsmap tbody tr.odd { } 
 */
?>
<script type="text/javascript">
<?php 
/* These are the settings for the Google map. You can see the
	Google API reference if you want to add more options.
	
	There's two options I've added:
	
	autozoom: This will automatically center in on/zoom 
	  so all your current flights are visible. If false,
	  then the zoom and center you specify will be used instead
	  
	refreshTime: Time, in seconds * 1000 to refresh the map.
	  The default is 10000 (10 seconds)
*/
?>
var acars_map_defaults = {
autozoom: true,
        styles: [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#131313"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#094981"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#0C336E"},{"visibility":"on"}]}], // <-- ADD THIS
zoom: 4,

    center: new google.maps.LatLng("<?php echo Config::Get('MAP_CENTER_LAT'); ?>", "<?php echo Config::Get('MAP_CENTER_LNG'); ?>"),
    mapTypeId: google.maps.MapTypeId.TERRAIN,
    refreshTime: 10000
};
</script>
<div class="mapcenter" align="center">
	<div id="acarsmap" style="width:<?php echo  Config::Get('MAP_WIDTH');?>; height: <?php echo Config::Get('MAP_HEIGHT')?>"></div>
</div>
<?php
/* See below for details and columns you can use in this table */
?><br/>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="deepBlue_table" style="background-color: #D82F2F;">
<thead style="background-color: #D82F2F;">
	<tr>
		<th><b>Piloto</b></th>
		<th><b>Vuelo</b></th>
		<th><b>Salida</b></th>
		<th><b>Llegada</b></th>
		<th><b>Estado</b></th>
		<th><b>Alt</b></th>
		<th><b>Distancia/Tiempo</b></th>
	</tr>
</thead>
<tbody id="pilotlist"></tbody>
</table>
<script type="text/javascript" src="<?php echo fileurl('/lib/js/acarsmap.js');?>"></script>
<?php
/* This is the template which is used in the table above, for each row. 
	Be careful modifying it. You can simply add/remove columns, combine 
	columns too. Keep each "section" (<%=...%>) intact
	
	Variables you can use (what they are is pretty obvious)
	
	Variable:							Notes:
	<%=flight.pilotid%>
	<%=flight.firstname%>
	<%=flight.lastname%>
	<%=flight.pilotname%>				First and last combined
	<%=flight.flightnum%>
	<%=flight.depapt%>					Gives the airport name
	<%=flight.depicao%>
	<%=flight.arrapt%>					Gives the airport name
	<%=flight.arricao%>
	<%=flight.phasedetail%>
	<%=flight.heading%>
	<%=flight.alt%>
	<%=flight.gs%>
	<%=flight.disremaining%>
	<%=flight.timeremaning%>
	<%=flight.aircraft%>				Gives the registration
	<%=flight.aircraftname%>			Gives the full name
	<%=flight.client%>					FSACARS/Xacars/FSFK, etc
	<%=flight.trclass%>					"even" or "odd"
	
	You can also use logic in the templating, if you so choose:
	http://ejohn.org/blog/javascript-micro-templating/
*/
?>
<script type="text/html" id="acars_map_row">
<tr class="<%=flight.trclass%>">
<td width="60"><?php
$code = substr($flight->code, 0,3);
?>
<td width="80"><a href="<?php echo url('/profile/view');?>/<%=flight.pilotid%>"><%=flight.pilotid%></a></td>
<td width="80"><%=flight.flightnum%></td>
<td width="20"><%=flight.depicao%></td>
<td width="20"><%=flight.arricao%></td>
<td width="140"><%=flight.phasedetail%></td>
<td width="40"><%=flight.alt%></td>
<td width="90"><%=flight.distremaining%> <?php echo Config::Get('UNITS');?> / <%=flight.timeremaining%></td>
</tr>
</script>

<?php
/*	This is the template for the little map bubble which pops up when you click on a flight
	Same principle as above, keep the <%=...%> tags intact. The same variables are available
	to use here as are available above.
*/
?>
<script type="text/html" id="acars_map_bubble">
<span style="font-size: 10px; text-align:left; width: 100%" align="left">
<a href="<?php echo url('/profile/view');?>/<%=flight.pilotid%>"><%=flight.pilotid%> - <%=flight.pilotname%></a><br />
<strong>Flight <%=flight.flightnum%></strong> (<%=flight.depicao%> to <%=flight.arricao%>)<br />
<strong>Status: </strong><%=flight.phasedetail%><br />
<strong>Dist/Time Remain: </strong><%=flight.distremaining%> <?php echo Config::Get('UNITS');?> / <%=flight.timeremaining%><br />
</span>
</script>

<?php
/*	This is a small template for information about a navpoint popup 
	
	Variables available:
	
	<%=nav.title%>
	<%=nav.name%>
	<%=nav.freq%>
	<%=nav.lat%>
	<%=nav.lng%>
	<%=nav.type%>	2=NDB 3=VOR 4=DME 5=FIX 6=TRACK
 */
?>
<script type="text/html" id="navpoint_bubble">
<span style="font-size: 10px; text-align:left; width: 100%" align="left">
<strong>Name: </strong><%=nav.title%> (<%=nav.name%>)<br />
<strong>Type: </strong>
<?php	/* Show the type of point */ ?>
<% if(nav.type == 2) { %> NDB <% } %>
<% if(nav.type == 3) { %> VOR <% } %>
<% if(nav.type == 4) { %> DME <% } %>
<% if(nav.type == 5) { %> FIX <% } %>
<% if(nav.type == 6) { %> TRACK <% } %>
<br />
<?php	/* Only show frequency if it's not a 0*/ ?>
<% if(nav.freq != 0) { %>
<strong>Frequency: </strong><%=nav.freq%>
<% } %>
</span>
</script>
