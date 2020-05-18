<?php

// What //
global $ex, $id;
$ex = (isset($_GET['ex']) && (int)$_GET['ex']!=0)?(int)$_GET['ex']:LISTE_CONTACT;
$id = (isset($_GET['id']) && (int)$_GET['id']>0)?(int)$_GET['id']:-1;

// Path //
$dir_to_include=array(CLASS_PATH."dataobjects",
					  CLASS_PATH."dbqueries",
					  CLASS_PATH."controls",
					  FUNCTIONS_PATH,
					  THEME_PATH,
					  VIEWS_PATH,
                      LIBS_PATH);
ini_set('include_path', ini_get('include_path').PATH_SEPARATOR.implode(PATH_SEPARATOR,$dir_to_include));
unset($dir_to_include);

// Access //
require_once ("access.php");

if (!isLogged())
	header("Location:index.php");

// Acces Base de données //
require_once ("CAccesDB.php");
CAccesDB::createAcces($conf['database_user'],$conf['database_password'],$conf['database_host'],$conf['database_name']);


// Utilitaires //
require_once ("utils.php");

// Design //
require_once ("design.php");

// Menu //
require_once ("menu.php");



?>