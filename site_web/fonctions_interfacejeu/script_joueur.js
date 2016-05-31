// SCRIPT VALIDATION FORMULAIRE AVEC ENTREE
function validerForm(){
	document.getElementById("poster").click();	
}
//Annulation défaut du saut de ligne 
$('textarea').click(function(e){
	e.preventDefault(); 
});

$(window).ready(function() {
	setTimeout(function() {
		 $('#loader').fadeOut(1000);
	}, 1000);	 		
});

//======================================//

// ==== ENVOI DU SUJET ==== //
$("#valider_sujet").click(function(){
	var id = document.getElementById("liste_choix_sujet").value;	
	if (id != null) {
	     	$.ajax({
			url : 'fonctions_interfacejeu/envoi_sujet.php',
	       		type : 'POST', 
	       		dataType : 'html',
			data : 'id_sujet='+id,
			success : function(){ 
				//Envoi ok, on efface le formulaire de choix de sujet	
				document.getElementById("choix_sujet").style.display='none';	
			}
	   	});
	}	
})


// ========== FONCTION GENERALE ========== //
//TO DO !!!
/*var timer=setInterval("general()",500);	
function general() {
	if(!arret_partie()) {
		setTimeout(function() {
			affichage();	
			actualiser();
		}, 500);		
	}
}*/

var timer=setInterval("affichage()",500);	
var timer=setInterval("actualiser()",1000);
var timer=setInterval("arret_partie()", 100);


// ========== AFFICHAGE DES MESSAGES ========== // 
	
//On stocke l'id du dernier message affiché 
//Initialisation à -1 quand le joueur arrive pour la première fois
var id_last_mess=-1;

function affichage() {
	var xhr = new XMLHttpRequest(); 
	//Traitement du résultat du php
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4) {				//serveur ok + réponse reçue
			var r_brut = xhr.responseText;		//récupération du résultat

			if (r_brut != "Dernier message atteint.") {
				if (r_brut != "Pas de messages."){
					//ù%*µ sont les caractères qui séparent l'id du message du message
					var index_separateur_id = r_brut.lastIndexOf('ù%*µ');
					index_separateur_id += 4;
					var id_message = r_brut.substring(index_separateur_id);

					//On mémorise l'id du dernier message affiché 
					id_last_mess = id_message;

					var auteur = r_brut.substring(0,1);	//auteur
					var r = r_brut.substring(1,index_separateur_id-4);	//message
			
					//Config du div contenant le bloc p
		    			var new_div = document.createElement('div');
					if (auteur==1){
						new_div.className = 'message_moi';
					}
					else {
						new_div.className = 'message_adv';
					}

					//Config du p contenant le message
					var new_p = document.createElement('p');
					new_p.className = 'arg';
		    			new_p.innerHTML = r;      
		
					//Passage de p dans le div
					new_div.appendChild(new_p);
					//Affichage du div 
		    			document.getElementById('conversation').appendChild(new_div);  	
				}
			}  							
		}			
	};
	
	//Passage avec POST
	xhr.open("POST", "fonctions_interfacejeu/afficher_message.php");
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	//ID du dernier message affiché
	xhr.send("id_last_mess="+id_last_mess);
}


// ================== ENVOI MESSAGE EN AJAX/JQUERY  ================== //
$("#poster").click(function(){
	var mess = document.getElementById("message").value.trim();	
	var id_adv = document.getElementById('idj2').innerHTML;
	if (mess != "") {
		//On grise le bouton d'envoi
		document.getElementById("poster").disabled=true;
	     	$.ajax({
			url : 'fonctions_interfacejeu/envoi_message.php',
	       		type : 'POST', 
	       		dataType : 'html',
			data : 'message='+mess+'&id_adv='+id_adv,
			success : function(){ 
				//On efface le contenu après postage du message
				document.getElementById('message').value='';  
			}
	   	});
	}	
})

// ========== ACTUALISATION DES INFOS  ========== // 
var bouton=document.getElementById("poster");
function actualiser(){
	var xhr = new XMLHttpRequest(); 
	//Passage avec GET
	xhr.open("GET", "fonctions_interfacejeu/infos_partie.php");
	xhr.send();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4) {				//serveur ok + réponse reçue
			var r = JSON.parse(xhr.responseText);			//récupération du résultat
			document.getElementById('pseudo_j1').innerHTML=r.pseudoj1;
			document.getElementById('pseudo_j2').innerHTML=r.pseudoj2;
			document.getElementById('idj1').innerHTML=r.idj1;
			document.getElementById('idj2').innerHTML=r.idj2;
			document.getElementById('sujet').innerHTML=r.sujet;

			// ========= CONDITIONS SUR LE BOUTON ENVOI, LE FORMULAIRE, LE MESSAGE AFFICHÉ ======== //

			//Formulaire "sujet" masqué de base à chaque appel
			document.getElementById("choix_sujet").style.display='none';
			//=== Mon tour ===/
			if(r.tour){				
				//Mon tour + pas de sujet 
				if(document.getElementById('sujet').innerHTML == "Sujet non-choisi.") {
					bouton.disabled=true;
					document.getElementById("communication").innerHTML="Veuillez choisir un sujet parmi la liste suivante : ";
					document.getElementById("choix_sujet").style.display='block';
				}

				//Mon tour + sujet choisi 
				else {
					//Mon tour + sujet choisi + pas d'adv
					if(document.getElementById('idj2').innerHTML==-1) {
						bouton.disabled=true;
						document.getElementById("communication").innerHTML="En attente d'un deuxième joueur...";
					}
					//Mon tour + sujet choisi + un adv présent 
					else {
						bouton.disabled=false;
						document.getElementById("communication").innerHTML="A vous de jouer !";						
					}
				}
			}	

			//=== Pas mon tour ===/
			else {
				//Pas mon tour + pas de sujet 
				if(document.getElementById('sujet').innerHTML == "Sujet non-choisi.") {
					bouton.disabled=true;
					document.getElementById("communication").innerHTML="Veuillez patienter, l'adversaire choisit un sujet...";
				}

				//Pas mon tour + sujet choisi 
				else {
					//Pas mon tour + sujet choisi + pas d'adv (impossible normalement : c'est forcément mon tour s'il n'y a pas d'aversaire)
					if(document.getElementById('idj2').innerHTML==-1) {
						bouton.disabled=true;
						document.getElementById("communication").innerHTML="En attente d'un deuxième joueur...";
					}
					//Pas mon tour + sujet choisi + un adv présent 
					else {
						bouton.disabled=true;
						document.getElementById("communication").innerHTML=r.pseudoj2+" prépare son argument...";					
					}
				}
			}	
		}
   	}	
};

// ========== COMPTEUR FIN DE PARTIE ========== // 
var fini=false;
function arret_partie(){
	if (fini==false){
		var xhr = new XMLHttpRequest(); 
		//Passage avec GET, arret_partie retourne TRUE s'il faut fermer la partie c-a-d que les 2 joueurs ont échangé 10 messages 
		xhr.open("GET", "fonctions_interfacejeu/arret_partie.php");
		xhr.send();
		xhr.onreadystatechange = function() {
			if(xhr.readyState == 4) {				//serveur ok + réponse reçue
				var r = xhr.responseText;			//récupération du résultat
				if(r==true){
					return true;
					fini=true;
					document.getElementById("poster").disabled=true;		
					document.getElementById("communication").innerHTML="Partie terminée !";
					setTimeout(function() {
						alert("Là normalement c'est vraiment fini.");
					}, 30000);			
				}
				else return false;
	   		}	
		}
	}
};
