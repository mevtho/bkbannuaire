<?php global $options; ?>

<form action="" method="POST" onsubmit="return checkInput(<?php echo CHECK_VILLE; ?>)">
	<fieldset class="main">
		<legend><?php echo $action; ?> commune</legend>
		<div id="error"></div>
		
		<fieldset>
			<legend>Détails</legend>
			Nom : <input type="text" name="nomVille" value="<?php echo $ville->getNomVille(); ?>" maxlength="45" size="45"/>
			<br /><br />
			Code Postal : <input type="text" name="cpVille" value="<?php echo cp($ville->getCPVille()); ?>" maxlength="5" size="5" />
			<br />
		</fieldset>
		<input type="hidden" name="idVille" value="<?php echo $ville->getIdVille(); ?>" />
		<input type="button" name="annuler" value="Annuler" onclick="javascript:<?php echo (!isset($options['notpl']))?"window.location='annuaire.php';":"window.close();" ?>" class="submit" />
		<input type="submit" name="send" value="Valider" class="submit" />		
		<br />
	</fieldset>	
</form>