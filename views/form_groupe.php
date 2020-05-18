<?php global $options; ?>

<form action="" method="POST"  onsubmit="return checkInput(<?php echo CHECK_GROUPE; ?>)">
	<fieldset class="main">
		<legend><?php echo $action; ?> groupe</legend>
		<div id="error"></div>
	
		<fieldset>
			<legend>Détails</legend>
			Nom : <input type="text" name="nomGroupe" value="<?php echo $groupe->getNomGroupe(); ?>" maxlength="60" size="60"/>
			<br /><br />
			Responsable : 
			<select name="idResponsable">
				<option value="-1">Aucun</option>
			<?php 
				foreach ($contacts as $contact)
					echo "<option value=\"".$contact->getIdContact()."\"".(($groupe->isResponsable($contact))?" selected=\"selected\"":"").">".$contact->getNomContact()." ".$contact->getPrenomContact()."</option>\n";
			?>
			</select>
		</fieldset>
		<input type="hidden" name="idGroupe" value="<?php echo $groupe->getIdGroupe(); ?>" />
		<input type="button" name="annuler" value="Annuler" onclick="javascript:<?php echo (!isset($options['notpl']))?"window.location='annuaire.php';":"window.close();" ?>" class="submit" />
		<input type="submit" name="send" value="Valider" class="submit" />		
		<br />
	</fieldset>
</form>