<?php
	include('config.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Nobelios V1.0 - version archive</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="stylesheet" media="screen" type="text/css" title="style" href="./design/<?php echo $theme; ?>/style.css" />
	</head>
	<body>
		
		<div align="center">
			<div class="taille_page">
				
				<!-- Logo principal -->
				<div id="logo">
				</div>
				
				<!-- Logo secondaire -->
				<div id="logo2">
				</div>

				<!-- Entete du site -->
				<div id="en_tete">
				</div>
				
				<!-- Menu -->
				<div id="menu">
					<?php include("./menu.php"); ?>
				</div>
				
				<!-- Corps du site -->
				<div id="corps">
					<?php
					
					// On procède à la récupération de l'adresse
					
					// Liste des sous-dossiers du répertoire 'page' dans un tableau
					function listfil($start, $max=3) {
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
								$Array2 = listfil($start2, $max2); 		// récupération des sous-données
								$Array = array_merge($Array,$Array2);  	// fusion des tableau de sous-données et de données								
								if (!is_file($start2) && $max2>0) { 	// Limite de pénétration non atteinte et dossier uniquement
									$Array[] = "$start2"; 				// Ajout d'un nouvel élément au tableau
								}
							}
						}
						RETURN $Array;
					}
					
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
					
					$liste = array();         // déclaration de variable
					$liste = listfil('page'); // lister tous les dossiers autorisées

					
					$listehtm = array();
					$listehtm = listhtm('page');
					
					/*
					// Contrôle du listing des pages
					foreach($listehtm as $element) {
						echo "$element <br />";
					}
					*/
					
					if (isset($_GET['page']) && ($_GET['page'] != null)) {
						if (in_array($_GET['page'],$listehtm)) { // on affiche que les pages listées et donc autorisées
							echo '<div id="bouton">';
							echo '<a title="imprimer la page" target="blank" href="./print.php?page=' . $_GET['page'] . '"><img src="./design/'.$theme.'/print.png" /></a>';
							echo '</div>';
							include($_GET['page']); 
						}
						else {
							include("page/Nobelios/accueil.htm");
						}
					}
					elseif (isset($_GET['dossier']) && ($_GET['dossier'] != null)) {
						if (in_array($_GET['dossier'],$liste)) {
							echo '<div id="bouton">';
							echo '</div>';
							echo '<br /><br /><br />';
							$dir = $_GET['dossier'];
							if ($handle3 = opendir($dir)) {
								while (false !== ($file3 = readdir($handle3))) {
									if ($file3 != "." && $file3 != "..") {
										$affichage_file3 = str_replace($code_caract, $affichage_caract, $file3);
										if (!preg_match("#\.(html|htm|php|txt|mp3|wav|avi|mpg|mpeg|jpg|bmp|gif|png|doc|pdf|odt|ods|odp|xml|xls|ppt|asm|c|zip|rar)#", "$file3")) {
											echo "<h3><img src=\"./design/" . $theme . "/dir.png\"/>" . $affichage_file3 . "</h3>";			
											// Listes
											if ($handle4 = opendir($dir . "/" . $file3)) {
												echo '<ul class="liste_menu">';
												while (false !== ($file4 = readdir($handle4))) {
													if ($file4 != "." && $file4 != "..") {
														$affichage_file4 = str_replace($code_caract, $affichage_caract, $file4);
														if (preg_match("#\.(html|htm|php|txt)#", "$file4")) {
															echo "<li><a class=\"menu_liste\" href=\"./index.php?page=" . $dir . "/" . $file3 . "/" . $file4 . "\"><img src=\"./design/" . $theme . "/file.png\" />" . $affichage_file4 . "</a></li>";
														}
													}
												}
												echo '</ul>';
												closedir($handle4);
											}
										}	
									}
								}
								closedir($handle3);
							}
						}
						else
						{
							include("page/Nobelios/accueil.htm");
						}
					}
					else
					{
						include("page/Nobelios/accueil.htm"); 
					}
					?>
				</div>
			</div>
		</div>
	</body>
</html>