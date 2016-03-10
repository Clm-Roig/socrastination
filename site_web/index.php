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
	
	<title>Socrat' - Accueil</title>
   	
</head>

<body> 
    
	<div class="row">
	  <div class="container-fluid">

		<?php include("elements_communs/header1.php");?>
			<ul class="nav navbar-nav">
				<li class="menu active"><a href="index.php">Accueil</a></li>
				<li class="menu"><a href="presentation.php">Présentation</a></li>
				<li class="menu"><a href="regles.php">Règles</a></li>
				<li class="menu"><a href="classement.php">Classement</a></li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li><a href="inscription.php"><span class="glyphicon glyphicon-user"></span> S'inscrire</a></li>
		<?php include("elements_communs/header2.php");?>

		<?php include("elements_communs/carousel.php");?>

		<div class="row">
			<div id="section">
				<div class="col-sm-1"></div>

				<a href="presentation.php">
					<div class="col-sm-3 blocL">
						<div class="row">
							<h2 class="cases">Présentation</h2>
						</div>
						<img class="case img-responsive" src="images/presentation.png" alt="Point d'interrogation">
					</div>
				</a>

		  		<a href="regles.php">
					<div class="col-sm-3 blocC">
						<div class="row">
							<h2 class="cases">Règles</h2>
						</div>
							<img class="case img-responsive" src="images/règles.png" alt="Manuscrit papier">
					</div>
				</a>

		  		<a href="classement.php">
					<div class="col-sm-3 blocR">
						<div class="row">
							<h2 class="cases">Classement</h2>
						</div>
							<img class="case img-responsive" src="images/classement.png" alt="Podium">
					</div>
				</a>
				
				<div class="col-sm-1"></div>
			</div>
		</div>

		<div class="row">
				<div class="col-sm-12"><hr class="foot"></div>

				<footer>
					<p>Mentions légales 2016, IUT Montpellier-Sète - Projet AS : Dalle-Cort, Chac, Ferrer, Roig</p>
				</footer>
		</div>

	  </div>
	</div>
</body>
</html>
