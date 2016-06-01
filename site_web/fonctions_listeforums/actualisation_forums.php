<?php
	//CONNEXION BDD
	require("../config.php");

	//NB DE JOUEURS
	$id_forum=$_GET['numforum'];
	$req_joueur = $bdd->query(	"
						SELECT COUNT(*) FROM Role R
					 	JOIN Forums F ON F.idPartie=R.idPartie
						WHERE F.idForum=$id_forum	
						AND R.role=0;
						"
					);
	$nb_j= $req_joueur->fetchColumn();	//on compte le nombre de joueur (role=0) dans une partie

	//NB D'ARBITRES
	$req_arbitre = $bdd->query(	"
						SELECT COUNT(*) FROM Role R
					 	JOIN Forums F ON F.idPartie=R.idPartie
						WHERE F.idForum=$id_forum	
						AND R.role=1;
						"
					);
	$nb_a= $req_arbitre->fetchColumn();	//on compte le nombre d'arbitres (role=1) dans une partie

	//SUJET CHOISI
	$req_sujet =	"SELECT nomSujet FROM Sujets S
				JOIN Parties P ON P.idSujet=S.idSujet
				JOIN Forums F ON F.idPartie=P.idPartie
				WHERE F.idForum={$id_forum}
				AND S.idSujet=P.idSujet 
				;";
	$res_sujet = $bdd->query($req_sujet);
	if ($res_sujet==false) {
		echo "Erreur query : $req_sujet";
		exit();
	}

	$res_sujet = $res_sujet->fetch();

	if ($res_sujet['nomSujet']==null) $sujet = "Partie disponible, sujet au choix.";
	else $sujet = $res_sujet['nomSujet'];

	// MISE À JOUR DE LA PAGE 
	// à faire : renvoyer du html, en chargeant une vue correspondant à une ligne du tableau des forums.
	echo "$nb_j,$nb_a,$sujet";	
?>
