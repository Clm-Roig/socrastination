//On va arrêter de chercher des messages après 10 arguments échangés
var compteur_j1=0;	
var compteur_j2=0;	
	
//On stocke l'id du dernier message affiché 
//Initialisation à -1 quand l'arbitre arrive pour la première fois
var id_last_mess=-1;

// ========== AFFICHAGE DU MESSAGE ========== // 
var timer=setInterval("affichage()",500);	//on lance la fonction toutes les 0.5s

function affichage() {
	var xhr = new XMLHttpRequest(); 

	//Traitement du résultat du php
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4) {				//serveur ok + réponse reçue
			var r = JSON.parse(xhr.responseText);		//récupération du résultat	
			if (r.statut){					
				var idj = r.auteur; 
				var message = r.message_txt;
				var idm = r.idm;
				var vote = r.vote;

				//On mémorise l'id du dernier message affiché 
				id_last_mess = idm;

				//Config du div contenant le bloc p + le vote
				var new_bloc_arbitre = document.createElement('div');
				new_bloc_arbitre.className='bloc_arbitre';

				//Config du div contenant le bloc p
	    			var new_div = document.createElement('div');

				//De qui vient le message ?
				var idj1=document.getElementById('idj1').innerHTML;
				var idj2=document.getElementById('idj2').innerHTML;

				if (idj==idj1){
					new_div.className = 'message_moi';
					compteur_j1++;
				}
				else {
					new_div.className = 'message_adv';
					compteur_j2++;
				}

				var new_p = document.createElement('p');
				new_p.className = 'arg';

				//Insertion du vote dans le bloc en fonction du vote déjà envoyé ou pas 
				if(vote==1) {
	    				new_p.innerHTML = message+'<div class="votes" id="'+idm+'"><span class="glyphicon glyphicon-thumbs-up vote_up vote_valide" onclick="vote(1,'+idm+') ; return false;"> </span>'+'<span class="glyphicon glyphicon-thumbs-down vote_down hide" onclick="vote(-1,'+idm+') ; return false;"> </span></div>';      
				}
				else if(vote==-1) {
					new_p.innerHTML = message+'<div class="votes" id="'+idm+'"><span class="glyphicon glyphicon-thumbs-up vote_up hide" onclick="vote(1,'+idm+') ; return false;"> </span>'+'<span class="glyphicon glyphicon-thumbs-down vote_down vote_valide" onclick="vote(-1,'+idm+') ; return false;"> </span></div>';      
				}
				else {
					new_p.innerHTML = message+'<div class="votes" id="'+idm+'"><span class="glyphicon glyphicon-thumbs-up vote_up" onclick="vote(1,'+idm+') ; return false;"> </span>'+'<span class="glyphicon glyphicon-thumbs-down vote_down" onclick="vote(-1,'+idm+') ; return false;"> </span></div>';      
				}

				//Passage de p dans le div et passage du div dans bloc_arbitre
				new_div.appendChild(new_p);
				new_bloc_arbitre.appendChild(new_div);

				//Affichage du div 
	    			document.getElementById('conversation').appendChild(new_bloc_arbitre);
			}						
		}			
	}
	
	//Passage avec POST
	xhr.open("POST", "fonctions_interfacejeu/afficher_message_arbitre.php");
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	//ID du dernier message affiché
	xhr.send("id_last_mess="+id_last_mess);
};

// ========== ENVOI DU VOTE ========== // 
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
				if (type_vote==1) {
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

// ========== ACTUALISATION DES PSEUDOS ========== // 
var timer=setInterval("actualiser()",400);	//on lance la fonction toutes les 0.4s
function actualiser(){
	var xhr = new XMLHttpRequest(); 
	//Passage avec GET
	xhr.open("GET", "fonctions_interfacejeu/infos_partie_arbitre.php");
	xhr.send();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4) {				//serveur ok + réponse reçue
			var r = JSON.parse(xhr.responseText);			//récupération du résultat
			document.getElementById('pseudo_j1').innerHTML=r.pseudoj1;
			document.getElementById('pseudo_j2').innerHTML=r.pseudoj2;
			document.getElementById('idj1').innerHTML=r.idj1;
			document.getElementById('idj2').innerHTML=r.idj2;
			document.getElementById('sujet').innerHTML=r.sujet;
		}
   	}	
};	

// ========== ALERTE SI ON QUITTE LA PAGE ========== // 
function quitter(){
	window.location = "liste_forums.php";
};	
