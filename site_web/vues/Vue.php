<?php
	class Vue{
		private $gabarit;//chaine de caractere
		
		public function __construct($fichier){
			$this->gabarit=file_get_contents("vues/$fichier");
		}
		public function configurer($motclef, $valeur){
			$this->gabarit= str_replace("{".$motclef."}",$valeur,$this->gabarit);
		}
		public function afficher(){
			echo $this->gabarit;
		}
		public function configurerAvecTableaux($tabmotclefs,$tabvaleur){
			$this->gabarit=str_replace($tabmotclefs,$tabvaleur,$this->gabarit);
		}	
	}
	
?>
