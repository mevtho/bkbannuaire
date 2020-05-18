<?php

require_once ("IView.php");
require_once ("CVilleDBQueries.php");

class CViewVille implements IView {
	public function display($_id="") {
		$ville=CVilleDBQueries::get($_id);
		
		$this->show($ville);
	}
	
	public function show ($_ville) {
		$ville=$_ville;
		
		$nex=Array(
			"ajout"			=>	SAISIE_VILLE,
			"clonage"		=>	SAISIE_VILLE,
			"edition"		=>	SAISIE_VILLE,
			"suppression"	=>	DELETE_VILLE		
		);
		
		require_once ("view_ville.php");
	}
}

?>