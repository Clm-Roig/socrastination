<?php
	session_start();
	//CONNEXION BDD
	require("../config.php");

	// ========== POST DU MESSAGE ========== // 
	$mess=$bdd->quote($_POST['message']);
	$req_message = 	"INSERT INTO Chat_messages(message_id_membre, message_time, message_text, id_partie)
					VALUES ({$_SESSION['idMembre']}, NOW(), $mess, {$_SESSION['id_partie']})
					;";	
	$res=$bdd->query($req_message);
	//CONTROLE
	if (!$res){
		echo "Erreur requete message : $req_message.";
	}
	
	// ========== MAJ JOUER_TOUR ======= //
	//Si ça marche, c'est à l'autre joueur de parler
	else { 
		//On récupère l'ID du joueur adverse
		$req_tour = 	"UPDATE Parties 
					SET tour_joueur={$_POST['id_adv']}
					WHERE idPartie={$_SESSION['id_partie']}
					;";
		$res_tour=$bdd->query($req_tour);
		//CONTROLE
		if (!$res_tour){
			echo "Erreur requete tour joueur : $req_tour.";
		}
	}
?>
