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

$pilot = PilotData::getPilotData($screenshot->pilot_id);
?>
<table width="100%">
        <tr>
            <td>
                <?php
                    $previous = ScreenshotsData::get_previous($screenshot->id);
                    if(!$previous)
                    {echo '&nbsp'; }
                    else
                    {
                ?>
                <form method="post" action="<?php echo SITE_URL ?>/index.php/Screenshots" >
                <input type="hidden" name="action" value="last" />
                <input type="hidden" name="id" value="<?php echo $previous->id; ?>" />
                <br>
                <input class="btn btn-dark" style="font-size: 12px;" type="submit" value="Imagen anterior">
                </form>
                <?php
                    }
                    ?>
            </td>
            <td colspan="2" align="right">
                <?php
                    $next = ScreenshotsData::get_next($screenshot->id);
                    if(!$next)
                    {echo '&nbsp'; }
                    else
                    {
                ?>
                <form method="post" action="<?php echo SITE_URL ?>/index.php/Screenshots" >
                <input type="hidden" name="action" value="last" />
                <input type="hidden" name="id" value="<?php echo $next->id; ?>" />
                <input class="btn btn-dark" style="font-size: 12px;" type="submit" value="Siguiente imagen">
                </form>
                <?php
                    }
                    ?>
            </td>
        </tr>
        <tr>
            <td colspan="3"><hr /></td>
        </tr>
        <tr>
            <td width="70%"valign="top"><h4>Imagen por: <?php echo $pilot->firstname.' '.$pilot->lastname.' - '.PilotData::GetPilotCode($pilot->code, $pilot->pilotid); ?></h4></td>
            
            <td width="15%" valign="bottom" align="center">
                <b>Votos: </b><?php echo $screenshot->rating; ?>
            </td>
            <td  width="15%" valign="bottom">
                <?php
                    if(Auth::loggedin())
                    {
                    $boost = ScreenshotsData::check_boost(Auth::$userinfo->pilotid, $screenshot->id);
                    if($boost->total > 0)
                    {echo 'Ya fue votada';}
                    else
                    {
                    ?>
                    <form method="post" action="<?php echo SITE_URL ?>/index.php/Screenshots/addkarma">
                    <input type="hidden" name="id" value="<?php echo $screenshot->id; ?>" />
                    <input class="btn btn-dark" style="font-size: 12px;" type="submit" value="Votar"></form>
                    <?php
                    }
                    }
                    else
                    {echo 'Ingresa para votar'; }
                    ?>
            </td>
        </tr>
        <tr>
            <td>
                <b>Enviada en:</b> <?php echo date('m/d/Y', strtotime($screenshot->date_uploaded)); ?><br />
                <b>Descripción:</b> <?php 
                                        if(!$screenshot->file_description)
                                        {echo 'No disponible';}
                                        else
                                        {echo $screenshot->file_description;} ?>
                <br /></td>
            <td align="center"><b>Views:</b> <?php echo $screenshot->views; ?></td>
            <td>
                <!-- <form><input class="btn btn-dark" style="font-size: 12px;" type="button" value="Back To Gallery" onClick="history.go(-1);return true;"> </form> -->
                  <?php if(PilotGroups::group_has_perm(Auth::$usergroups, ACCESS_ADMIN))
                        { ?><a href="<?php echo SITE_URL ?>/index.php/Screenshots/delete_screenshot?id=<?php echo $screenshot->id; ?>"><b>Borrar imagen</b></a><?php } else {} ?>
                <form method="link" action="<?php echo SITE_URL ?>/index.php/Screenshots">
                <input class="btn btn-dark" style="font-size: 12px;" type="submit" value="Volver a la galería"></form>
            </td>
        </tr>
        <tr>
            <td colspan="3"><hr /></td>
        </tr>
        <tr>
            <td align="center" colspan="3">
                <img src="<?php echo SITE_URL; ?>/pics/<?php echo $screenshot->file_name; ?>" style="max-width: 940px" alt="<?php echo $screenshot->file_description; ?>" />
            </td>
        </tr>
        <tr>
            <td colspan="3"><hr /></td>
        </tr>
        <tr>
            <td>
            <div class="card w-80">
                    <h5 class="card-header" style="background-color: #0A1437;"><b><font color="#FFFFFF"><i class="fa fa-star" fa-lg style="color:#FFFFFF"></i> Comentarios</font></b></h5>
                    <div class="card-body">
                    <table class="table table-bordered">
                    <tr>
                        <th>Comentario</th>
                        <th>Autor</th>
                    </tr>
                    <?php if(!$comments)
                        {echo '<p>No Comments</p>';}
                        else
                        {
                            echo '<tr><td colspan="3"><hr class="comment" /></td></tr>';
                            foreach($comments as $comment){
                                $pilot = PilotData::getPilotData($comment->pilot_id);
                                echo '<tr>';
                                echo '<td colspan="2">'.$comment->comment.'</td>';
                                echo '<td>'.$pilot->firstname.' '.$pilot->lastname.' - '.PilotData::getPilotCode($pilot->code, $pilot->pilotid).'</td>';
                                echo '</tr>';
                                echo '<tr><td colspan="3"><hr class="comment" /></td></tr>';
                            }
                        }
                    ?>            
                    </div>
                    </table>
            </div>
            </td>
            <td></td>
        </tr>
        
        <tr>
            <td colspan="3"><hr /></td>
        </tr>
        <?php if(Auth::LoggedIn())
        { ?>
        <tr>
            <td colspan="3"><h4>Add A Comment:</h4></td>
        </tr>
        <tr>
            <td colspan="3">
                <br />
                <form action="<?php echo url('/Screenshots');?>" method="post" enctype="multipart/form-data">
                <textarea name="comment" cols="50" rows="4"></textarea>
                    <br /><br />
                    <input type="hidden" name="id" value="<?php echo $screenshot->id; ?>" />
                    <input type="hidden" name="action" value="add_comment" />
                        <input class="btn btn-dark" style="font-size: 12px;" type="submit" value="Add Comment">
                </form>
            </td>
        </tr>
        <?php }
        else
        { ?>
        <tr>
            <td colspan="3">Login to add a comment</td>
        </tr>
        <?php } ?>
    </table>