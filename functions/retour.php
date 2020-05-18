<?php 
    global $_GET;
    if (!isset($_GET['notpl'])) {
    	$url="annuaire.php";
	    if (isset($_SERVER['HTTP_REFERER'])) {
		    if (strpos($_SERVER['HTTP_REFERER'],"ex=".SEARCH))
			    $url=$_SERVER['HTTP_REFERER'];
	    }
        echo "<a href=\"".$url."\">Retour</a>";
    }
?>