<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script>

	/*var timer=setInterval("envoi_message()",1000);	//on lance la fonction toutes les secondes.
	var i=0;
	
	$('#envoi').click(function(e){
    		e.preventDefault(); // on empêche le bouton d'envoyer le formulaire
		function envoi_message() {
			//Instanciation de l'objet pour passage à php
			var xhr = new XMLHttpRequest(); 
			var message = encodeURIComponent ($('#message').val()); 

			//Traitement du résultat du php
			xhr.onreadystatechange = function() {
				if(xhr.readyState == 4) {		//serveur ok + réponse reçue
					var r=xhr.responseText;	//récupération du résultat
					alert ('Message envoyé à la BDD');
				}			
			};

			//Passage avec POST
			xhr.open("POST", "envoi_message.php", true);
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                  
			xhr.send(message);
	}*/

</script>
