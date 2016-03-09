					<?php
					$PARAM_hote='http://infolimon.iutmontp.univ-montp2.fr/'; // le chemin vers le serveur
					$PARAM_nom_bd='chacc'; // le nom de votre base de données
					$PARAM_port='3306';
					$PARAM_utilisateur='chacc'; // nom d'utilisateur pour se connecter
					$PARAM_mot_passe='PetitChatDu34'; // mot de passe de l'utilisateur pour se connecter
					try{
					$bdd = new PDO ('mysql:dbname=chacc;host=infolimon.iutmontp.univ-montp2.fr','chacc','PetitChatDu34');}
					  //new PDO('mysql:dbname='.$PARAM_nom_bd.';host='.$PARAM_hote, $PARAM_utilisateur, $PARAM_mot_passe);
					
catch (PDOException $e){
       echo "problème PDO :". $e->getMessage();
       exit();
   }
					try{
					// REQUETE 
					$req = 'INSERT INTO Membres(pseudo, motDePasse, mail, niveau, nbDePoints, nbPartiesGagnees, NbTotalParties) VALUES(:pseudo, :motDePasse, :mail, 1, 0, 0, 0);';
					$stmt = $bdd->prepare($req);

					// PDO::BINDPARAM
					$stmt->bindParam(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
					$stmt->bindParam(':motDePasse', $_POST['motDePasse'], PDO::PARAM_STR);
					$stmt->bindParam(':mail', $_POST['mail'], PDO::PARAM_STR);
					$stmt->execute() or die (print_r($stmt->errorInfo(), true));
					} catch (PDOException $e) {
    echo 'Erreur enregistrement des donnees : ' . $e->getMessage();
}
echo 'Inscription reussis, vous allez etre redirige sur la page inscription automatiquement';
echo 'Sinon clique <a href="inscription.php">ici</a>';
      
header("refresh:3;url=inscription.php");
 
					?>