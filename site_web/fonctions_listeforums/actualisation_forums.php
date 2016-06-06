<?php
	//CONNEXION BDD
	require("../config.php");

	//NB DE JOUEURS
	$id_forum=$_GET['numforum'];
	$req_joueur = 	"SELECT COUNT(*) FROM Role R
					 JOIN Forums F ON F.idPartie=R.idPartie
					WHERE F.idForum=$id_forum	
					AND R.role=0
					;";
	$res_joueur = $bdd->query($req_joueur);
	if(!$res_joueur){
		echo "Erreur requete nb joueurs : $req_joueur.";
		exit();
	}	
	$nbj= $res_joueur->fetchColumn();	//on compte le nombre de joueur (role=0) dans une partie

	//NB D'ARBITRES
	$req_arbitre = 	"SELECT COUNT(*) AS nba FROM Role R
					 JOIN Forums F ON F.idPartie=R.idPartie
					WHERE F.idForum=$id_forum	
					AND R.role=1
					;";
	$res_arbitre = $bdd->query($req_arbitre);
	if(!$res_arbitre){
		echo "Erreur requete nb arbitres : $req_arbitre.";
		exit();
	}	
	$nba_tab=$res_arbitre->fetch();
	$nba=$nba_tab['nba'];

	//SUJET CHOISI
	$req_sujet =	"SELECT nomSujet FROM Sujets S
				JOIN Parties P ON P.idSujet=S.idSujet
				JOIN Forums F ON F.idPartie=P.idPartie
				WHERE F.idForum={$id_forum}
				AND S.idSujet=P.idSujet 
				;";
	$res_sujet = $bdd->query($req_sujet);
	if (!$res_sujet) {
		echo "Erreur requete sujet : $req_sujet";
		exit();
	}
	$res_sujet_tab = $res_sujet->fetch();

	if ($res_sujet_tab['nomSujet']==null) $sujet = '<i class="partie_dispo">Partie disponible, sujet au choix.</i>';
	else $sujet = '<p class="nom_sujet">'.$res_sujet_tab['nomSujet'].'</p>';

	// ENVOI EN TABLEAU JSON
	$tab = array(
			"nbj"=>$nbj,
			"nba"=>$nba,
			"sujet"=>$sujet,
		);	
	echo json_encode($tab);	
?>
