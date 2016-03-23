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
	
	<title>Socrat' - Règles</title>
   	
</head>

<body> 
    	<!-- DIV GLOBALE -->
	<div class="row" id="row_corps">
	<!-- ============ -->

			<!-- HEADER / NAV -->
			<?php include("elements_communs/header1.php");?>
			<ul class="nav navbar-nav">
				<li class="menu"><a href="index.php">Accueil</a></li>
				<li class="menu active"><a href="regles.php">Règles</a></li>
				<li class="menu"><a href="classement.php">Classement</a></li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li><a href="inscription.php"><span class="glyphicon glyphicon-user"></span> S'inscrire</a></li>
			<?php include("elements_communs/header2.php");?>
			<!-- ============ -->

		<div class="container" id="corps">

			<div class="row">
				<div id="section">

					<div class="col-sm-12">
						<div class="row">
							<h1>Règles</h1>
							<p class="text-center">Nul joueur n'est censé ignorer la loi. Vous veillerez particulièrement à respecter les règles suivantes :</p>
							<h2>Article 1</h2>
							<p class="text-center">Les dialogues se font dans le respect de l'autre.</p>
							<h2>Article 2</h2>
							<p class="text-center">Les insultes sont bannies. Eternellement.</p>
							<h2>Article 3</h2>
							<p class="text-center">Certaines discussions peuvent porter sur des sujets se rapportant à des domaines non-appropriés aux plus jeunes (sexualité, mort, religion...). En cela, le jeu est interdit au moins de 18 ans.</p>
						</div>		
					</div>

					<!-- BOUTON JOUER TEMPORAIRE -->
					<div class="row">
						<div class="col-sm-12">
							<h2><a href="liste_forums.php">JOUER</a></h2>
						</div>
					</div>
					<!-- ========================= -->

				</div><!-- Ferme la row  du milieu -->
			</div><!-- Ferme le bloc section du milieu -->

		</div><!-- Ferme le bloc du milieu (container #corps) -->

		<!-- FOOTER -->
		<div class="row">
			<div class="col-sm-12" id="footer">
					<p class="foot">Mentions légales 2016, IUT Montpellier-Sète - Projet AS : Dalle-Cort, Chac, Ferrer, Roig</p>
			</div>
		</div>
		<!-- ===== -->

	</div><!-- Ferme la row_corps" -->

</body>
</html>
