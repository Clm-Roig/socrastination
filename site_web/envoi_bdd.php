<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />

	<link rel="icon" href="images/favicon.ico"/>

	<meta name="viewport" content="width=device-width, user-scalable=no">

	<!-- CSS -->	

		<!-- BOOTSTRAP -->

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<!-- PERSO -->
		<link rel="stylesheet" href="css/style.css">   

	<!-- === -->

	<!-- POLICES EN LIGNE -->
	<link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Orbitron:400,700' rel='stylesheet' type='text/css'>
	<!-- ================ -->
	
	<title>Socrat' - Inscription</title>
   	
</head>

<body> 

	<!-- DIV GLOBALE -->
	<div class="row" id="row_corps">
	<!-- ============ -->

		<!-- HEADER / NAV -->
		 <?php include("elements_communs/header1.php");?>
		<ul class="nav navbar-nav">
			<li class="menu"><a href="index.php">Accueil</a></li>
			<li class="menu"><a href="regles.php">Règles</a></li>
			<li class="menu"><a href="classement.php">Classement</a></li>
		</ul>

		<ul class="nav navbar-nav navbar-right">
			<li class="active"><a href="inscription.php"><span class="glyphicon glyphicon-user"></span> S'inscrire</a></li>
		<?php include("elements_communs/header2.php");?>
		<!-- ============ -->

		<div class="container" id="corps">

			<div class="row">
				<div id="section">

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
						}
						catch (PDOException $e) {
					  		  echo '<h2>Erreur enregistrement des données : ' . $e->getMessage().'</h2>';
						}
						echo '<h2>Inscription reussie, vous allez être redirigé sur la page d\'accueil automatiquement</h2>';
						echo '<h2>Sinon cliquez <a href="index.php">ici</a></h2>';     
						header("refresh:3;url=index.php");
					?>

				</div><!-- Ferme le div #section-->
			</div><!-- Ferme la row -->
		</div><!-- Ferme le bloc du milieu #corps -->

		<!-- FOOTER -->
		<div class="row">
			<div class="col-sm-12" id="footer">
					<p class="foot">Mentions légales 2016, IUT Montpellier-Sète - Projet AS : Dalle-Cort, Chac, Ferrer, Roig</p>
			</div>
		</div>
		<!-- ===== -->
		
	</div><!-- Ferme la row_corps" -->

	<script>
		function checkpass() {
			var val1 = document.getElementById("pwd");
			var val2 = document.getElementById("pwdconfirm");
		 
		 	 if(val1.value != val2.value){
				document.getElementById("alerte").innerHTML="<p class=\"text-danger\">Tapez deux mots de passe identiques, merci.</p>";
		  	}
		 	else{
		    		document.getElementById("alerte").innerHTML="<p class=\"text-success\">Mot de passe valide, bravo !</p>";
		  	}
		}
	</script>
	
</body>
</html>
