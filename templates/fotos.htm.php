<form action="<?php print getValue('phpmodule');?>", name="fotos" method="post" enctype="multipart/form-data">
    <?php print getValue('phpmodule');?>
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="senden">
</form>
<p class="<?php echo getValue('css_class_meldung'); ?>">
    <?php echo getValue('meldung')."&nbsp;"; ?>
</p>