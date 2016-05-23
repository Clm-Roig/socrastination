<?php
	session_start();
	//CONNEXION BDD
	require("../config.php");

// ========== SEARCH DU MESSAGE ========== // 
	$id_mess = $_POST['id_last_mess'];
	//Si l'id passé en paramètre est celui du dernier message ou s'il n'y a pas de messages, on quitte 
	$req_last_id =	"SELECT MAX(message_id) AS last_id
					FROM Chat_messages
					WHERE id_partie=".$_SESSION['id_partie']."
					;";
	$res_last_id = $bdd -> query($req_last_id);
	$res_tab_last_id = $res_last_id -> fetch((PDO::FETCH_ASSOC));	

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
				AND message_id = (
					SELECT MIN(message_id)
					FROM Chat_messages
					WHERE id_partie=".$_SESSION['id_partie']."
					)
				;";

		$res_req = $bdd->query($req);
		$res_req_tab = $res_req->fetch();		
		$auteur_str = $res_req_tab['message_id_membre'];
		$id_mess = $res_req_tab['message_id'];
		$message_str = $res_req_tab['message_text'];
	}

	// Sinon, on sélectionne les messages suivants
	else {
		$req =	"SELECT message_id , message_id_membre, message_text
				FROM Chat_messages
				WHERE id_partie=".$_SESSION['id_partie']."
				AND message_time > (
					SELECT message_time	
					FROM Chat_messages
					WHERE message_id=$id_mess
					)
				;";

		$res_req = $bdd -> query($req);
		$res_req_tab = $res_req -> fetch();		
		$auteur_str = $res_req_tab['message_id_membre'];
		$id_mess = $res_req_tab['message_id'];
		$message_str = $res_req_tab['message_text'];
	}

	// ========== VERIF VOTE ========== // 
	$req_vote =	"SELECT vote FROM Votes
				WHERE idMessage=$id_mess 
				AND idArbitre={$_SESSION['idMembre']}
				;";
	$res_vote = $bdd -> query($req_vote);
	if($res_vote==false) $vote=0;	//Si la requete est vide, on retourne 0
	else {
		$res_tab = $res_vote->fetch();	
		if($res_tab['vote']==null) $vote=0;
		else $vote=$res_tab['vote'];
	}			
	
	//Tableau pour l'envoi
	$tab = array(
				"auteur"=>$auteur_str,
				"message_txt"=>$message_str,
				"idm"=>$id_mess,
				"vote"=>$vote,
				"statut"=>true,	//requete réussie 
				);

	echo json_encode($tab);	
?>
