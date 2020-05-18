<?php

global $id, $options, $ex, $_GET;

if (!isset($options['notpl'])) {
	$items=Array();

	if (canEdit()) {

		if ($id!=-1 && $ex != DELETE_CONTACT && $ex != DELETE_GROUPE && $ex != DELETE_VILLE) {
			$items['Supprimer']=Array("url"=>"javascript:confirmer('annuaire.php?ex=".$nex['suppression']."&id=".$id."')", "icon"=>"ui-icon ui-icon-trash");
			$items['Cloner']=Array("url"=>"annuaire.php?ex=".$nex['clonage']."&id=".$id."&duplicate=1", "icon"=>"ui-icon ui-icon-link");
			$items['Editer']=Array("url"=>"annuaire.php?ex=".$nex['edition']."&id=".$id, "icon"=>"ui-icon ui-icon-pencil");
		}

		$items['Ajouter nouveau']=Array("url"=>"annuaire.php?ex=".$nex['ajout'], "icon"=>"ui-icon ui-icon-contact");
	
	}
		
	if ($ex == LISTE_CONTACT) {
		$all = isset($_GET['all']);
		$items[($all)?'Licenciés seulement':'Tous']=Array("url"=>"annuaire.php?ex=".$nex['display'].(($all)?"":"&all"), "icon" =>"my-ui-icon ".(($all)?"ui-icon-licencie":"ui-icon-all"));
	}
	
	require_once ("view_barre_edition.php");
}

?>