<?php
/*
 *  @autor Michael Abplanalp
 *  @version 1.0
 *
 *  Dieses Modul beinhaltet Funktionen, welche die Anwendungslogik implementieren.
 *
 */

/*
 * Gibt die entsprechende CSS-Klasse aus einem assiziativen Array (key: Name Eingabefeld) zurück.
 * Wird im Template aufgerufen.
 *
 * @param   $name       Name des Eingabefeldes
 */
function getCssClass( $name ) {
    global $css_classes;
    if (isset($css_classes[$name])) return $css_classes[$name];
    else return getValue('cfg_css_class_normal');
}

/*
 * Beinhaltet die Anwendungslogik zur Anzeige und zum Bearbeiten von allen Fotoalben
 */
function fotoalben() {
    // Template abfüllen und Resultat zurückgeben
    setValue('phpmodule', $_SERVER['PHP_SELF']."?id=".__FUNCTION__);
    return runTemplate( "../templates/fotoalben.htm.php" );
}

/*
 * Beinhaltet die Anwendungslogik zum Hinzufügen eines Fotoalbums
 */
function album() {
    // Template abfüllen und Resultat zurückgeben
    setValue('phpmodule', $_SERVER['PHP_SELF']."?id=".__FUNCTION__);
    return runTemplate( "../templates/album.htm.php" );
}

/*
 * Beinhaltet die Anwendungslogik zum Hinzufügen von Fotos zu einem Album
 */
function fotos() {
    // Template abfüllen und Resultat zurückgeben
    setValue('phpmodule', $_SERVER['PHP_SELF']."?id=".__FUNCTION__);
    return runTemplate( "../templates/fotos.htm.php" );
}

/*
 * Prüft, ob der Primary Key "email" in der Tabelle "benutzer" bereits existiert
 */
function getBenutzerDaten($email) {
	return db_get_email($email);
}

/*
 * Liefert anhand der User-ID den Benutzernamen zurück
*/
function getBenutzerName($benutzerId=0) {
	$benutzerName = "";
	// Wenn die Benutzer-ID = 0, wird der aktuell angemeldete Benutzer zurückgeliefert
	if ($benutzerId == 0) $benutzerId = getSessionValue('benutzerId');
	if ($benutzerId > 0) {
	  $benutzer = db_get_benutzer($benutzerId);
	  if (count($benutzer)) {
		// Falls Vorname und/oder Nachname vorhanden: diese Werte holen
		if (strlen($benutzer[0]['vorname']) > 0 || strlen($benutzer[0]['nachname']) > 0) $benutzerName = trim($benutzer[0]['vorname']." ".$benutzer[0]['nachname']);
		// Ansonsten die Mailadresse verwenden
		else $benutzerName = $benutzer[0]['email'];
	  }
	}
	return $benutzerName;
}
?>
