<?php
/*
Module Created By Vansers-Add-Ons (Vansers)
This module is only use for phpVMS (www.phpvms.net) - (A Virtual Airline Admin Software)
@Created By Vansers
@Copyrighted @ 2013


Version 1.0 (April.20.13) - Module Created

TO INSTALL MODULE:

1) Place the files as structured in the folder into your phpVMS Install location

2) Please run the sql_install.sql in your phpVMS as this will insert two tables for functionally of the module.

3) Enjoy!

MODULE LINKS TO ADD TO YOUR WEBSITE. THE ADMIN LINK IS ALREADY ADDED.

<?php echo url('/vStaff'); ?>
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
        <h5 class="card-header" style="background-color: #0A1437;"><b><font color="#FFFFFF"><i class="fa fa-user" fa-lg style="color:#FFFFFF"></i> Ver perfil administrativo - <?php echo $staff->firstname.' '.$staff->lastname; ?> (<?php echo $staff->titleabr;?>)</font></b></h5>
        <div class="card-body">
        <?php if(isset($message)) { echo '<div id="success">'.$message.'</div>'; }?>
          <table width="0" border="0">
            <tr>
            <td rowspan="5">
              <?php if (empty($staff->picturelink))
              {
                echo '<img src="'.SITE_URL.'/staff_photos/nophoto.jpg"/>';
              }
              else
              {
                echo '<img src="'.SITE_URL.'/staff_photos/'.$staff->picturelink.'" width="220" height="138" />';
              }
              ?></td>
              <td><strong>Nombre:</strong></td>
              <td><?php echo $staff->firstname.' '.$staff->lastname; ?> - <a href="<?php echo url('profile/view/'.$staff->pilotid);?>">Ver perfil</a></td>
            </tr>
            <tr>
              
              <td><strong>Posición:</strong></td>
              <td><?php echo $staff->title; ?> (<?php echo $staff->titleabr;?>)</td>
            </tr>
            <tr>
              <td><strong>Correo:</strong></td>
              <td><a href="mailto:<?php echo $staff->email;?>"><?php echo $staff->email;?></a></td>
            </tr>
            <tr>
              <td><strong>Bio staff:</strong></td>
              <td>
              <?php if (empty($staff->bio))
              {
                echo 'No hay una Bio!';
              }
              else
              {
                echo html_entity_decode($staff->bio);
              }
              ?></td>
            </tr>
          </table>          
      </div>
    </section>