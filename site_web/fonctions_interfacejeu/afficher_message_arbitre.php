<?php
	session_start();
	//CONNEXION BDD
	require("../config.php");

	// ========== SEARCH DU MESSAGE ========== // 
	try{
		// REQUETE SELECTIONNANT LE DERNIER MESSAGE DANS LA BDD
		$req_message = 	"SELECT message_text 
						FROM Chat_messages
						WHERE id_partie=".$_SESSION['id_partie']."
						AND message_time=(
							SELECT MAX(message_time)	
							FROM Chat_messages
							)
						;";
	
		//VERIFICATION DE L'AUTEUR DU DERNIER MESSAGE
		$req_auteur = 	"SELECT message_id_membre 
						FROM Chat_messages
						WHERE id_partie=".$_SESSION['id_partie']."
						AND message_time=(
							SELECT MAX(message_time)	
							FROM Chat_messages
							)
						;";
		
		$res_req_auteur= $bdd->query($req_auteur);
		$res_req_auteur_str = $res_req_auteur->fetch();

		$res_req=$bdd->query($req_message);
		$res_req_str=$res_req->fetch();

		//On insère les caractères £$¤ pour séparer l'auteur du message
		echo $res_req_auteur_str."£$¤".$res_req_str[0];	
	}
	catch (PDOException $e) {
		echo '<h2>Erreur affichage des données : ' . $e->getMessage().'</h2>';
	}

?>
