<div id="autocomplete">
	<input type="hidden" name="href" value="json.php?ex=<?php echo SEARCH_COMPLETION; ?>" />
	<fieldset style="display:inline;">
		<legend>Filtrer</legend>
		<input type="text" size="40" name="searchfit" autocomplete="on" value="" style="float:left; margin-right:20px;"/>
		<a href="#" style="float:left; height:20px; width:20px; " class="icons lnk_icon ui-widget ui-helper-clearfix ui-state-default ui-corner-all">
			<span class="ui-icon ui-icon-search" style="width:16px; margin:2px;">&nbsp;</span>
		</a>
		<ul class="searchresults"></ul>
	</fieldset>
	<!--  <form method="GET" action="annuaire.php" name="search_panel">
		<input type="hidden" name="ex" value="<?php echo SEARCH; ?>" />
		<input type="hidden" name="id" value="" />
		<input type="hidden" name="q" value="" />
	</form>
	 -->
</div>