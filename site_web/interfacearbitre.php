<?php 
	session_start();
	require ("config.php");
	require ("fonctions_interfacejeu/infos_joueurs.php");

	$tab = infos_joueurs();

	$vue=file_get_contents("vues/v_interfacearbitre.html");
	$vue=str_replace("{pseudo_j1}",$tab['pseudoj1'],$vue);
	$vue=str_replace("{pseudo_j2}",$tab['pseudoj2'],$vue);
	$vue=str_replace("{idj1}",$tab['idj1'],$vue);
	$vue=str_replace("{idj2}",$tab['idj2'],$vue);
	echo $vue;
?>
