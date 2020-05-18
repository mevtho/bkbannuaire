<?php barreEdition($nex); ?>

<fieldset class="main">
	<legend>Groupe</legend>
	
	<fieldset>
		<legend>Détails</legend>
		<strong><?php echo $groupe->getNomGroupe(); ?></strong>
		<br />
		<?php 
			$responsable=$groupe->getResponsable();
			if (!is_null($responsable))
				echo "<br />Responsable : <a href=\"annuaire.php?ex=".DETAILS_CONTACT."&id=".$responsable->getIdContact()."\">".$responsable->getNomContact()." ".$responsable->getPrenomContact()."</a><br />\n";
		?>
	</fieldset>

	
	<?php if (count($groupe->getMembres())>0) { ?>			
	<fieldset>
		<legend>Membres ( <?php echo count($groupe->getMembres()); ?> )</legend>
		<table>
		<?php 
			foreach ($groupe->getMembres() as $membre) {
                if ($membre!=NULL) 
    				echo "<tr><td><a href=\"annuaire.php?ex=".DETAILS_CONTACT."&id=".$membre->getIdContact()."\">".$membre->getNomContact()." ".$membre->getPrenomContact()."</a></td></tr>\n";
			}
		?>
		</table>
	</fieldset>
	<?php } ?>
</fieldset>


<?php require_once ("retour.php");?>
