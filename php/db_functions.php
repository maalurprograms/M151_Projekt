<?php
/*
 *  @autor Michael Abplanalp
 *  @version 1.0
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
