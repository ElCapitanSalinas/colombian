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

 
$pagination = new Pagination();
$pagination->setLink("screenshots?page=%s");
$pagination->setPage($page);
$pagination->setSize($size);
$pagination->setTotalRecords($total);
$screenshots = ScreenshotsData::getpagnated($pagination->getLimitSql());
?>
<br>
<center><h4><b>Galería de screenshots</b></h4></center>
<table width="100%">
        <tr>
            <td width="50%"><h4>&nbsp;&nbsp;</h4></td>
            <td width="50%" align="right">
                <?php
                if(Auth::LoggedIn())
                    {
                        if(PilotGroups::group_has_perm(Auth::$usergroups, ACCESS_ADMIN))
                        {
                            echo '<br><form method="link" action="'.SITE_URL.'/index.php/screenshots/approval_list">
                                <font size="12px"><input class="btn btn-warning" type="submit" value="Aprobar capturas"></form></font>';
                        }
                        echo '<form method="link" action="'.SITE_URL.'/index.php/screenshots/upload">
                        <font size="12px"><input class="btn btn-info" type="submit" value="Subir una nueva captura"></form></font></td>';
                     }
                     else
                     {
                         echo 'Logueate para calificar o subir capturas.';
                     }
                     ?>
        </tr>
    </table>
    <hr />
    <center>
        <b>Dale click en cualquier imagen para verla ampliada.</b><br /><br />
<?php
if (!$screenshots) {echo '<div id="error">No hay capturas en la base de datos!</div>'; }
else {
    echo '<table class="profiletop">';
    $tiles=0;
    foreach($screenshots as $screenshot) {
        $pilot = PilotData::getpilotdata($screenshot->pilot_id);
        if(!$screenshot->file_description)
        {$screenshot->file_description = 'No disponible';}
        if ($tiles == '0') { echo '<tr>'; }
        echo '<td width="25%" valign="top"><br />
                    Vistas: '.$screenshot->views.' - Calificación: '.$screenshot->rating.'<br /><br />
                    <a href="'.SITE_URL.'/index.php/Screenshots/large_screenshot?id='.$screenshot->id.'">
                        <img src="'.SITE_URL.'/pics/'.$screenshot->file_name.'" border="0" width="450px" alt="Por: '.$pilot->firstname.' '.$pilot->lastname.'" /></a>
                            <br />
                    <u>Enviada por:</u> '.$pilot->firstname.' '.$pilot->lastname.' - '.PilotData::getpilotcode($pilot->code, $pilot->pilotid).'<br />
                    <u>Fecha:</u> '.date('m/d/Y', strtotime($screenshot->date_uploaded)).'<br />
                    <u>Descripción:</u> '.$screenshot->file_description.'<br /><br />
                </td>';
        $tiles++;
        if ($tiles == '4') {  echo '</tr>'; $tiles=0; }
    }
    echo '</table>';
}
$navigation = $pagination->create_links();
echo $navigation;
?>
    </center>