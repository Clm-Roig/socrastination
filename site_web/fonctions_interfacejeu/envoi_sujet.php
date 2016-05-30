<?php
	session_start();
	//CONNEXION BDD
	require("../config.php");
	$sujet=$_POST['id_sujet'];
	$req_sujet= 	"UPDATE Parties
				SET idSujet=$sujet
				WHERE idPartie={$_SESSION['id_partie']}
				";	
	$res=$bdd->query($req_sujet);	
	//CONTROLE
	if ($res==false){
		echo "Erreur";
	}
	else echo "Ok";
?>
