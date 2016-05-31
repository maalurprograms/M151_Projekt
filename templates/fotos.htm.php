<div id="content">
    <form action="<?php print getValue('phpmodule');?>", name="fotos" method="post" enctype="multipart/form-data">
        <input type="file" name="bild" required><br>
        Zu welcher Gallerie soll das Bild hinzugefügt werden?
        <select name="gallerieId" required>
<!--            Generiere Auswahl der gallerie-->
            <?php
                foreach (db_get_galleries_from_benutzer($_SESSION["benutzerId"]) as $gallerie){
                    print "<option id='".$gallerie["gid"]."' value='".$gallerie["gid"]."'>".$gallerie["name"]."</option>";
                }
            ?>
        </select><br>
        <input type="text" name="tags" placeholder="Tags mit ';' getrennt eingeben."><br>
        <input type="submit" value="Upload Image" name="senden">
    </form>
    <p class="<?php echo getValue('css_class_meldung'); ?>">
        <?php echo getValue('meldung')."&nbsp;"; ?>
    </p>
</div>