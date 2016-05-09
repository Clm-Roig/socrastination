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
	
	<title>Socrastination - Jeu</title>
   	
</head>

<body> 

	<!--<?php require("fonctions_interfacejeu/enjeu.php");?>-->

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
							
							</div>
					<!-- Fermeture panneau -->

					<!-- ZONE DE TEXTE -->
							<div class="row">
								<div class="col-sm-12">

									<form class="form-inline"  id="form_chat" onSubmit="return false;">
										<div class="form-group">
											<textarea class="form-control" id="message" name="message" onKeyUp="if(event.keyCode == 13) validerForm();" placeholder="Message..." maxlength="254" rows ="2" cols ="80"></textarea>	
										</div>
										  <button id="poster"  class="btn btn-default" type="submit" >Envoyer</button>
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
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script>

	// SCRIPT VALIDATION FORMULAIRE AVEC ENTREE
	function validerForm(){
		document.getElementById("poster").click();	
	}

	//Annulation défaut du saut de ligne 
	$('textarea').click(function(e){
		e.preventDefault(); 
	});

	//SCRIPT D'AFFICHAGE DES MESSAGES
	var timer=setInterval("affichage()",1000);	//on lance la fonction toutes les secondes.

	var compteur_moi=10;	
	var compteur_adv=10;	
		
	//On stocke le dernier message affiché pour ne pas le spammer 
	var last_mess="";

	function affichage() {
		//Instanciation de l'objet pour passage à php
		var xhr = new XMLHttpRequest(); 

		//Traitement du résultat du php
		xhr.onreadystatechange = function() {
			if(xhr.readyState == 4) {				//serveur ok + réponse reçue
				var r_brut = xhr.responseText;		//récupération du résultat
				var auteur=r_brut.substring(0,1);	//auteur
				var r=r_brut.substring(1);			//message
				if (r != last_mess){

					//Config du div contenant le bloc p
		    			var new_div = document.createElement('div');
					if (auteur==1){
						new_div.className = 'message_moi';
						compteur_moi --;
					}
					else {
						new_div.className = 'message_adv';
						compteur_adv --;
					}

					//Config du p contenant le message
					var new_p = document.createElement('p');
					new_p.className = 'arg';
		    			new_p.innerHTML = r;      
    			
					//Passage de p dans le div
					new_div.appendChild(new_p);
					//Affichage du div 
		    			document.getElementById('conversation').appendChild(new_div);  

					//MAJ last_mess
					last_mess=r;				
				}
			}			
		};

		//Passage avec GET
		xhr.open("GET","fonctions_interfacejeu/afficher_message.php"); 
		xhr.send(null);	
	}
	

	//ENVOI MESSAGE EN AJAX (2ème méthode)
	$("#poster").click(function(){
		var mess = document.getElementById("message").value;
	     	$.ajax({
			url : 'fonctions_interfacejeu/envoi_message.php',
	       		type : 'POST', 
	       		dataType : 'html',
			data : 'message='+mess
	   		});
		//On efface le contenu après postage du message
		document.getElementById('message').value='';  
	});

	</script>	
	<!-- ==================== -->

</body>
</html>
