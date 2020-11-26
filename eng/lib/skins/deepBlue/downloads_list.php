
<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<br>
<h3>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;<i class="fa fa-download" fa-lg"></i><b> Descargas</b></h3>

<section class="page-contents">
<div class="container">
<br />
<div class="row">
  <div class="col-lg-3">
        <div class="card w-175">
		<?php 
		if(!$allcategories)
		{
			echo 'No hay descargas disponibles!';
			return;
		}

		foreach($allcategories as $category)
		{
		?>
		<p><h2><strong></strong></h2></p>
		<h5 class="card-header" style="background-color: #0A1437;"><b><font color="#FFFFFF"><?php echo $category->name?></font></b></h5>
		<ul>

		<?php	
			# This loops through every download available in the category
			$alldownloads = DownloadData::GetDownloads($category->id);
			
			if(!$alldownloads)
			{
				echo 'No hay descargas en esta categoría';
				$alldownloads = array();
			}
			
			foreach($alldownloads as $download)
			{
		?>
        <div class="card-body">
		<img class="img-fluid" src="<?php echo $download->image; ?>" alt="<?php echo $download->name; ?>">
		<br>	
		Nombre:<a href="<?php echo url('/downloads/dl/'.$download->id);?>">
			 <?php echo $download->name?></a><br />
	      Descripción: <?php echo $download->description?><br />
          <em>Descargado <?php echo $download->hits?> veces</em></li>
			<?php
				}
			?><hr />
				<?php
			}
			?>

		</div>
</section>
