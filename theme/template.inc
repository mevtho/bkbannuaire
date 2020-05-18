<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "DTD/xhtml1-strict.dtd">
<html>
<head>
	<title>Annuaire - Saison <?php echo saisonEnCours(); ?> - </title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" type="text/css" href="theme/jquery-ui/jquery-ui-1.7.1.custom.css" />
	<link rel="stylesheet" type="text/css" href="theme/style.css" />
	<link rel="shortcut icon" href="theme/images/favicon.ico" />
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.7.1.custom.min.js"></script>
	<script type="text/javascript" src="js/ui.datepicker-fr.js"></script>
	<script type="text/javascript" src="js/jquery.auto-complete.js"></script>
	<script type="text/javascript" src="js/jquery.confirm.js"></script>
	<script type="text/javascript" src="js/annuaire.js"></script>
</head>
<body>
<div class="head">
    <div class="headlogo"></div>
    <div class="titre"><?php echo titre(); ?></div>
    <div class="saison"><?php echo saisonEnCours(); ?></div>
    <div class="menuhaut"><?php menu(); ?></div>
</div>

<div class="center">
	<div class="content">
		<?php route(); ?>
	</div>
</div>

<div class="foot">
    <div class="menu"><?php menu(); ?></div>
    <div class="credits">
	    <a href="mailto:thomas.sapela@mevtho.com" class="credits">Thomas MEVEL</a>, <?php echo date("Y"); ?>
    </div>
</div>

</body>
</html>
