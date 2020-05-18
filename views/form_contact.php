<?php global $options; ?>

<form action="" method="POST"  onsubmit="return checkInput(<?php echo CHECK_CONTACT; ?>)">
	<fieldset class="main">
		<legend class="titre"><?php echo $action; ?> contact</legend>
		<div id="error"></div>

		<fieldset>
			<legend>Détails</legend>
			Nom : <input type="text" name="nomContact" value="<?php echo $contact->getNomContact(); ?>" maxlength="45" size="30" />
			<br />
			Prénom : <input type="text" name="prenomContact" value="<?php echo $contact->getPrenomContact(); ?>" maxlength="45" size="30" />
			<br /><br />
			Sexe :
				<input type="radio" name="sexeContact" 	value="M" <?php echo (($contact->getSexeContact()=="M")?"checked":""); ?> />M
				<input type="radio" name="sexeContact" 	value="F" <?php echo (($contact->getSexeContact()=="F")?"checked":""); ?> />F
			<br /><br />
			Date de naissance : <input type="text" name="dateNaissance" class="" value="<?php echo (strlen($contact->getDateNaissance()))?datetostr($contact->getDateNaissance()):""; ?>" maxlength="10" size="10" /> <i>(jj/mm/aaaa)</i>
		</fieldset>

		<fieldset>
			<legend>Parents / Tuteurs / Personnes responsables</legend>
			Responsable 1 :
			<select name="idResponsable1"  id="responsable1">
				<option value="-1" selected></option>
			<?php
				foreach ($contacts as $othercontact)
					echo "<option value=".$othercontact->getIdContact()." ".(($contact->getResponsable1()==$othercontact->getIdContact())?"selected":"").">".$othercontact->getNomContact()." ".$othercontact->getPrenomContact()."</option>\n";
			?>
			</select>

			<?php if (!isset($options['notpl'])) { ?>
				<a href="javascript:popup('annuaire.php?ex=<?php echo SAISIE_CONTACT; ?>&notpl=1','contact1',<?php echo SAISIE_CONTACT; ?>);" >Ajouter contact</a>
			<?php } ?>

			<br /><br />
			Responsable 2 :
			<select name="idResponsable2" id="responsable2">
				<option value="-1" selected></option>
			<?php
				foreach ($contacts as $othercontact)
					echo "<option value=".$othercontact->getIdContact()." ".(($contact->getResponsable2()==$othercontact->getIdContact())?"selected":"").">".$othercontact->getNomContact()." ".$othercontact->getPrenomContact()."</option>\n";
			?>
			</select>

			<?php if (!isset($options['notpl'])) { ?>
				<a href="javascript:popup('annuaire.php?ex=<?php echo SAISIE_CONTACT; ?>&notpl=1','contact2',<?php echo SAISIE_CONTACT; ?>);" >Ajouter contact</a>
			<?php }?>
		</fieldset>

		<fieldset>
			<legend>Licence</legend>
			Numéro de licence : <input type="text" name="numLicence" value="<?php echo $contact->getLicence()->getNumLicence(); ?>" maxlength="10" size="10" />
			<br /><br />
			Date de qualification : <input type="text" name="dateQualification" class="date" value="<?php echo (strlen($contact->getLicence()->getDateQualification())?datetostr($contact->getLicence()->getDateQualification()):""); ?>" maxlength="10" size="10" /> <i>(jj/mm/aaaa)</i>
			<br /><br />
			<input type="checkbox" name="mutation"      <?php echo (($contact->getLicence()->getMutation())?"checked":""); ?> /> Mutation
			<input type="checkbox" name="surclassement" <?php echo (($contact->getLicence()->getSurclassement())?"checked":""); ?> /> Surclassement
			<input type="checkbox" name="brulure" 		<?php echo (($contact->getLicence()->getBrulure())?"checked":""); ?> /> Brulé
		</fieldset>

		<fieldset>
			<legend>Moyens de communication</legend>
			Adresse :<br />
			<input type="text" name="adresseL1" value="<?php echo $contact->getCommunication()->getAdresse()->getAdresseL1(); ?>" maxlength="120" size="80" /><br />
			<input type="text" name="adresseL2" value="<?php echo $contact->getCommunication()->getAdresse()->getAdresseL2();?>"  maxlength="120" size="80" /><br />

			<select name="idVille" id="ville">
				<option value="-1" selected></option>
			<?php
				foreach ($villes as $ville) {
					$idVilleContact=($contact->getCommunication()->getAdresse()->getVille()==NULL)?-1:$contact->getCommunication()->getAdresse()->getVille()->getIdVille();
					echo "<option value=".$ville->getIdVille()." ".(($idVilleContact==$ville->getIdVille())?"selected":"").">".cp($ville->getCPVille())." ".$ville->getNomVille()."</option>\n";
				}
			?>
			</select>

			<a href="javascript:popup('annuaire.php?ex=<?php echo SAISIE_VILLE; ?>&notpl=1','ville',<?php echo SAISIE_VILLE; ?>);">Ajouter commune</a>

			<br /><br />
			Téléphone 1 : <input type="text" name="tel1" value="<?php echo $contact->getCommunication()->getTel1(); ?>" maxlength="10" size="10" />
			<br /><br />

			Téléphone 2 : <input type="text" name="tel2" value="<?php echo $contact->getCommunication()->getTel2(); ?>" maxlength="10" size="10" />
			<br /><br />
			E-mail : <input type="text" name="email" value="<?php echo $contact->getCommunication()->getEmail(); ?>" maxlength="100" size="60"/>
		</fieldset>

		<fieldset>
			<legend>Groupes</legend>
			<?php
				if (count($groupes)) {
					$i=0;
					echo "<ul class=\"contact_grouplist\" id=\"groupe\">\n";
					foreach ($groupes as $groupe) {
						$found=array_search($groupe->getIdGroupe(),$contact->getGroupes())!==FALSE;
						echo "<li ".((($i++%2)==0)?"class=\"even\"":"")."><input type=\"checkbox\" name=\"groupes[]\" value=\"".$groupe->getIdGroupe()."\" ".(($found)?"checked":"")."/>".$groupe->getNomGroupe()."</li>\n";
					}
					echo "</ul>\n";
				}
			?>
			<div align="right"><a href="javascript:popup('annuaire.php?ex=<?php echo SAISIE_GROUPE; ?>&notpl=1','groupe',<?php echo SAISIE_GROUPE; ?>);" >Ajouter groupe</a></div>
		</fieldset>

		<fieldset>
			<legend>Notes</legend>
			<textarea rows="10" name="notes" class="notes"><?php echo $contact->getNotes(); ?></textarea>
		</fieldset>


		<input type="hidden" name="idContact" value="<?php echo $contact->getIdContact(); ?>" />
		<input type="button" name="annuler" value="Annuler" onclick="javascript:<?php echo (!isset($options['notpl']))?"window.location='annuaire.php';":"window.close();" ?>" class="submit" />
		<input type="submit" name="send" value="Valider" class="submit" />
		<br />
	</fieldset>
</form>

<div id="dialog"></div>
