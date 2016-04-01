<?php
	//CONNEXION BDD
	require("../config.php");

	$req_pseudo="SELECT pseudo FROM Membres";	
	$res_pseudo=$bdd->query($req_pseudo);
	$liste_pseudo=$res_pseudo->fetchobject();
	$pseudo_saisi=$_GET['pseudoinscr'];
	$res=0;
	while($liste_pseudo != null){
		if ($pseudo_saisi==$liste_pseudo->pseudo){
			$res=1;
		}
	}		
	echo "$res";
?>
