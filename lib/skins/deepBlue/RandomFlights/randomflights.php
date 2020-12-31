<?php
/*
* phpVMS Module: Random Itinerary Builder
* Coding by Jeffrey Kobus
* www.fs-products.net
* Version 1.4
* Dated: 06/01/2020
*/
?>

<section class="page-contents">
<div class="container">
<br />
<div class="row">
  <div class="col-sm-1">
  </div>
    <div class="col-lg-10">
        <div class="card w-175">
        <h5 class="card-header" style="background-color: #0A1437;"><b><font color="#FFFFFF"><i class="fa fa-star" fa-lg style="color:#FFFFFF"></i> Resultados</font></b></h5>
            <div class="card-body">
                <div id="imprimir">
                <table width="98%" border="0" class="table table-bordered" cellspacing="0">
                    <tr>
                        <th align = "center" <strong>Aerolinea</strong></th>
                        <th align = "center" <strong>Vuelo #</strong></th>
                        <th align = "center" <strong>Aeronave</strong></th>
                        <th align = "center" <strong>Salida</strong></th>
                        <th align = "center" <strong>Llegada</strong></th>
                        <th align = "center" <strong>Duración</strong></th>
                        <th align = "center" <strong>Precio</strong></th>
                    </tr>

                    <?php
                    $pilotid = Auth::PilotID();
                    $user = PilotData::getPilotData($pilotid);

                    if (!$schedules)
                    {
                    ?>
                    <tr><td>No se han encontrado rutas!</td></tr>
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
                    </div>
                    <form name="bidAll" id="bidAll" action="<?php echo SITE_URL?>/index.php/RandomFlights/bidAll" method="post">

                        <?php
                        for($i = 0; $i < count($schedules); $i++)
                        {
                            ?>
                            <input type="hidden" name="schedules[<?php echo $i;?>]" value="<?php echo $schedules[$i]->id;?>">
                            <?php
                        }
                        ?>
                        <hr>
                        <input type="hidden" name="count" value = "<?php echo count($schedules);?>">
                        <input type="hidden" name="pilotid" value="<?php echo $pilotid;?>">
                        <input type="submit" name="submit" class="btn btn-dark" value="Agendar">
                        <input type="button" onclick="printDiv('imprimir')" class="btn btn-info" value="Imprimir" />
                        <a href="<?php echo SITE_URL?>/index.php/RandomFlights"><div class="alert alert-warning" role="alert">Volver a sortear</div></a>
                    </form>
                

            </div>
	    </div>
	</div>
</section>

<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>