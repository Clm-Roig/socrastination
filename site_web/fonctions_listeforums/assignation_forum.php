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
	
			//CREATION DE LA REQUETE
			//Requete pour la table Forums
			$req_creation1="UPDATE Forums
						SET idPartie=$id_max
						WHERE idForum=$num_forum;							
						";

			//Requete pour la table Parties
			$req_creation2="INSERT INTO Parties (idPartie)
						VALUES ($id_max);						
						";

			//Requete pour la table Role
			$req_creation3="INSERT INTO Role (role,idPartie,idMembre)
						VALUES ($num_role,$id_max,".$_SESSION['idMembre'].");						
						";

			$bdd->query($req_creation1);
			$bdd->query($req_creation2);
			$bdd->query($req_creation3);	

			//Redirection vers la partie créée
			header("Location: ../interfacejeu.php?npartie=$id_max&nforum=$num_forum");
			exit();
		}		

	}
?>
