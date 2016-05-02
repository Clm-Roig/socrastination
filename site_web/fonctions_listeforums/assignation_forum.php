<?php
	session_start();

	//CONNEXION BDD
	require("../config.php");
	if (!isset($_SESSION['pseudo'])) {
		header('Location: ../erreur.php?num_erreur=0');
	}
	
	else {
		//RECUPERATION DES VARIABLES
		$num_forum = (int) ($_POST['assign']/10);
		$num_role = $_POST['assign']%10;

		//VERIFICATION SI PARTIE INEXISTANTE 
		$verif=$bdd->query("SELECT idPartie FROM Forums WHERE idForum=$num_forum");
		$verif_string=$verif->fetchobject();
		$id_partie=$verif_string->idPartie;

		if($id_partie == 0){		//si 0, on créé une nouvelle partie
			
			//ON CHERCHE L'ID MAX DES PARTIES (et on incrémente)
			$req_id="SELECT MAX(idPartie) AS idmax FROM Parties";	
			$res_id=$bdd->query($req_id);
			$id_max=$res_id->fetchobject();
			$id_max=$id_max->idmax;		
			$id_max++;
	
			//CREATION DES REQUETES
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

			//Stockage dans $_SESSION 
			$_SESSION['id_forum']=$num_forum;	
			$_SESSION['id_partie']=$id_max;				

			//Redirection vers la partie créée
			header("Location: ../interfacejeu.php?npartie=$id_max&nforum=$num_forum");
			exit();
		}

		else{	
			 if($num_role==0) {		//Il y a une partie sur ce forum et on est rentré en tant que joueur

				//VERIFICATION NOMBRE DE JOUEURS
				$req_nbj=$bdd->query("SELECT COUNT(*) FROM Role WHERE idPartie=$id_partie AND role=0");
				$nb_j= $req_nbj->fetchColumn();

				if($nb_j >= 2){		//Il y a trop de joueurs, on va voir si c'est toi qui était dedans 

					//Nope c'était pas toi , redirection vers listeforums
					header("Location: ../erreur.php?num_erreur=2");
					exit();
				}

				else {	//Ok on a une place pour toi, joueur
					//Requete pour la table Role
					$req_creation_j1="INSERT INTO Role (role,idPartie,idMembre)
								VALUES ($num_role,$id_partie,".$_SESSION['idMembre'].");						
								";

					$bdd->query($req_creation_j1);

					//Stockage dans $_SESSION 
					$_SESSION['id_forum']=$num_forum;	
					$_SESSION['id_partie']=$id_partie;

					//Redirection vers la partie
					header("Location: ../interfacejeu.php?npartie=$id_partie&nforum=$num_forum");
					exit();
				}
			}
	
			if($num_role==1){			//Il y a une partie sur ce forum et on est rentré en tant qu'arbitre
				//VERIFICATION NOMBRE D'ARBITRES
				$req_nba=$bdd->query("SELECT COUNT(*) FROM Role WHERE idPartie=$id_partie AND role=1");
				$nb_a= $req_nba->fetchColumn();

				if($nb_a >= 10){		//Il y a trop d'arbitres, du balais !
					//Redirection vers erreur.php
					header("Location: ../erreur.php?num_erreur=2");
					exit();
				}
				
				else {	//Ok on a une place pour toi, arbitre

					//Requete pour la table Role
					$req_creation_a1="INSERT INTO Role (role,idPartie,idMembre)
								VALUES ($num_role,$id_partie,".$_SESSION['idMembre'].");						
								";

					$bdd->query($req_creation_a1);

					//Stockage dans $_SESSION 
					$_SESSION['id_forum']=$num_forum;	
					$_SESSION['id_partie']=$id_partie;

					//Redirection vers la partie
					header("Location: ../interfacearbitre.php?npartie=$id_partie&nforum=$num_forum");
					exit();
				}
			}	
		}
	}
?>
