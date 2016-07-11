<?php
	class Vue{
		private $gabarit;//chaine de caractere
		
		public function __construct($fichierVue){
			/*
			* Données : $fichierVue
			*
			* Résultat : charge le contenu du fichier $fichierVue depuis le dossier "vues/" dans le gabarit de cette vue.
			*/
			$this->gabarit=file_get_contents("vues/$fichierVue");
		}


		public function configurer($motClef, $valeur){
			/*
			* Données : $motClef : une chaine de caractère, $valeur : une chaine de caractère
			*
			* Résultat : remplace les occurences de {$motClef} par $valeur dans le gabarit de cette vue
			*/
			$this->gabarit= str_replace("{$motClef}",$valeur,$this->gabarit);
		}


		public function afficher(){
			/*
			* Données : aucunes
			*
			* Résultat : affiche le gabarit
			*/
			echo $this->gabarit;
		}


		public function configurerAvecTableaux($tabMotsClefs,$tabValeurs){
			/*
			* Données : deux tableaux
			*
			* Résultat : remplace les occurences des valeurs de $tabmotClefs les valeurs de $tabValeurs dans le gabarit de la vue
			*/
			$this->gabarit=str_replace($tabMotsClefs,$tabValeurs,$this->gabarit);
		}


		public function configurerAvecTableauAssociatif($tableau){	
			/*
			* Données : un tableau associatif
			*
			* Résultat : remplace les occurences de {$clef} par $valeur dans le gabarit de la vue
			*/		
			foreach ( $tableau as $clef->$valeur){
				$this->gabarit= str_replace("{$clef}",$valeur,$this->gabarit);	
			}		
		}	
	}
	
?>
