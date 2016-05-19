<?php
	session_start();
	//CONNEXION BDD
	require("../config.php");

	try{
		$id_message=$_POST['id_message'];
		if ($_POST['type_vote']==1) {	//VOTE +1
			// UPDATE DE LA TABLE
			$req_vote= 	"UPDATE Chat_messages
						SET votes_up=votes_up+1
						WHERE message_id=$id_message;
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

		else {	//vote -1
			// UPDATE DE LA TABLE
			$req_vote= 	"UPDATE Chat_messages
						SET votes_down=votes_down+1
						WHERE message_id=$id_message;
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
