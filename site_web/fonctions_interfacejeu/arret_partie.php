<?php
	session_start();
	require ("../config.php");
		
	// ====== Requete qui compte le nombre de message ======= //
	$req = 	"SELECT COUNT(message_id) FROM Chat_messages
			WHERE id_partie={$_SESSION['id_partie']}
			";
	$res = $bdd->query($req);
	if ($res==false){
		echo "Erreur query arrêt partie : $req";
		exit();
	}
	$nb_mess=$res->fetchColumn();

	//S'il y a 20 messages échangés, on positionne l'attribut tour_joueur sur -1 
	//pour que personne n'envoie de message supplémentaire
	//Et on débloque le compteur
	if($nb_mess==20) {
		$req_stop = 	"UPDATE Parties
					SET tour_joueur=-1
					WHERE idPartie={$_SESSION['id_partie']}
					";
		$res_stop = $bdd->query($req_stop);
		if ($res_stop==false){
			echo "Erreur query arret partie : $req_stop.";
			exit();
		}
		//TODO : INSERTION BDD TIME FIN PARTIE
	}

	echo $nb_mess >= 20; 
?>
