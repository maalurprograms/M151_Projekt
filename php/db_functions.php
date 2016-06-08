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
    return sqlSelect("select * from benutzer where email=?", "s", array($email));
}

function db_get_benutzer_from_id($bid) {
    return sqlSelect("select * from benutzer where bid=?", "i", array($bid));
}

function db_get_fotos_from_album($aid){
    return sqlSelect("select * from fotos JOIN album on fotos.ida=album.aid WHERE album.aid=?", "i", array($aid));
}

function db_get_alben_from_benutzer($bid){
    return sqlSelect("select * from album JOIN benutzer on album.idb=benutzer.bid where benutzer.bid=?", "i", array($bid));
}

function db_get_tagid($name){
    return sqlSelect("select tid from tag where name=?", "s", array($name));
}

function db_get_fotos_from_tag($tid){
    return sqlSelect("select fid from tag join fotos_tag on tag.tid=fotos_tag.idt JOIN fotos on fotos.fid=fotos_tag.idf WHERE tag.tid=?", "i", array($tid));
}

function db_check_foto_from_benutzer($fid){
    return sqlSelect("select fid from fotos join album on fotos.ida=album.aid join benutzer on album.idb=benutzer.bid where fotos.fid=?", "i", array($fid));
}

function db_get_all_tags_from_benutzer($bid){
    return sqlSelect("SELECT DISTINCT tag.name FROM tag join fotos_tag on fotos_tag.idt=tag.tid join fotos on fotos.fid=fotos_tag.idf JOIN album on album.aid=fotos.ida join benutzer on benutzer.bid=album.idb where benutzer.bid = ?", "i", array($bid));
}

// Inserts: 

function db_insert_tag($name){
    return sqlQuery("insert into tag (name) VALUE (?)", "s", array(htmlspecialchars($name)));
}

function db_insert_fotos_tag($tid, $fid){
    return sqlQuery("insert into fotos_tag (idf, idt) VALUE (?, ?)", "ii", array($fid, $tid));
}

function db_insert_foto($aid){
    return sqlQuery("insert into fotos (ida) VALUE (?)", "i", array($aid));
}

function db_insert_benutzer($params, $passwort) {
    sqlQuery("insert into benutzer (vorname, nachname, email, passwort) values (?,?,?,?)", "ssss", array(htmlspecialchars($params['vorname']), htmlspecialchars($params['nachname']), htmlspecialchars($params['email']), $passwort));
}

function db_insert_album($name, $benutzerId){
    sqlQuery("insert into album (name, idb) VALUE (?,?)", "si", array(htmlspecialchars($name), $benutzerId));
}

// Delete:

function db_delete_foto($fid){
    sqlQuery("delete from fotos_tag where idf = ?", "i", array($fid));
    sqlQuery("delete from fotos where fid = ?", "i", array($fid));
}

function db_delete_album($aid){
    sqlQuery("delete from fotos_tag where fotos_tag.idf in ( select fid from fotos where fotos.ida=?)", "i", array($aid));
    sqlQuery("delete from fotos where fotos.ida=?", "i", array($aid));
    sqlQuery("delete from album where aid = ?", "i", array($aid));
}