<section class="page-contents">
<div class="container">
<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<br />
<h3><i class="fa fa-book" fa-lg style="color:#0C336E"></i> My Flight Bids</h3>
<?php
if(!$bids)
{
	echo '<br />';
echo '<div align="center">';
echo '<div class="alert alert-danger"><strong>You have not bid on any flights!</strong></div>';
echo '<div>';
	return;
}
?>
<table class="deepBlue_table" width="100%" cellspacing="0">
<thead>
<tr>
	<th>Flight Number</th>
	<th>Route</th>
	<th>Aircraft</th>
	<th>Departure Time</th>
	<th>Arrival Time</th>
	<th>Distance</th>
	<th>Options</th>
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
	<td><a href="<?php echo url('/pireps/filepirep/'.$bid->bidid);?>"><i class="fa fa-file" aria-hidden="true" style="color:#04327F"></i> File PIREP</a><br />
		<a id="<?php echo $bid->bidid; ?>" class="deleteitem" href="<?php echo url('/schedules/removebid');?>"><i class="fa fa-trash" aria-hidden="true" style="color:#04327F"></i> Remove Bid <font color="cc0000">*</font></a><br />
		<a href="<?php echo url('/schedules/brief/'.$bid->id);?>"><i class="fa fa-user" aria-hidden="true" style="color:#04327F"></i> Pilot Brief</a><br />
		<a href="<?php echo url('/schedules/boardingpass/'.$bid->id);?>" /><i class="fa fa-ticket" aria-hidden="true" style="color:#04327F"></i> Boarding Pass</a>
		
	</td>
</tr>
<?php
}
?>
</tbody>
</table>
<p align="right"><font color="cc0000">*</font> - double click</p>
<hr>
<a id="<?php echo $bid->bidid; ?>" class="deleteitem btn btn-danger" href="<?php echo url('/schedules/removebid');?>" style="width: 100%" >Cancel Booking</a>
<button href="<?php echo url('/schedules/removebid');?>" action="deletebid" id="<?php echo $bid->bidid;?>" class="deleteitem {button:{icons:{primary:'ui-icon-trash'}}}">Delete</button>

<!-- REMOVE BIDS HELPER - START -->
<script>
    $('.deleteitem').on('click', function() {
        var bid_id = $(this).attr("id");
        console.log(bid_id);
        $.ajax({
            type: "POST",
            url: "<?= url('/schedules/removebid') ?>",
            data:{
                id: bid_id
            },
            success:function(response) {
                $('#bid'+bid_id).fadeOut( "slow" );
                Swal.fire({
                    title: 'Success!', 
                    html: "Reservation removed successfully!", 
                    icon: "success"
                }).then(function() {
                    window.location = "<?php echo SITE_URL; ?>";
                });
            },
            error:function(){
                Swal.fire({
                    title: 'Oopsss!', 
                    html: "There was an error removing your reservation, if you think this is an error, contact an administrator.", 
                    icon: "error"
                }).then(function() {
                    window.location = "<?php echo SITE_URL; ?>";
                });
            }
        });
        
        return false;
    });
</script>
<!-- REMOVE BIDS HELPER - END -->

</div>
</section>
