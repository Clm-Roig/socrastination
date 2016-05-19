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
	
	<title>Socrastination - Liste des Forums</title>
   	
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
								<th>Sujet</th>
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
								<td><span id="suj1"></span></td>
								<td><span id="nbj1"></span>/2 
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="10" name="assign">Rejoindre</button>
									</form>  
								</td>
								<td><span id="nba1"></span>/10
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="11" name="assign">Rejoindre</button>
									</form>  
								</td>
							</tr>
						      	<tr>
								<td>2</td>
								<td><span id="suj2"></span></td>
								<td><span id="nbj2"></span>/2 
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="20" name="assign">Rejoindre</button>
									</form>  
								</td>
								<td><span id="nba2"></span>/10
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="21" name="assign">Rejoindre</button>
									</form>  
								</td>
							</tr>
							<tr>
								<td>3</td>
								<td><span id="suj3"></span></td>
								<td><span id="nbj3"></span>/2 
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="30" name="assign">Rejoindre</button>
									</form>  
								</td>
								<td><span id="nba3"></span>/10
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="31" name="assign">Rejoindre</button>
									</form>  
								</td>
							</tr>
							<tr>
								<td>4</td>
								<td><span id="suj4"></span></td>
								<td><span id="nbj4"></span>/2 
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="40" name="assign">Rejoindre</button>
									</form>  
								</td>
								<td><span id="nba4"></span>/10
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="41" name="assign">Rejoindre</button>
									</form>  
								</td>
							</tr>
							<tr>
								<td>5</td>
								<td><span id="suj5"></span></td>
								<td><span id="nbj5"></span>/2 
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="50" name="assign">Rejoindre</button>
									</form>  
								</td>
								<td><span id="nba5"></span>/10
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="51" name="assign">Rejoindre</button>
									</form>  
								</td>
							</tr>
							<tr>
								<td>6</td>
								<td><span id="suj6"></span></td>
								<td><span id="nbj6"></span>/2 
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="60" name="assign">Rejoindre</button>
									</form>  
								</td>
								<td><span id="nba6"></span>/10
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="61" name="assign">Rejoindre</button>
									</form>  
								</td>
							</tr>
							<tr>
								<td>7</td>
								<td><span id="suj7"></span></td>
								<td><span id="nbj7"></span>/2 
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="70" name="assign">Rejoindre</button>
									</form>  
								</td>
								<td><span id="nba7"></span>/10
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="71" name="assign">Rejoindre</button>
									</form>  
								</td>
							</tr>
							<tr>
								<td>8</td>
								<td><span id="suj8"></span></td>
								<td><span id="nbj8"></span>/2 
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="80" name="assign">Rejoindre</button>
									</form>  
								</td>
								<td><span id="nba8"></span>/10
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="81" name="assign">Rejoindre</button>
									</form>  
								</td>
							</tr>
							<tr>
								<td>9</td>
								<td><span id="suj9"></span></td>
								<td><span id="nbj9"></span>/2 
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="90" name="assign">Rejoindre</button>
									</form>  
								</td>
								<td><span id="nba9"></span>/10
									<form class="forum" method="post" action="fonctions_listeforums/assignation_forum.php">               
										<button class="btn btn-default" value="91" name="assign">Rejoindre</button>
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
					<p class="foot">Mentions légales 2016, IUT Montpellier-Sète - Projet AS : <a href="http://www.dalle-cort.fr/" target="_blank">Dalle-Cort</a>, Chac, <a href="http://www.maxime.ferrer-ferrer.fr/" targ="_blank">Ferrer</a>, <a href="http://infolimon.iutmontp.univ-montp2.fr/~roigc/" target="_blank">Roig</a></p>
			</div>
		</div>
		<!-- ===== -->

	</div><!-- Ferme la row_corps" -->


	<!-- JS/AJAX pour actualiser le nombre de joueurs sur les forums -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
	<script>

	//on lance la fonction toutes les secondes pour tous les forums
	var timer=setInterval("actualiser(1)",1000);
	var timer=setInterval("actualiser(2)",1000);	
	var timer=setInterval("actualiser(3)",1000);
	var timer=setInterval("actualiser(4)",1000);	
	var timer=setInterval("actualiser(5)",1000);
	var timer=setInterval("actualiser(6)",1000);	
	var timer=setInterval("actualiser(7)",1000);
	var timer=setInterval("actualiser(8)",1000);	
	var timer=setInterval("actualiser(9)",1000);	

	function actualiser(numero) {
		//Instanciation de l'objet pour passage à php
		var xhr = new XMLHttpRequest(); 

		//Traitement du résultat du php
		xhr.onreadystatechange = function() {
			if(xhr.readyState == 4) {		//serveur ok + réponse reçue
				var r=xhr.responseText;	//récupération du résultat
				var rj=r.substring(0,1);
				var ra=r.substring(2,3);
				var suj=r.substring(4);
				document.getElementById('nbj'+numero).innerHTML = rj;
				document.getElementById('nba'+numero).innerHTML = ra;
				document.getElementById('suj'+numero).innerHTML = suj;
			}			
		};
		//Passage avec GET
		xhr.open("GET","fonctions_listeforums/actualisation_forums.php?numforum="+numero); 
		xhr.send(null);	
	}

	</script>

</body>
</html>
