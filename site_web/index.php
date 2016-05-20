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

/*----------------- DEFAUT (INDEX) ----------------- */
		default :
			$vue=file_get_contents("vues/v_index.html");	
			break;
	}//fin switch

	//Remplacement header + affichage
	$vue=str_replace("{header}",$header,$vue);
	echo $vue;
?>
		
