<?php

	require_once("rsc/constant.php");

	$access["Viewer"] = md5("sapela");
	$access["Editer"] = md5("2213047");

	$canView = Array (DETAILS_CONTACT, DETAILS_GROUPE, DETAILS_VILLE, LISTE_CONTACT, 
					  LISTE_GROUPE, LISTE_VILLE, SEARCH, SEARCH_COMPLETION,	IMPRESSION);

	function isLogged () {
		return ($_COOKIE['Access']==EDITER ) || ($_COOKIE['Access']==VIEWER);
	}
	
	function canEdit() {
		return $_COOKIE['Access']==EDITER;
	}
	
	function canView($_ex) {
		global $canView;
		return ( $_COOKIE['Access']==EDITER ) || ($_COOKIE['Access']==VIEWER && in_array($_ex, $canView) );
	}
	
?>