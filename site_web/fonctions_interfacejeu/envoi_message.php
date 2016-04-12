<?php
	//CONNEXION BDD
	require("fonctions_interfacejeu/../config.php");

	// ========== POST DU MESSAGE ========== // 
	try{
		// REQUETE 
		$req_message = 	"INSERT INTO Chat_messages (message_id_membre, message_time, message_text, n_forum)
						VALUES (".$_SESSION['idMembre'].",NOW(),".$_POST['message'].",".$_SESSION['id_forum'].";)
						";	
		$bdd->query(req_message);
	}
	catch (PDOException $e) {
		echo '<h2>Erreur enregistrement des données : ' . $e->getMessage().'</h2>';
	}

?>
