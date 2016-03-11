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
	
	<title>Socrat' - Classement</title>
   	
</head>

<body> 

  	<!-- DIV GLOBAUX -->
	<div class="row" id="row_corps">
		<div class="container" id="corps">
	<!-- ============ -->

			<!-- HEADER / NAV -->
			<?php include("elements_communs/header1.php");?>
			<ul class="nav navbar-nav">
				<li class="menu"><a href="index.php">Accueil</a></li>
				<li class="menu"><a href="presentation.php">Présentation</a></li>
				<li class="menu"><a href="regles.php">Règles</a></li>
				<li class="menu active"><a href="classement.php">Classement</a></li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li><a href="inscription.php"><span class="glyphicon glyphicon-user"></span> S'inscrire</a></li>
				<?php include("elements_communs/header2.php");?>
			<!-- ============ -->

			<!-- CORPS -->

			<div class="row">
				<div id="section">

					<div class="col-sm-1"></div><!-- Marge gauche => trouver une autre solution -->

					<a href="presentation.php">
						<div class="col-sm-2 blocL">
							<div class="row">
								<h2 class="cases">Présentation</h2>
							</div>
							<img class="case img-responsive" src="images/presentation.png" alt="Point d'interrogation">
						</div>
					</a>

					<div class="col-sm-5 blocC">
						<div class="row">
								
							<!-- PHP pour le Classement -->
							<?php
								// connexion 
								require("config.php");

						   		// INTERROGATION
						   		$classement = $bdd -> query("SELECT * FROM Membres ORDER BY nbDePoints DESC LIMIT 5");
						   		if ($classement==false) {
						       			echo "erreur query";
						       			exit();
						   		}
						   
						   		echo "	<h2 class=\"cases\">Classement</h2>";
						  		echo "	<ol>";

						   
						   		// TRAITEMENT
						  		while(($info=$classement -> fetchobject())!=null){ 
						       			echo "<li> {$info->pseudo} : {$info->nbDePoints} points</li>";
							   	}
						   		echo "</ol>";
						   	?>
							<!-- ============== -->
								
						</div>
					</div>

			  		<a href="regles.php">
						<div class="col-sm-2 blocR">
							<div class="row">
								<h2 class="cases">Règles</h2>
							</div>
								<img class="case img-responsive" src="images/règles.png" alt="Manuscrit papier">
						</div>
					</a>

					<div class="col-sm-1"></div><!-- Marge droite => trouver une autre solution -->

				</div>
			</div>

			<!-- FOOTER -->
			<div class="row">
					<div class="col-sm-12"><hr class="foot"></div>

					<footer>
						<p>Mentions légales 2016, IUT Montpellier-Sète - Projet AS : Dalle-Cort, Chac, Ferrer, Roig</p>
					</footer>
			</div>
			<!-- ===== -->

	  	</div>
	</div>

</body>
</html>
