<?php
	session_start();
	require("config.php");

	if (!isset($_SESSION['pseudo'])) {
		$header=file_get_contents("elements_communs/header2.php");
	}
	else {
		$header=file_get_contents("elements_communs/header3.php");
	}

	if(isset($_GET['action'])) $action=$_GET['action'];
	else $action='default';

	switch($action) {

/*----------------- CLASSEMENT ----------------- */
		case("classement") :
			$vue=file_get_contents("vues/v_classement.html");	

	   		// INTERROGATION 
	   		$classement = $bdd -> query("SELECT * FROM Membres ORDER BY nbDePoints DESC LIMIT 5");
	   		if ($classement==false) {
	       			header('Location: erreur.php?num_erreur=1');
	       			exit();
	   		}
	  
			$i=1;
	  		while(($info=$classement -> fetchobject())!=null){ 
	       			$ps=$info->pseudo; 
				$po=$info->nbDePoints;
				$vue=str_replace("{pseudo".$i."}",$ps,$vue);
				$vue=str_replace("{nbp".$i."}",$po,$vue);
				$i = $i+1;
		   	}					
			break;

/*----------------- REGLES ----------------- */
		case("regles") :
			$vue=file_get_contents("vues/v_regles.html");	
			break;

/*----------------- INSCRIPTION ----------------- */
		case("inscription") :
			$vue=file_get_contents("vues/v_inscription.html");	
			break;

/*----------------- MEMBRE ----------------- */
		case("membre") :
			$vue=file_get_contents("vues/v_membre.html");
			// INTERROGATION
			$req = "SELECT * FROM Membres WHERE idMembre={$_SESSION['idMembre']}";
			$query = $bdd->query($req);
			if ($query==false) {
				echo "Erreur query : $req";
				exit();
			}
			else {
				$info=$query->fetch();
				$vue=str_replace("{pseudo}",$info['pseudo'],$vue);
				$vue=str_replace("{mail}",$info['mail'],$vue);
				$vue=str_replace("{niveau}",$info['niveau'],$vue);
				$vue=str_replace("{nbDePoints}",$info['nbDePoints'],$vue);
				$vue=str_replace("{nbTotalParties}",$info['nbTotalParties'],$vue);
				$vue=str_replace("{nbPartiesGagnees}",$info['nbPartiesGagnees'],$vue);
			}
			break;

/*----------------- ERREUR ----------------- */
		case("erreur") :
			$vue = file_get_contents("vues/v_erreur.html");
			$message="";

			//Contrôle de l'erreur envoyée
			if ($_GET['num_erreur']==0){
				$message = 'Erreur : identification requise.';
			}

			if ($_GET['num_erreur']==1){
				$message = 'Erreur : problème de connexion serveur.';
			}

			if ($_GET['num_erreur']==2){
				$message = 'Erreur : partie pleine.';
			}	

			if ($_GET['num_erreur']==3){
				$message = 'Erreur : login incorrect.';
			}
	
			//Remplacement
			$vue = str_replace('{erreur}',$message,$vue);	
			break;

/*----------------- DEFAUT (INDEX) ----------------- */
		default :
			$vue=file_get_contents("vues/v_index.html");	
			break;
	}//fin switch

	//Remplacement header + pseudo + affichage
	$vue=str_replace("{header}",$header,$vue);
	echo $vue;
?>
		
