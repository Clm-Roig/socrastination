// SCRIPT VALIDATION FORMULAIRE AVEC ENTREE
function validerForm(){
	document.getElementById("poster").click();	
}
//Annulation défaut du saut de ligne 
$('textarea').click(function(e){
	e.preventDefault(); 
});

//======================================//

// ========== AFFICHAGE DES MESSAGES ========== // 
var timer=setInterval("affichage()",500);	//on lance la fonction toutes les secondes.

var compteur_moi=0;	
var compteur_adv=0;	
	
//On stocke l'id du dernier message affiché 
//Initialisation à -1 quand l'arbitre arrive pour la première fois
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
						compteur_moi ++;
					}
					else {
						new_div.className = 'message_adv';
						compteur_adv ++;
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
	var mess = document.getElementById("message").value;
	if (mess != null) {
		//On grise le bouton d'envoi
		document.getElementById("poster").disabled=true;
	     	$.ajax({
			url : 'fonctions_interfacejeu/envoi_message.php',
	       		type : 'POST', 
	       		dataType : 'html',
			data : 'message='+mess,
			success : function(){ 
				//On efface le contenu après postage du message
				document.getElementById('message').value='';  
				//On rétablit le bouton pour envoyer un autre message après 1 seconde
				setTimeout(function() {
					document.getElementById("poster").disabled=false;
				}, 1000);				
			}
	   	});
	}	
})

// ========== ACTUALISATION DES PSEUDOS ========== // 
var timer=setInterval("actualiser()",1000);	//on lance la fonction toutes les secondes.
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
		}
   	}	
}	

// ========== ALERTE SI ON QUITTE LA PAGE ========== // 
var confirmOnLeave = function(msg) {
    window.onbeforeunload = function (e) {
        e = e || window.event;
        msg = msg || '';
 
        // For IE and Firefox
        if (e) {e.returnValue = msg;}
 
        // For Chrome and Safari
        return msg;
    }; 
};

// message de confirmation générique du navigateur
confirmOnLeave(); 
// message de confirmation personnalisé
confirmOnLeave('Si vous quittez cette page, vous allez perdre la partie en cours. Voulez vous tout de même quitter ?');
