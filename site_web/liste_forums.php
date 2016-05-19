<?php
	session_start();
	require ("config.php");
	
	//Contrôle pour savoir quel header nécessaire
	if (!isset($_SESSION['pseudo'])) {
		$header=file_get_contents("elements_communs/header2.php");
	}
	else {
		$header=file_get_contents("elements_communs/header3.php");
	}

	//Chargement de la vue
	$gabarit=file_get_contents("vues/v_liste_forums.html");
	$gabarit=str_replace("{header}",$header,$gabarit);
	echo $gabarit;
?>
