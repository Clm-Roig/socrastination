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
	
	<title>Socrastination - Arbitrage</title>
   	
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
						<h2 class="haut_chat">EN JEU (arbitrage)<h2>
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

	var timer=setInterval("affichage()",1000);	//on lance la fonction toutes les secondes.

	//On va arrêter de chercher des messages après 10 arguments échangés
	var compteur_j1=10;	
	var compteur_j2=10;	
		
	//On stocke le dernier message affiché pour ne pas le spammer 
	var last_mess="";

	//On stocke les id des joueurs
	var idj1=-1;
	var idj2=-1;

	function affichage() {
		//Instanciation de l'objet pour passage à php
		var xhr = new XMLHttpRequest(); 

		//Traitement du résultat du php
		xhr.onreadystatechange = function() {
			if(xhr.readyState == 4) {				//serveur ok + réponse reçue
				var r_brut = xhr.responseText;		//récupération du résultat

				// £$¤ sont les caractères qui séparent l'id du membre du message
				var index_separateur_auteur=r_brut.lastIndexOf('£$¤');
				var idj=r_brut.substring(0,index_separateur_auteur);		//auteur
				index_separateur_auteur += 3;

				// ù%*µ sont les caractères qui séparent l'id du message du message
				var index_separateur_id = r_brut.lastIndexOf('ù%*µ');
				index_separateur_id += 4;
				var id_message = r_brut.substring(index_separateur_id);	//id_message
				
				var r = r_brut.substring(index_separateur_auteur,index_separateur_id-4);

				//On va initialiser les id des joueurs si ils sont vides
				if (idj1== -1){
					idj1=idj;
				}
				if (idj2 == -1){
					idj2=idj;
				}

				if (r != last_mess){
			
					//Config du div contenant le bloc p + le vote
					var new_div0 = document.createElement('div');
					new_div0.className='bloc_arbitre';

					//Config du div contenant le bloc p
		    			var new_div = document.createElement('div');
					if (idj==idj1){
						new_div.className = 'message_moi';
						compteur_j1--;
					}
					else {
						new_div.className = 'message_adv';
						compteur_j2--;
					}

					//Config du p contenant le message

					//MAJ last_mess
					last_mess = r;	
					var new_p = document.createElement('p');
					new_p.className = 'arg';

					//Insertion du vote dans le bloc
		    			new_p.innerHTML = r+'<div class="votes '+id_message+'"><a href="" onclick="vote(1)"><span class="glyphicon glyphicon-thumbs-up"> </span></a> '+' <a href="#" onclick="vote(-1)"><span class="glyphicon glyphicon-thumbs-down"></a></div>';      
    			
					//Passage de p dans le div et passage du div dans bloc_arbitre
					new_div.appendChild(new_p);
					new_div0.appendChild(new_div);

					//Affichage du div 
		    			document.getElementById('conversation').appendChild(new_div0);  									
				}
			}			
		};

		//Passage avec GET
		xhr.open("GET","fonctions_interfacejeu/afficher_message_arbitre.php"); 
		xhr.send(null);	
	}

	//ENVOI VOTE EN AJAX
	function vote(type_vote, id_mess){
	     	$.ajax({
			url : 'fonctions_interfacejeu/envoi_vote.php',
	       		type : 'POST', 
	       		dataType : 'html',
			data : { 	type_vote : type_vote,
				  	id_message : id_mess	
				}
	   		});

		//On efface le bouton de vote après post
	};
	
	</script>	
	<!-- ==================== -->

</body>
</html>
