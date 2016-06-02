<?php
	session_start();
	require("config.php");
	require("vues/Vue.php");

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
			$vue=new Vue("v_classement.html");	

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
				$tabmotclef=array(0=>"{pseudo".$i."}",1=>"{nbp".$i."}");
				$tabvaleur=array(0=>$ps,1=>$po);
				$vue->configurerAvecTableaux($tabmotclef,$tabvaleur);
				$i = $i+1;
		   	}					
			break;

/*----------------- REGLES ----------------- */
		case("regles") :
			$vue=new Vue("v_regles.html");	
			break;

/*----------------- INSCRIPTION ----------------- */
		case("inscription") :
			$vue=new Vue("v_inscription.html");	
			break;
			
			
/*----------------- INSCRIPTION VALIDEE----------------- */
		case("inscription_validee") :
			$vue = new Vue("v_erreur.html");
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
			
			$vue->configurer('erreur',$message);
			break;
			
/*----------------- RESULTAT ----------------- */

		case("resultat") :
			$vue =New Vue("v_pageresultat.html");  //$_SESSION['id_partie']
			$req="SELECT R.idMembre, M.pseudo FROM Role AS R JOIN Membres AS M ON R.idMembre = M.idMembre WHERE idPartie={$_SESSION['id_partie']};";//{$_SESSION['id_partie']}
			$res=$bdd->query($req);
			if ($res!=false){
				$vue->configurer('num_partie',$_SESSION['id_partie']);
				while(($data=$res -> fetchobject())!=null){
					if(($data->idMembre)!=($_SESSION['idMembre'])){
						$vue->configurer('pseudo_adversaire',$data->pseudo);
					}
					else{
						$vue->configurer('pseudo_joueur',$data->pseudo);
					}
				}				
			}
			else{
				header('Location: erreur.php?num_erreur=1');
	       		exit();
			}
			$reqPlus="SELECT C.message_id_membre, COUNT(V.idMessage) AS vote_plus FROM Votes AS V JOIN Chat_messages AS C ON V.idMessage=C.message_id WHERE vote=1 AND C.id_partie={$_SESSION['id_partie']} GROUP BY C.message_id_membre;";
			$resPlus=$bdd->query($reqPlus);
			if ($resPlus!=false){
				$votePlus=$resPlus->fetch();
				if ($votePlus['message_id_membre']==$_SESSION['idMembre']){
					$vue->configurer('nb_votes_plus_joueur',$votePlus['vote_plus']);
				}
				else{
					$vue->configurer('nb_votes_plus_adversaire',$votePlus['vote_plus']);
				}
			}
			$reqMoins="SELECT C.message_id_membre, COUNT(V.idMessage) AS vote_plus FROM Votes AS V JOIN Chat_messages AS C ON V.idMessage=C.message_id WHERE vote=-1 AND C.id_partie={$_SESSION['id_partie']} GROUP BY C.message_id_membre;";
			$resMoins=$bdd->query($reqMoins);
			if ($resMoins!=false){
				$voteMoins=$resMoins->fetch();
				if ($voteMoins['message_id_membre']==$_SESSION['idMembre']){
					$vue->configurer('nb_votes_moins_joueur',$voteMoins['vote_plus']);
				}
				else{
					$vue->configurer('nb_votes_moins_adversaire',$voteMoins['vote_plus']);
				}
			}
				
			
			
			
		
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
			$vue=new Vue("v_membre.html");
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
				$tabmotclef=array(0=>"{pseudo}",1=>"{mail}",2=>"{nbDePoints}",3=>"{nbTotalParties}",4=>"{nbPartiesGagnees}");
				$tabvaleur=array(0=>$info['pseudo'],1=>$info['mail'],2=>$info['nbDePoints'],3=>$info['nbTotalParties'],4=>$info['nbPartiesGagnees']);
				$vue->configurerAvecTableaux($tabmotclef,$tabvaleur);
			}
			
			break;

/*----------------- ERREUR ----------------- */
		case("erreur") :
			$vue 		= new Vue("v_erreur.html");
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
			$vue ->configurer('erreur',$message);	
			break;

/*----------------- DEFAUT (INDEX) ----------------- */
		default :
			$vue=new Vue("v_index.html");	
			break;
	}//fin switch
		
	//Remplacement Header
	$vue->configurer("header",$header);

	
	$vue->afficher();
?>
		
