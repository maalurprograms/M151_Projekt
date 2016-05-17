<div class="container">
    <div class="card card-container">
        <p id="profile-name" class="profile-name-card">Registration</p>
        <form class="form-signin" name="login" action="<?php echo getValue('phpmodule'); ?>" method="post">
            <span id="reauth-email" class="reauth-email"></span>
            <input name="vorname" type="text" id="inputVorname" class="form-control" placeholder="Vorname" required autofocus value="<?php echo getHtmlValue('vorname'); ?>">
            <input name="nachname" type="text" id="inputNachname" class="form-control" placeholder="Nachname" required autofocus value="<?php echo getHtmlValue('nachanme'); ?>">
            <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus value="<?php echo getHtmlValue('email'); ?>">
            <input name="passwort" type="password" id="inputPassword" class="form-control" placeholder="Password" required value="<?php echo getHtmlValue('passwort'); ?>">
            <input name="passwort2" type="password" id="inputPassword2" class="form-control" placeholder="Password wiederholen" required value="<?php echo getHtmlValue('passwort2'); ?>">
            <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="senden">Send</button>
        </form>
        <p class="<?php echo getValue('css_class_meldung'); ?>">
            <?php echo getValue('meldung')."&nbsp;"; ?>
        </p>
    </div>
</div>

<!--Original: --------------------------------------------------------------------------------------------------------->
<!--<form name="registration" action="--><?php //echo getValue('phpmodule'); ?><!--" method="post">-->
<!--<table cellpadding="0" cellspacing="0">-->
<!--  <tr>-->
<!--	<td colspan="2"><h2>Registration</h2></td>-->
<!--  </tr>-->
<!--  <tr>-->
<!--    <td>-->
<!--      <table class="login" cellpadding="5" cellspacing="1">-->
<!--		<col width="120" />-->
<!--		<col width="290" />-->
<!--        <tr>-->
<!--          <td><span class="label">Vorname</span></td>-->
<!--          <td><input class="--><?php //echo getCssClass('vorname'); ?><!--" type="text" name="vorname" value="--><?php //echo getHtmlValue('vorname'); ?><!--" size="40" maxlength="100"></td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--          <td><span class="label">Nachname</span></td>-->
<!--          <td><input class="--><?php //echo getCssClass('nachname'); ?><!--" type="text" name="nachname" value="--><?php //echo getHtmlValue('nachname'); ?><!--" size="40" maxlength="100"></td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--          <td><span class="label">E-Mail *</span></td>-->
<!--          <td><input class="--><?php //echo getCssClass('email'); ?><!--" type="text" name="email" value="--><?php //echo getHtmlValue('email'); ?><!--" size="40" maxlength="100"></td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--          <td><span class="label">Passwort *</span></td>-->
<!--		  <td><input class="--><?php //echo getCssClass('passwort'); ?><!--" type="password" name="passwort" value="--><?php //echo getHtmlValue('passwort'); ?><!--" size="40" maxlength="20"></td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--          <td><span class="label">Passwort wiederholen *</span></td>-->
<!--		  <td valign="top"><input class="--><?php //echo getCssClass('passwort2'); ?><!--" type="password" name="passwort2" value="--><?php //echo getHtmlValue('passwort2'); ?><!--" size="40" maxlength="20"></td>-->
<!--        </tr>-->
<!--      </table>-->
<!--	</td>-->
<!--	<td valign="top">-->
<!--	  <table border="0" cellpadding="5" cellspacing="1" width="360">-->
<!--	    <tr>-->
<!--		  <td>-->
<!--		    <input type="submit" name="senden" value="senden" height="100">-->
<!--		  </td>-->
<!--		</tr>	  -->
<!--	    <tr>-->
<!--		  <td valign="top">-->
<!--		    <input type="submit" name="abbrechen" value="abbrechen">-->
<!--		  </td>-->
<!--		</tr>-->
<!--        <tr><td>&nbsp;</td></tr>-->
<!--        <tr><td>1 Gross-, Kleinbuchst., Ziffer + Sonderz., min.Länge = 8</td></tr>-->
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
