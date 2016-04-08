<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />

	<link rel="icon" href="../images/favicon.ico"/>

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
		<link rel="stylesheet" href="../css/style.css">   

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
		<div class="row">
			<nav class="navbar navbar-inverse">
			  	<div class="container-fluid">
				    	<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
					     	</button>
				    	</div>

			    		<div class="collapse navbar-collapse" id="myNavbar">      
						<ul class="nav navbar-nav">
							<li class="menu"><a href="../index.php">Accueil</a></li>
							<li class="menu"><a href="../regles.php">Règles</a></li>
							<li class="menu"><a href="../classement.php">Classement</a></li>
						</ul>

						<ul class="nav navbar-nav navbar-right">
							<li><a href="../inscription.php"><span class="glyphicon glyphicon-user"></span> S'inscrire</a></li>
		<?php 
			if (!isset($_SESSION['pseudo'])) {
				echo '		<li>
								<form class="form-inline" action="login.php" method="post">
							 		<div class="form-group">
										<input type="text" name="pseudo" class="form-control" id="pseudo" placeholder="Pseudo" required>
										<input type="password" name="pwd" class="form-control" id="password" placeholder="Mot de passe" required>
									</div>

									<div class="form-group">
										<button type="submit" name="connexion" class="btn"><span class="glyphicon glyphicon-log-in"></span> Se connecter</button>
									</div>
								</form>
							</li>
						</ul>
			   		</div>
				</div>
			</nav>
		</div>	
				';
			}
			else {
				echo '		<li><a href="../membre.php">Mon compte</a></li>
							<li><button  class="btn btn-danger" id="deco" type="submit" name="deconnexion" onclick="self.location.href=\'../deco.php\'"><span class="glyphicon glyphicon-log-out"></span> Se deconnecter</button></li>		  
						</ul>
			   		</div>
				</div>
			</nav>
		</div>	
				';
			}
		?>
		<!-- ============ -->

		<div class="container" id="corps">
			<div class='row' id='liste_forums'>
				<h1>
		<?php

		if ($_GET['num_erreur']==0){
			echo "
					Erreur : identification requise.
				";
		}

		if ($_GET['num_erreur']==1){
			echo "
					Erreur : problème de connexion serveur.
				";
		}

		if ($_GET['num_erreur']==2){
			echo "
					Erreur : partie pleine.
				";
		}
		?>
				</h1>	
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

</body>
</html>
