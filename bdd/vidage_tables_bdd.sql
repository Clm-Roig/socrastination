#Supprimer toutes les parties + messages déjà crées 
DELETE FROM Parties; 
DELETE FROM Role; 
DELETE FROM Chat_messages;
DELETE FROM Votes;

# TODO: faire une suppression en cascade.
UPDATE Forums 
SET idPartie=0;						
			
