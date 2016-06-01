<div id="content">
    <form id="search" name="fotoalben" action="<?php echo getValue('phpmodule'); ?>" method="post">
        <input class="search_bar" name="search_tags" placeholder="Geben Sie hier ( mit ';' getrennt ) Tags ein" style="text-align: center; width: 400px" required>
        <input type="hidden" name="senden_suche">
        <input class="search_button" type="image" src="../icons/search.png">
    </form>
    <?php
        $html = "<div class='alben'>";

//       Dies ist der Code Teil der im ZoomDiv bei sowohl den Alben als auch den Suchresultaten gleich.
        $zoomContent = "
            <img class='zoom_img'>
            <input type='image' class='close_button' src='../icons/close.png'>
            <input type='image' class='delete_button' src='../icons/delete.png'>
            <form class='delete_foto' name='fotoalben' action='".getValue('phpmodule')."' method='post'>
                <input class='delete_foto_id' name='delete_foto' hidden>
            </form>
        </div>";

    //  Wenn etwas Gesucht wurde, werden die Suchresultate angezeigt.
        if (getValue("search_results")) {
            $html .= "
                    <div class='search_result_album'>
                        <p class='title'>Resultate für Tags: ".getValue("search_tags")."</p>";
    //       Jedes Bild das den/die Tag/s aus der Suchanfrage hat wird nun generiert.
            foreach (getValue("search_results") as $fotoId){
                $html.= "<img id='$fotoId' src='../images/thumbnails/$fotoId'>";
            }
            
        }
    //  Nun erstellen wir noch das Vergrösserte Bild das aber erst angezeigt wird wenn wir auf ein Bild klicken.
        $html .= "
                </div>
                <div class='zoom' id='search_results_zoom'>$zoomContent";
    
    //  Wenn der Benutzer Alben gespeichert hat werden si nun mit den dazugehörigen
    //  Bildern angezeigt.
        if(getValue("alben")) {
            foreach (getValue("alben") as $album){
    //          getValue("alben") gibt die Id und den Namen zurück, 
    //          wesswegen wir den String noch mal aufteilen.
                $albumId = explode("_", $album)[0];
                $albumName = explode("_", $album)[1];
                $html .= "<div class='album' id='$albumId".""."_album'><p class='title'>".$albumName."</p>";
                if (getValue("album_".$albumId)){
    //              Wenn das Album Fotos beinhaltet, werden diese als HTML generiert.
                    foreach (getValue("album_$albumId") as $fotoId){
                        $html .= "<img id='$fotoId".""."_foto' src='../images/thumbnails/$fotoId'>";
                    }
                }
                $html .= "
                </div>
                <div class='zoom' id='$albumId".""."_zoom'>$zoomContent";
            }
            $html .= "</div>";
        }
    
        print $html;

    ?>
</div>