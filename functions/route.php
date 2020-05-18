<?php

function close_popup () {
	global $ex, $options, $id;
	if (strtolower($_SERVER['REQUEST_METHOD'])=="post") {
		$text="";
		switch ($ex) {
			case SAISIE_CONTACT :
				$contact=CContactDBQueries::get($id,CContactDBQueries::$IDS_ONLY);
				$text=$contact->getPrenomContact()." ".$contact->getNomContact();
				break;
			case SAISIE_GROUPE :
				$groupe=CGroupeDBQueries::get($id,CGroupeDBQueries::$IDS_ONLY);
				$text=$groupe->getNomGroupe();
				break;
			case SAISIE_VILLE :
				$ville=CVilleDBQueries::get($id);
				$text=$ville->getCPVille()." ".$ville->getNomVille();
				break;
			default : 
				break; 
		}
		echo "<input type=\"button\" class=\"submit\" onclick=\"javascript:popup_close(".$id.",'".$text."');\" value=\"Appliquer\" />";
	}
}

function route ($_ex=-1) {
	global $ex, $id, $_GET;
	$val=($_ex==-1)?$ex:$_ex;
	
	if (!canView($ex)) $val = LISTE_CONTACT;

	switch ($val) {
		case DETAILS_CONTACT :
			require_once("CViewContact.php");
			$details=new CViewContact();
			$details->display($id);
			break;
		case DETAILS_GROUPE :
			require_once("CViewGroupe.php");
			$details=new CViewGroupe();
			$details->display($id);
			break;
		case DETAILS_VILLE :
			require_once("CViewVille.php");
			$details=new CViewVille();
			$details->display($id);
			break;
		case LISTE_CONTACT : 
			require_once ("CViewListContact.php");
			$list=new CViewListContact();
			$list->display((!isset($_GET['all']))?"numLicence!=''":"");
			break;
		case LISTE_GROUPE : 
			require_once ("CViewListGroupe.php");
			$list=new CViewListGroupe();
			$list->display();
			break;
		case LISTE_VILLE : 
			require_once ("CViewListVille.php");
			$list=new CViewListVille();
			$list->display();
			break;
		case SAISIE_CONTACT :
			require_once ("CFormContact.php");
			require_once ("form.php");
			if (form(new CFormContact())===true) {
				$id=last_modified_id();
				route(DETAILS_CONTACT);
			}
			break;
		case SAISIE_GROUPE :
			require_once ("CFormGroupe.php");
			require_once ("form.php");
			if (form(new CFormGroupe())===true) {
				$id=last_modified_id();
				route(DETAILS_GROUPE);
			}
			break;
		case SAISIE_VILLE :
			require_once ("CFormVille.php");
			require_once ("form.php");
			if (form(new CFormVille())===true) {
				$id=last_modified_id();
				route(DETAILS_VILLE);
			}
			break;
		case DELETE_CONTACT :
			require_once ("CContactDBQueries.php");
			CContactDBQueries::delete(CContactDBQueries::get($id,CContactDBQueries::$IDS_ONLY));
			echo "fiche supprimée";
			route(LISTE_CONTACT);
			break;
		case DELETE_GROUPE :
			require_once ("CGroupeDBQueries.php");
			CGroupeDBQueries::delete(CGroupeDBQueries::get($id,CGroupeDBQueries::$IDS_ONLY));
			echo "fiche supprimée";
			route(LISTE_CONTACT);
			break;
		case DELETE_VILLE :
			require_once ("CVilleDBQueries.php");
			CVilleDBQueries::delete(CVilleDBQueries::get($id));
			echo "fiche supprimée";
			route(LISTE_VILLE);
			break;
		case SEARCH :
			require_once ("search.php");
			apply_search($_GET);
			break;
		case IMPRESSION :
			require_once ("CImpression.php");
			$impressionPage = new CImpression ();
			$impressionPage->show();
			break;
		default: 	
			route(LISTE_CONTACT);
			break;
	}
}

?>