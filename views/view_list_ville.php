<?php barreEdition($nex); ?>

<table cellspacing="0" class="liste">
	<tr><th>Villes</th></tr>
<?php
	foreach ($villes as $ville) {
		echo "<tr><td>".$ville->getCPVille()." ".$ville->getNomVille()."</td></tr>\n";
	}
?>
</table>