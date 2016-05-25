<?php	
	session_start();
	require("../config.php");

	$req = 	"DELETE FROM Role 
			WHERE idMembre={$_SESSION['idMembre']};
			DELETE FROM Chat_messages 
			WHERE message_id_membre={$_SESSION['idMembre']};
			";

	$res = $bdd->query($req);
	//Si ça ne marche pas on ne fait rien
	if($res==false) {
		echo "Erreur query : $req.";
		exit();
	}
	//Sinon on redirige vers la liste des forums
	else {
		header('Location: ../liste_forums.php');
	}
?>
