<?php
	session_start();
	//CONNEXION BDD
	require("../config.php");

	// ========== POST DU MESSAGE ========== // 
	try{
		
		// REQUETE 
		$req_message = 	"INSERT INTO Chat_messages(message_id_membre, message_time, message_text, n_forum)
						VALUES (".$_SESSION['idMembre'].",NOW(),'".$_POST['message']."',".$_SESSION['id_forum'].");
						";	
		echo "<h1>".$req_message."</h1>";
		$bdd->query($req_message);

		//CONTROLE
		if (!$bdd){
			header("Location: ../interfacejeu.php?npartie=".$_SESSION['id_partie']."&nforum=".$_SESSION['id_forum']."&erreur=1");
			exit();
		}

		//OK REDIRECTION
		else {
			header("Location: ../interfacejeu.php?npartie=".$_SESSION['id_partie']."&nforum=".$_SESSION['id_forum'])."&erreur=0";
			exit();
		}
	}
	catch (PDOException $e) {
		echo '<h2>Erreur enregistrement des données : ' . $e->getMessage().'</h2>';
	}

?>
