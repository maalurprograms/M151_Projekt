<div class="container">
	<div class="card card-container">
		<p id="profile-name" class="profile-name-card">Login</p>
		<form class="form-signin" name="login" action="<?php echo getValue('phpmodule'); ?>" method="post">
			<span id="reauth-email" class="reauth-email"></span>
			<input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus value="<?php echo getHtmlValue('email'); ?>">
			<input name="passwort" type="password" id="inputPassword" class="form-control" placeholder="Password" required value="<?php echo getHtmlValue('passwort'); ?>">
			<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="senden">Send</button>
		</form>
		<p class="<?php echo getValue('css_class_meldung'); ?>">
			<?php echo getValue('meldung')."&nbsp;"; ?>
		</p>
	</div>
</div>