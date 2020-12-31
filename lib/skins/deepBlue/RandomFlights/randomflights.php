<?php
/*
* phpVMS Module: Random Itinerary Builder
* Coding by Jeffrey Kobus
* www.fs-products.net
* Version 1.4
* Dated: 06/01/2020
*/
?>

<p><a href="<?php echo SITE_URL?>/index.php/RandomFlights">Start New Flight Search</a></p>

<section class="page-contents">
<div class="container">
<br />
<div class="row">
  <div class="col-sm-1">
  </div>
    <div class="col-lg-10">
        <div class="card w-175">
        <h5 class="card-header" style="background-color: #0A1437;"><b><font color="#FFFFFF"><i class="fa fa-star" fa-lg style="color:#FFFFFF"></i> Medallas</font></b></h5>
            <div class="card-body">
            
                <table width="98%" border="0" class="table table-bordered" cellspacing="0">
                    <tr>
                        <th align = "center" <strong>Airline</strong></th>
                        <th align = "center" <strong>Flight #</strong></th>
                        <th align = "center" <strong>Aircraft</strong></th>
                        <th align = "center" <strong>Departure</strong></th>
                        <th align = "center" <strong>Arrival</strong></th>
                        <th align = "center" <strong>Duration</strong></th>
                        <th align = "center" <strong>Price</strong></th>
                    </tr>

                    <?php
                    $pilotid = Auth::PilotID();
                    $user = PilotData::getPilotData($pilotid);

                    if (!$schedules)
                    {
                    ?>
                    <tr><td>No Routes Found!</td></tr>
                    <?php
                    } else {
                        foreach($schedules as $result)
                        {
                            $info = OperationsData::getAircraftByReg($result->registration);
                        ?>
                        <tr>
                            <td><?php echo $result->code;?></td>
                            <td><?php echo $result->code.$result->flightnum;?></td>
                            <td><?php echo $info->registration;?></td>
                            <td><?php echo $result->depicao;?></td>
                            <td><?php echo $result->arricao;?></td>
                            <td><?php echo $result->flighttime;?></td>
                            <td><?php echo $result->price;?></td>
                        </tr>
                        <?php } } ?>
                        </table>
                    <form name="bidAll" id="bidAll" action="<?php echo SITE_URL?>/index.php/RandomFlights/bidAll" method="post">

                        <?php
                        for($i = 0; $i < count($schedules); $i++)
                        {
                            ?>
                            <input type="hidden" name="schedules[<?php echo $i;?>]" value="<?php echo $schedules[$i]->id;?>">
                            <?php
                        }
                        ?>
                        <input type="hidden" name="count" value = "<?php echo count($schedules);?>">
                        <input type="hidden" name="pilotid" value="<?php echo $pilotid;?>">
                        <input type="submit" name="submit" class="btn btn-dark"value="Agendar">
                        
                    </form>
                

            </div>
	    </div>
	</div>
</section>
