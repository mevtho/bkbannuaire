<?php

interface IForm {
	public function showForm ($_id=-1);
	public function processForm ($_vars);
	public function checkInput ($_vars);
	public function cloneForm ($_id=-1);
}

?>