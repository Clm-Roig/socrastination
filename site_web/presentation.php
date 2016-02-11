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
	
	<title>Socrat' - Présentation</title>
   	
</head>

<body> 

     <div class="row">
	<div class="container-fluid">

		<?php include("header1.php");?>
			<ul class="nav navbar-nav">
							<li class="menu"><a href="index.php">Accueil</a></li>
							<li class="menu active"><a href="presentation.php">Présentation</a></li>
							<li class="menu"><a href="regles.php">Règles</a></li>
							<li class="menu"><a href="classement.php">Classement</a></li>
					      </ul>

					      <ul class="nav navbar-nav navbar-right">
							<li><a href="inscription.php"><span class="glyphicon glyphicon-user"></span> S'inscrire</a></li>
		<?php include("header2.php");?>
		
		<div class="row">
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
				  <!-- Indicators -->
				  <ol class="carousel-indicators">
				    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				    <li data-target="#myCarousel" data-slide-to="1"></li>
				    <li data-target="#myCarousel" data-slide-to="2"></li>
				    <li data-target="#myCarousel" data-slide-to="3"></li>
				  </ol>

				  <!-- Wrapper for slides -->
				  <div class="carousel-inner" role="listbox">
				    <div class="item active">
				      <img class="slide img-responsive" src="images/fresque.jpeg" alt="Chania">
				      <div class="carousel-caption">
					<a class="jouer" href="listetables.php"><div class="blocboutonplay">JOUER</div></a>
					<h3>Fresque</h3>
					<p>Test légende</p>
				      </div>
				    </div>

				    <div class="item">
				      <img class="slide img-responsive" src="images/socrate.jpg" alt="Chania">
				      <div class="carousel-caption">
					<h3>Socrate</h3>
					<p>Tout débuta ainsi...</p>
				      </div>
				    </div>

				    <div class="item">
				      <img class="slide img-responsive" src="images/socrate.jpg" alt="Flower">
				      <div class="carousel-caption">
					<h3>Socrate</h3>
					<p>Tout débuta ainsi...</p>
				      </div>
				    </div>

				    <div class="item">
				      <img class="slide img-responsive" src="images/socrate.jpg" alt="Flower">
				      <div class="carousel-caption">
					<h3>Socrate</h3>
					<p>Tout débuta ainsi...</p>
				      </div>
				    </div>
				  </div>

				  <!-- Left and right controls -->
				  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
				    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				    <span class="sr-only">Previous</span>
				  </a>
				  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
				    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				    <span class="sr-only">Next</span>
				  </a>
			</div>
		</div>

	<div class="row">
			<div id="section">
				<div class="col-sm-1"></div>

				<a href="regles.php">
					<div class="col-sm-2 blocL">
						<div class="row">
							<h2 class="cases">Règles</h2>
						</div>
							<img class="case img-responsive" src="images/règles.png" alt="Manuscrit papier">
					</div>
				</a>

					<div class="col-sm-5 blocC">
						<div class="row">
							<h2 class="cases">Présentation</h2>
						</div>
						<img class="case img-responsive" src="images/presentation.png" alt="Point d'interrogation">
					</div>

		  		<a href="classement.php">
					<div class="col-sm-2 blocR">
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
