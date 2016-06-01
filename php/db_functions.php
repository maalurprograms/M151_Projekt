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

function db_get_benutzer_from_id($bid) {
	return sqlSelect("select * from benutzer where bid=".$bid);
}

function db_get_fotos_from_album($aid){
    return sqlSelect("select * from fotos JOIN album on fotos.ida=album.aid WHERE album.aid = $aid");
}

function db_get_alben_from_benutzer($bid){
    return sqlSelect("select * from album JOIN benutzer on album.idb=benutzer.bid where benutzer.bid = $bid");
}

function db_get_tagid($name){
    return sqlSelect("select tid from tag where name = '$name'");
}

function db_get_fotos_from_tag($tid){
    return sqlSelect("select fid from tag join fotos_tag on tag.tid=fotos_tag.idt JOIN fotos on fotos.fid=fotos_tag.idf WHERE tag.tid = $tid");
}

function db_get_album_by_name($name){
    return sqlSelect("select aid from album WHERE name = '$name'");
}

function db_get_tags_from_photo($fid){
    return sqlSelect("select tag.name from tag JOIN fotos_tag on fotos_tag.idt=tag.tid join fotos on fotos.fid=fotos_tag.idf WHERE fotos.fid = $fid");
}

function db_foto_from_user($fid){
    return sqlSelect("select fid from fotos join album on fotos.ida=album.aid join benutzer on album.idb=benutzer.bid where fotos.fid = $fid");
}

// Inserts: 

function db_insert_tag($name){
    return sqlQuery("insert into tag (name) VALUE ('".htmlspecialchars($name)."')");
}

function db_insert_fotos_tag($tagId, $fotoId){
    return sqlQuery("insert into fotos_tag (idf, idt) VALUE ($fotoId, $tagId)");
}

function db_insert_foto($albumId){
    return sqlQuery("insert into fotos (ida) VALUE ($albumId)");
}

function db_insert_benutzer($params, $passwort) {
    sqlQuery("insert into benutzer (vorname, nachname, email, passwort) values ('".htmlspecialchars($params['vorname'])."','".htmlspecialchars($params['nachname'])."','".htmlspecialchars($params['email'])."','".$passwort."')");
}

function db_insert_album($name, $benutzerId){
    sqlQuery("insert into album (name, idb) VALUE ('".htmlspecialchars($name)."', $benutzerId)");
}

// Delete:

function db_delete_foto($fid){
    sqlQuery("delete from fotos where fid = $fid");
}