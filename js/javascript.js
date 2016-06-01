function confdel(item) {
//  Je nach System müssen Umlaute maskiert werden oder nicht
//  answer=confirm(unescape("M%F6chten Sie " + item + " wirklich l%F6schen?"));
    answer = confirm("Möchten Sie " + item + " wirklich löschen?");
    return answer;
}

$(window).ready(function () {
    $(".zoom").hide()

    // Wenn auf ein Bildthumbnail geklickt wird, wird das div mit dem Original Bild sichtbar.
    $(".album img, .search_result_album img").click(function () {

        // Wenn auf ein Bild der Suche geklickt wird muss das anders behandelt werden als bei einem Bild von einem Album.
        if ($(this).parent().attr("class") == "search_result_album"){
            // Das geklickte Bild wird nun als SRC attribut im Zoom DIV angegeben.
            $("#search_results_zoom .zoom_img").attr("src", "../images/"+$(this).attr("id"))
            // Die Id im Delete Form setzen damit wir beim absenden des Forms wissen welches bild wir löschen müssen.
            $("#search_results_zoom .delete_foto_id").attr("value", $(this).attr("id"))
            // Das Zoom DIV wird gezeigt.
            $("#search_results_zoom").show()

            //Wenn auf das Schliessen Icon geklickt wird, soll das Grosse Bild wieder zugehen.
            $(".close_button").click(function () {
                $("#search_results_zoom").hide()
            })
        } else {

            // Die ID des Albums wird gespeichert
            var album = $(this).parent().attr("id").split("_")[0]
            // Die ID des Fotos wird gespeichert.
            var foto = $(this).attr("id").split("_")[0]
            // Jedes Zoom DIV wird wider unsichtbar gemacht,
            // da wir immer nur das DIV mit dem Bild das wir angeklickt haben sehen wollen.
            $(".zoom").each(function () {
                if ($(this).attr("id") != "#" + album + "_zoom") {
                    $(this).hide();
                }
            })
            // Das geklickte Bild wird nun als SRC attribut im Zoom DIV angegeben.
            $("#" + album + "_zoom .zoom_img").attr("src", "../images/" + foto)
            // Die Id im Delete Form setzen damit wir beim absenden des Forms wissen welches bild wir löschen müssen.
            $("#" + album + "_zoom .delete_foto_id").attr("value", foto)
            // Das Zoom DIV wird gezeigt.
            $("#" + album + "_zoom").show()

            //Wenn auf das Schliessen Icon geklickt wird, soll das Grosse Bild wieder zugehen.
            $(".close_button").click(function () {
                $("#" + album + "_zoom").hide()
            })
        }
        // Wenn auf das löschen icon geklickt wird, kommt eine Bestätigungsfrage.
        // Danach wird ein submit auf das Delete_Foto form ausgeführt.
        $(".delete_button").click(function () {
            if (confdel("dieses Bild")){
                $("#"+$(this).parent().attr("id")+" .delete_foto").submit()
            }
        })
        
    })
})