<?php

require_once ("config.php");

define ("DS",DIRECTORY_SEPARATOR);

define ("TABLE_CONTACT"       , $conf['database_table_prefix']."contact"           );
define ("TABLE_VILLE"         , $conf['database_table_commune_prefix']."ville"     );
define ("TABLE_MEMBRE_GROUPE" , $conf['database_table_prefix']."membre_groupe"     );
define ("TABLE_GROUPE"        , $conf['database_table_prefix']."groupe"            );

define("BASE_PATH"            ,realpath(dirname(__FILE__)."/..")                   );
define("CLASS_PATH"           ,BASE_PATH.DS."class".DS);
define("FUNCTIONS_PATH"       ,BASE_PATH.DS."functions".DS);
define("THEME_PATH"           ,BASE_PATH.DS."theme".DS);
define("IMAGE_PATH"           ,THEME_PATH."images".DS);
define("VIEWS_PATH"           ,BASE_PATH.DS."views".DS);
define("LIBS_PATH"            ,BASE_PATH.DS."libs".DS);

define("VIEWER", "16547873242153173");
define("EDITER", "98777543546645564");

$i=0;
define("HOME" , $i++);
define("DETAILS_CONTACT", $i++);
define("DETAILS_GROUPE", $i++);
define("DETAILS_VILLE", $i++);
define("LISTE_CONTACT", $i++);
define("LISTE_GROUPE", $i++);
define("LISTE_VILLE", $i++);
define("SAISIE_CONTACT", $i++);
define("SAISIE_GROUPE" , $i++);
define("SAISIE_VILLE"  , $i++);
define("DELETE_CONTACT", $i++);
define("DELETE_GROUPE" , $i++);
define("DELETE_VILLE"  , $i++);
define("CHECK_CONTACT", $i++);
define("CHECK_GROUPE" , $i++);
define("CHECK_VILLE"  , $i++);
define("SEARCH"	,$i++);
define("SEARCH_COMPLETION"	,$i++);
define("IMPRESSION", $i++);



?>