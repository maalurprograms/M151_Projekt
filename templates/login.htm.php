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

<!--Original: --------------------------------------------------------------------------------------------------------->
<!--<form name="login" action="--><?php //echo getValue('phpmodule'); ?><!--" method="post">-->
<!--<table cellpadding="0" cellspacing="0">-->
<!--  <tr>-->
<!--	<td colspan="2"><h2>Login</h2></td>-->
<!--  </tr>-->
<!--  <tr>-->
<!--    <td>-->
<!--      <table class="login" cellpadding="5" cellspacing="1">-->
<!--		<col width="120" />-->
<!--		<col width="290" />-->
<!--        <tr>-->
<!--          <td><span class="label">E-Mail:</span></td>-->
<!--          <td><input class="--><?php //echo getCssClass('email'); ?><!--" type="text" name="email" value="--><?php //echo getHtmlValue('email'); ?><!--" size="40" maxlength="100"></td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--          <td><span class="label">Passwort:</span></td>-->
<!--		  <td><input class="--><?php //echo getCssClass('passwort'); ?><!--" type="password" name="passwort" value="--><?php //echo getHtmlValue('passwort'); ?><!--" size="40" maxlength="100"></td>-->
<!--        </tr>-->
<!--      </table>-->
<!--	</td>-->
<!--	<td valign="top">-->
<!--	  <table border="0" cellpadding="5" cellspacing="1" width="360">-->
<!--	    <tr>-->
<!--		  <td>-->
<!--		    <input type="submit" name="senden" value="senden">-->
<!--		  </td>-->
<!--		</tr>-->
<!--	    <tr>-->
<!--		  <td>-->
<!--		    <input type="submit" name="abbrechen" value="abbrechen">-->
<!--		  </td>-->
<!--		</tr>-->
<!--	  </table>-->
<!--	</td>-->
<!--  </tr>-->
<!--  <tr>-->
<!--	<td class="--><?php //echo getValue('css_class_meldung'); ?><!--" colspan="2">-->
<!--	  --><?php //echo getValue('meldung')."&nbsp;"; ?>
<!--	</td>-->
<!--  </tr>-->
<!--</table>-->
<!--</form>-->