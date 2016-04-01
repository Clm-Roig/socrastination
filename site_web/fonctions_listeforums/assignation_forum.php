<?php
	session_start();

	//CONNEXION BDD
	require("../config.php");
	
	if (!isset($_SESSION['pseudo'])) {
		header('Location: ../erreur_paslog.php');
	}
	
	else {
		//RECUPERATION DES VARIABLES
		$num_forum = (int) ($_POST['assign']/10);
		$num_role = $_POST['assign']%10;

		//CREATION DE LA PARTIE SI JOUEUR ET PARTIE INEXISTANTE 
		$verif=$bdd->query("SELECT idPartie FROM Forums WHERE idForum=$num_forum");
		$verif_string=$verif->fetchobject();

		if($verif_string->idPartie == 0){		//si 0, on créer une nouvelle partie
			$req_creation="INSERT INTO Forums(idForum, idPartie) 
				VALUES(
						NULL,
						$num_forum,
			)";
			$bdd->query($req_creation);
		}
		
		/*$res_partie_creee = 'SELECT' ;
		$req = 'INSERT INTO Role(role, , ) VALUES(:pseudo, :motDePasse, :mail, 1, 0, 0, 0);';
		*/
	}
?>
