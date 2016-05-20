<?php
	session_start();
	require ("../config.php");

	//REQUETE idj1 (id le plus petit)
	$req_j1 =	"SELECT M.idMembre,pseudo FROM Membres M
				JOIN Role R ON R.idMembre=M.idMembre
				WHERE R.idPartie={$_SESSION['id_partie']}
				AND R.role=0
				AND R.idMembre= 
					(SELECT MIN(R2.idMembre) FROM Role R2
					WHERE R2.idPartie={$_SESSION['id_partie']}
					AND R2.role=0
					)
				;";

	$res_j1 = $bdd->query($req_j1);
	if($res_j1 == false) {
		echo "Erreur query : $req_j1.";
	}

	$tab_j1 = $res_j1->fetch();
	if ($tab_j1['pseudo']==null) $pseudoj1 ="En attente d'un joueur...";
	else $pseudoj1  = $tab_j1['pseudo'];

	if ($tab_j1['idMembre']==null) $idj1 ="-1";
	else $idj1  = $tab_j1['idMembre'];

	//REQUETE idj2 (id le plus grand)
	$req_j2 =	"SELECT M.idMembre,pseudo FROM Membres M
				JOIN Role R ON R.idMembre=M.idMembre
				WHERE R.idPartie={$_SESSION['id_partie']}
				AND R.role=0
				AND M.idMembre= 
					(SELECT MAX(R2.idMembre) FROM Role R2
					WHERE R2.idPartie={$_SESSION['id_partie']}
					AND R2.role=0
					)
				;";

	$res_j2 = $bdd -> query($req_j2);
	if($res_j2 == false) {
		echo "Erreur query : $req_j2.";
	}
	$tab_j2 = $res_j2 -> fetch();

	if ($tab_j2['pseudo']==null || $tab_j2['pseudo']==$_SESSION['pseudo']) $pseudoj2 ="En attente d'un joueur...";
	else $pseudoj2  = $tab_j2['pseudo'];

	if ($tab_j2['idMembre']==null) $idj2 ="-1";
	else $idj2  = $tab_j2['idMembre'];

	$tab = array(
				"idj1"=>$idj1,
				"idj2"=>$idj2,
				"pseudoj1"=>$pseudoj1,
				"pseudoj2"=>$pseudoj2
				);

	echo json_encode($tab);	
?>
