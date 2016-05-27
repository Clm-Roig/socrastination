<?php
	session_start();
	require ("../config.php");
	
	$req = 	"SELECT COUNT(message_id) FROM Chat_messages
			WHERE id_partie={$_SESSION['id_partie']}
			";
	$res = $bdd->query($req);
	if ($res==false){
		echo "Erreur query : $req";
		exit();
	}
	$nb_mess=$res->fetchColumn();
	echo $nb_mess>=20; 
?>
