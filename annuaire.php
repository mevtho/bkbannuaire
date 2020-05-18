<?php ini_set("display_errors","on"); ?>
<?php

require_once("rsc/rsc.php");
require_once("route.php");
require_once("menu.php");
require_once("options.php");

if (!isset($_GET['notpl']))
	include("template.inc");
else
	include("template_lite.inc");
?>

 	