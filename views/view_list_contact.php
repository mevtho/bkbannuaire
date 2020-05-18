<?php require("view_search_panel.php"); ?>

<?php barreEdition($nex); ?>

<table cellspacing="0" class="liste">
	<tr><th colspan="6"><?php echo count($contacts); ?> <?php echo (!isset($_GET['all']))?"Licenciés":"Contacts"; ?> / <?php echo $nbQualifies; ?> qualifiés</th></tr>
<?php
	foreach ($contacts as $contact) {
		echo "<tr>
				<td><a href=\"annuaire.php?ex=".DETAILS_CONTACT."&id=".$contact->getIdContact()."\">".$contact->getNomContact()." ".$contact->getPrenomContact()."</a></td>
				<td style=\"width:80px\">".$contact->getLicence()->getNumLicence()."</td>
				<td style=\"width:120px\">".strinttophone($contact->getCommunication()->getTel1())."</td>
				<td style=\"width:120px\">".strinttophone($contact->getCommunication()->getTel2())."</td>
				<td style=\"width:16px\">".(($contact->getLicence()->getDateQualification()!="0000-00-00")?"<img src=\"theme/images/qualifie.png\" alt=\"Q\" title=\"Qualifié le : ".datetostr($contact->getLicence()->getDateQualification())."\">":"")."</td>
				<td style=\"width:16px\">
					<a href=\"annuaire.php?ex=".DETAILS_CONTACT."&id=".$contact->getIdContact()."\" class=\"icons lnk_icon ui-widget ui-helper-clearfix ui-state-default ui-corner-all\">
						<span class=\"ui-icon ui-icon-plus\" style=\"width:16px;\">&nbsp;</span>
					</a>
				</td>
			</tr>\n";
	}
?>
</table>

<?php global $ex; if ($ex==SEARCH) echo "<br /><a href=\"annuaire.php\">Voir tous</a>"; ?>
