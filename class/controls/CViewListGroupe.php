<?php

require_once ("IView.php");
require_once ("CGroupe.php");
require_once ("CGroupeDBQueries.php");

class CViewListGroupe implements IView {
	
	public function display($_w="") {
		$groupes=CGroupeDBQueries::getList($_w,CGroupeDBQueries::$IDS_ONLY);
		
		$this->show($groupes);
	}

	public function show($_groupes) {
		$groupes=$_groupes;
		
		$nex=Array(
			"ajout"			=>	SAISIE_GROUPE,
		);
		
		include ("view_list_groupe.php");
		
	}
	
}

?>