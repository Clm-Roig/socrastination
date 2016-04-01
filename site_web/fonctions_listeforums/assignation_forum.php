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

		if($verif_string->idPartie == 0){		//si 0, on créé une nouvelle partie
			
			//ON CHERCHE L'ID MAX DES PARTIES
			$req_id="SELECT MAX(idPartie) AS idmax FROM Forums";	
			$res_id=$bdd->query($req_id);
			$id_max=$res_id->fetchobject();
			$id_max=$id_max->idmax;		
			$id_max++;

			$req_creation="UPDATE Forums
						SET idPartie=$id_max
						WHERE idForum=$num_forum;							
						";
			echo "$req_creation";
		}		
		/*$res_partie_creee = 'SELECT' ;
		$req = 'INSERT INTO Role(role, , ) VALUES(:pseudo, :motDePasse, :mail, 1, 0, 0, 0);';
		*/
	}
?>
