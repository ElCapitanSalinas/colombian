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
?>
<section class="page-contents">
<div class="container">
<br />
<div class="row">
  <div class="col-sm-1">
  </div>
  <div class="col-lg-10">
        <div class="card w-175">
        <h5 class="card-header" style="background-color: #0A1437;"><b><font color="#FFFFFF"><i class="fa fa-star" fa-lg style="color:#FFFFFF"></i> Subir nueva imagen</font></b></h5>
        <div class="card-body">
                    
            <form action="<?php echo url('/Screenshots');?>" method="post" enctype="multipart/form-data">
                <table class="profiletop">
                    <tr>
                        <td width="50%" valign="top">
                            <h5><b>Para tener en cuenta:</b></h5>
                            <ul>
                                <li>- No está permitido subir imagenes no relacionadas con la aerolinea</li>
                                <li>- Está prohibido subir contenido pornografico o de cualquier otra indole</li>
                                <li>- En lo posible subir imagenes relacionadas con el simulador</li>
                            </ul>
                        </td>
                        <td>
                            <p>
                                <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size ?>">
                            </p>

                            <p>
                                <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
                                <label for="file">Subir:</label><br />
                                <input class="form-control-file" id="file" type="file" name="uploadedfile" />
                            </p>

                            <p>
                                <label for="description">Ingresa una descripción para la imagen:</label><br />
                                <textarea name="description" class="form-control" rows="5" cols="50"></textarea>
                            </p>

                            <p>
                                <input type="hidden" name="action" value="save_upload" />
                                <input type="submit" class="btn btn-dark" value="Subir">
                            </p>
                        </td>
                    </tr>
                </table>
            </form>

            <center>
                <br />
                <form method="link" action="<?php echo SITE_URL; ?>/index.php/screenshots">
                    <input  type="submit" value="Volver a galería"></form>
            </center>       
	</div>
	</div>
	</div>
</section>