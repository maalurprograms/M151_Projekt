<div id="content">
<?php
    $galleries = db_galleries_from_benutzer($_SESSION["benutzerId"]);
    print "<table>";
    foreach ($galleries as $gallery){
        print "<tr>";
        $photos = db_photos_from_gallery($gallery["gid"]);
        if ($photos) {
            foreach ($photos as $photo) {
                print "
                <td>
                    <img class='pic' src='../images/" . $photo["fid"] . "'>
                    <img class='picbig' src='../images/" . $photo["fid"] . "'>
                </td>";
            }
        }
        print "</tr>";
    }
    print "</table>"
?>
</div>