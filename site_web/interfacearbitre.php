<?php 
	session_start();
	require ("config.php");

	if (!isset($_SESSION['pseudo'])) {
		header('Location: liste_forums.php');
	}

	$vue = file_get_contents("vues/v_interfacearbitre.html");
	echo $vue;
?>
