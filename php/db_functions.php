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

function db_get_tags_from_photo($fid){
    return sqlSelect("select tag.name from tag JOIN fotos_tag on fotos_tag.idt=tag.tid join fotos on fotos.fid=fotos_tag.idf WHERE fotos.fid=?", "i", array($fid));
}

function db_check_foto_from_user($fid){
    return sqlSelect("select fid from fotos join album on fotos.ida=album.aid join benutzer on album.idb=benutzer.bid where fotos.fid=?", "i", array($fid));
}

// Inserts: 

function db_insert_tag($name){
    return sqlQueryPstmt("insert into tag (name) VALUE (?)", "s", array(htmlspecialchars($name)));
}

function db_insert_fotos_tag($tid, $fid){
    return sqlQueryPstmt("insert into fotos_tag (idf, idt) VALUE (?, ?)", "ii", array($fid, $tid));
}

function db_insert_foto($aid){
    return sqlQueryPstmt("insert into fotos (ida) VALUE (?)", "i", array($aid));
}

function db_insert_benutzer($params, $passwort) {
    sqlQueryPstmt("insert into benutzer (vorname, nachname, email, passwort) values (?,?,?,?)", "ssss", array(htmlspecialchars($params['vorname']), htmlspecialchars($params['nachname']), htmlspecialchars($params['email']), $passwort));
}

function db_insert_album($name, $benutzerId){
    sqlQueryPstmt("insert into album (name, idb) VALUE (?,?)", "si", array(htmlspecialchars($name), $benutzerId));
}

// Delete:

function db_delete_foto($fid){
    sqlQueryPstmt("delete from fotos_tag where idf = ?", "i", array($fid));
    sqlQueryPstmt("delete from fotos where fid = ?", "i", array($fid));
}

//<?php
///*
// *  @autor Michael Abplanalp
// *  @version 1.jpg.0
// *
// *  Dieses Modul beinhaltet sämtliche Datenbankfunktionen.
// *  Die Funktionen formulieren die SQL-Anweisungen und rufen dann die Funktionen
// *  sqlQuery() und sqlSelect() aus dem Modul basic_functions.php auf.
// *
// */
//
//
//// Selects: 
//function db_get_benutzer_from_email($email) {
//    $pstmt = getValue('cfg_db')->prepare("select * from benutzer where email=?");
//    $pstmt->bind_param("s", $email);
//    return sqlSelect($pstmt);
//}
//
//function db_get_benutzer_from_id($bid) {
//    $pstmt = getValue('cfg_db')->prepare("select * from benutzer where bid=?");
//    $pstmt->bind_param("i", $bid);
//    return sqlSelect($pstmt);
//}
//
//function db_get_fotos_from_album($aid){
//    $pstmt = getValue('cfg_db')->prepare("select * from fotos JOIN album on fotos.ida=album.aid WHERE album.aid=?");
//    $pstmt->bind_param("i", $aid);
//    return sqlSelect($pstmt);
//}
//
//function db_get_alben_from_benutzer($bid){
//    $pstmt = getValue('cfg_db')->prepare("select * from album JOIN benutzer on album.idb=benutzer.bid where benutzer.bid=?");
//    $pstmt->bind_param("i", $bid);
//    return sqlSelect($pstmt);
//}
//
//function db_get_tagid($name){
//    $pstmt = getValue('cfg_db')->prepare("select tid from tag where name=?");
//    $pstmt->bind_param("s", $name);
//    return sqlSelect($pstmt);
//}
//
//function db_get_fotos_from_tag($tid){
//    $pstmt = getValue('cfg_db')->prepare("select fid from tag join fotos_tag on tag.tid=fotos_tag.idt JOIN fotos on fotos.fid=fotos_tag.idf WHERE tag.tid=?");
//    $pstmt->bind_param("i", $tid);
//    return sqlSelect($pstmt);
//}
//
//function db_get_album_by_name($name){
//    $pstmt = getValue('cfg_db')->prepare("select aid from album WHERE name=?");
//    $pstmt->bind_param("s", $name);
//    return sqlSelect($pstmt);
//}
//
//function db_get_tags_from_photo($fid){
//    $pstmt = getValue('cfg_db')->prepare("select tag.name from tag JOIN fotos_tag on fotos_tag.idt=tag.tid join fotos on fotos.fid=fotos_tag.idf WHERE fotos.fid=?");
//    $pstmt->bind_param("i", $fid);
//    return sqlSelect($pstmt);
//}
//
//function db_foto_from_user($fid){
//    $pstmt = getValue('cfg_db')->prepare("select fid from fotos join album on fotos.ida=album.aid join benutzer on album.idb=benutzer.bid where fotos.fid=?");
//    $pstmt->bind_param("i", $fid);
//    return sqlSelect($pstmt);
//}
//
//// Inserts: 
//
//function db_insert_tag($name){
//    $pstmt = getValue('cfg_db')->prepare("insert into tag (name) VALUE (?)");
//    $pstmt->bind_param("s", htmlspecialchars($name));
//    return sqlQuery($pstmt);
//}
//
//function db_insert_fotos_tag($tid, $fid){
//    $pstmt = getValue('cfg_db')->prepare("insert into fotos_tag (idf, idt) VALUE (?, ?)");
//    $pstmt->bind_param("ii", $tid, $fid);
//    return sqlQuery($pstmt);
//}
//
//function db_insert_foto($aid){
//    $pstmt = getValue('cfg_db')->prepare("insert into fotos (ida) VALUE (?)");
//    $pstmt->bind_param("i", $aid);
//    return sqlQuery($pstmt);
//}
//
//function db_insert_benutzer($params, $passwort) {
//    $pstmt = getValue('cfg_db')->prepare("insert into benutzer (vorname, nachname, email, passwort) values (?,?,?,?)");
//    $pstmt->bind_param("ssss", htmlspecialchars($params["vorname"]), htmlspecialchars($params["nachname"]), htmlspecialchars($params["email"]), $passwort);
//    sqlQuery($pstmt);
//}
//
//function db_insert_album($name, $bid){
//    $name = htmlspecialchars($name);
//    $pstmt = getValue('cfg_db')->prepare("insert into album (name, idb) VALUE (?,?)");
//    $pstmt->bind_param("si", $name, $bid);
//    sqlQuery($pstmt);
//}
//
//// Delete:
//
//function db_delete_foto($fid){
//    $pstmt = getValue('cfg_db')->prepare("delete from fotos_tag where idf=?");
//    $pstmt->bind_param("i", $fid);
//    sqlQuery($pstmt);
//    $pstmt = getValue('cfg_db')->prepare("delete from fotos where fid=?");
//    $pstmt->bind_param("i", $fid);
//    sqlQuery($pstmt);
//}