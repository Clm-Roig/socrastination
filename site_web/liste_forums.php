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

			<div class="row" id="liste_forums">

					<table class="table table-hover table-responsive">	
						<thead>
							<tr>
								<th>N° Forum</th>
								<th>Nombre de joueurs</th>
								<th>Nombre d'arbitres</th>
							</tr>
						</thead>

						<tbody>	
							<!-- Pour le post des "value" :	
								- Premier chiffre => numéro du forum
								- Deuxième chiffre =>  joueur (0) ou arbitre (1) 

							 	Ex : 21, sur le forum 2, je veux entrer en tant qu'arbitre
							-->
							<tr>
								<td>1</td>
								<td>0/2 
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="10" name="assign">Rejoindre en tant que joueur</button>
									</form>  
								</td>
								<td>0/10
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="11" name="assign">Rejoindre en tant qu'arbitre</button>
									</form>  
								</td>
							</tr>
						      	<tr>
								<td>2</td>
								<td>0/2 
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="20" name="assign">Rejoindre en tant que joueur</button>
									</form>  
								</td>
								<td>0/10
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="21" name="assign">Rejoindre en tant qu'arbitre</button>
									</form>  
								</td>
							</tr>
							<tr>
								<td>3</td>
								<td>0/2 
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="30" name="assign">Rejoindre en tant que joueur</button>
									</form>  
								</td>
								<td>0/10
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="31" name="assign">Rejoindre en tant qu'arbitre</button>
									</form>  
								</td>
							</tr>
							<tr>
								<td>4</td>
								<td>0/2 
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="40" name="assign">Rejoindre en tant que joueur</button>
									</form>  
								</td>
								<td>0/10
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="41" name="assign">Rejoindre en tant qu'arbitre</button>
									</form>  
								</td>
							</tr>
							<tr>
								<td>5</td>
								<td>0/2 
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="50" name="assign">Rejoindre en tant que joueur</button>
									</form>  
								</td>
								<td>0/10
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="51" name="assign">Rejoindre en tant qu'arbitre</button>
									</form>  
								</td>
							</tr>
							<tr>
								<td>6</td>
								<td>0/2 
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="60" name="assign">Rejoindre en tant que joueur</button>
									</form>  
								</td>
								<td>0/10
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="61" name="assign">Rejoindre en tant qu'arbitre</button>
									</form>  
								</td>
							</tr>
							<tr>
								<td>7</td>
								<td>0/2 
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="70" name="assign">Rejoindre en tant que joueur</button>
									</form>  
								</td>
								<td>0/10
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="71" name="assign">Rejoindre en tant qu'arbitre</button>
									</form>  
								</td>
							</tr>
							<tr>
								<td>8</td>
								<td>0/2 
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="80" name="assign">Rejoindre en tant que joueur</button>
									</form>  
								</td>
								<td>0/10
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="81" name="assign">Rejoindre en tant qu'arbitre</button>
									</form>  
								</td>
							</tr>
							<tr>
								<td>9</td>
								<td>0/2 
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="90" name="assign">Rejoindre en tant que joueur</button>
									</form>  
								</td>
								<td>0/10
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="91" name="assign">Rejoindre en tant qu'arbitre</button>
									</form>  
								</td>
							</tr>
						</tbody>
					</table> 
	
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
