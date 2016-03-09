					<?php

					require("config.php");
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