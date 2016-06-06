<?php
	session_start();
	require("config.php");
	require("vues/Vue.php");
	require("vues/VueResultat.php");

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
	   		$classement = $bdd -> query("SELECT * FROM Membres ORDER BY points DESC LIMIT 5;");
	   		if ($classement==false) {
	       			header('Location: index.php?action=erreur&num_erreur=1');
	       			exit();
	   		}
	  
			$i=1;
	  		while(($info=$classement -> fetchobject())!=null){ 
	       			$ps=$info->pseudo; 
				$po=$info->points;
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
			$vue =New VueResultat("v_pageresultat.html");  //$_SESSION['id_partie']
			
			$role=$vue->role();
			$nbArbitre=$vue->nombreArbitre();
			
			// Cas des Joueurs
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
						$idAdverse=$data->idMembre;
						$vue->configurer('pseudo_adversaire',$data->pseudo);
						$vue->configurer('pseudo',"contre {$data->pseudo}");
					}
					else{
						$vue->configurer('pseudo_joueur',$data->pseudo);
					}
				}				
				
			
				//Requete pour joueur
				
				$votePlusJoueur=$vue ->votePlus($_SESSION['idMembre']);
				$vue->configurer('nb_votes_plus_joueur',$votePlusJoueur['vote_plus']);
				
				$voteMoinsJoueur=$vue->voteMoins($_SESSION['idMembre']);
				$vue->configurer('nb_votes_moins_joueur',$voteMoinsJoueur['vote_moins']);
				
				
				$final_joueur=($votePlusJoueur['vote_plus'])-($voteMoinsJoueur['vote_moins']);
				$vue->configurer('score_joueur',$final_joueur);
				
				$pointJoueur=$vue->calculPoints($final_joueur,$nbArbitre['nbArbitre']);
				$vue->configurer('point_joueur',$pointJoueur);
				
				
				//Requete pour adverse
				
				$votePlusAdverse=$vue->votePlus($idAdverse);
				$vue->configurer('nb_votes_plus_adversaire',$votePlusAdverse['vote_plus']);
				
				
				$voteMoinsAdverse=$vue->voteMoins($idAdverse);
				$vue->configurer('nb_votes_moins_adversaire',$voteMoinsAdverse['vote_moins']);
				
				$final_adverse=($votePlusAdverse['vote_plus'])-($voteMoinsAdverse['vote_moins']);
				$vue->configurer('score_adversaire',$final_adverse);
				
				$pointAdverse=$vue->calculPoints($final_adverse,$nbArbitre['nbArbitre']);
				$vue->configurer('point_adversaire',$pointAdverse);
								
				$statut=$vue->statutFinalJoueur($final_joueur,$_SESSION['idMembre'],$final_adverse,$idAdverse);
				$vue->configurer('statut',"$statut");
			}
			// cas arbitres
			else{
				
				$vue->configurer('num_partie',$_SESSION['id_partie']);
				
				//Requete pour Joueur idMIN
				
				$donneeMin=$vue->getIdMin();			
				$pseudoMin=$vue->reqPseudo($donneeMin['idMembre']);
				$vue->configurer('pseudo_joueur',$pseudoMin['pseudo']);				
			
				$votePlusMin=$vue->votePlus($donneeMin['idMembre']);
				$vue->configurer('nb_votes_plus_joueur',$votePlusMin['vote_plus']);
				
				$voteMoinsMin=$vue->voteMoins($donneeMin['idMembre']);
				$vue->configurer('nb_votes_moins_joueur',$voteMoinsMin['vote_moins']);
				
				$final_Min=($votePlusMin['vote_plus'])-($voteMoinsMin['vote_moins']);
				$vue->configurer('score_joueur',$final_Min);
				
				$pointMin=$vue->calculPoints($final_Min,$nbArbitre['nbArbitre']);
				$vue->configurer('point_joueur',$pointMin);
				
				
				//Requete pour Joueur idMAX
				
				$donneeMax=$vue->getIdMax();
				$pseudoMax=$vue->reqPseudo($donneeMax['idMembre']);				
				$vue->configurer('pseudo_adversaire',$pseudoMax['pseudo']);
				
				$vue->configurer('pseudo',"arbitrée ({$pseudoMin['pseudo']} vs {$pseudoMax['pseudo']})");				

				$votePlusMax=$vue->votePlus($donneeMax['idMembre']);
				$vue->configurer('nb_votes_plus_adversaire',$votePlusMax['vote_plus']);				
			
				$voteMoinsMax=$vue->voteMoins($donneeMax['idMembre']);
				$vue->configurer('nb_votes_moins_adversaire',$voteMoinsMax['vote_moins']);
				
				$final_Max=($votePlusMax['vote_plus'])-($voteMoinsMax['vote_moins']);
				$vue->configurer('score_adversaire',$final_Max);
				
				$pointMax=$vue->calculPoints($final_Max,$nbArbitre['nbArbitre']);
				$vue->configurer('point_adversaire',$pointMax);
				
				$statut=$vue->statutFinalArbitre($final_Min,$pseudoMin['pseudo'],$final_Max,$pseudoMax['pseudo']);
				$vue->configurer('statut',"$statut");
				
				
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
				$tabvaleur=array(0=>$info['pseudo'],1=>$info['mail'],2=>$info['points'],3=>$info['nbTotalParties'],4=>$info['nbPartiesGagnees']);
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
		
