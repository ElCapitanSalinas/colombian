<section class="page-contents">
<div class="container">
<br />
<div class="row">
  <div class="col-sm-1">
  </div>
  <div class="col-lg-10">
        <div class="card w-175">
        <h5 class="card-header" style="background-color: #0A1437;"><b><font color="#FFFFFF"><i class="fa fa-star" fa-lg style="color:#FFFFFF"></i> Awards</font></b></h5>
        <div class="card-body">
        <table class="table table-bordered">
			<thead>
				<tr>
				<th scope="col">Award</th>
				<th scope="col">Description</th>
				<th scope="col">Image</th>
				</tr>
			</thead>
			<tbody>
			<?php
			foreach($awards as $aw);
			{
			?>
			<tr id="row<?php echo $aw->awardid;?>">
				<td align="center"><?php echo $aw->name; ?></td>
				<td align="center"><?php echo $aw->descrip; ?></td>
				<td align="center"><img src="<?php echo $aw->image; ?>" /></td>
				</tr>
			<?php
			}
			?>
	</tbody>
	</table>
	</div>
</section>