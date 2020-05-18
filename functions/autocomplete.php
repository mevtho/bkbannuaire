<?php

function autocomplete ($value) {
	$db=CAccesDB::getDBAcces();
	
	if (strlen($value)==0)
		return "";
	
	$contacts=CContactDBQueries::getList("prenomContact like '".$value."%' or nomContact like '".$value."%'",CContactDBQueries::$IDS_ONLY);
	$groupes=CGroupeDBQueries::getList("nomGroupe like '".$value."%'",CGroupeDBQueries::$IDS_ONLY);
	
	$results=array();
	
	foreach ($groupes as $groupe) {
		$results[]=array("value" => "g".$groupe->getIdGroupe(),"display" =>utf8_encode("Groupe : ".$groupe->getNomGroupe()));
	}
	
	foreach ($contacts as $contact) {
		$results[]=array("value" => "c".$contact->getIdContact(), "display" => utf8_encode($contact->getNomContact()." ".$contact->getPrenomContact()));
	}
	
	return $results;
}
?>