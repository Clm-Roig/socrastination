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

		if($verif_string->idPartie == ''){		//si 0, on crée une nouvelle partie
			$req_creation="UPDATE Forums
						SET idPartie
						WHERE idForum=$num_forum;							
						";
			echo "$req_creation";
			$bdd->query($req_creation);
		}
		
		/*$res_partie_creee = 'SELECT' ;
		$req = 'INSERT INTO Role(role, , ) VALUES(:pseudo, :motDePasse, :mail, 1, 0, 0, 0);';
		*/
	}
?>
