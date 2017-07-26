<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Modifier un DPS</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="#">Opérationnel</a></li>
	<li><a href="dps-list-view.php">Dispositifs de secours</a></li>
	<li class="active">Modification</li>
</ol>


<!-- Compute city calculation according to POST & GET variables (before auth)-->
<?php require_once('functions/dps/dps-compute-city.php'); ?>

<!-- Authentication -->
<?php require_once('functions/dps/dps-create-authentication.php'); ?>


<!-- Create a new DPS : Controller -->
<?php require_once('functions/controller/dps-update-controller.php'); ?>

<!-- Page content container -->
<div class="container">

	<!-- Update : Operation status indicator -->
	<?php require_once('components/operation-status-indicator.php'); ?>

	<h2><center>Modification d'un Dispositif Prévisionnel de Secours</center></h2>
	<h3><center><?php echo $cu_full; ?></center></h3>


	<!-- Formulaire de création de DPS -->
	<?php require_once('components/dps/dps-update-form.php'); ?>

</div>

<?php require_once('components/footer.php'); ?>


</body>
</html>
