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
	<li class='active'>Utilisation</li>
</ol>


<!-- Authentication -->
<?php //$rbac->enforce("picture-editor-use", $currentUserID); ?>

<!-- Add logo to picture : Controller -->
<?php include 'functions/controller/picture-add-logo-controller.php'; ?>

<!-- Page content container -->
<div class="container">

	<div class="page-header">
		<h2>Cartouche sur photo <small>Pour ajouter facilement le logo Protec dans vos photos</small></h2>
	</div>

	<!-- Update picture : Operation status indicator -->
	<?php include 'components/operation-status-indicator.php'; ?>



	<!-- @Benoit, Le code est à mettre ici -->






</div>

<?php include('components/footer.php'); ?>
</body>
</html>
