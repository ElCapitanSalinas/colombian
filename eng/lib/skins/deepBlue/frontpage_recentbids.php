<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<?php
if(!$lastbids)
{
echo '<tr><td colspan="9"><i class="fa fa-frown-o" style="color:#04327F"></i> Looks like our pilots are sleeping right now. No bids have been placed.</td></tr>';
?>

<?php
}
else
foreach($lastbids as $lastbid)
{
$airp1 = OperationsData::getairportinfo($lastbid->depicao);
$airp2 = OperationsData::getairportinfo($lastbid->arricao);
?>
<tr style="padding:5px;">
<?php
$flightid = $lastbid->id
?>
<?php
$params = $lastbid->pilotid;
$airp1 = OperationsData::getairportinfo($lastbid->depicao);
$airp2 = OperationsData::getairportinfo($lastbid->arricao);
$pilot = PilotData::GetPilotData($params);
$pname = $pilot->firstname;
$psurname = $pilot->lastname;
$acrid = OperationsData::getAircraftByReg($lastbid->registration);
?>
<style type="text/css">
<!--
.style2 {
	font-family: Arial;
	font-size: 10px;
}
-->
</style>

<table width="100%" border="0" align="center" cellpadding="1" cellspacing="0">
  <tr>
    <td><p class="style2"><a href="<?php echo SITE_URL?>/index.php/profile/view/<?php echo '' . $params . ''; ?>"><?php echo $pname; ?></a> <strong>has chosen flight</strong> <a href="<?php echo SITE_URL?>/index.php/schedules/details/<?php echo '' . $flightid . '';?> "></a><?php echo $lastbid->code; ?><?php echo $lastbid->flightnum; ?></a> <strong>departing from</strong> <?php echo '<a href=" '.SITE_URL.'/index.php/airports/get_airport?icao='.$lastbid->depicao.'">'.$lastbid->depicao.'</a>';?> <strong>arriving at</strong> <?php echo '<a href=" '.SITE_URL.'/index.php/airports/get_airport?icao='.$lastbid->arricao.'">'.$lastbid->arricao.'</a>';?><strong>,and will be flying a</strong> <a href="<?php echo SITE_URL?>/index.php/vFleetTracker/view/<?php echo '' . $lastbid->registration . ''; ?>">
    <?php echo $lastbid->aircraft; ?></a> (<a href="<?php echo SITE_URL?>/index.php/vFleetTracker/view/<?php echo '' . $lastbid->registration . ''; ?>"><?php echo $lastbid->registration; ?>)</a>
        </p>
        <div class="hr"></div>
        <?php
}
?>
</p>
</td>
  </tr>
</table>




