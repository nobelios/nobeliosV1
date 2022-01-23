<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>IMPRESSION, Nobelios V1.0</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="stylesheet" media="screen" type="text/css" title="print" href="./design/darkfox/print.css" />
	</head>
	<body>

		<?php
		
		// Liste des sous-dossiers du répertoire 'page' dans un tableau
		function listhtm($start, $max=5) {
			$max2 = $max-1; // Limite de profondeur dans le listage
			$Array = array(); 
			$Array2 = array(); 
			$dir = opendir($start);
			//boucle qui lit le répertoire  
			while ($file = readdir($dir)){
				//condition qui permet de supprimer les fichiers temporaires word et   les répertoires . et ..
				if  (ereg("~","$file" ) || $file == "." || $file == ".." ) {

				} else {
					$start2 = $start.'/'.$file; 			// création d'un nouveau chemin d'accès aux dossiers
					$Array2 = listhtm($start2, $max2); 		// récupération des sous-données
					$Array = array_merge($Array,$Array2);  	// fusion des tableau de sous-données et de données								
					if (is_file($start2) && $max2>0) { 	    // Limite de pénétration non atteinte et dossier uniquement
						$Array[] = "$start2"; 				// Ajout d'un nouvel élément au tableau
					}
				}
			}
			RETURN $Array;
		}
		
		$listehtm = array();
		$listehtm = listhtm('page');

		if (isset($_GET['page']) && ($_GET['page'] != null)) {
			if (in_array($_GET['page'],$listehtm)) {
				include($_GET['page']); 
			}
			else {
				include("page/Nobelios/accueil.htm");
			}
		}

		?>
		
	</body>
</html>