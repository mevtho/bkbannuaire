<?php

require_once ("IView.php");
require_once ("CContact.php");
require_once ("CContactDBQueries.php");

class CViewListContact implements IView {	
	public function display($_w="") {
		$contacts=CContactDBQueries::getList($_w,CContactDBQueries::$IDS_ONLY);
		$this->show($contacts);
	}
	
	public function show ($_contacts) {
		$contacts=$_contacts;
		
		$nex=Array(
			"ajout"			=>  SAISIE_CONTACT,
			"display"		=>  LISTE_CONTACT
		);

		$nbQualifies = 0;
		for ($i=0;$i< count($contacts); ++$i)
			if ($contacts[$i]->getLicence() != null && $contacts[$i]->getLicence()->getDateQualification() != "0000-00-00" )
				++$nbQualifies;

		include ("view_list_contact.php");
	}
}

?>
