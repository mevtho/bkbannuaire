<div class="barre_edition">
<?php
	echo "<ul class=\"icons barre_edition ui-widget ui-helper-clearfix\">\n";
	foreach($items as $key=>$item) {
		echo "<li class=\"barre_edition ui-state-default ui-corner-all\"><a href=\"".$item['url']."\" title=\"".$key."\"><span class=\"".$item['icon']."\" style=\"width:16px; float: left; margin-right: 0.3em;\">&nbsp;</span></a></li>\n";
	}
	echo "</ul>\n"; 
?>
</div>

