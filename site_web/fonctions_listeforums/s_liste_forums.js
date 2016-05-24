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

function actualiser(numero) {
	//Instanciation de l'objet pour passage à php
	var xhr = new XMLHttpRequest(); 

	//Traitement du résultat du php
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4) {		//serveur ok + réponse reçue
			var r=xhr.responseText;	//récupération du résultat
			var rj=r.substring(0,1);
			var ra=r.substring(2,3);
			var suj=r.substring(4);
			document.getElementById('nbj'+numero).innerHTML = rj;
			document.getElementById('nba'+numero).innerHTML = ra;
			document.getElementById('suj'+numero).innerHTML = suj;
		}		
	};

	//Passage avec GET
	xhr.open("GET","fonctions_listeforums/actualisation_forums.php?numforum="+numero); 
	xhr.send(null);	
}
