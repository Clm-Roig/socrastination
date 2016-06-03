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
	       			header('Location: index.php?action=erreur&num_erreur=1');
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
			
			$reqRole="SELECT role FROM Role WHERE idPartie={$_SESSION['id_partie']} AND idMembre={$_SESSION['idMembre']};";
			$resRole=$bdd->query($reqRole);
			if ($resRole==false){
				echo "erreur requete resRole: $reqRole";
				ecit();
			}
			$role=$resRole->fetch();
			
			if($role['role']==0){
				$req="SELECT R.idMembre, M.pseudo FROM Role AS R JOIN Membres AS M ON R.idMembre = M.idMembre WHERE idPartie={$_SESSION['id_partie']} AND R.role={$role['role']};";//{$_SESSION['id_partie']}
				$res=$bdd->query($req);
				if ($res==false){
					echo "erreur requete res : $req";
					exit();
				}
				$vue->configurer('num_partie',$_SESSION['id_partie']);
				while(($data=$res -> fetchobject())!=null){
					if(($data->idMembre)!=($_SESSION['idMembre'])){
						$vue->configurer('pseudo_adversaire',$data->pseudo);
						$vue->configurer('pseudo',"contre {$data->pseudo}");
					}
					else{
						$vue->configurer('pseudo_joueur',$data->pseudo);
					}
				}				
			
			
			
				//Requete pour joueur
				$reqPlusJoueur="SELECT COUNT(V.idMessage) AS vote_plus FROM Votes AS V JOIN Chat_messages AS C ON V.idMessage=C.message_id WHERE vote=1 AND C.id_partie={$_SESSION['id_partie']} AND C.message_id_membre={$_SESSION['idMembre']};";
				$resPlusJoueur=$bdd->query($reqPlusJoueur);
				if ($resPlusJoueur==false){ 
					echo "erreur requete resPlus : $reqPlusAdverse";
					exit();
				}
				$votePlusJoueur=$resPlusJoueur->fetch();
				$vue->configurer('nb_votes_plus_joueur',$votePlusJoueur['vote_plus']);
				
				$reqMoinsJoueur="SELECT COUNT(V.idMessage) AS vote_moins FROM Votes AS V JOIN Chat_messages AS C ON V.idMessage=C.message_id WHERE vote=-1 AND C.id_partie={$_SESSION['id_partie']} AND C.message_id_membre={$_SESSION['idMembre']};";
				$resMoinsJoueur=$bdd->query($reqMoinsJoueur);
				if ($resMoinsJoueur==false){
					echo "erreur requete resPlus : $reqMoinsAdverse"; 
					exit();
				}
				$voteMoinsJoueur=$resMoinsJoueur->fetch();
				$vue->configurer('nb_votes_moins_joueur',$voteMoinsJoueur['vote_moins']);
				$final_joueur=($votePlusJoueur['vote_plus'])-($voteMoinsJoueur['vote_moins']);
				$vue->configurer('score_joueur',$final_joueur);
				
				
				//Requete pour adverse
				$reqPlusAdverse="SELECT COUNT(V.idMessage) AS vote_plus FROM Votes AS V JOIN Chat_messages AS C ON V.idMessage=C.message_id WHERE vote=1 AND C.id_partie={$_SESSION['id_partie']} AND C.message_id_membre!={$_SESSION['idMembre']};";
				$resPlusAdverse=$bdd->query($reqPlusAdverse);
				if ($resPlusAdverse==false){ 
					echo "erreur requete resPlus : $reqPlusAdverse";
					exit();
				}
				$votePlusAdverse=$resPlusAdverse->fetch();
				$vue->configurer('nb_votes_plus_adversaire',$votePlusAdverse['vote_plus']);
				
				$reqMoinsAdverse="SELECT COUNT(V.idMessage) AS vote_moins FROM Votes AS V JOIN Chat_messages AS C ON V.idMessage=C.message_id WHERE vote=-1 AND C.id_partie={$_SESSION['id_partie']} AND C.message_id_membre!={$_SESSION['idMembre']};";
				$resMoinsAdverse=$bdd->query($reqMoinsAdverse);
				if ($resMoinsAdverse==false){
					echo "erreur requete resPlus : $reqMoinsAdverse"; 
					exit();
				}
				$voteMoinsAdverse=$resMoinsAdverse->fetch();
				$vue->configurer('nb_votes_moins_adversaire',$voteMoinsAdverse['vote_moins']);
				$final_adverse=($votePlusAdverse['vote_plus'])-($voteMoinsAdverse['vote_moins']);
				$vue->configurer('score_adversaire',$final_adverse);
				

				
				if ($final_joueur>$final_adverse){
					$vue->configurer('statut','Victoire !');
				}
				else if($final_adverse>$final_joueur){
					$vue->configurer('statut','Defaite !');
				}
				else{
					$vue->configurer('statut','Egalité !');
				}
			}
			else{
				$req="SELECT R.idMembre, M.pseudo FROM Role AS R JOIN Membres AS M ON R.idMembre = M.idMembre WHERE idPartie={$_SESSION['id_partie']}";//{$_SESSION['id_partie']}
				$res=$bdd->query($req);
				if ($res==false){
					echo "erreur requete res : $req";
					exit();
				}
				$vue->configurer('num_partie',$_SESSION['id_partie']);
				while(($data=$res -> fetchobject())!=null){
					if(($data->idMembre)==($_SESSION['idMembre'])){
						$vue->configurer('pseudo',$data->pseudo);
					}
					else{
						$vue->configurer('pseudo_joueur',$data->pseudo);
						
					}
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
		
