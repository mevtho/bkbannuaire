<?php barreEdition($nex); ?>

<table cellspacing="0" class="liste">
	<tr><th>Groupes</th></tr>
<?php
	foreach ($groupes as $groupe) {
		echo "<tr><td><a href=\"annuaire.php?ex=".DETAILS_GROUPE."&id=".$groupe->getIdGroupe()."\">".$groupe->getNomGroupe()."</a></td></tr>\n";
	}
?>
</table>