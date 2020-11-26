<section class="page-contents">
<div class="container">
<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<?php
if(!$allpages)
	return;

foreach($allpages as $page)
{
	echo '<li><a href="'.url('/pages/'.$page->filename).'">'.$page->pagename.'</a></li>';
}

?>
</div>
</section>