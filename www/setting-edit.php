<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Paramètres généraux</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Accueil</a></li>
	<li><a href="/setting-list.php">Réglages de l'application</a></li>
	<li class="active">Modification</li>
</ol>


<!-- Authentication -->
<?php require_once('functions/setting/setting-update-authentication.php'); ?>

<!-- Common -->
<?php include 'functions/controller/setting-common.php'; ?>

<!-- Create a new setting : Controller -->
<?php include 'functions/controller/setting-update-controller.php'; ?>


<!-- Page content container -->
<div class="container">

	<div class="page-header">
		<h2>Réglages de l'application <small>Modification du paramètre <?php echo htmlentities($name); ?></small></h2>
	</div>

	<!-- Operation status indicator -->
	<?php include 'components/operation-status-indicator.php'; ?>

	<!-- Update a setting : display form -->
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Modification d'un paramètre</h3>
		</div>
		<div class="panel-body">
			<?php require_once('components/setting/setting-edit-form.php'); ?>
		</div>
	</div>
</div>

<?php include('components/footer.php'); ?>

<script text='text/javascript'>
	$('#auto-validation-form').validate();
</script>

</body>
</html>
