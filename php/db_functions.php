<?php
/*
 *  @autor Michael Abplanalp
 *  @version 1.jpg.0
 *
 *  Dieses Modul beinhaltet sämtliche Datenbankfunktionen.
 *  Die Funktionen formulieren die SQL-Anweisungen und rufen dann die Funktionen
 *  sqlQuery() und sqlSelect() aus dem Modul basic_functions.php auf.
 *
 */

function db_get_email($email) {
	return sqlSelect("select * from benutzer where email='".$email."'");
}

function db_get_benutzer($benutzerId) {
	return sqlSelect("select * from benutzer where bid=".$benutzerId);
}

function db_insert_benutzer($params, $passwort) {
    $sql = "insert into benutzer (vorname, nachname, email, passwort)
            values ('".escapeSpecialChars($params['vorname'])."','".escapeSpecialChars($params['nachname'])."','".escapeSpecialChars($params['email'])."','".$passwort."')";
    sqlQuery($sql);
}

function db_albums(){
    return sqlSelect("select * from gallerie");
}

function db_photos_from_gallery($galleryId){
    return sqlSelect("select * from fotos JOIN gallerie on fotos.idg=gallerie.gid WHERE gallerie.gid = $galleryId");
}

function db_galleries_from_benutzer($benutzerId){
    return sqlSelect("select * from gallerie JOIN benutzer on gallerie.idb=benutzer.bid where benutzer.bid = $benutzerId");
}

function db_insert_foto($benutzerId, $galleryId){
    return sqlQuery("insert into fotos (idb, idg) VALUE ($benutzerId, $galleryId)");
}