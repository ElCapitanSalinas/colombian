<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<?php
/**
 * 	STOP! HAMMER TIME!
 *
 * ====> READ THIS !!!!!
 *
 * I really really, REALLY suggest you don't edit this file.
 * Why? This is the "main header" file where I put changes for updates.
 * And you don't want to have to manually go through and figure those out.
 *
 * That equals headache for you, and headache for me to figure out what went wrong.
 *
 * BUT BUT WAIT, you say... I want to include more javascript, css, etc...!
 * Well - in your skin's header.tpl file, this file is included as:
 *
 * Template::Show('core_htmlhead.tpl');
 *
 * Just add your stuff under that line there. That way, it's in the proper
 * spot, and this file stays intact for the system (and me) to be able to
 * make clean updates whenever needed. Less bugs = happy users (and happy me)
 *
 * THANKS!
 */
?>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <meta name="description" content="Bienvenido a Colombian Airways, que esperas para iniciar esta nueva etapa virtual?, Las puertas están abiertas para aprender y para volar!.">
    <meta name="keywords" content="Colombian Airways, CBV, Colombian, IVAO, Colombia Aerolineas, Virtual Airlines, aerolineas virtuales colombia, juan f salinas, simulacion, aviacion, aerocivil, ivaocol">

	  <meta name="author" content="Juan F. Salinas"/>
    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = yes, width = device-width">
<script type="text/javascript">
var baseurl = "<?php echo SITE_URL;?>";
var geourl = "<?php echo GEONAME_URL; ?>";
</script>

<link rel="stylesheet" media="all" type="text/css" href="<?php echo fileurl('lib/css/phpvms.css')?>" />
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo Config::Get('PAGE_ENCODING');?>" />

<script async defer src="https://maps.googleapis.com/maps/api/js?AIzaSyBtraAmIrI1-tZWbhOQ9aV74GV-mYZdAA4"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBGo1W8rA2v4SCtxx3Ei5_GkVJMUkHoUQk"></script>
<script type="text/javascript" src="<?php echo fileurl('lib/js/jquery.form.js');?>"></script>
<script type="text/javascript" src="<?php echo fileurl('lib/js/phpvms.js');?>"></script>
<script type="text/html" src="<?php echo SITE_URL?>/lib/skins/blueIce/js/jquery.dataTables.min.js"></script>
<script type="text/html" src="<?php echo SITE_URL?>/lib/skins/blueIce/js/jquery.dataTables.js"></script>
<?php
echo $MODULE_HEAD_INC;