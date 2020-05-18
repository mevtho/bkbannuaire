<?php

require_once ("IView.php");
require_once ("CGroupeDBQueries.php");

class CViewGroupe implements IView {
	public function display($_id="") {
		$groupe=CGroupeDBQueries::get($_id, CGroupeDBQueries::$DETAILS_MEMBRES | CGroupeDBQueries::$DETAILS_RESPONSABLE);

		$this->show($groupe);
	}
	
	public function show($_groupe) {
		$groupe=$_groupe;
		
		$nex=Array(
			"ajout"			=>	SAISIE_GROUPE,
			"clonage"		=>	SAISIE_GROUPE,
			"edition"		=>	SAISIE_GROUPE,
			"suppression"	=>	DELETE_GROUPE		
		);
		
		require_once ("view_groupe.php");
	}
}

?>