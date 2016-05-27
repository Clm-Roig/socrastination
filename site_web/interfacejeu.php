<?php
	session_start();
	require ("config.php");

	if (!isset($_SESSION['pseudo'])) {
		header('Location: liste_forums.php');
	}
	$gabarit=file_get_contents("vues/v_interfacejeu.html");
	echo $gabarit;
?>

