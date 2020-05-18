<?php

require_once ("IView.php");
require_once ("CContactDBQueries.php");

class CViewContact implements IView{
	public function display($_id="") {
		$contact=CContactDBQueries::get($_id,CContactDBQueries::$DETAILS_RESPONSABLE | CContactDBQueries::$DETAILS_GROUPES );
		$this->show($contact);	
	}
	
	public function show($_contact) {
		$contact=$_contact;
		$nex=Array(
			"ajout"			=>	SAISIE_CONTACT,
			"clonage"		=>	SAISIE_CONTACT,
			"edition"		=>	SAISIE_CONTACT,
			"suppression"	=>	DELETE_CONTACT		
		);
		
		require_once ("view_contact.php");
	}
	
}

?>