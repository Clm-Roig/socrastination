<?php 
	session_start();
	require ("config.php");

	//REQUETE idj1 (id le plus petit)
	$req_pseudoj1 =	"SELECT pseudo FROM Membres M
					JOIN Role R ON R.idMembre=M.idMembre
					WHERE R.idPartie={$_SESSION['id_partie']}
					AND R.role=0
					AND M.idMembre= 
						(SELECT MIN(idMembre) FROM Membres M2
						JOIN Role R2 ON R2.idMembre=M.idMembre
						WHERE R2.idPartie={$_SESSION['id_partie']}
						)
					;";

	$res_pseudoj1 = $bdd ->query($req_pseudoj1);
	if($res_pseudoj1 == false) {
		echo "Erreur query : $req_pseudoj1.";
	}
	$tab_pseudoj1 = $res_pseudoj1->fetch();
	$pseudoj1 = $tab_pseudoj1['pseudo'];

	//REQUETE idj2 (id le plus grand)
	$req_pseudoj2 =	"SELECT pseudo FROM Membres M
					JOIN Role R ON R.idMembre=M.idMembre
					WHERE R.idPartie={$_SESSION['id_partie']}
					AND R.role=0
					AND M.idMembre= 
						(SELECT MAX(idMembre) FROM Membres M2
						JOIN Role R2 ON R2.idMembre=M.idMembre
						WHERE R2.idPartie={$_SESSION['id_partie']}
						)
					;";

	$res_pseudoj2 = $bdd -> query($req_pseudoj2);
	if($res_pseudoj2 == false) {
		echo "Erreur query : $req_pseudoj2.";
	}
	$tab_pseudoj2 = $res_pseudoj2 -> fetch();
	$pseudoj2 = $tab_pseudoj2['pseudo'];

	//Chargement de la vue + remplacements
	$vue=file_get_contents("vues/v_interfacearbitre.html");
	echo $vue;
?>
