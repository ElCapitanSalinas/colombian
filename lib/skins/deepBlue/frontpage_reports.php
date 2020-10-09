<?php
$count = 5;
$pireps = PIREPData::getRecentReportsByCount($count);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="deepBlue_table">
    <tr>
        <th>Flight</th>
        <th>Pilot</th>
        <th>Dep</th>
        <th>Arr</th>
        <th>Aircraft</th>
        <th>Time</th>
        <th>Landing</th>
        <th>Info</th>
	</tr>
<?php
if(count($pireps) > 0)
{
  foreach ($pireps as $pirep)
  {
    $pilotinfo = PilotData::getPilotData($pirep->pilotid);
    $pilotid = PilotData::getPilotCode($pilotinfo->code, $pilotinfo->pilotid);
    $acrid = OperationsData::getAircraftByReg($pirep->registration);

    echo '<tr>';
    echo '<td><a href="'.SITE_URL.'/index.php/pireps/viewreport/'.$pirep->pirepid.'">'.$pirep->code.$pirep->flightnum.'</a></td>';
    echo '<td><a href="'.SITE_URL.'/index.php/profile/view/'.$pilotinfo->pilotid.'">'.$pilotinfo->firstname.' '.$pilotinfo->lastname.'</a></td>';
    echo '<td>'.$pirep->depicao.'</td>';
    echo '<td>'.$pirep->arricao.'</td>';
    echo '<td>'.$pirep->aircraft.'</td>';
    echo '<td>'.$pirep->flighttime.'</td>';
    echo '<td>'.$pirep->landingrate.' ft/m</td>';
if($pirep->accepted == PIREP_ACCEPTED)

echo '<td><span class="label label-important"><font color="green"><i class="fa fa-check-square" aria-hidden="true"></i> Accepted</font></span></td>';

                                elseif($pirep->accepted == PIREP_REJECTED)

echo '<td><span class="label label-important"><font color="cc0000"><i class="fa fa-minus-circle" aria-hidden="true"></i> Rejected</font></span></td>';

                                elseif($pirep->accepted == PIREP_PENDING)

echo '<td><span class="label label-important"><font color="835C3B"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Pending</font></span></td>';

                                elseif($pirep->accepted == PIREP_INPROGRESS)

echo '<td>On Progress</td>';
    echo '</tr>';
  }
}
else
{
    echo '<tr><td>There are no recent flights!</td></tr>';
}
?>
</tbody>
</table>
