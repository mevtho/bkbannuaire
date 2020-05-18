<?php

require_once ("IView.php");
require_once ("CVille.php");
require_once ("CVilleDBQueries.php");

class CViewListVille implements IView {
	
	public function display($_w="") {
		$villes=CVilleDBQueries::getList($_w);
		
		$this->show($villes);
	}
	
	public function show($_villes) {
		$villes=$_villes;
		
		$nex=Array(
			"ajout"			=>	SAISIE_VILLE,
		);
		
		include ("view_list_ville.php");
	}
	
}

?>