<?php

require_once ("CFormGroupe.php");
require_once ("CFormVille.php");
require_once ("CFormContact.php");

function check ($_form, $_vars) {
	$ok=$_form->checkInput($_vars);
	if ($ok===true)
		return true;
		
	$return=array();
	foreach ($ok as $what)
		$return[]=utf8_encode($what);
	return $return;
}

function json_route () {
	global $ex, $_GET;
	
	if (!canView($ex)) 
		$ex = LISTE_CONTACT;
	
	switch ($ex) {
		case CHECK_CONTACT :
			return json_encode(check(new CFormContact(), $_GET));
			break;
		case CHECK_GROUPE :
			return json_encode(check(new CFormGroupe(), $_GET));
			break;
		case CHECK_VILLE :
			return json_encode(check(new CFormVille(), $_GET));
			break;
		case DETAILS_CONTACT :
			return json_encode(CContactDBQueries::get($_GET['id'],CContactDBQueries::$IDS_ONLY));
			break;
		case DETAILS_GROUPE :
			return json_encode(CGroupeDBQueries::get($_GET['id'],CGroupeDBQueries::$IDS_ONLY));
			break;
		case DETAILS_VILLE :
			return json_encode(CVilleDBQueries::get($_GET['id']));
			break;
		case SEARCH_COMPLETION :
			require_once("autocomplete.php");
			return json_encode(autocomplete(trim($_POST['query'])));
			break;
		case IMPRESSION :
			require_once("CImpression.php");
			$impression = new CImpression();
			$res=$impression->SearchArrayResult($_GET);
			$return="";
			for($i=0;$i<count($res);++$i) {
				$return.="<li rec=\"".$res[$i]->getIdContact()."\">".$res[$i]->getNomContact()." ".$res[$i]->getPrenomContact()."</li>\n";
			}
			echo json_encode(utf8_encode($return));
			break;
		default :
			break;
	}
}

?>