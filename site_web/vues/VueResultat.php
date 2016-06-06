<?php
	class VueResultat extends Vue{
				
		
		public function role(){
			require("config.php");
			$reqRole="SELECT role FROM Role WHERE idPartie={$_SESSION['id_partie']} AND idMembre={$_SESSION['idMembre']};";
			$resRole=$bdd->query($reqRole);
			if ($resRole==false){
				echo "erreur requete resRole: $reqRole";
				exit();
			}
			return $resRole->fetch();				
		}
		
		public function nombreArbitre(){
			require("config.php");
			$reqNbArbitre="SELECT COUNT(idMembre) AS nbArbitre FROM Role WHERE idPartie={$_SESSION['id_partie']} AND role=1";
				$resNbArbitre=$bdd->query($reqNbArbitre);
				if($resNbArbitre==false){
					echo "erreur requete resNbArbitre : $reqNbArbitre";
					exit();
				}
			return $resNbArbitre->fetch();
		}
		
		public function votePlus($idJoueur){
			require("config.php");
			$reqPlusJoueur="SELECT COUNT(V.idMessage) AS vote_plus FROM Votes AS V JOIN Chat_messages AS C ON V.idMessage=C.message_id WHERE vote=1 AND C.id_partie={$_SESSION['id_partie']} AND C.message_id_membre={$idJoueur};";
				$resPlusJoueur=$bdd->query($reqPlusJoueur);
				if ($resPlusJoueur==false){ 
					echo "erreur requete resPlus : $reqPlusAdverse";
					exit();
				}
			return $resPlusJoueur->fetch();
		}
		
		public function voteMoins($idJoueur){
			require("config.php");
			$reqMoinsJoueur="SELECT COUNT(V.idMessage) AS vote_moins FROM Votes AS V JOIN Chat_messages AS C ON V.idMessage=C.message_id WHERE vote=-1 AND C.id_partie={$_SESSION['id_partie']} AND C.message_id_membre={$idJoueur};";
				$resMoinsJoueur=$bdd->query($reqMoinsJoueur);
				if ($resMoinsJoueur==false){
					echo "erreur requete resPlus : $reqMoinsAdverse"; 
					exit();
				}
			return 	$resMoinsJoueur->fetch();		
		}
		
		public function calculPoints($voteTotal,$nbArbitre){
			if ($nbArbitre==0){
				return $voteTotal;
			}
			else{
			return ceil(($voteTotal)/(ceil($nbArbitre/2)));
			}
		}
		
		public function statutFinalJoueur($scoreJoueur,$idJoueur,$scoreAdversaire,$idAdversaire){
			require("config.php");
			if ($scoreJoueur>$scoreAdversaire){
				$reqVictoire="UPDATE Membres SET nbPartiesGagnees=nbPartiesGagnees+1 WHERE idMembre={$idJoueur}; UPDATE Membres SET points=points+{$scoreJoueur} WHERE idMembre={$idJoueur}; UPDATE Membres SET nbTotalParties=nbTotalParties+1 WHERE idMembre={$idJoueur};";
				$resVictoire=$bdd->query($reqVictoire);
				if ($resVictoire==false){
					echo "erreur requete resVictoire : $reqVictoire";
					exit();
				}
				
				return "Victoire !";	
			}
			else if($scoreAdversaire>$scoreJoueur){
				$reqDefaite="UPDATE Membres SET points=points+{$scoreJoueur} WHERE idMembre={$idJoueur}; UPDATE Membres SET nbTotalParties=nbTotalParties+1 WHERE idMembre={$idJoueur};";
				$resDefaite=$bdd->query($reqDefaite);
				if ($resDefaite==false){
					echo "erreur requete resDefaite : $reqDefaite";
					exit();
				}
				return "Défaite !";
				
			}
			else{
				$reqAddPoints="UPDATE Membres SET points=points+{$scoreJoueur} WHERE idMembre={$idJoueur}; UPDATE Membres SET points=points+{$scoreAdversaire} WHERE idMembre={$idAdversaire}; UPDATE Membres SET nbTotalParties=nbTotalParties+1 WHERE idMembre={$idJoueur}; UPDATE Membres SET nbTotalParties=nbTotalParties+1 WHERE idMembre={$idAdversaire};";
				$resAddPoints=$bdd->query($reqAddPoints);
				if ($resAddPoints==false){
					echo "erreur requete resAddPoints : $reqAddPoints";
					exit();
				}
				return "Egalité !";
				
			}
		}
		
		
		/*public function setPoints($pointsJoueur,$idAdversaire,$pointsAdversaire){
			require("config.php");
			$reqAddPoints="UPDATE Membres SET points=points+{$pointsAdversaire} WHERE idMembre={$idAdversaire}; UPDATE Membres SET points=points+{$pointsJoueur} WHERE idMembre={$_SESSION['idMembre']};";
				$resAddPoints=$bdd->query($reqAddPoints);
				if ($resAddPoints==false){
					echo "erreur requete resAddPoints : $reqAddPoints";
					exit();
				}
			
		}*/
		
		public function getIdMin(){
			require("config.php");
			$reqJoueurMin= "SELECT MIN(idMembre) AS idMembre FROM Role WHERE idPartie={$_SESSION['id_partie']} AND role=0";
				$resJoueurMin=$bdd->query($reqJoueurMin);
				if($resJoueurMin==false){
					echo "erreur requete resJoueurMax : $reqJoueurMin";
					exit();
				}
				return $resJoueurMin->fetch();
		}
		
		public function getIdMax(){
			require("config.php");
			$reqJoueurMax= "SELECT MAX(idMembre) AS idMembre FROM Role WHERE idPartie={$_SESSION['id_partie']} AND role=0";
				$resJoueurMax=$bdd->query($reqJoueurMax);
				if($resJoueurMax==false){
					echo "erreur requete resJoueurMax : $reqJoueurMax";
					exit();
				}
				return $resJoueurMax->fetch();
		}
		
		public function reqPseudo($idJoueur){
			require("config.php");
			$reqPseudo="SELECT pseudo FROM Membres WHERE idMembre={$idJoueur}";
				$resPseudo=$bdd->query($reqPseudo);
				if($resPseudo==false){
					echo "erreur requete resPseudo: $reqPseudo";
					exit();
				}
			return $resPseudo->fetch();
		}
		public function statutFinalArbitre($scoreMin,$pseudoMin,$scoreMax,$pseudoMax){
			if ($scoreMin>$scoreMax){
					return "Victoire de {$pseudoMin}";
				}
				else if($scoreMax>$scoreMin){
					return "Victoire de {$pseudoMax}";
				}
				else{
					return "Egalité !";
				}
		}
		
	}
	
?>
