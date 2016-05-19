<?php
	session_start();

	$vue = file_get_contents("vues/v_erreur.html");
	$message="";

	//Contrôle pour savoir quel header nécessaire
	if (!isset($_SESSION['pseudo'])) {
		$header=file_get_contents("elements_communs/header2.php");
	}
	else {
		$header=file_get_contents("elements_communs/header3.php");
	}

	//Contrôle de l'erreur envoyée
	if ($_GET['num_erreur']==0){
		$message = 'Erreur : identification requise.';
	}

	if ($_GET['num_erreur']==1){
		$message = 'Erreur : problème de connexion serveur.';
	}

	if ($_GET['num_erreur']==2){
		$message = 'Erreur : partie pleine.';
	}	

	if ($_GET['num_erreur']==3){
		$message = 'Erreur : login incorrect.';
	}
	
	//Affichage
	$vue = str_replace('{erreur}',$message,$vue);	
	$vue = str_replace('{header}',$header,$vue);	
	echo $vue;
?>


