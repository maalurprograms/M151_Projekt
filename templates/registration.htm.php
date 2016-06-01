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