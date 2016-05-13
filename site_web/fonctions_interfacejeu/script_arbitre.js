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
	    			new_p.innerHTML = r+'<div class="votes" id="'+id_message+'"><span class="glyphicon glyphicon-thumbs-up" onclick="vote(1,'+id_message+') ; return false;"> </span>'+'<span class="glyphicon glyphicon-thumbs-down" onclick="vote(-1,'+id_message+') ; return false;"> </span></div>';      
		
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
	if (document.getElementById(id_mess).children[0].style.display != 'none' && document.getElementById(id_mess).children[1].style.display != 'none' ){
	     	$.ajax({
			url : 'fonctions_interfacejeu/envoi_vote.php',
	       		type : 'POST', 
	       		dataType : 'html',
			data : { 	type_vote : type_vote,
				  	id_message : id_mess	
			},
			success : function(){ 	//En cas d'envoi, on empêche un vote supplémentaire
				var div_votes = document.getElementById(id_mess);
				var span_plus = div_votes.firstChild;		//span du vote positif
				var span_moins = div_votes.children[1];	//span du vote négatif
				if(type_vote==1) {
					//Mise en gras du vote positif + disparition du négatif
					span_plus.className += ' vote_valide';
					span_moins.style.display = 'none';
				}
				else {
					//Mise en gras du vote négatif + disparition du positif						
					span_moins.className += ' vote_valide';
					span_plus.style.display = 'none';
				}
      			}
   		});	
	}	
};

