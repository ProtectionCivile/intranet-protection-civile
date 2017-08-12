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
	<li><a href="dps-list-view.php">Dispositifs de secours</a></li>
	<li class="active">Modification</li>
</ol>


<!-- Compute city calculation according to POST & GET variables (before auth)-->
<?php require_once('functions/dps/dps-compute-city.php'); ?>

<!-- Common -->
<?php include ('functions/controller/dps-common.php'); ?>

<!-- Authentication -->
<?php require_once('functions/dps/dps-create-authentication.php'); ?>

<!-- Update a DPS : Controller -->
<?php require_once('functions/controller/dps-update-controller.php'); ?>

<!-- Page content container -->
<div class="container">

	<h2 class='text-center'>DPS <?php echo $cu_full; ?></h2>

	<!-- Update : Operation status indicator -->
	<?php require_once('components/operation-status-indicator.php'); ?>

	<?php if (empty($genericError)) { ?>

		<!-- Affichage de statut de DPS -->
		<?php require_once('components/dps/dps-workflow-display-status-module.php'); ?>

		<!-- Formulaire de modification de statut du DPS -->
		<?php require_once('components/dps/dps-workflow-update-status-module.php'); ?>

		<!-- Form to upload files -->
	  <?php require_once('components/dps/dps-files-upload-panel.php'); ?>

		<!-- Formulaire de création de DPS -->
		<?php require_once('components/dps/dps-edit-form.php'); ?>

	<?php } ?>

</div>

<?php require_once('components/footer.php'); ?>


</body>
</html>
