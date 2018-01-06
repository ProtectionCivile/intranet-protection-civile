<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Cartoucheur de photo</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href='/'>Accueil</a></li>
	<li><a href='picture-logo-appender.php'>Cartoucheur de photo</a></li>
	<li class='active'>Réglages</li>
</ol>


<!-- Authentication -->
<?php $rbac->enforce("picture-editor-update-settings", $currentUserID); ?>

<!-- Add logo to picture : Controller -->
<?php include 'functions/controller/picture-update-settings-controller.php'; ?>

<!-- Page content container -->
<div class="container">

	<div class="page-header">
		<h2>Réglages du cartouche <small>Modifiez les réglages de l'apposition du logo dans la photo</small></h2>
	</div>

	<!-- Update picture : Operation status indicator -->
	<?php include 'components/operation-status-indicator.php'; ?>



	<!-- @Benoit, Le code est à mettre ici -->






</div>

<?php include('components/footer.php'); ?>
</body>
</html>
