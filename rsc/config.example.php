<?php

ini_set("default_charset", "");

$conf=array();

$conf['saison']=$_COOKIE['Season'];

$conf['database_user']="";
$conf['database_host']="";
$conf['database_password']="";
$conf['database_name']="";

$conf['database_table_prefix']="an".$conf['saison']."_";
$conf['database_table_commune_prefix']="an_";

$conf['titre']="bkbAnnuaire";

?>
