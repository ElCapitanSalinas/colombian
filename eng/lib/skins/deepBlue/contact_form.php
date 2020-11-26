<section class="page-contents">
<div class="container">
<br />
<div class="row">
  <div class="col-sm-1">
  </div>
  <div class="col-lg-10">
        <div class="card w-200">
        <h5 class="card-header" style="background-color: #0A1437;"><b><font color="#FFFFFF"><i class="fa fa-envelope" fa-lg style="color:#FFFFFF"></i> Contact Us</font></b></h5>
        <div class="card-body">
		<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
		<form method="post" action="<?php echo url('/contact'); ?>">
        <table class="table table-bordered">
		<tr>
      <td><strong>Name:</strong></td>
      <td>
		<?php
		if(Auth::LoggedIn())
		{
			echo Auth::$userinfo->firstname .' '.Auth::$userinfo->lastname;
			echo '<input type="hidden" class="form-control" name="name"
					value="'.Auth::$userinfo->firstname
							.' '.Auth::$userinfo->lastname.'" />';
		}
		else
		{
		?>
			<input type="text" class="form-control" name="name"value="" />
			<?php
		}
		?>
      </td>
    </tr>
    <tr>
		<td width="1%" nowrap><strong>Mail:</strong></td>
		<td>
		<?php
		if(Auth::LoggedIn())
		{
			echo Auth::$userinfo->email;
			echo '<input type="hidden" class="form-control" name="name"
					value="'.Auth::$userinfo->email.'" />';
		}
		else
		{
		?>
			<input type="text" class="form-control" name="email" value="" />
			<?php
		}
		?>
		</td>
	</tr>

	<tr>
		<td><strong>Subject: </strong></td>
		<td><input class="form-control" type="text" name="subject" value="<?php echo $_POST['subject'];?>" /></td>

	</tr>
    <tr>
      <td><strong>Message:</strong></td>
      <td>
		<textarea name="message" class="form-control" cols='45' rows='5'><?php echo $_POST['message'];?></textarea>
      </td>
    </tr>

    <tr>
		<td width="1%" nowrap><strong>Captcha</strong></td>
		<td>
                    <?php if(isset($captcha_error)){echo '<p class="error">'.$captcha_error.'</p>';} ?>
                    <div class="g-recaptcha" data-sitekey="<?php echo $sitekey;?>"></div>
                    <script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=<?php echo $lang;?>">
                    </script>
		</td>
	</tr>

    <tr>
		<td>
			<input type="hidden" name="loggedin" class="form-control" value="<?php echo (Auth::LoggedIn())?'true':'false'?>" />
		</td>
		<td>
			<button type="submit" class="btn btn-success" name="submit" value='Enviar Mensaje'>Send</button>
		</td>
    </tr>
	</tbody>
	</table>
	<div class="col-sm-1">
  </div>
	</div>
</section>