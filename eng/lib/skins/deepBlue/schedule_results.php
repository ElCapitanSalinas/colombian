<section class="page-contents">
<div class="container">
<br />
<h3><i class="fa fa-book" fa-lg style="color:#0C336E"></i> Schedule Results</h3>
<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<?php
if(!$schedule_list)
{
	echo '<p align="center">No routes have been found!</p>';
	return;
}
?> 
<script type="text/javascript">
$(document).ready(function() {
    oTable = $('#deepBlue_Schedule_Results').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers"
    });
} );

</script>
<table id="deepBlue_Schedule_Results" width="100%" border="0" cellspacing="0" cellpadding="0" class="deepBlue_table">
<thead>
<tr>
	<th>Flight Info</th>
	<th>Options</th>
</tr>
</thead>
<tbody>
<?php foreach($schedule_list as $schedule) { ?>
<tr>
	<td>
		<a href="<?php echo url('/schedules/details/'.$schedule->id);?>"><?php echo $schedule->code . $schedule->flightnum?>
			<?php echo '('.$schedule->depicao.' - '.$schedule->arricao.')'?>
		</a>
		<br />
		
		<strong>Departure: </strong><?php echo $schedule->deptime;?> &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Arrival: </strong><?php echo $schedule->arrtime;?><br />
		<strong>Equipment: </strong><?php echo $schedule->aircraft; ?> (<?php echo $schedule->registration;?>)  <strong>Distance: </strong><?php echo $schedule->distance . Config::Get('UNITS');?>
		<br />
		<strong>Days Flown: </strong><?php echo Util::GetDaysCompact($schedule->daysofweek); ?><br />
		<?php echo ($schedule->route=='') ? '' : '<strong>Route: </strong>'.$schedule->route.'<br />' ?>
		<?php echo ($schedule->notes=='') ? '' : '<strong>Notes: </strong>'.html_entity_decode($schedule->notes).'<br />' ?>
		<?php
		# Note: this will only show if the above code to
		#	skip the schedule is commented out
		if($schedule->bidid != 0) {
			echo 'This route has been bid on';
		}
		?>
	</td>
	<td nowrap>
		<a href="<?php echo url('/schedules/details/'.$schedule->id);?>"><i class="fa fa-search-plus" aria-hidden="true" style="color:#04327F"></i> View Details</a><br />
		<a href="<?php echo url('/schedules/brief/'.$schedule->id);?>"><i class="fa fa-user" aria-hidden="true" style="color:#04327F"></i> Pilot Brief</a><br />
		<?php 
		# Don't allow overlapping bids and a bid exists
		if(Config::Get('DISABLE_SCHED_ON_BID') == true && $schedule->bidid != 0) {
		?>
			<a id="<?php echo $schedule->id; ?>" class="addbid" 
				href="<?php echo actionurl('/schedules/addbid/?id='.$schedule->id);?>"><i class="fa fa-plus-circle" aria-hidden="true" style="color:#04327F"></i> Add to Bid</a>
		<?php
		} else {
			if(Auth::LoggedIn()) {
			 ?>
				<a id="<?php echo $schedule->id; ?>" class="addbid" 
					href="<?php echo url('/schedules/addbid');?>"><i class="fa fa-plus-circle" aria-hidden="true" style="color:#04327F"></i> Add to Bid</a>
			<?php			 
			}
		}		
		?>
	</td>
</tr>
<?php
 /* END OF ONE TABLE ROW */
}
?>
</tbody>
</table>
<hr>
</div>
</section>