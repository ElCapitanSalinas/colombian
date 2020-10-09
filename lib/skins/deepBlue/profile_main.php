<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<?php
if(!$pilot) {
    echo '<h3>Este piloto no existe!</h3>';
    return;
}
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

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
                        <img src="<?php echo PilotData::getPilotAvatar($pilotcode); ?>"width="128"height="128"class="img-circle"/><br />
                        <img src="<?php echo $userinfo->rankimage?>"  alt="" />
                        </center>
                        </div>
                </div>
        </div>
        <div class="col-lg-4">
        <center><div class="alert alert-success" role="alert">
<center>Tienes <a href="#" class="alert-link"><?php echo FinanceData::FormatMoney($userinfo->totalpay) ?></a> Dólares en tu banco!.</center>
</div></center>
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
<br>
<br>
<h1>&nbsp;</h1>

<div class="container">
<br />
<div class="row">
        <div class="col-lg-1">
        </div>
        <div class="col-lg-10">
        <div class="card">
                <h5 class="card-header" style="background-color: #0A1437;"><b><font color="#FFFFFF"><i class="fa fa-star" fa-lg style="color:#FFFFFF"></i> ACCIONES PROPIAS</font></b></h5>
                <div class="card-body">
                                                        
                <div class="card-group">
                                <div class="card">
                                <center><font size="+2"><i class="fa fa-pencil fa-5x"style="color:#D82F2F"></i></font></center>
                        <div class="card-body">
                        <p class="card-text"><center><a href="<?php echo url('/profile/editprofile'); ?>"><button type="button" class="btn btn-primary">Editar Perfil</button></a></center></p>
                </div>
                </div>
                <div class="card">
                <center><font size="+2"><i class="fa fa-lock fa-5x"style="color:#D82F2F"></i></font></center>
                        <div class="card-body">
                        <p class="card-text"><center><a href="<?php echo url('/profile/changepassword'); ?>"><button type="button" class="btn btn-danger">Cambiar mi contraseña</button></a></center></p>
                        </div>
                        </div>
                <div class="card">
                                <center><font size="+2"><i class="fa fa-user fa-5x"style="color:#D82F2F"></i></font></center>
                                <div class="card-body">
                                <p class="card-text" style="color:#ffffff;"></p>
                                <p class="card-text"><center><a href="<?php echo url('/profile/badge'); ?>"><button type="button" class="btn btn-primary">Ver mi firma</button></a></center></p>
                                </div>
                                </div>
                        </div>
                        <div class="card-group">
                                <div class="card">
                                <center><font size="+2"><i class="fa fa-line-chart fa-5x"style="color:#D82F2F"></i></font></center>
                        <div class="card-body">
                        <p class="card-text"><center><a href="<?php echo url('/profile/stats'); ?>"><button type="button" class="btn btn-danger">Mis estadísticas</button></a></center></p>
                </div>
                </div>
                <div class="card">
                <center><font size="+2"><i class="fa fa-search fa-5x"style="color:#D82F2F"></i></font></center>
                        <div class="card-body">
                        <p class="card-text"><center><a href="<?php echo url('/pireps/mine'); ?>"><button type="button" class="btn btn-primary">Ver mis PIREP's</button></a></center></p>
                        </div>
                        </div>
                <div class="card">
                                <center><font size="+2"><i class="fa fa-map-marker fa-5x"style="color:#D82F2F"></i></font></center>
                                <div class="card-body">
                                <p class="card-text" style="color:#ffffff;"></p>
                                <p class="card-text"><center><a href="<?php echo url('/pireps/routesmap'); ?>"><button type="button" class="btn btn-danger">Mapa de vuelos</button></a></center></p>
                                </div>
                                </div>
                        </div>
                        
                </div>
                

                <div class="card-group">
                                <div class="card">
                                <center><font size="+2"><i class="fa fa-file-text-o fa-5x"style="color:#D82F2F"></i></font></center>
                        <div class="card-body">
                        <p class="card-text"><center><a href="<?php echo url('/Fltbook'); ?>"><button type="button" class="btn btn-primary">Buscar vuelos</button></a></center></p>
                </div>
                </div>
                <div class="card">
                <center><font size="+2"><i class="fa fa-book  fa-5x"style="color:#D82F2F"></i></font></center>
                        <div class="card-body">
                        <p class="card-text"><center><a href="<?php echo url('/schedules/bids'); ?>"><button type="button" class="btn btn-danger">Mis agendas</button></a></center></p>
                        </div>
                        </div>
                <div class="card">
                                <center><font size="+2"><i class="fa fa-money fa-5x"style="color:#D82F2F"></i></font></center>
                                <div class="card-body">
                                <p class="card-text" style="color:#ffffff;"></p>
                                <p class="card-text"><center><a href="<?php echo url('/finances'); ?>"><button type="button" class="btn btn-primary">Finanzas generales</button></a></center></p>
                                </div>
                                </div>
                        </div>
                        
                </div>
                        
                </div>
                
        </div>
        </div>
        </div>
        <div class="col-lg-1">
        
        </div>
</div>
</div>

<!--Begin Bank Roll -->
<div class="row">
        <div class="col-lg-4">
        </div>
  <div class="col-lg-12">
        
    </div>  
    <div class="col-lg-4">
        </div>
</div>
