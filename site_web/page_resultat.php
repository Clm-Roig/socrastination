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
		<link rel="stylesheet" href="css/style_resultat.css">   

	<!-- === -->

	<!-- POLICES EN LIGNE -->
	<link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Orbitron:400,700' rel='stylesheet' type='text/css'>
	<!-- ================ -->
	
	<title>Socrat' - Liste des Forums</title>
   	
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
			<li><a href="inscription.php"><span class="glyphicon glyphicon-user"></span> S'inscrire</a></li>
		<?php 
			if (!isset($_SESSION['pseudo'])) {
				include("elements_communs/header2.php");
				}
		else {
			include("elements_communs/header3.php");
			}
			?>
		<!-- ============ -->

		<div class="container" id="corps">
			<div class='row' id='liste_forums'>
				<div class="col-sm-12">
					<h1>Partie n°{num_partie} contre {pseudo_adversaire}</h1>
					<div class="row">
						<div class="col-sm-6 text-center bloc_score">	
							<h3>{pseudo_joueur}</h3>
							<p class="resultat"><span class="glyphicon glyphicon-thumbs-up vote_up"></span> {nb_votes_plus_joueur}</p>
							<p class="resultat"><span class="glyphicon glyphicon-thumbs-down vote_down"></span> {nb_votes_moins_joueur}</p>
							<h3>Total : {score_joueur}</h3>
						</div>
						<div class="col-sm-6 text-center bloc_score">	
							<h3>{pseudo_advesiare}</h3>
							<p class="resultat"><span class="glyphicon glyphicon-thumbs-up vote_up"></span> {nb_votes_plus_adversaire}</p>
							<p class="resultat"><span class="glyphicon glyphicon-thumbs-down vote_down"></span> {nb_votes_moins_adversaire}</p>
							<h3>Total : {score_adversaire}</h3>
						</div>
					</div>
					<h2>Vous avez {statut} !</h2>
				</div>	
			</div>
		</div><!-- Ferme le bloc du milieu --> 

		<!-- FOOTER -->
		<div class="row">
			<div class="col-sm-12" id="footer">
					<p class="foot">Mentions légales 2016, IUT Montpellier-Sète - Projet AS : Dalle-Cort, Chac, Ferrer, Roig</p>
			</div>
		</div>
		<!-- ===== -->

	</div><!-- Ferme la row_corps" -->
</body></html>

