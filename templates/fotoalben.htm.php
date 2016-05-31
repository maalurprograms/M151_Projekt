<div id="content">
<!--    TODO DELETE FORM-->
    <form id="delete" name="fotoalben" action="<?php echo getValue('phpmodule'); ?>" method="post">
        <input id="" name="" hidden>
    </form>

    <form id="search" name="fotoalben" action="<?php echo getValue('phpmodule'); ?>" method="post">
        <input class="search_bar" name="search_tags" placeholder="Geben Sie hier ( mit ';' getrennt ) Tags ein" style="text-align: center; width: 400px" required>
        <input type="hidden" name="senden_suche">
        <input class="search_button" type="image" src="../icons/search.png">
    </form>
    <?php
//      Es werden alle Gallerien des Angemeldeten Users ausgelesen.
        $galleries = db_get_galleries_from_benutzer($_SESSION["benutzerId"]);
        print "<div class='alben'>";






//      Das sollte warscheinlich nicht hier sein sonder als value (setValue, getValue) übergeben werden
        if (isset($_REQUEST['senden'])) {
            if(!ctype_space($_POST["search_tags"]) && $_POST["search_tags"]){
//              Wenn eine Anfrage gesendet wurde und das Tag feld nicht leer ist, wird der String aus dem Tag Feld augeteilt.
                print "
                    <div class='search_result_album'>
                        <p class='title'>Resultate für Tags: ".$_POST["search_tags"]."</p>";
                $tags = explode(";", $_POST["search_tags"]);
                foreach ($tags as $tag) {
//                  Für jeden Tag der eingegeben wurde, wird geschaut ob es ihn gibt und wenn ja
//                  werde alle Fotos die diesen tag haben angezeigt.
                    $tagId = db_get_tagid($tag)[0]["tid"];
                    if ($tagId){
                        foreach (db_get_photos_from_tag($tagId) as $foto){
                            $fotoId = $foto["fid"];
                            print "<img id='$fotoId' src='../images/thumbnails/$fotoId'>";
                        }
                    }                
                }
                print "
                    </div>
                    <div class='zoom' id='search_results_zoom'>
                        <img class='zoom_img'>
                        <img class='close_button' src='../icons/close.png'>
                        <img class='delete_button' src='../icons/delete.png'>
                    </div>";
            }
        }
    






        if($galleries) {
            foreach ($galleries as $gallery) {
                print "<div class='album' id='" . $gallery["gid"] . "_album'><p class='title'>" . $gallery["name"] . "</p>";
                $photos = db_get_photos_from_gallery($gallery["gid"]);
                if ($photos) {
                    foreach ($photos as $photo) {
                        print "<img id='" . $photo["fid"] . "_foto' src='../images/thumbnails/" . $photo["fid"] . "'>";
                    }
                }
                print "
                </div>
                <div class='zoom' id='" . $gallery["gid"] . "_zoom'>
                    <img class='zoom_img'>
                    <img class='close_button' src='../icons/close.png'>
                    <img class='delete_button' src='../icons/delete.png'>
                </div>";
            }
            print "</div>";
        }
    ?>
</div>