<div style="text-align:center;">
  <h2><?php echo $this->school_name !== '' ? $this->school_name : '';?></h2>
</div>
<form action="" method="POST"  class="form-signin" role="form" autocomplete="off">
<h2 class="form-signin-heading" style="text-align:center;">
<span class="label label-default"><span class="glyphicon glyphicon-user"></span> <?=htmlspecialchars(ucwords($userType)); ?></span>
</h2>
<?=$system_message;?>
	<input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
	<input type="password" name="password" class="form-control" placeholder="Password" required>
	<input type="text" name="captcha_text" class="form-control" placeholder="Captcha" required>
	<?=$captcha_image;?>
	
	
	
	<input type="hidden" name="fit" value="<?=$form_token;?>"/>
	<input class="btn btn-lg btn-primary btn-block" type="submit" value="Login" name="backstage_login"/>
</form>

<div style="padding-left:20px;">
	<a href="<?php echo site_url('welcome');?>"class="btn btn-default btn-sm"><span class="glyphicon glyphicon-home"></span> Back To Home</a>
</div>