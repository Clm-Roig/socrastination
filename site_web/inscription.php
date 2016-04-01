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
	
	<title>Socrat' - Inscription</title>
   	
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
			<li class="active"><a href="inscription.php"><span class="glyphicon glyphicon-user"></span> S'inscrire</a></li>
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

			<div class="row">
				<div id="section">

					<div class="col-sm-2"></div><!-- Marge gauche => trouver une autre solution -->

					<div class="col-sm-8">
						 <form class="form-horizontal" role="form" action="envoi_bdd.php" method="post">
							<h1>Inscription</h1>

							<div class="row">
								<div class="form-group">
									<label class="control-label col-sm-3" for="pseudo">Pseudo</label>
								   	<div class="col-sm-9">
								      		<input type="text" required="required" class="form-control" name="pseudo" id="pseudoinscr" placeholder="Entrer pseudo" onkeyup="check_pseudo();">
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="form-group">								
									<label class="control-label col-sm-3" for="email">Adresse email</label>
									<div class="col-sm-9">
										<input type="email" required="required" class="form-control" name="mail" id="email" placeholder="Entrer email">
									</div>
								</div>
							</div>

							<div class="row">
						  		<div class="form-group">
							    		<label class="control-label col-sm-3" for="pwd">Mot de passe</label>
							   		<div class="col-sm-9">
								      		<input type="password" required="required" class="form-control" name="motDePasse" id="pwd" placeholder="Entrer mot de passe">
								    	</div>
								</div>
							</div>

							<div class="row">
							 	<div class="form-group">
								    
									<label class="control-label col-sm-3" for="pwd">Confirmer mot de passe</label>
								    	<div class="col-sm-9">
								      		<input type="password" required="required" class="form-control" id="pwdconfirm" placeholder="Confirmer mot de passe" onkeyup="checkpass();">
								    	</div>
			
							  	</div>
							</div>

							<div class="row">
								<div class="form-group">
									<div id="alerte" class="col-sm-12"></div>
								</div>
							</div>

							<div class="row">
								<div class="form-group">
									<div id="alerte2" class="col-sm-12"></div>
								</div>
							</div>
							
							<div class="row">
							  	<div class="form-group">
									<div class="col-sm-12">
								      		<button type="submit" class="btn btn-default" id="bouton_envoi">Envoyer</button>
								    	</div>
							  	</div>
							</div>

						</form>

					</div><!-- Ferme le col-sm-8 du formulaire -->

					<div class="col-sm-2"></div><!-- Marge droite => trouver une autre solution -->

				</div><!-- Ferme la row du formulaire -->

			</div><!-- Ferme le bloc du milieu -->
		</div><!-- Ferme le div #section -->

		<!-- FOOTER -->
		<div class="row">
			<div class="col-sm-12" id="footer">
					<p class="foot">Mentions légales 2016, IUT Montpellier-Sète - Projet AS : Dalle-Cort, Chac, Ferrer, Roig</p>
			</div>
		</div>
		<!-- ===== -->
		
	</div><!-- Ferme la row_corps" -->

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>

	<script>
		function checkpass() {
			var val1 = document.getElementById("pwd");
			var val2 = document.getElementById("pwdconfirm");
		 
		 	 if(val1.value != val2.value){
				document.getElementById("alerte").innerHTML="<p class=\"text-danger\">Tapez deux mots de passe identiques, merci.</p>";
				document.getElementById("bouton_envoi").disabled=true;
		  	}
		 	else{
		    		document.getElementById("alerte").innerHTML="<p class=\"text-success\">Les mots de passe concordent !</p>";
				document.getElementById("bouton_envoi").disabled=false;
		  	}
		}

		function check_pseudo() {
			
			var val1 = document.getElementById("pseudoinscr");
			//Passage de la valeur en AJAX pour php
			//instanciation de l'objet XMLHHTP
			var xhr = new XMLHttpRequest();
		
			//Attente du résultat du php
			xhr.onreadystatechange = function(){
				if(xhr.readyState  == 4) {		//serveur ok + réponse reçue
					if(xhr.responseText==1){
						document.getElementById('alerte2').innerHTML = "<p class=\"text-danger\">Pseudo déjà utilisé, veuillez en choisir un autre.</p>"
					}
					else{
						document.getElementById('alerte2').innerHTML = "<p class=\"text-success\">Pseudo valide !</p>"; 
					}
				}
			};

			//Passage par url
			xhr.open("GET","/fonctions_inscription/check_pseudo.php?pseudoinscr="+val1.value+"", true);
			xhr.send(null);		

		}
	</script>
	
</body>
</html>
