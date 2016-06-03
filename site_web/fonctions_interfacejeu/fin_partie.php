<?php 
	session_start();
	require('../config.php');
	//On regarde si le forum a bien été délesté de sa partie par quelqu'un 
	$req = 	"SELECT idPartie FROM Forums
			WHERE idForum={$_SESSION['id_forum']}
			;";
	$res = $bdd->query($req);
	if(!$res){
		echo "Erreur requete idPartie du forum : $req.";
		exit();
	}	
	$res_tab = $res->fetch();
	$idp = $res_tab['idPartie'];
	//Si l'id est différent du nôtre, c'est que soit il vaut 0 (quelqu'un l'a mis à 0 déjà), 
	//soit il a été mis à 0 puis quelqu'un a créé une partie par-dessus 
	//Auquel cas on en fait rien. Sinon, il faut le mettre à 0
	if($idp==$_SESSION['id_partie']){
		$req_f = 	"UPDATE Forums 
				SET idPartie=0
				WHERE idPartie={$_SESSION['id_partie']}
				;";
		$res_f = $bdd->query($req_f);
		if(!$res_f){
			echo "Erreur nettoyage Forum : $req_f.";
			exit();
		}	
	}
		
	$_SESSION['id_forum']=0;
	//Redirection vers les résultats
	header('Location: ../index.php?action=resultat');
?>
