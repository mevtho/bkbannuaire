<?php

include_once ("view_menu.php");

global $menu;

$menu=Array();

//$menu['Consultation']=Array();
$menu['Contacts']="annuaire.php?ex=".LISTE_CONTACT;
$menu['Groupes']="annuaire.php?ex=".LISTE_GROUPE;
$menu['Villes']="annuaire.php?ex=".LISTE_VILLE;
$menu['Impression']="annuaire.php?ex=".IMPRESSION;
$menu['Déconnexion']="index.php";

function menu () {
	global $menu;
	
	showMenu($menu);
}

?>
