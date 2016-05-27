<?php
	session_start();
	require ("config.php");

	if (!isset($_SESSION['pseudo'])) {
		header('Location: liste_forums.php');
	}

	// REQUETE SUJETS DISPONIBLES
	$req=	"SELECT idSujet,nomsujet FROM Sujets;";
	$res=$bdd->query($req);
	if ($res==false) {
		echo "Erreur query sujets : $req.";
		exit();
	}

	$sujets="";
	while($liste_sujets=$res->fetch()){
		$sujets=$sujets.'<option value="'.$liste_sujets['idSujet'].'">'.$liste_sujets['nomsujet'].'</option>';										
	}	

	$vue=file_get_contents("vues/v_interfacejeu.html");
	$vue=str_replace("{sujets}",$sujets,$vue);
	echo $vue;
?>

