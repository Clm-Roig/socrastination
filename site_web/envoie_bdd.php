					<?php
					$PARAM_hote='http://infolimon.iutmontp.univ-montp2.fr/my'; // le chemin vers le serveur
					$PARAM_nom_bd='chacc'; // le nom de votre base de données
					$PARAM_utilisateur='chacc'; // nom d'utilisateur pour se connecter
					$PARAM_mot_passe='PetitChatDu34'; // mot de passe de l'utilisateur pour se connecter
					try{
					$bdd = new PDO('mysql:host='.$PARAM_hote.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
					} catch (PDOException $e) {
					echo 'Erreur de connexion : ' . $e->getMessage();
					}
					// REQUETE 
					$req = 'INSERT INTO Membres(pseudo, motDePasse, mail) VALUES(:pseudo, :motDePasse, :mail);';
					$stmt = $bdd->prepare($req);

					// PDO::BINDPARAM
					$stmt->bindParam(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
					$stmt->bindParam(':motDePasse', $_POST['motDePasse'], PDO::PARAM_STR);
					$stmt->bindParam(':mail', $_POST['mail'], PDO::PARAM_STR);
					$stmt->execute() or die (print_r($stmt->errorInfo(), true));
					?>