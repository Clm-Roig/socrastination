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
	
	<title>Socrat' - Jeu</title>
   	
</head>

<body> 

	<?php require("fonctions_interfacejeu/enjeu.php");?>

	<!-- DIV GLOBALE -->
	<div class="row" id="row_corps">
	<!-- ============ -->

		<!-- HEADER / NAV -->
		<div class="row">
			 <nav class="navbar navbar-inverse">
				<div class="container-fluid">
				    	<div class="navbar-header">
						<h2 class="haut_chat">EN JEU<h2>
					</div>
				</div>
			</nav>
		</div>
		<!-- ========= -->

		<div class="container" id="corps">
			<div class="row">

				<div id="section">

	<!-- INTERFACE DE CHAT -->
			
					<div class="col-sm-12">
						<div class="row">
	
					<!-- Panneau affichage de la conversation -->
							<div id="conversation">
								<div class ="message_adv">
									<p class="arg">Mon argument est le suivant. En effet, on peut considérer le citoyen comme indépendant et croyant en sont propre esprit conceptuel. Cependant, cela ne le mènera qu'à sa perte.</p>
								</div>
								<div class="message_moi">
									<p class="arg">Test conversation Test conversation Test conversation Test conversation Test conversation Test conversation Test conversation</p>
								</div>
								<div class ="message_adv">
									<p class="arg">Test conversation Test conversation Test conversation Test conversation Test conversation Test conversation Test conversation</p>
								</div>
								<div class="message_moi">
									<p class="arg">Test conversation Test conversation Test conversation Test conversation Test conversation Test conversation Test conversation</p>
								</div>
								<div class ="message_adv">
									<p class="arg">Mon argument est le suivant. En effet, on peut considérer le citoyen comme indépendant et croyant en sont propre esprit conceptuel. Cependant, cela ne le mènera qu'à sa perte.</p>
								</div>
								<div class="message_moi">
									<p class="arg">Test conversation Test conversation Test conversation Test conversation Test conversation Test conversation Test conversation</p>
								</div>
								<div class ="message_adv">
									<p class="arg">Test conversation Test conversation Test conversation Test conversation Test conversation Test conversation Test conversation</p>
								</div>
								<div class="message_moi">
									<p class="arg">Test conversation Test conversation Test conversation Test conversation Test conversation Test conversation Test conversation</p>
								</div>
							</div>
					<!-- Fermeture panneau -->

					<!-- ZONE DE TEXTE -->
							<div class="row">
								<div class="col-sm-12">

									<form class="form-inline" id="form_chat" action="fonctions_interfacejeu/envoi_message.php" method="post">
										<div class="form-group">
											<input type="text" class="form-control" id="message" name="message" placeholder="Message...">	
										</div>
										  <button id="poster"  class="btn btn-default" type="submit">Envoyer</button>
									</form>

								</div>
							</div>
					<!-- Fermeteure z. de texte -->				

						</div>
					</div>
				
	<!-- FIN INTERFACE CHAT -->

				</div><!--Ferme le div #section -->
			</div><!-- Ferme ROW principale -->
		</div><!-- Ferme CONTAINER #corps -->

		<!-- FOOTER -->
		<div class="row">
			<div class="col-sm-12" id="footer">
					<p class="foot">Mentions légales 2016, IUT Montpellier-Sète - Projet AS : Dalle-Cort, Chac, Ferrer, Roig</p>
			</div>
		</div>
		<!-- ===== -->

			 
	</div><!-- Ferme #row_corps -->

	<!-- INVOCATION DU SCRIPT-->
	 <script type="text/javascript" src="fonctions_interfacejeu/afficher_message.js"></script>
	<!-- ==================== -->

</body>
</html>
