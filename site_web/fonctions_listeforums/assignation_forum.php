<?php
	session_start();

	//CONNEXION BDD
	require("../config.php");
	
	if (!isset($_SESSION['pseudo'])) {
		header('Location: ../erreur_paslog.php');
	}
	
	else {
		//RECUPERATION DES VARIABLES
		$num_forum = $_POST['assign']/10;
		$num_role = $_POST['assign']%10;

		echo 'Valeur du num_forum : '.$num_forum;
		echo '<br>Valeur du role : '.$num_role;
		/*
		$res_partie_creee = 'SELECT' ;
		$req = 'INSERT INTO Role(role, , ) VALUES(:pseudo, :motDePasse, :mail, 1, 0, 0, 0);';
		$stmt = $bdd->prepare($req);*/

		echo '<br>Valeur du post : '.$_POST['assign'];
	}
?>
