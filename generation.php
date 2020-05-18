<?php
	ini_set('display_errors','on');
	require_once("rsc/rsc.php");
	require_once("COutput.php");
	
	require_once ("CImpression.php");
	$impressionPage = new CImpression ();
	$contacts=$impressionPage->getContacts($_GET);

	$output=null;
	if ($_GET['output']=="html") $output=new OutputHTML();
	if ($_GET['output']=="csv")  $output=new OutputXLSCSV();
	
	if ($output!=null) {
		$output->generate($_GET['libelle'], $contacts, $_GET);
	}

?>