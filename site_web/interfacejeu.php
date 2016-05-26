<?php
	session_start();
	require ("config.php");

	if (!isset($_SESSION['pseudo'])) {
		header('Location: liste_forums.php');
	}

	//REQUETE MON PSEUDO
	$req_pseudo_moi =	"SELECT pseudo FROM Membres 
						WHERE idMembre=".$_SESSION['idMembre'].
						";";

	$res_pseudo_moi = $bdd -> query($req_pseudo_moi);
	if($res_pseudo_moi == false) {
		echo "Erreur query : $req_pseudo_moi.";
	}
	$tab_pseudo_moi = $res_pseudo_moi -> fetch();
	$pseudo_moi = $tab_pseudo_moi['pseudo'];

	//REQUETE PSEUDO ADVERSAIRE
	$req_pseudo_adv =	"SELECT M.pseudo FROM Membres M
						JOIN Role R ON R.idMembre=M.idMembre
						WHERE R.idPartie={$_SESSION['id_partie']} 
						AND M.idMembre!={$_SESSION['idMembre']} 	
						AND R.role=0							
						;";

	$res_pseudo_adv = $bdd -> query($req_pseudo_adv);
	if ($res_pseudo_adv == false) {
		echo "Erreur query : $req_pseudo_adv.";
	}
	$tab_pseudo_adv = $res_pseudo_adv -> fetch();
	if ($tab_pseudo_adv['pseudo']==null) $pseudo_adv="En attente d'un joueur...";
	else $pseudo_adv = $tab_pseudo_adv['pseudo'];

	//Chargement de la vue
	$gabarit=file_get_contents("vues/v_interfacejeu.html");
	$gabarit=str_replace("{pseudo_moi}", $pseudo_moi, $gabarit);
	$gabarit=str_replace("{pseudo_adv}", $pseudo_adv, $gabarit);
	echo $gabarit;
?>

