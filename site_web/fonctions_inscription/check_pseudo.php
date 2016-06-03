<?php
	//CONNEXION BDD
	require("../config.php");

	$pseudo=$_GET['pseudoinscr'];
	$req = $bdd->query("SELECT pseudo FROM Membres WHERE pseudo='$pseudo'");
	$nb_occur= $req->fetch();
	if($nb_occur >= 1) {
		echo '1';
	}
	else {
		echo '0';
	}
?>
