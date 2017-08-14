<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Liste des DPS</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8";>
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
	</head>
<body>
<?php require_once('components/header.php'); ?>
<?php require_once('functions/dps/dps-view-functions.php'); ?>


<!-- Authentication -->
<?php //require_once('functions/dps/dps-authentication.php'); ?>


<!-- Page content container -->
<div class="container">


	<?php $base_url="nico.php"; ?>

	<!-- Beginning of the filter's parent module -->
	<?php //include_once('components/filter/module-dps-list-filter.php'); ?>

	<?php //require_once('functions/dps/dps-filter-interpretor.php'); ?>

	<?php //require_once('components/filter/parts/paging-interpretor.php'); ?>
	
	<br />

	<?php
	$texte="example";
	echo $texte." -> ".mysqli_real_escape_string($db_link, $texte)." -> ".mysqli_real_escape_string($db_link, mysqli_real_escape_string($db_link, $texte))."<br />";

	$texte="ceci 'est' un texte";
	echo $texte." -> ".mysqli_real_escape_string($db_link, $texte)." -> ".mysqli_real_escape_string($db_link, mysqli_real_escape_string($db_link, $texte))."<br />";

	$texte="oui/je/sais";
	echo $texte." -> ".mysqli_real_escape_string($db_link, $texte)." -> ".mysqli_real_escape_string($db_link, mysqli_real_escape_string($db_link, $texte))."<br />";

	$texte="très\bien";
	echo $texte." -> ".mysqli_real_escape_string($db_link, $texte)." -> ".mysqli_real_escape_string($db_link, mysqli_real_escape_string($db_link, $texte))."<br />";


	?>

	<?php //require_once('components/filter/parts/filter-paging-display.php'); ?>








</div>
<?php require ('components/footer.php'); ?>
</body>
</html>