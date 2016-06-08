<?php
	//Retourne le temps restant avant fin de partie (si finie), sinon -1

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
	if($nb_mess==10) {
		$req_stop = 	"UPDATE Parties
					SET tour_joueur=-1
					WHERE idPartie={$_SESSION['id_partie']}
					;";
		$res_stop = $bdd->query($req_stop);
		if ($res_stop==false){
			echo "Erreur query arret partie : $req_stop.";
			exit();
		}
		
		//Requete time fin partie
		$req_time = 	"SELECT time_fin_partie
					FROM Parties 
					WHERE idPartie={$_SESSION['id_partie']}
					;";
		$res_time = $bdd->query($req_time);
		if(!$res_time){
			echo "Erreur vérif time_fin_partie null : $req_time.";
			exit();
		}
		$time=$res_time->fetch()['time_fin_partie'];
		$now=date("Y-m-d H:i:s");
		//S'il n'y a pas de time_fin_partie, on l'initialise.
		if($time==null){
			$req_up_time = 	"UPDATE Parties
							SET time_fin_partie='$now'
							WHERE idPartie={$_SESSION['id_partie']}
							;";
			$res_up_time = $bdd->query($req_up_time);
			if(!$res_up_time){
				echo "Erreur insertion time_fin_partie : $req_up_time.";
				exit();
			}
		}	
	
		//On retourne combien de temps il reste avant la fin
		$res =30-(strtotime($now)-strtotime($time));
		if($res<0) $res=0;
		echo $res;
	}
	else echo -1;
?>
