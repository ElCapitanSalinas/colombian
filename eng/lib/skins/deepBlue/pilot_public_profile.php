<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<?php
if(!$pilot) {
    echo '<br>
    <br>
    <div class="alert alert-danger" role="alert">
    Este piloto no existe!
    </div>';
    return;
}
?>

<div class="container">
<br />
<div class="row">
        <div class="col-lg-4">
        </div>
        <div class="col-lg-4">
                <div class="card">
                        <h5 class="card-header" style="background-color: #0A1437;"><b><font color="#FFFFFF"><center> <i class="fa fa-user" fa-lg style="color:#FFFFFF"></i> Avatar </center></font></b></h5>
                        <div class="card-body">
                        <center>
                        <img src="<?php echo PilotData::getPilotAvatar($pilotcode); ?>"width="256"height="256"class="img-circle"/><br />
                        
                        </center>
                        </div>
                </div>
        </div>
        <div class="col-lg-4">
        <center><div class="alert alert-success" role="alert">
<center>Tienes <a href="#" class="alert-link"><?php echo FinanceData::FormatMoney($userinfo->totalpay) ?></a> Dólares en tu banco!.</center>
</div>
</center>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <center>Contratado hace <strong><?php echo ceil((time() - strtotime($userinfo->joindate)) / 86400); ?> días</strong>!.</center>
            </div>
            <center><button type="button" class="btn btn-dark"><span class="counter"><a href="<?php echo url('/Pilots'); ?>" title="Pilots"><i class="fa fa-users" style="color:#ffffff"></i> <font color="ffffff">Ver todos los pilotos</a></font></span></button></center>
            <br>
            <center><img src="<?php echo $userinfo->rankimage?>"  alt="" /></center>
        </div>
</div>
</div>


<div class="container">
<br />
<div class="row">
  <div class="col-lg-12">
        <div class="card">
                <h5 class="card-header" style="background-color: #0A1437;"><b><font color="#FFFFFF"><i class="fa fa-star" fa-lg style="color:#FFFFFF"></i> Estadisticas de <?php echo $userinfo->firstname . ' ' . $userinfo->lastname; ?></font></b></h5>
                <div class="card-body">
                <table class="table table-bordered">
                <thead>
                        <th width="25%">Nombre</font></b></th>
                        <td width="25%"><?php echo $userinfo->firstname . ' ' . $userinfo->lastname; ?></td>

                        <th width="25%">Horas</font></b></th>
                        <td width="25%"><?php echo Util::AddTime($userinfo->totalhours, $userinfo->transferhours); ?></td>
                        </tr>
                        <tr>
                        <th width="25%">ID</font></b></th>
                        <td width="25%"><?php echo $pilotcode ?></td>
                        <th width="25%">Flights</font></b></th>
                        <td width="25%"><?php echo $userinfo->totalflights?></td>
                        </tr>
                        <tr>
                        <th width="25%">Hub</font></b></th>
                        <td width="25%"><?php echo '<a href=" '.SITE_URL.'/index.php/'.$userinfo->hub.'">'.$userinfo->hub.'</a>';?></td>
                        <th width="25%">Distancia recorrida</font></b></th>

                        </tr>
                        <tr>
                        <th width="25%">Rango</font></b></th>
                        <td width="25%"><?php echo $userinfo->rank;?></td>
                        <th width="25%">Ultimo vuelo</font></b></th>
                        <td width="25%"><?php
                                                if ($userinfo->lastpirep == '0000-00-00 00:00:00') {
                                                        echo 'No hay vuelos!';
                                                }
                                                else {
                                                        $datebefore1 = substr($userinfo->lastpirep, 0, 10);
                                                        $datetoday2 = date("Y-m-d");
                                                        $datebefore3 = strtotime($datebefore1);
                                                        $datetoday4 = strtotime($datetoday2);
                                                        $newdate = $datetoday4-$datebefore3;
                                                        $lastpirep = floor($newdate/(60*60*24));
                                                        echo ' ';
                                                                if ($lastpirep == 0) { echo 'Hoy'; }
                                                                else if ($lastpirep == 1) { echo 'Ayer'; }
                                                                else {
                                                                        echo 'Hace '. $lastpirep . ' Días';
                                                                }
                                                        }                       ?></td>
                        </tr>
                        <tr>
                        <th width="25%">Fecha de contrato:</font></b></th>
                        <td width="25%"><?php echo date('m/d/Y', strtotime($userinfo->joindate));?></td>
                        <th width="25%">Fecha del ultimo vuelo:</font></b></th>
                        <td width="25%"><?php echo date('m/d/Y', strtotime($userinfo->lastpirep));?></td>
                        </tr>
                        </thead>
                        </tbody>

                </table>
                </div>
</div>
</div>


<div id="deepBlue-main">
<div class="deepBlue-sheet clearfix">
<div class="deepBlue-layout-wrapper">
<div class="deepBlue-content-layout">
<div class="deepBlue-content-layout-row">
<div class="deepBlue-layout-cell deepBlue-content"><article class="deepBlue-post deepBlue-deepBlueicle">
<div class="deepBlue-postcontent deepBlue-postcontent-0 clearfix">
<br />

<section class="page-contents">
<div class="container">
<br />
<div class="row">
  <div class="col-sm-1">
  </div>
  <div class="col-lg-10">
        <div class="card w-175">
        <h5 class="card-header" style="background-color: #0A1437;"><b><font color="#FFFFFF"><i class="fa fa-star" fa-lg style="color:#FFFFFF"></i> Medallas ( <?php echo count($allawards); ?> )</font></b></h5>
        <div class="card-body">
        <tr>
<td align="center" colspan="2"><table class="content_middle" width="98%" cellpadding="0" cellspacing="1">
<tr>
<td class="content_middle_b1" width="98%">
<?php
if(!$allawards)
{
echo '<br />';
echo '<div align="center">';
echo '<div class="alert alert-danger"><strong>El piloto no ha ganado medallas aún.</strong></div>';
echo '<div>';
}
else
{
/* To show the image:<img src="<?php echo $award->image?>" alt="<?php echo $award->descrip?>"  /> */
?>
<ul>
<table width="100%" border="0" cellspacing="1" cellpadding="1">
<tr>
<?php $counter = 0; foreach ($allawards as $award) { if ($counter < 4 ) {
echo'<td width="25%"><center><img width="25%" src="'.$award->image.'" alt="'.$award->descrip.'"  title="'.$award->descrip.'" /></center>';
$counter++; } else { echo '<td width="25%"><center><img width="25%" src="'.$award->image.'" alt="'.$award->descrip.'" title="'.$award->descrip.'" /></center></tr><tr>'; $counter = 0;  }}?>
</tr>
</table>
</ul>
<?php
}
?>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
	</div>
</section>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
