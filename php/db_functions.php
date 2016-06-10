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
//  Alles vom User mit der Email $email wird ausgegeben.
    return sqlSelect("select * from benutzer where email=?", "s", array($email));
}

function db_get_benutzer_from_id($bid) {
//  Alles vom User mit der ID $bid.
    return sqlSelect("select * from benutzer where bid=?", "i", array($bid));
}

function db_get_fotos_from_album($aid){
//  Alle Fotos vom Album mit der Id $aid werden geholt.
    return sqlSelect("select * from fotos JOIN album on fotos.ida=album.aid WHERE album.aid=?", "i", array($aid));
}

function db_get_alben_from_benutzer($bid){
//  Alle Alben vom Benutzer mit der Benutzerid $bid werden geholt.
    return sqlSelect("select * from album JOIN benutzer on album.idb=benutzer.bid where benutzer.bid=?", "i", array($bid));
}

function db_get_tagid($name){
//  Die Id des Tags mit dem Namen $name wird geholt.
    return sqlSelect("select tid from tag where name=?", "s", array($name));
}

function db_get_fotos_from_tag($tid){
//  Alle Fotos mit dem Tag mit der id $tid werden geholt.
    return sqlSelect("select fid from tag join fotos_tag on tag.tid=fotos_tag.idt JOIN fotos on fotos.fid=fotos_tag.idf WHERE tag.tid=?", "i", array($tid));
}

function db_check_foto_from_benutzer($fid, $bid){
//  Foto mit der Id $fid und vom Benutzer mit der id $bid wird geholt.
    return sqlSelect("select fid from fotos join album on fotos.ida=album.aid join benutzer on album.idb=benutzer.bid where fotos.fid=? and benutzer.bid=?", "ii", array($fid, $bid));
}

function db_get_all_tags_from_benutzer($bid){
//  Alle Tags vom benutzer mit der Id $bid werden ausgelesen.
    return sqlSelect("SELECT DISTINCT tag.name FROM tag join fotos_tag on fotos_tag.idt=tag.tid join fotos on fotos.fid=fotos_tag.idf JOIN album on album.aid=fotos.ida join benutzer on benutzer.bid=album.idb where benutzer.bid = ?", "i", array($bid));
}

// Inserts: 

function db_insert_tag($name){
//  Tag mit Name $name wird eingefügt.
    return sqlQuery("insert into tag (name) VALUE (?)", "s", array(htmlspecialchars($name)));
}

function db_insert_fotos_tag($tid, $fid){
//  Eintrag in der Verbindungs Tabelle fotos_tags wird eingefügt mit Foto $fid und Tag $tid.
    return sqlQuery("insert into fotos_tag (idf, idt) VALUE (?, ?)", "ii", array($fid, $tid));
}

function db_insert_foto($aid){
//  Foto wird zum Album mit der id $aid hinzugefügt.
    return sqlQuery("insert into fotos (ida) VALUE (?)", "i", array($aid));
}

function db_insert_benutzer($params, $passwort) {
//  Benutzer wird eingefügt.
    sqlQuery("insert into benutzer (vorname, nachname, email, passwort) values (?,?,?,?)", "ssss", array(htmlspecialchars($params['vorname']), htmlspecialchars($params['nachname']), htmlspecialchars($params['email']), $passwort));
}

function db_insert_album($name, $benutzerId){
//  Album mit Name $name wird zum Benutzer mit Id $benutzerId hinzugefügt.
    sqlQuery("insert into album (name, idb) VALUE (?,?)", "si", array(htmlspecialchars($name), $benutzerId));
}

// Delete:

function db_delete_foto($fid){
//  Foto wird gelöscht und auch die Verbindungen zu Tags werden gelöscht.
    sqlQuery("delete from fotos_tag where idf = ?", "i", array($fid));
    sqlQuery("delete from fotos where fid = ?", "i", array($fid));
}

function db_delete_album($aid){
//  Alle Fotos sammt Tags Verbindungen werden zusammen mit dem Album gelöscht.
    sqlQuery("delete from fotos_tag where fotos_tag.idf in ( select fid from fotos where fotos.ida=?)", "i", array($aid));
    sqlQuery("delete from fotos where fotos.ida=?", "i", array($aid));
    sqlQuery("delete from album where aid = ?", "i", array($aid));
}