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
								<td><span id="nbj1"></span>/2 
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="10" name="assign">Rejoindre en tant que joueur</button>
									</form>  
								</td>
								<td><span id="nba1"></span>/10
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="11" name="assign">Rejoindre en tant qu'arbitre</button>
									</form>  
								</td>
							</tr>
						      	<tr>
								<td>2</td>
								<td><span id="nbj2">/2 
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="20" name="assign">Rejoindre en tant que joueur</button>
									</form>  
								</td>
								<td><span id="nba2">/10
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="21" name="assign">Rejoindre en tant qu'arbitre</button>
									</form>  
								</td>
							</tr>
							<tr>
								<td>3</td>
								<td><span id="nbj3">/2 
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="30" name="assign">Rejoindre en tant que joueur</button>
									</form>  
								</td>
								<td><span id="nbj3">/10
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="31" name="assign">Rejoindre en tant qu'arbitre</button>
									</form>  
								</td>
							</tr>
							<tr>
								<td>4</td>
								<td><span id="nbj4">/2 
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="40" name="assign">Rejoindre en tant que joueur</button>
									</form>  
								</td>
								<td><span id="nba4">/10
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="41" name="assign">Rejoindre en tant qu'arbitre</button>
									</form>  
								</td>
							</tr>
							<tr>
								<td>5</td>
								<td><span id="nbj5">/2 
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="50" name="assign">Rejoindre en tant que joueur</button>
									</form>  
								</td>
								<td><span id="nba5">/10
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="51" name="assign">Rejoindre en tant qu'arbitre</button>
									</form>  
								</td>
							</tr>
							<tr>
								<td>6</td>
								<td><span id="nbj6">/2 
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="60" name="assign">Rejoindre en tant que joueur</button>
									</form>  
								</td>
								<td><span id="nba6">/10
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="61" name="assign">Rejoindre en tant qu'arbitre</button>
									</form>  
								</td>
							</tr>
							<tr>
								<td>7</td>
								<td><span id="nbj7">/2 
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="70" name="assign">Rejoindre en tant que joueur</button>
									</form>  
								</td>
								<td><span id="nba7">/10
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="71" name="assign">Rejoindre en tant qu'arbitre</button>
									</form>  
								</td>
							</tr>
							<tr>
								<td>8</td>
								<td><span id="nbj8">/2 
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="80" name="assign">Rejoindre en tant que joueur</button>
									</form>  
								</td>
								<td><span id="nbj8">/10
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="81" name="assign">Rejoindre en tant qu'arbitre</button>
									</form>  
								</td>
							</tr>
							<tr>
								<td>9</td>
								<td><span id="nbj9">/2 
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="90" name="assign">Rejoindre en tant que joueur</button>
									</form>  
								</td>
								<td><span id="nba9">/10
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="91" name="assign">Rejoindre en tant qu'arbitre</button>
									</form>  
								</td>
							</tr>
						</tbody>
					</table> 

				<div class="alerte"></div>
	
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


	<!-- JS/AJAX pour actualiser le nombre de joueurs sur les forums -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
	<script>

	var timer=setInterval("actualiser()",1000);	//on lance la fonction toutes les secondes.

	function actualiser() {
		//Instanciation de l'objet pour passage à php
		var xhr = new XMLHttpRequest(); 

		//Traitement du résultat du php
		xhr.onreadystatechange = function() {
			if(xhr.readyState == 4) {		//serveur ok + réponse reçue
				var r=xhr.responseText;	//récupération du résultat
				rj=r.substring(0,1);
				ra=r.substring(2,3);
				document.getElementById('nbj1').innerHTML = rj;
				document.getElementById('nba1').innerHTML = ra;
			}			
		};

		//Passage avec GET
		xhr.open("GET","fonctions_listeforums/compteur_utilisateur.php?numforum=1"); 	//pour l'instant on teste que sur le forum 1
		xhr.send(null);	
	}

	</script>

</body>
</html>
