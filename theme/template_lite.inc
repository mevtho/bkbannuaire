<?php ini_set("display_errors","on"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "DTD/xhtml1-strict.dtd">
<html>
<head>
	<title>Annuaire - Saison <?php echo saisonEnCours(); ?> - </title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" type="text/css" href="theme/jquery-ui/jquery-ui-1.7.1.custom.css" />
	<link rel="stylesheet" type="text/css" href="theme/style.css" />
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.7.1.custom.min.js"></script>
	<script type="text/javascript" src="js/ui.datepicker-fr.js"></script>
	<script type="text/javascript" src="js/jquery.auto-complete.js"></script>
	<script type="text/javascript" src="js/annuaire.js"></script>
	
</head>
<body>

<div class="center">
	<div class="content">
		<?php route(); ?>
		<?php close_popup(); ?>
	</div>
</div>

</body>
</html>
