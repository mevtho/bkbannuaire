<fieldset class="main">
	<legend>Impressions</legend>

	<fieldset>
		<legend>Critères de sélection</legend>
		<form name="recherche" onsubmit="rechercher(this); return false;">
			<table>
				<tr>
					<td colspan="2">ID Contact : <input type="text" name="idContact" maxlength="11" size="11" /></td>
				</tr>
				<tr>
					<td width="50%">Nom : <input type="text" name="nomContact" value="" maxlength="45" size="30" /></td>
					<td>Prénom : <input type="text" name="prenomContact" value="" maxlength="45" size="30" /></td>
				</tr>
				<tr>
					<td>
						Sexe :
							<input type="radio" name="sexeContact" 	value="All" checked />M/F
							<input type="radio" name="sexeContact" 	value="M" />M
							<input type="radio" name="sexeContact" 	value="F" />F
					</td>
					<td>Année de naissance : <input type="text" name="anneeNaissance" value="" maxlength="4" size="4" /> <i>(aaaa)</i></td>
				</tr>
				<tr>
					<td colspan="2">Numéro de licence : <input type="text" name="numLicence" value="" maxlength="7" size="7" /></td>
				</tr>
				<tr>
					<td>
						Ville :
							<select name="idVille" id="ville">
								<option value="-1" selected></option>
								<?php
									foreach ($villes as $ville) {
										echo "<option value=\"".$ville->getIdVille()."\">".cp($ville->getCPVille())." ".$ville->getNomVille()."</option>\n";
									}
								?>
							</select>
					</td>
					<td>
						Groupe :
							<select name="idGroupe" id="groupe">
							<option value="-1" selected></option>
							<?php
								foreach ($groupes as $groupe) {
									echo "<option value=\"".$groupe->getIdGroupe()."\">".$groupe->getNomGroupe()."</option>\n";
								}
							?>
							</select>
					</td>
				</tr>
			</table>
			<hr>
			<input type="submit" value="Rechercher" class="submit" />
			<input type="reset" value="Réinitialiser" class="submit" />
		</form>
	</fieldset>

	<fieldset class="results">
		<legend>Résultat</legend>
		<div class="ctf" style="display:none">
			<div id="results"></div>
		</div>
	</fieldset>

	<fieldset>
		<legend>Options de génération</legend>
		<form name="settingsGeneration" method="GET" action="generation.php" onsubmit="populateIds()" target="_blank" >
			Intitulé : <input type="text" name="libelle" size="50" maxlength="150" />
			<br />
			Format sortie :
				<select name="output" id="output">
					<?php
						foreach ($outputs as $koutput => $voutput) {
							echo "<option value=\"".$koutput."\">".$voutput."</option>\n";
						}
					?>
				</select>

			<br /><br />

			<fieldset>
				<legend>Afficher</legend>
				<table width="100%"><tr valign="top"><td width="33%">
					<input type="checkbox" name="nomContact" value="1" checked/>Nom<br />
					<input type="checkbox" name="prenomContact" value="1" checked/>Prénom<br />
					<input type="checkbox" name="sexeContact" value="1" />Sexe<br />
					<input type="checkbox" name="dateNaissanceContact" value="1" />Date de Naissance<br />
					<input type="checkbox" name="responsable1Contact" value="1" />Responsable 1<br />
					<input type="checkbox" name="responsable2Contact" value="1" />Responsable 2<br />
				</td><td  width="33%">
					<input type="checkbox" name="numLicenceContact" value="1" />Numéro de Licence<br />
					<input type="checkbox" name="mutationContact" value="1" />Mutation<br />
					<input type="checkbox" name="surclassementContact" value="1" />Surclassement<br />
					<input type="checkbox" name="dateQualificationContact" value="1" />Date de Qualification<br />
					<input type="checkbox" name="adresseContact" value="1" />Adresse<br />
					<input type="checkbox" name="villeContact" value="1" />Ville<br />
				</td><td  width="33%">
					<input type="checkbox" name="tel1Contact" value="1" />Téléphone 1<br />
					<input type="checkbox" name="tel2Contact" value="1" />Téléphone 2<br />
					<input type="checkbox" name="emailContact" value="1" />Email<br />
				</td></tr></table>

				<br />
			</fieldset>

			<input type="hidden" name="ids" value="ttttttttttttt" />
			<input type="submit" value="Générer" class="submit" />
		</form>
	</fieldset>

</fieldset>

<?php require_once ("retour.php");?>
