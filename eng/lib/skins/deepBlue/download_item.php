<br />
<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div align="center">
<p>
<div align="center">
<div class="alert alert-success">Tu descarga empezará en segundos, o <a href="<?php echo $download->link;?>">click acá para descargar manualmente.</div>
</div></a>
</p>
</div>
<script type="text/javascript"> 
    window.location = "<?php echo $download->link;?>";
</script>

