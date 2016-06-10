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

function setDefaultError(){
	setValue('css_class_meldung', "fehler");
	setValue('meldung', "Ein Fehler ist aufgetreten. Bitte versuchen Sie es nocheinmal.");
}

/*
 * Beinhaltet die Anwendungslogik zur Anzeige und zum Bearbeiten von allen Fotoalben
 */

function deleteFoto($fid){
//	Zuerst löschen iwr alle Einträge in der Datenbank und
// 	danach löschen wir das Thumbnail und das Original Foto.
	db_delete_foto($fid);
	unlink("../images/$fid");
	unlink("../images/thumbnails/$fid");
}

function deleteAlbum($aid){
	if(db_get_fotos_from_album($aid)) {
		foreach (db_get_fotos_from_album($aid) as $f) {
			unlink("../images/" . $f["fid"]);
			unlink("../images/thumbnails/" . $f["fid"]);
		}
	}
}

function fotoalben() {
//  Es werden alle Gallerien des Angemeldeten Users ausgelesen.
	$alben = db_get_alben_from_benutzer($_SESSION["benutzerId"]);

//  Das sollte warscheinlich nicht hier sein sonder als value (setValue, getValue) übergeben werden
	if (isset($_REQUEST['senden_suche'])) {
		if(!ctype_space($_POST["search_tags"]) && $_POST["search_tags"]){
//  	Wenn eine Anfrage gesendet wurde und das Tag feld nicht leer ist, wird der String aus dem Tag Feld augeteilt.
			setValue("search_tags", $_POST["search_tags"]);
			$tags = explode(";", $_POST["search_tags"]);
			$search_results = array();
			foreach ($tags as $tag) {
//  		Für jeden Tag der eingegeben wurde, wird geschaut ob es ihn gibt und wenn ja
//  		werde alle Fotos die diesen tag haben angezeigt.
				$tagId = db_get_tagid($tag)[0]["tid"];
				if ($tagId){
					foreach (db_get_fotos_from_tag($tagId) as $foto){
						array_push($search_results, $foto["fid"]);
					}
				}
			}
//			Das Array mit den gefundenen Bildern wird nun gespeichert.
			setValue("search_results", $search_results);
		}
	}

	if(isset($_POST['delete_foto_id'])){
		if (isCleanNumber($_POST['delete_foto_id'])) {
			if (db_check_foto_from_benutzer($_POST["delete_foto_id"], $_SESSION["benutzerId"])) {
//			Wenn das Foto zum löschen überhaupt dem angemeldeten User gehört, 
//			wird es gelöscht.
				deleteFoto($_POST["delete_foto_id"]);
			}
		}  else {
			setDefaultError();
		}
	}

	if(isset($_POST['delete_album_id'])){
//		Wenn das Foto zum löschen überhaupt dem angemeldeten User gehört, 
//		wird es gelöscht.
		if (isCleanNumber($_POST['delete_album_id'])) {
			foreach (db_get_alben_from_benutzer($_SESSION["benutzerId"]) as $v) {
				if ($v["aid"] == $_POST["delete_album_id"]) {
					deleteAlbum($_POST["delete_album_id"]);
					db_delete_album($_POST["delete_album_id"]);
					setValue('phpmodule', $_SERVER['PHP_SELF'] . "?id=" . __FUNCTION__);
					return runTemplate("../templates/fotoalben.htm.php");
				}
			}
		} else{
//			Wenn der Benutzer das Html manuel abgeändert hat dann wird ein Fehler ausgegeben da wir ansonsten nicht wissen was wir jetz löschen.
			setDefaultError();
		}
	}

//	Wenn es Alben gibt, werden alle mit Ihren dazugehörigen Fotos aufgelistet.
//	Falls es keine Bilder in einem Album hat wird nichts ausgegeben.
	if($alben) {
		$album_list = array();
		foreach ($alben as $album) {
			array_push($album_list, $album["aid"]."_".$album["name"]);
			$foto_list = array();
			$fotos = db_get_fotos_from_album($album["aid"]);
			if ($fotos) {
				foreach ($fotos as $foto) {
					array_push($foto_list, $foto["fid"]);
				}
			}
			setValue("album_".$album["aid"], $foto_list);
		}
		setValue("alben", $album_list);
//		Nun wird eine Variabel Alben gesetzt die ein Array von alen alben beinhalten.
//		Dann wird noch für jedes Album eine Variabel gesezt die alle Fotos des Albums beinhalten.
	}

    // Template abfüllen und Resultat zurückgeben
    setValue('phpmodule', $_SERVER['PHP_SELF']."?id=".__FUNCTION__);
    return runTemplate( "../templates/fotoalben.htm.php" );
}

/*
 * Beinhaltet die Anwendungslogik zum Hinzufügen eines Fotoalbums
 */
function album() {
	if (isset($_POST['senden'])) {
		if(!ctype_space($_POST["name"]) && $_POST["name"]){
//			Wenn der Name nicht leer ist, wird geschaut ob es ein Album mit exakt diesem Namen schon gibt.
//			Wenn ja dann wird ausgegeben das das Album schon existiert.
//			Ansonsten wird es erstellt.

			if (db_get_alben_from_benutzer($_SESSION["benutzerId"])) {
				foreach (db_get_alben_from_benutzer($_SESSION["benutzerId"]) as $v) {
					if ($v["name"] == $_POST["name"]) {
						setValue('css_class_meldung', "fehler");
						setValue('meldung', "Dieses Album existiert bereits.");
						setValue('phpmodule', $_SERVER['PHP_SELF'] . "?id=" . __FUNCTION__);
						return runTemplate("../templates/album.htm.php");
					}
				}
			}

			db_insert_album($_POST["name"], $_SESSION["benutzerId"]);
			setValue('css_class_meldung',"meldung");
			setValue('meldung', "Das Album wurde erstellt.");
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
	if (db_get_alben_from_benutzer($_SESSION["benutzerId"])) {
		if (isset($_POST['senden'])) {
//		Wenn eine request an den Server gesendet wurde, verschieben wir das Bild von dem Standart upload Ordner in den Images/tmp Ordner.
//		Falls dies ein Fehler ergibt, wissen wir das kein File gesendet wurde oder ein anderer Fehler aufgetreten ist.
			$tmp_path = "../images/tmp/" . $_FILES["bild"]["name"];

			if (move_uploaded_file($_FILES['bild']['tmp_name'], $tmp_path)) {
//			Wenn wir die Bild grösse aus dem File lesen können wissen wir das es ein Bild ist.
//			Falls es kein Bil ist wird ein Fehler ausgegeben.
				if (getimagesize($tmp_path)) {
//				Wir erstellen einen DB Eintrag für das Bild und verschieben es von images/tmp nach /images und nun mit der ID als Namen.
					$bildId = db_insert_foto($_POST["gallerieId"]);
//					Wenn keine nummer als AlbumId mitegeben wurde wird ein Fehler ausgegeben.
					if (isCleanNumber($bildId)) {
						$final_path = "../images/$bildId";
						$thumbnail_path = "../images/thumbnails/$bildId";
						rename($tmp_path, $final_path);

//				Nun müssen wir noch das Thumbnail erstellen. Das wird in einer eigenen Methode erledigt.
						createThumbnail($final_path, $thumbnail_path);

//				Jetz müssen wir noch die Tags hinzufügen
//				Falls nichts oder nur Spaces im Tag Feld steht ignorieren wir es.
						if (!ctype_space($_POST["tags"]) && $_POST["tags"]) {
//					Die Tags werden aufgeteilt und es wird überprüft ob sie schon in der DB existieren.
//					Wenn ja wird nur die Verknüpfung von Foto und Tag hinzugefügt. Wenn der Tag noch nicht existiert,
//					wird er erstellt.
							$tag_list = explode(";", $_POST["tags"]);
							foreach ($tag_list as $tag) {
								$db_tagId = db_get_tagid($tag)[0]["tid"];
								if (!$db_tagId) {
									$tagId = db_insert_tag($tag);
								} else {
									$tagId = $db_tagId;
								}
								db_insert_fotos_tag($tagId, $bildId);
							}
						}

						setValue('css_class_meldung', "meldung");
						setValue('meldung', "Ihr Bild wurde hochgeladen.");
					} else{
						unlink($tmp_path);
						setDefaultError();
					}
				} else {
//				Falls die hochgeladene Datei kein Bild ist, wird sie wider aus dem Temporären Verzeichniss gelöscht.
					unlink($tmp_path);
					setValue('css_class_meldung', "fehler");
					setValue('meldung', "Unbekannter Bildtyp.");
				}
			} else {
				setValue('css_class_meldung', "fehler");
				setValue('meldung', "Ein unbekannter Fehler ist aufgetreten.");
			}
		}
	} else{
		setValue('css_class_meldung', "fehler");
		setValue('meldung', "Sie müssen zuerst ein Album erstellen.");
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
