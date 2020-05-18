<?php

function titre() {
	global $conf;
	return $conf['titre'];
}

function barreEdition ($_nex) {
	$nex=$_nex;
	require_once ("edition.php");
}

function saisonEnCours () {
    global $conf, $saisons;
    return $saisons[$conf['saison']];
}

?>