<?php

require_once ("IForm.php");

require_once ("CGroupe.php");
require_once ("CGroupeDBQueries.php");
require_once ("CContactDBQueries.php");

class CFormGroupe implements IForm {
	
	public function showForm ($_id=-1) {
		$groupe=CGroupeDBQueries::get($_id);
		$contacts=CContactDBQueries::getList("",CContactDBQueries::$IDS_ONLY);
		
		if (is_null($groupe))
			$groupe=new CGroupe();

		$action=($groupe->getIdGroupe()==-1)?"Nouveau":"Edition";	
			
		require_once ("form_groupe.php");
	}
	
	public function processForm ($_vars) {			
		$groupe=new CGroupe($_vars['idGroupe'], $_vars['nomGroupe'], $_vars['idResponsable']);
		CGroupeDBQueries::put($groupe);
	}
	
	public function checkInput ($_vars) {
		$return=array();
		if (strlen($_vars['nomGroupe']) == 0 ) {
			$return[]="Nom groupe : Le nom du groupe doit être spécifié.";		
		}
		else if (strlen($_vars['nomGroupe']) > 45 ) {
			$return[]="Nom groupe : Le nom du groupe doit être composé d'au plus 45 caractères.";
		}
		
		return ((empty($return))?true:$return);
	}
	
	public function cloneForm ($_id=-1) {
		if ($_id==-1) {
			showForm($_id);
			return;
		}
		
		$groupe=CGroupeDBQueries::get($_id);
		$contacts=CContactDBQueries::getList("",CContactDBQueries::$IDS_ONLY);
				
		if (is_null($groupe)){
			showForm($_id);
			return;
		}
		
		$action="Nouvelle";
		$groupe->setIdGroupe(-1);
		
		require_once ("form_groupe.php");
	}
}

?>