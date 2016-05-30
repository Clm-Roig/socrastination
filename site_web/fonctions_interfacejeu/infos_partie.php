<?php
	session_start();
	require ("../config.php");

	//===============REQUETE idj adverse============================
	$req =	"SELECT M.idMembre,pseudo FROM Membres M
			JOIN Role R ON R.idMembre=M.idMembre
			WHERE R.idPartie={$_SESSION['id_partie']}
			AND R.role=0
			AND R.idMembre!={$_SESSION['idMembre']}
			;";

	$res = $bdd -> query($req);
	if($res == false) {
		echo "Erreur query : $req.";
		exit();
	}
	$tab_j2 = $res -> fetch();

	//Si pseudo vide, pseudo "en attente d'un joueur"
	if ($tab_j2['pseudo']==null) $pseudoj2 ="En attente d'un joueur...";
	else $pseudoj2  = $tab_j2['pseudo'];

	//Si id vide, id = -1
	if ($tab_j2['idMembre']==null) $idj2 ="-1";
	else $idj2  = $tab_j2['idMembre'];

	//===============REQUETE SUJET DE LA PARTIE===================
	$req_sujet=	"SELECT nomSujet FROM Sujets S
				JOIN Parties P ON P.idSujet=S.idSujet
				WHERE idPartie={$_SESSION['id_partie']}
				;";
	$res_sujet = $bdd -> query($req_sujet);
	if($res_sujet == false) {
		echo "Erreur query : $req_sujet.";
	}	

	$tab_sujet = $res_sujet -> fetch();
	if($tab_sujet['nomSujet']==null) $sujet="Sujet non-choisi.";
	else $sujet=$tab_sujet['nomSujet'];

	//Tableau pour l'envoi
	$tab = array(
				"idj1"=>$_SESSION['idMembre'],
				"idj2"=>$idj2,
				"pseudoj1"=>$_SESSION['pseudo'],
				"pseudoj2"=>$pseudoj2,
				"sujet"=>$sujet,
				);

	echo json_encode($tab);	
?>
