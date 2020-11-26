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
<br>
<section class="page-contents">
<div class="container">
<br />
<div class="row">
  <div class="col-sm-1">
  </div>
  <div class="col-lg-10">
        <div class="card w-175">
        <h5 class="card-header" style="background-color: #0A1437;"><b><font color="#FFFFFF"><i class="fa fa-shield" fa-lg style="color:#FFFFFF"></i> Nuestro Staff</font></b></h5>
        <div class="card-body">
        <table class="table table-bordered">
        <?php
                if(!$stafflevels)
                {
                echo 'No hay staff!';
                $stafflevels = array();
                }
                foreach($stafflevels as $level)
                {
                ?>
			<thead>
				<tr>
				<th scope="col"><?php echo $level->name;?></th>
				</tr>
			</thead>
			<tbody>
              <?php
                $allstaff = vStaffListData::GetAllStaffInCat($level->id);
                    if(!$allstaff)
                    {
                    $allstaff = array();
                    echo '<tr class="row0"><td align="center" colspan="3">No Staff Members</td></tr>';
                    }
                    foreach($allstaff as $staff)
                    {
                ?>
                <tr>
                <td align="center"><?php if($staff->pilotid == 0)
                                    {
                                        echo 'VACANT';
                                    }
                                    else
                                    {
                                        echo '<a href="'.url('vStaff/view/'.$staff->id).'">'.$staff->firstname.' '.$staff->lastname.'</a>';
                                    }
                                    ?></td>
                <td align="center"><?php echo $staff->title;?></td>
                <td align="center"><?php echo $staff->email;?></td>
                </tr>
                <?php
                }
                ?>
            <?php
            }
            ?>
	</tbody>
	</table>
	</div>
</section>
