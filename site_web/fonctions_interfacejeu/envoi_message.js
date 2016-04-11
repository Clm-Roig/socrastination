<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script>

	var timer=setInterval("envoi_message()",1000);	//on lance la fonction toutes les secondes.
	var i=0;

	function envoi_message() {
		//Instanciation de l'objet pour passage à php
		var xhr = new XMLHttpRequest(); 

		//Traitement du résultat du php
		xhr.onreadystatechange = function() {
			if(xhr.readyState == 4) {		//serveur ok + réponse reçue
				var r=xhr.responseText;	//récupération du résultat
				document.getElementById("conversation").childNodes[i].innerHTML = r;
			}			
		};

		//Passage avec GET
		xhr.open("GET","fonctions_interfacejeu/envoi_message.php"); 	
		xhr.send(null);	
	}

</script>
