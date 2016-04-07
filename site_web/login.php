<?php
	session_start();
	require("config.php");

	if (empty($_POST['pseudo']) || empty($_POST['pwd']) ) { //Oubli d'un champ
		echo "un champ est vide";
		exit();
	}
	else { //On check le mot de passe
		$query=$bdd->prepare('SELECT idMembre,pseudo, motDePasse FROM Membres WHERE pseudo = :pseudo');
		$query->bindValue(':pseudo',$_POST['pseudo'], PDO::PARAM_STR);
		if($query->execute()){
			$data=$query->fetch();
			if ($data['motDePasse'] == $_POST['pwd']) { // Accès OK 
				$_SESSION['pseudo'] = $data['pseudo'];
				$_SESSION['idMembre'] = $data['idMembre'];
				header('Location: membre.php'); 
			}
			else { // Accès pas OK !
				echo "Erreur login, mot de passe ou pseudo incorect !";
			}
			$query->CloseCursor();
		}
		else { 
			header('Location: erreur_paslog.php?num_erreur=1');
		}
	}

?>
