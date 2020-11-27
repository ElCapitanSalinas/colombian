<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <style>
   @import url('https://fonts.googleapis.com/css2?family=Spartan&display=swap');


   #nav{
      font-family: 'Spartan', sans-serif;
   }
   </style>

    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light" style="font-family: 'Spartan', sans-serif;">
    <a class="navbar-brand" href="#">
    <img src="https://media.discordapp.net/attachments/501578269355671553/762528748720881714/Logo.png" width="70%" height="" alt="" loading="lazy">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo SITE_URL ?>/index.php">Home</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-briefcase"></i> Nosotros
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
         <a class="dropdown-item" href="https://colombianairways.com/index.php/pages/objetivos">Objetivos</a>
         <a class="dropdown-item" href="https://colombianairways.com/docs/MGO.pdf">Rs & Rs</a>
          <a class="dropdown-item" href="<?php echo SITE_URL ?>/index.php/Pilots">Pilotos</a>
          <a class="dropdown-item" href="<?php echo SITE_URL ?>/index.php/vStaff">Staff</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?php echo SITE_URL ?>/index.php/Contact">Contactanos</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-book"></i> Operaciones
        </a>   
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="<?php echo SITE_URL ?>/index.php/Awards">Medallas</a>
          <a class="dropdown-item" href="<?php echo SITE_URL ?>/index.php/Career">Rangos</a>
          <a class="dropdown-item" href="<?php echo SITE_URL ?>/index.php/Finances">Finanzas</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo SITE_URL ?>/index.php/Acars">Mapa</a>
      </li>
         <!-- Start Downloads -->
         <?php
         if(!Auth::LoggedIn())
         {
            // Show these if they haven't logged in yet
         ?>
         <?php
         }
         else
         {
            // Show these items only if they are logged in
         ?>
            <li class="nav-item">
            <a class="nav-link" href="<?php echo SITE_URL ?>/index.php/Downloads"  aria-haspopup="true" aria-expanded="false">
             Descargas</a>
            </li>
            <?php
         }
         ?>
      

         <!-- End Downloads -->
          <!-- Start Crew Center -->
         <?php
         if(!Auth::LoggedIn())
         {
            // Show these if they haven't logged in yet
         ?>
         <?php
         }
         else
         {
            // Show these items only if they are logged in
         ?>
         <ul>
                  <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-users"></i> Centro de tripulación
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
               <a class="dropdown-item" href="<?php echo SITE_URL ?>/index.php/Profile">Mi perfil</a>
               <a class="dropdown-item" href="<?php echo SITE_URL ?>/index.php/Pireps/mine">Mis pireps</a>
               <?php
                        $allbids = SchedulesData::getBids(Auth::$userinfo->pilotid);
                        $counter = (is_array($allbids) ? count($allbids) : 0);
                        if($counter > 0) {
                    ?>
                        <a class="dropdown-item" href="<?php echo SITE_URL ?>/index.php/Schedules/Bids">Mi reserva</a>
                    <?php } else { ?>
                        <a class="dropdown-item" href="<?php echo SITE_URL ?>/index.php/Fltbook">Agendar vuelo</a>
                    <?php } ?>

               <a class="dropdown-item" href="<?php echo SITE_URL ?>/index.php/profile/editprofile">Editar perfil</a>
               <div class="dropdown-divider"></div>
               <a class="dropdown-item" href="https://chat.whatsapp.com/JjwM7KJ7ITG9AwpqMzmtPr" style="text-align: center; font-size: 12px;"><b><i class="fa fa-whatsapp"></i> Whatsapp</b></a>
               <a class="dropdown-item" href="https://discord.gg/rZDB8UGcvd" style="text-align: center; font-size: 12px;"><b><i class="fa fa-globe"></i> Discord</b></a>            
            </div>
            </li>
            <?php
         }
         ?>
            <!-- End Crew Center -->
       <!-- Start Admin -->
         <?php
         if(Auth::LoggedIn())
         {
         if(PilotGroups::group_has_perm(Auth::$usergroups, ACCESS_ADMIN))
         { ?>
         <li class="nav-item">
        <a class="nav-link" href="<?php echo SITE_URL ?>/admin/"><button type="button" class="btn btn-warning"><i class="fa fa-cog"></i></button></a>
          </li>
            
            </ul></li>
            <?php } }?>
         <?php
         if(Auth::LoggedIn() == false);
         {
         ?>
   <!-- End Admin -->
    <!-- Start Sign In -->
         
         <?php
         }
         ?>

            <!-- End Sign In -->

            <!-- Start Logout -->

         <?php
         if(!Auth::LoggedIn())
         {
            // Show these if they haven't logged in yet
         ?>
         <li><a data-toggle="modal" href="#login"><button type="button" class="btn btn-success"><i class="fa fa-user"></i></button></a></li>
         <?php
         }
         else
         {
            // Show these items only if they are logged in
         ?>
         <li><a data-toggle="modal" href="#LogoutModal"><button type="button" class="btn btn-danger"><i class="fa fa-sign-out"></i></button></a></li>
         <?php
         }
         ?>
      <li>&nbsp;</li>
     <li><a data-toggle="nav-item"><img src="https://media.discordapp.net/attachments/501578269355671553/781660738522710096/CO.png" alt=""></a></li>
     <li>&nbsp;&nbsp;&nbsp;</li>
     <li><a data-toggle="nav-item" href="https://colombianairways.com/eng"><img src="https://media.discordapp.net/attachments/501578269355671553/781660734030348328/US.png" alt=""></a></li>
   
    </ul>
  </div>
</nav>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

