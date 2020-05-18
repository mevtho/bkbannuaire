<?php

require_once ("IForm.php");

require_once ("CVille.php");
require_once ("CVilleDBQueries.php");

class CFormVille implements IForm {
	
	public function showForm ($_id=-1) {
		$ville=CVilleDBQueries::get($_id);
		
		if (is_null($ville))
			$ville=new CVille();
		
		$action=($ville->getIdVille()==-1)?"Nouvelle":"Edition";	
			
		require_once ("form_ville.php");
	}
	
	public function processForm ($_vars) {
		$ville=new CVille($_vars['idVille'], (int)$_vars['cpVille'], $_vars['nomVille']);
		CVilleDBQueries::put($ville);
	}
	
	public function checkInput ($_vars) {
		$return = array();
		if (strlen($_vars['nomVille']) == 0) {
			$return[]="Nom commune : Le nom de la commune doit être spécifié";
		}
		else if (strlen($_vars['nomVille']) > 45) {
			$return[]="Nom commune : Le nom de la commune est composé d'au plus 45 caractères";
		}
		
		if (((int)$_vars['cpVille'])==0) {
			$return[]="Code postal : Un code postal est composé de 5 chiffres"; 
		}
		return ((empty($return))?true:$return);
	}
	
	public function cloneForm ($_id=-1) {
		if ($_id==-1) {
			showForm($_id);
			return;
		}
		
		$ville=CVilleDBQueries::get($_id);
		
		if (is_null($ville)){
			showForm($_id);
			return;
		}
		
		$action="Nouvelle";
		$ville->setIdVille(-1);
		
		require_once ("form_ville.php");
	}
}

?>