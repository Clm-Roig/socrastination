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


// ================== ENVOI MESSAGE EN AJAX/JQUERY  ================== //
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