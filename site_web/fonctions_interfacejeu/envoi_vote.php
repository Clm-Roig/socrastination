<?php
	session_start();
	//CONNEXION BDD
	require("../config.php");

	try{
		if ($_GET['type_vote']==1) {	//VOTE +1

			// UPDATE DE LA TABLE
			$id_message=$_GET['id_message'];
			$req_vote= 	"UPDATE Chat_messages
						SET votes_up=votes_up+1
						WHERE message_id=$id_message
						";	

			$bdd->query($req_vote);

			//CONTROLE
			if (!$bdd){
				echo "Erreur envoi BDD, veuillez réessayer.";
			}

			//OK 
			else {
			
			}

		else {	//vote -1
			// UPDATE DE LA TABLE
			$id_message=$_GET['id_message'];
			$req_vote= 	"UPDATE Chat_messages
						SET votes_up=votes_down+1
						WHERE message_id=$id_message
						";	

			$bdd->query($req_vote);

			//CONTROLE
			if (!$bdd){
				echo "Erreur envoi BDD, veuillez réessayer.";
			}

			//OK 
			else {
			
			}

		}
	}
	catch (PDOException $e) {
		echo 'Erreur connexion BDD : ' . $e->getMessage().'';
	}

?>
