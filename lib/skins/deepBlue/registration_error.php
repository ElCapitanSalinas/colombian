<section class="page-contents">
<div class="container">
<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<br />
<div class="card text-white bg-success mb-3" style="max-width: 18rem;">
  <div class="card-header">Error!</div>
  <div class="card-body">
    <h5 class="card-title"><b>Sucedió un error</b></h5>
    <p class="card-text">Al parecer ha sucedido un error procesando tu solicitud, contacta a un administrador!.</p>
    <p><?php echo $error; ?></p>
  </div>
</div>
</section>