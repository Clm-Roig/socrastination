<?php
	try{
		$bdd = new PDO ('mysql:dbname=chacc;charset=utf8;host=infolimon.iutmontp.univ-montp2.fr','chacc','PetitChatDu34');}
		//new PDO('mysql:dbname='.$PARAM_nom_bd.';host='.$PARAM_hote, $PARAM_utilisateur, $PARAM_mot_passe);
					
	catch (PDOException $e){
		echo "problème PDO :". $e->getMessage();
      	 	exit();
	}
 ?>
