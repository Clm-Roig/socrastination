<?php
	//CONNEXION BDD
	require("config.php");

	if (!isset($_SESSION['pseudo'])) {
		header('Location: ../erreur_paslog.php');
	}
	
	else {
		//RECUPERATION DES VARIABLES
		$num_forum = $_GET['nforum'];
		$num_partie = $_GET['npartie'];
		echo "<p class=\"foot\">Vous êtes ".$_SESSION['pseudo']." et vous vous situez sur le forum $num_forum, dans la partie $num_partie.</p>";
	}
?>
