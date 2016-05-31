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


// Selects: 
function db_get_benutzer_from_email($email) {
	return sqlSelect("select * from benutzer where email='".$email."'");
}

function db_get_benutzer_from_id($benutzerId) {
	return sqlSelect("select * from benutzer where bid=".$benutzerId);
}

function db_get_photos_from_gallery($galleryId){
    return sqlSelect("select * from fotos JOIN gallerie on fotos.idg=gallerie.gid WHERE gallerie.gid = $galleryId");
}

function db_get_galleries_from_benutzer($benutzerId){
    return sqlSelect("select * from gallerie JOIN benutzer on gallerie.idb=benutzer.bid where benutzer.bid = $benutzerId");
}

function db_get_tagid($name){
    return sqlSelect("select tid from tag where name = '$name'");
}

function db_get_photos_from_tag($tagId){
    return sqlSelect("select fid from tag join fotos_tag on tag.tid=fotos_tag.idt JOIN fotos on fotos.fid=fotos_tag.idf WHERE tag.tid = $tagId");
}

// Inserts: 

function db_insert_tag($name){
    return sqlQuery("insert into tag (name) VALUE ('".escapeSpecialChars($name)."')");
}

function db_insert_fotos_tag($tagId, $fotoId){
    return sqlQuery("insert into fotos_tag (idf, idt) VALUE ($fotoId, $tagId)");
}

function db_insert_foto($benutzerId, $galleryId){
    return sqlQuery("insert into fotos (idb, idg) VALUE ($benutzerId, $galleryId)");
}

function db_insert_benutzer($params, $passwort) {
    sqlQuery("insert into benutzer (vorname, nachname, email, passwort) values ('".escapeSpecialChars($params['vorname'])."','".escapeSpecialChars($params['nachname'])."','".escapeSpecialChars($params['email'])."','".$passwort."')");
}