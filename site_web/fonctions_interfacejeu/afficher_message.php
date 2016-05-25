<?php
	session_start();
	//CONNEXION BDD
	require("../config.php");

	// ========== SEARCH DU MESSAGE ========== // 
	try{
		$id_mess = $_POST['id_last_mess'];
		//Si l'id passé en paramètre est celui du dernier message, on quitte le script php
		$req_last_id =	"SELECT MAX(message_id) AS last_id
						FROM Chat_messages
						WHERE id_partie=".$_SESSION['id_partie']."
						;";

		$res_last_id = $bdd -> query($req_last_id);
		$res_tab_last_id = $res_last_id -> fetch((PDO::FETCH_ASSOC));	

		if ($res_tab_last_id['last_id']==null) {
			echo 'Pas de messages.';
			exit();
		}
		if ($id_mess==$res_tab_last_id['last_id']) {
			echo 'Dernier message atteint.';
			exit();
		}

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
				$id_str = $res_req_tab['message_id'];
				$message_str = $res_req_tab['message_text'];
				$auteur_str = $res_req_tab['message_id_membre'];
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
				$id_str = $res_req_tab['message_id'];
				$message_str = $res_req_tab['message_text'];
			}

			//$bool_auteur = 1 si le message vient du joueur, sinon 0 (adversaire)
			$bool_auteur = 1;
			if ($auteur_str != $_SESSION['idMembre']){
				$bool_auteur = 0;
			}

			echo $bool_auteur.$message_str.'ù%*µ'.$id_str;	
		}
	}
	catch (PDOException $e) {
		echo '<h2>Erreur affichage des données : ' . $e->getMessage().'</h2>';
	}

?>
