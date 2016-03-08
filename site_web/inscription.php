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

     <div class="row">
	<div class="container-fluid">

		 <?php include("elements_communs/header1.php");?>
			<ul class="nav navbar-nav">
							<li class="menu"><a href="index.php">Accueil</a></li>
							<li class="menu"><a href="presentation.php">Présentation</a></li>
							<li class="menu"><a href="regles.php">Règles</a></li>
							<li class="menu"><a href="classement.php">Classement</a></li>
					      </ul>

					      <ul class="nav navbar-nav navbar-right">
							<li class="active"><a href="inscription.php"><span class="glyphicon glyphicon-user"></span> S'inscrire</a></li>
		<?php include("elements_communs/header2.php");?>

		<div class="row">

			<div class="col-sm-2"></div>

			<div class="col-sm-8">

				 <form class="form-horizontal">
					<h1>Inscription</h1>

					  <div class="form-group">
						    <div class="col-sm-2"></div>
						    <label class="control-label col-sm-2" for="email">Pseudo</label>
						    <div class="col-sm-6">
						      <input type="text" class="form-control" id="pseudoinscr" placeholder="Entrer pseudo">
						    </div>
						    <div class="col-sm-2"></div>
					  </div>
					  <div class="form-group">
						    <div class="col-sm-2"></div>
						    <label class="control-label col-sm-2" for="email">Adresse email</label>
						    <div class="col-sm-6">
						      <input type="email" class="form-control" id="email" placeholder="Entrer email">
						    </div>
						    <div class="col-sm-2"></div>
					  </div>
					  <div class="form-group">
						    <div class="col-sm-2"></div>
						    <label class="control-label col-sm-2" for="pwd">Mot de passe</label>
						    <div class="col-sm-6">
						      <input type="password" class="form-control" id="pwd" placeholder="Entrer mot de passe">
						    </div>
						    <div class="col-sm-2"></div>
					  </div>
					  <div class="form-group">
						    <div class="col-sm-2"></div>
						    <label class="control-label col-sm-2" for="pwd">Confirmer mot de passe</label>
						    <div class="col-sm-6">
						      <input type="password" class="form-control" id="pwdconfirm" placeholder="Confirmer mot de passe">
						    </div>
						    <div class="col-sm-2"></div>
					  </div>
					
					  <div class="form-group">
						    <div class="col-sm-12">
						      <button type="submit" class="btn btn-default">Envoyer</button>
						    </div>
					  </div>
				</form>
					<?php
					$PARAM_hote='http://infolimon.iutmontp.univ-montp2.fr/my'; // le chemin vers le serveur
					$PARAM_nom_bd='chacc'; // le nom de votre base de données
					$PARAM_utilisateur='chacc'; // nom d'utilisateur pour se connecter
					$PARAM_mot_passe='PetitChatDu34'; // mot de passe de l'utilisateur pour se connecter
					
					$bdd= new PDO('mysql:host=http://infolimon.iutmontp.univ-montp2.fr/my;dbname=chacc;charset=utf8','chacc','PetitChatDu34');
					
					// REQUETE 
					$req = 'INSERT INTO Membre(pseudo, motDePasse, mail) VALUES(:pseudo, :motDePasse, :mail);';
					$stmt = $bdd->prepare($req);

					// PDO::BINDPARAM
					$stmt->bindParam(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
					$stmt->bindParam(':motDePasse', $_POST['motDePasse'], PDO::PARAM_STR);
					$stmt->bindParam(':mail', $_POST['mail'], PDO::PARAM_STR);
					$stmt->execute() or die (print_r($stmt->errorInfo(), true));
					?>
			</div>

			<div class="col-sm-2"></div>
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
