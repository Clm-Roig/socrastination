<?php
	session_start();
	require("config.php");

	//Header dynamique (loggué ou pas)
	if (!isset($_SESSION['pseudo'])) {
		$header=file_get_contents("elements_communs/header2.php");
	}
	else {
		$header=file_get_contents("elements_communs/header3.php");
		$header=str_replace("{pseudo}",$_SESSION['pseudo'],$header);
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
			
			
/*----------------- INSCRIPTION VALIDEE----------------- */
		case("inscription_validee") :
			$vue = file_get_contents("vues/v_erreur.html");
			$message="";
			// REQUETE 
			$mdp=md5("{$_POST['motDePasse']}");
			$req = "INSERT INTO Membres(pseudo, motDePasse, mail, nbDePoints, nbPartiesGagnees, NbTotalParties) VALUES('{$_POST['pseudo']}', '{$mdp}', '{$_POST['mail']}', 0, 0, 0);";
			$res=$bdd->query($req);
			if($res!=false){
				$message="Inscription validée.";
			}
			else { // Accès pas OK !
					header('Location: index.php?action=erreur&num_erreur=3');
					
				}
			
			$vue = str_replace('{erreur}',$message,$vue);
			break;
			
			
/*----------------- CONNEXION ----------------- */			
		
		case("connexion") :
			$pseudo=trim($_POST['pseudo']);
			$req="SELECT idMembre,pseudo,motDePasse FROM Membres WHERE pseudo='$pseudo';";
			$res=$bdd->query($req);
			
			if($res!=false){
				$data=$res->fetch();
				$mdp=$data['motDePasse'];
				if (md5($_POST['pwd'])=="$mdp") { // Accès OK 
					$_SESSION['pseudo'] = $data['pseudo'];
					$_SESSION['idMembre'] = $data['idMembre'];
					header('Location: liste_forums.php'); 
				}
				else { // Accès pas OK !
					header('Location: index.php?action=erreur&num_erreur=3');
					
				}
			}
			else { 
				header('Location: index.php?action=erreur&num_erreur=1');
			}
			
		break;
/*----------------- DECONNEXION ----------------- */

		case("deconnexion") :
		session_unset ();
		// On détruit notre session
		session_destroy ();
		header('Location: index.php');
		break;
		

/*----------------- MEMBRE ----------------- */
		case("membre") :
			$vue=file_get_contents("vues/v_membre.html");
			$header=str_replace("{class_membre}","active",$header);
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
				$vue=str_replace("{nbDePoints}",$info['nbDePoints'],$vue);
				$vue=str_replace("{nbTotalParties}",$info['nbTotalParties'],$vue);
				$vue=str_replace("{nbPartiesGagnees}",$info['nbPartiesGagnees'],$vue);
			}
			
			break;

/*----------------- ERREUR ----------------- */
		case("erreur") :
			$vue 		= file_get_contents("vues/v_erreur.html");
			$message	="";		

			//Contrôle de l'erreur envoyée
			switch ($_GET['num_erreur']){
				case(0):
					$message = 'Erreur : identification requise.';
					break;

				case(1):
					$message = 'Erreur : problème de connexion serveur.';
					break;

				case(2):
					$message = 'Erreur : partie pleine.';
					break;

				case(3):
					$message = 'Erreur : login incorrect.';
					break;

				default:
					$message = 'Erreur : inconnue...';
					break;
			}
	
			//Remplacement
			$vue = str_replace('{erreur}',$message,$vue);	
			break;

/*----------------- DEFAUT (INDEX) ----------------- */
		default :
			$vue=file_get_contents("vues/v_index.html");	
			break;
	}//fin switch
		
	//Remplacement Header
	$vue=str_replace("{header}",$header,$vue);

	echo $vue;
?>
		
