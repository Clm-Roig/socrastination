<?php
session_start();
//CONNEXION BDD
require("../config.php");

$id_message=$_POST['id_message'];
if ($_POST['type_vote']==1) {	//VOTE +1

	// UPDATE DE LA TABLE VOTES
	$req_vote= 	"INSERT INTO Votes(idArbitre, idMessage, vote) 
				VALUES({$_SESSION['idMembre']},$id_message, 1)
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
	// UPDATE DE LA TABLE VOTES
	$req_vote= 	"INSERT INTO Votes(idArbitre, idMessage, vote) 
				VALUES({$_SESSION['idMembre']},$id_message, -1)
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
?>
