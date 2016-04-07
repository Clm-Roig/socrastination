<?php
	//CONNEXION BDD
	require("../config.php");

	$id_forum=$_GET['numforum'];
	$req_joueur = $bdd->query(	"
						SELECT COUNT(*) FROM Role R
					 	JOIN Forums F ON F.idPartie=R.idPartie
						WHERE F.idForum='$id_forum'		
						AND R.role=0;
						"
					);
	$nb_j= $req_joueur->fetchColumn();	//on compte le nombre de joueur (role=0) dans une partie

	$req_arbitre = $bdd->query(	"
						SELECT COUNT(*) FROM Role R
					 	JOIN Forums F ON F.idPartie=R.idPartie
						WHERE F.idForum='$id_forum'		
						AND R.role=1;
						"
					);
	$nb_a= $req_arbitre->fetchColumn();	//on compte le nombre d'arbitres (role=1) dans une partie

	// MISE À JOUR DE LA PAGE 
	echo "$nb_j,$nb_a";	
?>
