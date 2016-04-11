<?php
	//CONNEXION BDD
	require("../config.php");

	// ========== POST DU MESSAGE ========== // 
	try{
		// REQUETE 
		$req = 'INSERT INTO ...';

	}
	catch (PDOException $e) {
		echo '<h2>Erreur enregistrement des données : ' . $e->getMessage().'</h2>';
	}

?>
