<?php
//simpilotgroup addon module for phpVMS virtual airline system
//
//simpilotgroup addon modules are licenced under the following license:
//Creative Commons Attribution Non-commercial Share Alike (by-nc-sa)
//To view full license text visit http://creativecommons.org/licenses/by-nc-sa/3.0/
//
//@author David Clark (simpilot)
//@copyright Copyright (c) 2009-2010, David Clark
//@license http://creativecommons.org/licenses/by-nc-sa/3.0/
?>
<br>
<div class="row">
  <div class="col-lg-2">
  </div>
  <div class="col-lg-8">
    <div class="card w-175">
        <h5 class="card-header" style="background-color: #0A1437;"><b><font color="#FFFFFF"><i class="fa fa-star" fa-lg style="color:#FFFFFF"></i> Top aterrizajes</font></b></h5>
        <div class="card-body">
        <table width="100%" class="table table-bordered">
            <tr>
                <td>Piloto</td>
                <td>Aeronave</td>
                <td>Aeropuerto</td>
                <td>Landing Rate</td>
                <td>Fecha</td>
            </tr>
        <?php
            foreach($stats as $stat)
            {
                $pilot = PilotData::getPilotData($stat->pilotid);
                $aircraft = OperationsData::getAircraftInfo($stat->aircraft);
                echo '<tr>';
                echo '<td>'.PilotData::getPilotCode($pilot->code, $pilot->pilotid).' - '.$pilot->firstname.' '.$pilot->lastname.'</td>';
                echo '<td>'.$aircraft->fullname.'</td>';
                echo '<td>'.$stat->arricao.'</td>';
                echo '<td>'.$stat->landingrate.'</td>';
                echo '<td>'.date(DATE_FORMAT, strtotime($stat->submitdate)).'</td>';
                echo '</tr>';
            }
        ?>
        </table>
	      </div>
	    </div>
    </div>
    <div class="col-lg-2">
  </div>
</div>
<br>
<!-- 
<table width="100%" border="1px">
    <tr>
        <td>Pilot</td>
        <td>Aircraft</td>
        <td>Arrival Field</td>
        <td>Landing Rate</td>
        <td>Date Posted</td>
    </tr>
<?php
    foreach($stats as $stat)
    {
        $pilot = PilotData::getPilotData($stat->pilotid);
        $aircraft = OperationsData::getAircraftInfo($stat->aircraft);
        echo '<tr>';
        echo '<td>'.PilotData::getPilotCode($pilot->code, $pilot->pilotid).' - '.$pilot->firstname.' '.$pilot->lastname.'</td>';
        echo '<td>'.$aircraft->fullname.'</td>';
        echo '<td>'.$stat->arricao.'</td>';
        echo '<td>'.$stat->landingrate.'</td>';
        echo '<td>'.date(DATE_FORMAT, strtotime($stat->submitdate)).'</td>';
        echo '</tr>';
    }
?>
</table> -->