<?php
/*
 *  @autor Michael Abplanalp
 *  @version 1.jpg.0
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

	function getFileType($path){
		
	}

	if (isset($_REQUEST['senden'])) {
//		Wenn eine request an den Server gesendet wurde, verschieben wir das Bild von dem Standart upload Ordner in den Images/tmp Ordner.
//		Falls dies ein Fehler ergibt, wissen wir das kein File gesendet wurde oder ein anderer Fehler aufgetreten ist.
		if (move_uploaded_file($_FILES['bild']['tmp_name'], "../images/tmp/".$_FILES["bild"]["name"])) {
//			Wenn wir die Bild grösse aus dem File lesen können wissen wir das es ein Bild ist.
//			Falls es kein Bil ist wird ein Fehler ausgegeben.
			if(getimagesize("../images/tmp/".$_FILES["bild"]["name"])){
//				Wir erstellen einen DB Eintrag für das Bild und verschieben es von images/tmp nach /images und nun mit der ID als Namen.
				$bildId = db_insert_foto($_SESSION["benutzerId"], $_POST["gallerieId"]);
				rename("../images/tmp/".$_FILES["bild"]["name"], "../images/".$bildId);

//				Um das Bild zu verkleiner müssen wir zuerst das Verhältnis ausrechen. Nach dem wir die gewünschte Grösse
//				haben copieren wir das bild und schneidem es um. Dafür ist die imagecopyresized() Methode zuständig.
				list($originalHeight, $originalWidth) = getimagesize("../images/".$bildId);
				$ratio = $originalWidth / $originalHeight;
				if ($ratio < 1) {
					$targetHeight = 100;
					$targetWidth = $targetHeight * $ratio;
				} else {
					$targetWidth = 100;
					$targetHeight = $targetWidth / $ratio;
				}
				
//				TODO Check what type the image is to convert it to source for imagecopyresampled
				
				imagecopyresampled("../images/thumbnails/$bildId", imagecreatefromgif("../images/$bildId") ,0 ,0 ,0 ,0 ,$targetWidth ,$targetHeight ,$originalWidth ,$originalHeight );
				setValue('css_class_meldung',"meldung");
				setValue('meldung', "Ihr Bild wurde hochgeladen.");
			} else {
				unlink("../images/tmp/".$_FILES["bild"]["name"]);
				setValue('css_class_meldung',"fehler");
				setValue('meldung', "Unbekannter Bildtyp.");
			}
		} else {
			setValue('css_class_meldung',"fehler");
			setValue('meldung', "Ein unbekannter Fehler ist aufgetreten.");
		}
	}
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
