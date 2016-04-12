<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script>
	var timer=setInterval("affichage()",1000);	//on lance la fonction toutes les 4 secondes.

	function affichage() {
		//Instanciation de l'objet pour passage à php
		var xhr = new XMLHttpRequest(); 

		//Traitement du résultat du php
		xhr.onreadystatechange = function() {
			if(xhr.readyState == 4) {		//serveur ok + réponse reçue
				var r=xhr.responseText;	//récupération du résultat
				document.getElementById('test').innerHTML = r;
			}			
		};

		//Passage avec GET
		xhr.open("GET","afficher_message.php"); 
		xhr.send(null);	
	}
</script>	
