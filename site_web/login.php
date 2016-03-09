<?php


	require("config.php");


    if (empty($_POST['pseudo']) || empty($_POST['pwd']) ) //Oublie d'un champ
    { echo "un champ est vide";
	exit();
    }
    else //On check le mot de passe
    {
        $query=$bdd->prepare('SELECT pseudo, motDePasse FROM Membres WHERE pseudo = :pseudo');
        $query->bindValue(':pseudo',$_POST['pseudo'], PDO::PARAM_STR);
        $query->execute();
        $data=$query->fetch();
	if ($data['motDePasse'] == $_POST['pwd']) // Acces OK !
	{

	$_SESSION['pseudo'] = $data['pseudo'];
		
	header('Location: membre.php'); 
	}
	else // Acces pas OK !
	{
	  echo "erreur inconnu";
	}
    $query->CloseCursor();
    }
   
	

?>