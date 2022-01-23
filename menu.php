<?php
// Menus
if ($handle = opendir($dir)) {
	while (false !== ($file = readdir($handle))) {
		if ($file != "." && $file != "..") {
			
			// Création d'un block de menu (ouverture de balise)
			?>
			<div class="element_menu">
				<h3><?php echo "$file\n"; ?></h3>
			<?php	
			
			// Listes
			if ($handle2 = opendir($dir . "/" . $file)) {
				while (false !== ($file2 = readdir($handle2))) {
					if ($file2 != "." && $file2 != "..") {
						
						$extensions = array(".htm", ".html", ".txt");
						$lien = str_replace($extensions, "", "$file2");
						$affichage_lien = str_replace($code_caract, $affichage_caract, $lien);
						$affichage_file2 = str_replace($code_caract, $affichage_caract, $file2);
						
						// Création de la liste de menu
						/*if (preg_match("#.fr#", "$file2"))
						{
							echo "<a target=\"blank\" href=\"http://" . $file2 . "\"><img src=\"./design/" . $theme . "/link.png\"/>" . $lien . "</a></br>";
						}
						*/
						if (preg_match("#\.#", "$file2"))
						{
							echo "<a href=\"./index.php?page=" . $dir . "/" . $file . "/" . $file2 . "\"><img src=\"./design/" . $theme . "/file.png\"/>" . $affichage_lien . "</a><br/>";
						}
						else
						{
							echo "<a href=\"./index.php?dossier=" . $dir . "/" . $file . "/" . $file2 . "\"><img src=\"./design/" . $theme . "/dir.png\"/>" . $affichage_file2 . "</a><br/>";
						}
					}
				}
				closedir($handle2);
			}
			
			// Création d'un block de menu (fermeture de balise)
			?>
			</div>
			<?php
			
		}
	}
	closedir($handle);
}
?>