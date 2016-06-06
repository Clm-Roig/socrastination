//On lance la fonction toutes les secondes pour tous les forums
var timer=setInterval("actualiser(1)",1000);
var timer=setInterval("actualiser(2)",1000);	
var timer=setInterval("actualiser(3)",1000);
var timer=setInterval("actualiser(4)",1000);	
var timer=setInterval("actualiser(5)",1000);
var timer=setInterval("actualiser(6)",1000);	
var timer=setInterval("actualiser(7)",1000);
var timer=setInterval("actualiser(8)",1000);	
var timer=setInterval("actualiser(9)",1000);

//Gif de chargement
$(window).ready(function() {
	for (var i=1; i <10 ;  i++){
		document.getElementById('nbj'+i).innerHTML = '<img src="images/loader_forum.gif" alt="Gif de chargement">';
		document.getElementById('nba'+i).innerHTML ='<img src="images/loader_forum.gif" alt="Gif de chargement">';
		document.getElementById('suj'+i).innerHTML = '<img src="images/loader_forum.gif" alt="Gif de chargement">';	
	}			
});	

function actualiser(numero) {
	//Instanciation de l'objet pour passage à php
	var xhr = new XMLHttpRequest(); 

	//Traitement du résultat du php
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4) {		//serveur ok + réponse reçue
			var r=JSON.parse(xhr.responseText);     //récupération résultat JSON
			var nbJoueur=r.nbj;
           		var nbArbitre=r.nba;
            		var sujet=r.sujet;
			
			// Ne pourrait-on pas plutot injecter un gros div avec tout le tableau rempli d'un seul coup ? Il faut que actualisation_forums.php renvoie du html.
			document.getElementById('nbj'+numero).innerHTML = nbJoueur;
			document.getElementById('nba'+numero).innerHTML = nbArbitre;
			document.getElementById('suj'+numero).innerHTML = sujet;
		}		
	};

	//Passage avec GET
	xhr.open("GET","fonctions_listeforums/actualisation_forums.php?numforum="+numero); 
	xhr.send(null);	
}
