<?php
//simpilotgroup addon module for phpVMS virtual airline system
//
//simpilotgroup addon modules are licenced under the following license:
//Creative Commons Attribution Non-commercial Share Alike (by-nc-sa)
//To view full icense text visit http://creativecommons.org/licenses/by-nc-sa/3.0/
//
//@author David Clark (simpilot)
//@copyright Copyright (c) 2009-2010, David Clark
//@license http://creativecommons.org/licenses/by-nc-sa/3.0/

echo '<br /><center>';
if (!$screenshots)
{
    echo '<div id="error">No hay screenshots esperando a ser aprobadas</div>';
    echo '<form method="link" action="'.SITE_URL.'/index.php/Screenshots">
                <input class="btn btn-dark" style="font-size: 12px;" type="submit" value="Volver a la galería"></form>';
    }
else
{
foreach($screenshots as $screenshot)
    {
        $pilot = PilotData::getpilotdata($screenshot->pilot_id);
        
        echo '<form action="'.SITE_URL.'/index.php/Screenshots" method="post" enctype="multipart/form-data">';
       echo '
                    <section class="page-contents">
                <div class="container">
                <br />
                <div class="row">
                <div class="col-sm-1">
                </div>
                <div class="col-lg-10">
                        <div class="card w-175">
                        <h5 class="card-header" style="background-color: #0A1437;"><b><font color="#FFFFFF"><i class="fa fa-star" fa-lg style="color:#FFFFFF"></i> Foto de '.$pilot->firstname.' '.$pilot->lastname.' - '.PilotData::getpilotcode($pilot->code, $pilot->pilotid).' </font></b></h5>
                        <div class="card-body">
                        <table class="profiletop">
                        <tr>
                                    <td>
                                        <img src="'.SITE_URL.'/pics/'.$screenshot->file_name.'" width="25%" height="28%" alt="screenshot" /><br /><br />
                                    </td>
                                    <td>
                                        Nombre del archivo: '.$screenshot->file_name.'<br /><br />
                                        Enviada por: '.$pilot->firstname.' '.$pilot->lastname.' - '.PilotData::getpilotcode($pilot->code, $pilot->pilotid).'<br /><br />
                                        Fecha: '.date('m/d/Y', date(strtotime($screenshot->date_uploaded))).'<br /><br />
                                        Descripción: '.$screenshot->file_description.'<br /><br />
                                        <input type="hidden" name="file" value="'.$screenshot->file_name.'" />
                                        <input type="hidden" name="id" value="'.$screenshot->id.'" />
                                        <input type="hidden" name="pid" value="'.$pilot->pilotid.'" />
                                        <input type="hidden" name="action" value="approve_screenshot" />
                                        <input class="btn btn-success" style="font-size: 12px;" type="submit" value="Aprobar">
                                        </form>
                                        <br /><br />
                                        <form action="'.SITE_URL.'/index.php/Screenshots" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="file" value="'.$screenshot->file_name.'" />
                                        <input type="hidden" name="id" value="'.$screenshot->id.'" />
                                        <input type="hidden" name="pid" value="'.$pilot->pilotid.'" />
                                        <input type="hidden" name="action" value="reject_screenshot" />
                                        <input class="btn btn-danger" style="font-size: 12px;" type="submit" value="Rechazar">
                                    </td>';
                              echo '</tr>';
                              echo '</table>
                    </div>
                    </div>
                    </div>
                </section>
</form>';

    }
}
 echo '</center>';
?>