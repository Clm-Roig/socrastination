<?php
	session_start();
	require ("config.php");

	if (!isset($_SESSION['pseudo'])) {
		header('Location: liste_forums.php');
	}

	// REQUETE SUJETS DISPONIBLES
	$req=	"SELECT nomsujet FROM Sujets;";
	$res=$bdd->query($req);
	if ($res==false) {
		echo "Erreur query sujets : $req.";
		exit();
	}

	$c=1;	
	$vue=file_get_contents("vues/v_interfacejeu.html");
	while($liste_sujets=$res->fetch()){
		$vue=str_replace("{sj".$c."}",$liste_sujets['nomsujet'],$vue);
		$c=$c+1;
	}	
	echo $vue;
?>

