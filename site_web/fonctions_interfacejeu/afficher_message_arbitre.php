<?php
	session_start();
	//CONNEXION BDD
	require("../config.php");

// ========== SEARCH DU MESSAGE ========== // 
	$id_mess = $_GET['id_last_mess'];

	//Si l'id passé en paramètre est celui du dernier message ou s'il n'y a pas de messages, on quitte 
	$req_last_id =	"SELECT MAX(message_id) AS last_id
					FROM Chat_messages
					WHERE id_partie=".$_SESSION['id_partie']."
					;";
	$res_last_id = $bdd -> query($req_last_id);
	$res_tab_last_id = $res_last_id -> fetch();	

	if ($id_mess==$res_tab_last_id['last_id']) {
		//Tableau pour l'envoi
		$tab = array(
					"statut"=>false,	//requete échouée 
					);
		echo json_encode($tab);	
		exit();
	}
	if ($res_tab_last_id['last_id']==null) {
		//Tableau pour l'envoi
		$tab = array(
					"statut"=>false,	//requete échouée 
					);
		echo json_encode($tab);
		exit();	
	}
	
	//Si l'id = -1, on le positionne sur le premier message de la partie 
	if ($id_mess==-1){
		$req =	"SELECT message_id , message_id_membre, message_text
				FROM Chat_messages
				WHERE id_partie=".$_SESSION['id_partie']."
				AND message_time = (
					SELECT MIN(message_time)
					FROM Chat_messages
					WHERE id_partie=".$_SESSION['id_partie']."
					)
				;";

		$res_req = $bdd->query($req);
		$res_req_tab = $res_req->fetch();		
		$auteur_str = $res_req_tab['message_id_membre'];
		$id_new_mess = $res_req_tab['message_id'];
		$message_str = $res_req_tab['message_text'];
	}

	// Sinon, on sélectionne les messages suivants
	else {
		//Requete pour l'heure du dernier message affiché
		$req_time_last_mess = 	"SELECT message_time	
							FROM Chat_messages
							WHERE message_id={$id_mess}
							;";
		$res_time = $bdd->query($req_time_last_mess);
		if ($res_time==false) {
			echo "Erreur query : $req_time_last_mess";
			exit();
		}
		$res_time = $res_time->fetch();
		$time_last_mess = $res_time['message_time'];

		//Requete pour le message suivant
		$req =	"SELECT message_id, message_id_membre, message_text
				FROM Chat_messages
				WHERE id_partie={$_SESSION['id_partie']}
				AND message_time=( 
							SELECT MIN(message_time) 
							FROM Chat_messages 
							WHERE message_time > '{$time_last_mess}'
							AND id_partie={$_SESSION['id_partie']}
							)
				;";	

		$res_req = $bdd -> query($req);
		if ($res_req==false){
			echo "Erreur query : $req";
			exit();
		}
		$res_req_tab = $res_req->fetch();		
		$auteur_str = $res_req_tab['message_id_membre'];
		$id_new_mess = $res_req_tab['message_id'];
		$message_str = $res_req_tab['message_text'];
	}

	// ========== VERIF VOTE ========== // 
	$req_vote =	"SELECT vote FROM Votes
				WHERE idMessage=$id_new_mess 
				AND idArbitre={$_SESSION['idMembre']}
				;";
	$res_vote = $bdd -> query($req_vote);
	if(!$res_vote) {
		echo("Erreur requete vote : $req_vote.");
		exit();
	}
	$res_vote_tab = $res_vote->fetch();
	if ($res_vote_tab==false) $vote=0;	//Si la requete est vide, on retourne 0
	else {
		$vote=$res_vote_tab['vote'];
	}			
	
	//Tableau pour l'envoi
	$tab = array(
				"auteur"=>$auteur_str,
				"message_txt"=>$message_str,
				"idm"=>$id_new_mess,
				"vote"=>$vote,
				"statut"=>true,	//requete réussie 
				);

	echo json_encode($tab);	
?>
