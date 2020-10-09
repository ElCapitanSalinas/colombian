<section class="page-contents">
<div class="container">
<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<h3><i class="fa fa-commenting" fa-lg style="color:#0C336E"></i> Add Comment</h3>
<form action="<?php echo url('/pireps/viewpireps');?>" method="post">
<strong>Comment: </strong><br />
<textarea name="comment" style="width:90%; height: 150px"></textarea><br />

<input type="hidden" name="action" value="addcomment" />
<input type="hidden" name="pirepid" value="<?php echo $pirep->pirepid?>" /><br>
<input type="submit" name="submit" value="Add Comment" />
</form>
</div>
</section>