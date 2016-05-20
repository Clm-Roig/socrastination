<?php
	session_start();
	if (!isset($_SESSION['pseudo'])) {
		header ('Location: index.php');
		exit();
	}
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
	
	<title>Socrastination - Espace Membre</title>
   	
</head>

<body> 
    	<!-- DIV GLOBALE -->
	<div class="row" id="row_corps">
	<!-- ============ -->
			
		<!-- HEADER / NAV -->
		<div class="row">
			<nav class="navbar navbar-inverse">
				<div class="container-fluid">
					<div id="myNavbar">
					      
						<ul class="nav navbar-nav">
							<li class="menu active"><a href="index.php">Accueil</a></li>
							<li class="menu"><a href="index.php?action=regles">Règles</a></li>
							<li class="menu"><a href="index.php?action=classement">Classement</a></li>
						</ul>

						<ul class="nav navbar-nav navbar-right">
						<li><a href="index.php?action=inscription"><span class="glyphicon glyphicon-user"></span> S'inscrire</a></li>

					<?php 
						if (!isset($_SESSION['pseudo'])) {
							include("elements_communs/header2.php");
						}
						else {
							include("elements_communs/header3.php");
							}
						?>
		<!-- ========= -->

		<div class="container" id="corps">
			<div class="row">
				<div id="section">
				
					<?php
						// connexion BDD
						require("config.php");
						   
						// INTERROGATION
						$query = $bdd->prepare('SELECT * FROM Membres WHERE pseudo = :pseudo');
						$query->bindValue(':pseudo',$_SESSION['pseudo'], PDO::PARAM_STR);
						$query->execute();
						$info=$query->fetchobject();
						if ($query==false) {
							echo "erreur query";
							exit();
						} 

					   	// TRAITEMENT
						echo "
							<ul class=\"membre\">
								<li class=\"membre\"><h2 class=\"membre souligne\">Pseudo :</h2><h2 class=\"membre\">{$info->pseudo}</h2></li>
								<li class=\"membre\"><h2 class=\"membre souligne\">Mail :</h2><h2 class=\"membre\">{$info->mail}</h2></li>
								<li class=\"membre\"><h2 class=\"membre souligne\">Niveau :</h2><h2 class=\"membre\">{$info->niveau}</h2></li>
								<li class=\"membre\"><h2 class=\"membre souligne\">Points :</h2><h2 class=\"membre\">{$info->nbDePoints}</h2></li>
								<li class=\"membre\"><h2 class=\"membre souligne\">Total parties :</h2><h2 class=\"membre\">{$info->NbTotalParties}</h2></li>
								<li class=\"membre\"><h2 class=\"membre souligne\">Parties gagnees :</h2><h2 class=\"membre\">{$info->nbPartiesGagnees}</h2></li>
							</ul>					
						";	
					?>

					</div><!-- Ferme la row  du milieu -->
				</div><!-- Ferme le bloc section du milieu -->
			</div><!-- Ferme le bloc du milieu (container #corps) -->

		<!-- FOOTER -->
		<div class="row">
			<div class="col-sm-12" id="footer">
					<p class="foot">Mentions légales 2016, IUT Montpellier-Sète - Projet AS : <a href="http://www.dalle-cort.fr/" target="_blank">Dalle-Cort</a>, <a href="http://infolimon.iutmontp.univ-montp2.fr/~chacc">Chac</a>, <a href="http://www.maxime.ferrer-ferrer.fr/" target="_blank">Ferrer</a>, <a href="http://infolimon.iutmontp.univ-montp2.fr/~roigc/" target="_blank">Roig</a></p>
			</div>
		</div>
		<!-- ===== -->

		</div><!-- Ferme la row_corps" -->

</body>
</html>

