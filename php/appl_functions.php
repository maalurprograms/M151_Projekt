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
	if (isset($_REQUEST['senden'])) {
		if(!ctype_space($_POST["name"]) && $_POST["name"]){
//			Wenn der Name nicht leer ist, wird geschaut ob es ein Album mit exakt diesem Namen schon gibt.
//			Wenn ja dann wird ausgegeben das das Album schon existiert.
//			Ansonsten wird es erstellt.
			if (!db_get_album_by_name($_POST["name"])){
				db_insert_album($_POST["name"], $_SESSION["benutzerId"]);
				setValue('css_class_meldung',"meldung");
				setValue('meldung', "Das Album wurde erstellt.");
			} else{
				setValue('css_class_meldung',"fehler");
				setValue('meldung', "Dieses Album existiert bereits.");
			}
		}
	}
    // Template abfüllen und Resultat zurückgeben
    setValue('phpmodule', $_SERVER['PHP_SELF']."?id=".__FUNCTION__);
    return runTemplate( "../templates/album.htm.php" );
}


// Thumbnail: Bennötigt um aus einem Bild ein Source objekt zu generieren das verkleinert werden kann.
// Gibt das Source Objekt und den Filetyp zurück.
function convertImageToSource($path){
	$finfo = new finfo(FILEINFO_MIME);
	switch (explode(";", $finfo->file($path))[0]){
		case "image/png":
			$image_source = imagecreatefrompng($path);
			break;
		case "image/jpeg":
			$image_source = imagecreatefromjpeg($path);
			break;
		case "image/gif":
			$image_source = imagecreatefromgif($path);
			break;
	}
	return array($image_source, explode(";", $finfo->file($path))[0]);
}

// Konvertiert das Source Objekt zurück in ein Bild.
function convertSourceToImage($path, $source, $type){
	switch ($type){
		case "image/png":
			imagepng($source, $path);
			break;
		case "image/jpeg":
			imagejpeg($source, $path);
			break;
		case "image/gif":
			imagegif($source, $path);
			break;
	}
}

function createThumbnail($final_path, $thumbnail_path){
// 	Um das Bild zu verkleiner müssen wir zuerst das Verhältnis ausrechen. Nach dem wir die gewünschte Grösse
// 	haben copieren wir das bild und schneidem es um. Dafür ist die imagecopyresized() Methode zuständig.
	list($originalWidth, $originalHeight) = getimagesize($final_path);
	$ratio = $originalWidth / $originalHeight;
	if ($ratio < 1) {
		$targetHeight = 100;
		$targetWidth = $targetHeight * $ratio;
	} else {
		$targetWidth = 100;
		$targetHeight = $targetWidth / $ratio;
	}

// 	Das Bild wird in ein Source Objekt konvertiert und danach zugeschnitten und wider umkonvertiert.
	list($image_source, $image_type) = convertImageToSource($final_path);
//	Hier wird ein dummy Image erstellt in das wir dann das verkleinerte Bild schreiben
	$image_thumbnail = imagecreatetruecolor($targetWidth, $targetHeight);
	imagecopyresampled($image_thumbnail, $image_source ,0 ,0 ,0 ,0 ,$targetWidth ,$targetHeight ,$originalWidth ,$originalHeight );
// 	Hier wird aus $image_thumbnail ein Bild gemacht und gespeichert.
// 	Der Bild Typ ist dabei der selbe wie beim Original.
	convertSourceToImage($thumbnail_path, $image_thumbnail, $image_type);
}

/*
 * Beinhaltet die Anwendungslogik zum Hinzufügen von Fotos zu einem Album
 */
function fotos() {

	if (isset($_REQUEST['senden_suche'])) {
//		Wenn eine request an den Server gesendet wurde, verschieben wir das Bild von dem Standart upload Ordner in den Images/tmp Ordner.
//		Falls dies ein Fehler ergibt, wissen wir das kein File gesendet wurde oder ein anderer Fehler aufgetreten ist.
		$tmp_path = "../images/tmp/".$_FILES["bild"]["name"];

		if (move_uploaded_file($_FILES['bild']['tmp_name'], $tmp_path)) {
//			Wenn wir die Bild grösse aus dem File lesen können wissen wir das es ein Bild ist.
//			Falls es kein Bil ist wird ein Fehler ausgegeben.
			if(getimagesize($tmp_path)){
//				Wir erstellen einen DB Eintrag für das Bild und verschieben es von images/tmp nach /images und nun mit der ID als Namen.
				$bildId = db_insert_foto($_SESSION["benutzerId"], $_POST["gallerieId"]);
				$final_path = "../images/$bildId";
				$thumbnail_path = "../images/thumbnails/$bildId";
				rename($tmp_path, $final_path);

//				Nun müssen wir noch das Thumbnail erstellen. Das wird in einer eigenen Methode erledigt.
				createThumbnail($final_path, $thumbnail_path);

//TAGS:			Jetz müssen wir noch die Tags hinzufügen
//				Falls nichts oder nur Spaces im Tag Feld steht ignorieren wir es.
				if(!ctype_space($_POST["tags"]) && $_POST["tags"]){
//					Die Tags werden aufgeteilt und es wird überprüft ob sie schon in der DB existieren.
//					Wenn aj wird nur die Verknüpfung von Foto und Tag hinzugefügt. Wenn der Tag noch nicht existiert,
//					wird er erstellt.
					$tag_list = explode(";", $_POST["tags"]);
					foreach ($tag_list as $tag){
//						TODO Hier macht alles Probleme keine Ahnung was falschläuft.
						$db_tagId = db_get_tagid($tag)[0]["tid"];
						if (!$db_tagId){
							$tagId = db_insert_tag($tag);
						} else{
							$tagId = $db_tagId;
						}
						db_insert_fotos_tag($tagId,$bildId);
					}
				}

				setValue('css_class_meldung',"meldung");
				setValue('meldung', "Ihr Bild wurde hochgeladen.");
			} else {
//				Falls die hochgeladene Datei kein Bild ist, wird sie wider aus dem Temporären Verzeichniss gelöscht.
				unlink($tmp_path);
				setValue('css_class_meldung',"fehler");
				setValue('meldung', "Unbekannter Bildtyp.");
			}
		} else {
			setValue('css_class_meldung',"fehler");
			setValue('meldung', "Ein unbekannter Fehler ist aufgetreten.");
		}
	}
	
	if (isset($_REQUEST["senden_löschen"])){
		print "OK";
	}
    // Template abfüllen und Resultat zurückgeben
    setValue('phpmodule', $_SERVER['PHP_SELF']."?id=".__FUNCTION__);
    return runTemplate( "../templates/fotos.htm.php" );
}

/*
 * Prüft, ob der Primary Key "email" in der Tabelle "benutzer" bereits existiert
 */
function getBenutzerDaten($email) {
	return db_get_benutzer_from_email($email);
}

/*
 * Liefert anhand der User-ID den Benutzernamen zurück
*/
function getBenutzerName($benutzerId=0) {
	$benutzerName = "";
	// Wenn die Benutzer-ID = 0, wird der aktuell angemeldete Benutzer zurückgeliefert
	if ($benutzerId == 0) $benutzerId = getSessionValue('benutzerId');
	if ($benutzerId > 0) {
	  $benutzer = db_get_benutzer_from_id($benutzerId);
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
