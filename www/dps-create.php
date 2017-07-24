<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Créer un DPS</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>




<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="#">Opérationnel</a></li>
	<li><a href="dps-list-view.php">Dispositifs de secours</a></li>
	<li class="active">Création</li>
</ol>


<!-- Compute city calculation according to POST & GET variables (before auth)-->
<?php require_once('functions/dps/dps-compute-city.php'); ?>

<!-- Authentication -->
<?php require_once('functions/dps/dps-create-authentication.php'); ?>

<!-- DPS duplication or client insertion : interpretor -->
<?php require_once('components/dps/dps-preselect-client-or-duplicate-computation.php'); ?>

<!-- Create a new DPS : Controller -->
<?php require_once('functions/controller/dps-create-controller.php'); ?>

<!-- Page content container -->
<div class="container">

	<!-- Update : Operation status indicator -->
	<?php require_once('components/operation-status-indicator.php'); ?>

	<h2><center>Création d'un Dispositif Prévisionnel de Secours</center></h2>
	<h3><center><?php echo $cu_full; ?></center></h3>


	<!-- Notice after DPS duplication -->
	<?php if(isset($_POST['duplicate_dps'])){?>
		<div class='alert alert-warning'>
			<span class="glyphicon glyphicon-alert" style="font-size:2em"></span>
			<strong> Attention : </strong>Tous les champs ne sont pas dupliqués.	Vous devez vérifier tous les champs avant d'envoyer en validation.
		</div>
	<?php }?>



	<!-- Panel Accès spécial DDO : préselect section -->
	<?php require_once('components/dps/dps-create-ddo-access-select-section.php'); ?>


	<!-- Panel d'aide à la création de DPS -->
	<?php require_once('components/dps/dps-preselect-client-or-duplicate-module.php'); ?>


	<!-- Formulaire de création de DPS -->
	<?php require_once('components/dps/dps-create-form.php'); ?>

</div>


<script src='js/dps-compute-ris.js' type='text/javascript'></script>

<?php require_once('components/footer.php'); ?>

<script text='text/javascript'>
	$('#auto-validation-form').validate();
</script>
</body>
</html>
