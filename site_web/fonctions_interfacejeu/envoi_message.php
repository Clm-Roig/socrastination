<?php
	session_start();
	//CONNEXION BDD
	require("../config.php");

	// ========== POST DU MESSAGE ========== // 
	try{
		
		// REQUETE 
		$req_message = 	"INSERT INTO Chat_messages(message_id_membre, message_time, message_text, id_partie)
						VALUES (".$_SESSION['idMembre'].",NOW(),'".$_POST['message']."',".$_SESSION['id_partie'].");
						";	

		$bdd->query($req_message);

		//CONTROLE
		if (!$bdd){
			echo "Erreur envoi BDD, veuillez réessayer.";
		}

		//OK 
		else {
			
		}
	}
	catch (PDOException $e) {
		echo 'Erreur connexion BDD : ' . $e->getMessage().'';
	}

?>
