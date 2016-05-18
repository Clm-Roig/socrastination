<?php
session_start();

$vue = file_get_contents("vues/v_erreur.html");
$message="";

if ($_GET['num_erreur']==0){
	$message = 'Erreur : identification requise.';
	$vue = str_replace('{erreur}',$message,$vue);	
	echo $vue;
}

if ($_GET['num_erreur']==1){
	$message = 'Erreur : problème de connexion serveur.';
	$vue = str_replace('{erreur}',$message,$vue);	
	echo $vue;
}

if ($_GET['num_erreur']==2){
	$message = 'Erreur : partie pleine.';
	$vue = str_replace('{erreur}',$message,$vue);	
	echo $vue;
}	

if ($_GET['num_erreur']==3){
	$message = 'Erreur : login incorrect.';
	$vue = str_replace('{erreur}',$message,$vue);	
	echo $vue;
}
?>


