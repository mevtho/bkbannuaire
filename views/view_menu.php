<?php 

function line($_name, $_link, $_indent) {
	$is_array=is_array($_link);
	$href=($is_array)?"#":$_link;
	$onclick=($is_array)?"onclick=\"javascript:display('".$_name."');\"":"";
	
	echo "<li class=\"menu\" style=\"padding-left:".($_indent*0.5)."em;\"> [ <a href=\"".$href."\" $onclick>".$_name."</a> ]";
		
	if ($is_array)
		showMenu($_link, $_name);
	echo "</li>\n";
}

function showMenu($_menu, $_parent="") {
	static $level=-1;
	$add=(strlen($_parent)>0)?"id=\"".$_parent."\" style=\"display:none\"":"";
	$level++;
	echo "<ul class=\"menu\" ".$add.">\n";
	foreach ($_menu as $name => $link) {
		line($name, $link, $level);
	}
	echo "</ul>\n";
	$level--;
}
?>