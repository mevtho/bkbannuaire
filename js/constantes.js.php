<?php 
require_once ("../rsc/constant.php");

$constantes = get_defined_constants(true);
foreach($constantes['user'] as $key => $value) {
	if ((int)$value>0)
		echo $key."=".$value.";\n";
}

?>
