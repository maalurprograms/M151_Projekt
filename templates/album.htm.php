<div id="content">
    <form id="album" name="album" action="<?php echo getValue('phpmodule'); ?>" method="post">
        <p class="title">Album erstellen</p>
        <input name="name" placeholder="Name eingeben" style="text-align: center">
        <input type="hidden" name="senden">
        <br><input class="safe_button" type="image" src="../icons/ok.png">
        <p class="<?php echo getValue('css_class_meldung'); ?>">
            <?php echo getValue('meldung')."&nbsp;"; ?>
        </p>
    </form>
</div>
