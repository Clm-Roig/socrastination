<?php
	session_start();

	//CONNEXION BDD
	require("../config.php");
	
	if (!isset($_SESSION['pseudo'])) {
		header('Location: ../erreur_paslog.php');
	}
	
	else {
		//REQUETE SQL => Insertion dans Role
		$req = 'INSERT INTO Role(role, , ) VALUES(:pseudo, :motDePasse, :mail, 1, 0, 0, 0);';
		$stmt = $bdd->prepare($req);

		echo 'Valeur du post : '.$_POST['assign'];
	}
?>
