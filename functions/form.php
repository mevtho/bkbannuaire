<?php

function form ($_form) {
	global $_SERVER, $_GET, $_POST, $id;
	if (strtolower($_SERVER['REQUEST_METHOD'])=="get") {
		if (!isset($_GET['duplicate'])) {
			$_form->showForm($id);
		}
		else {
			$_form->cloneForm($id);
		}
		return false;
	}
	else {
		$ok=$_form->checkInput($_POST);
		if ($ok===true)
			$_form->processForm($_POST);
		return $ok;
	}
}

?>