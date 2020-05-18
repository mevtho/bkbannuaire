<?php barreEdition($nex); ?>

<fieldset class="main">
	<legend>Contact</legend>

	<fieldset>
		<legend>Détails</legend>
		<strong><?php echo $contact->getPrenomContact(); ?> <?php echo $contact->getNomContact(); ?></strong>
		<br />
		Sexe : <?php echo ($contact->getSexeContact()=="M")?"Masculin":"Féminin"; ?>
		<br />
		<?php if (strlen(datetostr($contact->getDateNaissance()))) { ?>
            Né<?php echo ($contact->getSexeContact()=="F")?"e":""; ?> le : <?php echo datetostr($contact->getDateNaissance()); ?>
        <?php } ?>

		<?php if (count($contact->getGroupes())) { ?>
			<?php
				echo "<br>Groupe".((count($contact->getGroupes())==1)?"":"s")." : ";
				$sep="";
				foreach ($contact->getGroupes() as $groupe) {
					echo $sep."<a href=\"annuaire.php?ex=".DETAILS_GROUPE."&id=".$groupe->getIdGroupe()."\">".$groupe->getNomGroupe()."</a>";
					$sep=" | ";
				}
			?>
		<?php } ?>
	</fieldset>

	<?php if (!is_null($contact->getResponsable1()) || !is_null($contact->getResponsable2())){ ?>
		<fieldset>
			<legend>Parents / Tuteurs / Personnes responsables</legend>
			Responsable 1 :
			<?php
				if (!is_null($contact->getResponsable1()))
					echo "<a href=\"annuaire.php?ex=".DETAILS_CONTACT."&id=".$contact->getResponsable1()->getIdContact()."\">".$contact->getResponsable1()->getPrenomContact()." ".$contact->getResponsable1()->getNomContact()."</a>";
			?>

			<br /><br />
			Responsable 2 :
			<?php
				if (!is_null($contact->getResponsable2()))
					echo "<a href=\"annuaire.php?ex=".DETAILS_CONTACT."&id=".$contact->getResponsable2()->getIdContact()."\">".$contact->getResponsable2()->getPrenomContact()." ".$contact->getResponsable2()->getNomContact()."</a>";
			?>
		</fieldset>
	<?php } ?>

	<?php if (!is_null($contact->getLicence()) && strlen($contact->getLicence()->getNumLicence())) { ?>
		<fieldset>
			<legend>Licence</legend>
			Numéro : <?php echo $contact->getLicence()->getNumLicence(); ?>
			<?php echo (($contact->getLicence()->getMutation())?", Muté":""); ?>
			<?php echo (($contact->getLicence()->getSurclassement())?", Surclassé":""); ?>
			<?php echo (($contact->getLicence()->getBrulure())?", <img src=\"theme/images/brulure.png\" alt=\"Brulé\" title=\"Brulé\"/> Brulé":""); ?>
			<br />
    		<?php if (strlen(datetostr($contact->getLicence()->getDateQualification()))) { ?>
	    		Date de qualification : <?php echo datetostr($contact->getLicence()->getDateQualification()); ?><br />
            <?php } ?>

		</fieldset>
	<?php } ?>

	<fieldset>
		<legend>Moyens de communication</legend>
		<?php
			$adresse=$contact->getCommunication()->getAdresse();
			if (strlen($adresse->getAdresseL1()) || strlen($adresse->getAdresseL2()) || !is_null($adresse->getVille())) { ?>
			Adresse :<br />
			<?php echo (strlen($adresse->getAdresseL1()))?$adresse->getAdresseL1()."<br />":""; ?>
			<?php echo (strlen($adresse->getAdresseL2()))?$adresse->getAdresseL2()."<br />":""; ?>
			<?php echo (!is_null($adresse->getVille()))?$adresse->getVille()->getCPVille()." ".$adresse->getVille()->getNomVille()."<br />":""; ?>
			<br />
		<?php } ?>
		<?php if (strlen($contact->getCommunication()->getTel1())>0) { ?>
			Téléphone 1 : <?php echo strinttophone($contact->getCommunication()->getTel1()); ?>
			<br />
		<?php }	?>
		<?php if (strlen($contact->getCommunication()->getTel2())>0) { ?>
		    Téléphone 2 : <?php echo strinttophone($contact->getCommunication()->getTel2()); ?>
		    <br /><br />
		<?php }	?>
        <?php if (strlen($contact->getCommunication()->getEmail())) { ?>
    		E-mail : <a href="mailto:<?php echo $contact->getCommunication()->getEmail(); ?>"><?php echo $contact->getCommunication()->getEmail(); ?></a>
        <?php } ?>
	</fieldset>

	<?php if (strlen($contact->getNotes())>0) { ?>
		<fieldset>
			<legend>Notes</legend>
			<?php echo str_replace("\n","<br />", $contact->getNotes()); ?>
		</fieldset>
	<?php } ?>

</fieldset>

<?php require_once ("retour.php");?>
