<?php
	session_start();
	//CONNEXION BDD
	require("../config.php");

	// ========== SEARCH DU MESSAGE ========== // 
	try{
		$id_mess = $_POST['id_last_mess'];
		//Si l'id passé en paramètre est celui du dernier message, on quitte 
		$req_last_id =	"SELECT MAX(message_id) AS last_id
						FROM Chat_messages
						WHERE id_partie=".$_SESSION['id_partie']."
						;";
		$res_last_id = $bdd -> query($req_last_id);
		$res_tab_last_id = $res_last_id -> fetch((PDO::FETCH_ASSOC));	
		if ($id_mess==$res_tab_last_id['last_id']) echo 'Dernier message atteint.';
		
		else {
		
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

				$res_req = $bdd -> query($req);
				$res_req_tab = $res_req -> fetch((PDO::FETCH_ASSOC));		
				$auteur_str = $res_req_tab['message_id_membre'];
				$id_str = $res_req_tab['message_id'];
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
				$res_req_tab = $res_req -> fetch((PDO::FETCH_ASSOC));		
				$auteur_str = $res_req_tab['message_id_membre'];
				$id_str = $res_req_tab['message_id'];
				$message_str = $res_req_tab['message_text'];
			}

			//On insère les caractères £$¤ pour séparer l'auteur du message
			//Pareil avec ù%*µ pour séparer l'id du message
			echo $auteur_str.'£$¤'.$message_str.'ù%*µ'.$id_str;
		}
	}
	catch (PDOException $e) {
		echo '<h2>Erreur affichage des données : ' . $e->getMessage().'</h2>';
	}

?>
