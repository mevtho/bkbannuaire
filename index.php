<?php

require_once("rsc/saison.php");

$err="";

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
	require_once("rsc/access.php");
	
    $idSaison = array_key_exists($_POST["saison"], $saisons) ? $_POST["saison"] : $saisons[0];
    
	if (md5($_POST['password']) == $access['Viewer']) {
		setcookie("Access", VIEWER, time()+3600);  /* expire in 1 hour */
        setcookie("Season", $_POST["saison"], time()+3600); 
		header("Location:annuaire.php");
		exit();
	}
	else if (md5($_POST['password']) == $access['Editer']) {
		setcookie("Access", EDITER, time()+3600);  /* expire in 1 hour */
        setcookie("Season", $_POST["saison"], time()+3600);
		header("Location:annuaire.php");
		exit();
	}
	else
		$err = "Mot de passe erroné.";

}

setcookie("Access");
setcookie("Season");

?>

<html>
	<head>
		<title>bkbAnnuaire - Identification</title>
		<link rel="stylesheet" type="text/css" href="theme/jquery-ui/jquery-ui-1.7.1.custom.css" />
		<link rel="stylesheet" type="text/css" href="theme/style.css" />
		<link rel="shortcut icon" href="theme/images/favicon.ico">
		<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.7.1.custom.min.js"></script>
		<script type="text/javascript" src="js/ui.datepicker-fr.js"></script>
		<script type="text/javascript" src="js/jquery.auto-complete.js"></script>
		<script type="text/javascript" src="js/jquery.confirm.js"></script>
		<script type="text/javascript" src="js/annuaire.js"></script>
	 <style type="text/css">
		body { font-size: 80%; color:#FFFFFF; }
		label, input { display:block; }
		input.text { width:80%; padding: .4em; }
		fieldset { padding:0; border:0; margin-top:10px; }
		form { padding :0; }
		.ui-button { outline: 0; margin:0; text-decoration:none;  !important; cursor:pointer; position: relative; text-align: center; }
		.ui-dialog-title { vertical-align : center; padding :0; }
		.ui-dialog-content { margin :0; }
		.ui-dialog-buttonpane { background-color : transparent; border:0; padding:0;  }
		</style>
	</head>
	<body>
	

	<script type="text/javascript">
	$(function() {		
		var password = $("#password"),
			allFields = $([]).add(password),
			tips = $("#validateTips");

		$("#dialog").dialog({
			dialogClass: 'dialogidentification',
			title: '<img src="theme/images/logo.png" width="24" /> Identification',
			resizable: false,
			bgiframe: true,
			autoOpen: true,
			modal: true,
			buttons: {
				'OK': function() {
					$("form").submit();
					$(this).dialog('close');
				}
			}
		});
	});
	</script>


<div id="dialog">
	<form method="POST">
	<fieldset>
		<label for="password">Mot de passe :</label>
		<input type="password" name="password" id="password" class="text ui-widget-content ui-corner-all" /><br />
		<?php if (strlen($err)>0) echo "<font color=\"#FF0000\">".$err."</font>"; ?>
        <label for="saison">Saison :</label>
		<select name="saison" id="saison" class="ui-widget-content ui-corner-all">
        <?php
            foreach ($saisons as $key => $saison)
                echo "<option value=\"".$key."\" ".(($saison == $saisons[0])?"selected":"").">".$saison."</option>\n";
        ?>
        </select>
	</fieldset>
	</form>
</div>

	</body>
</html>