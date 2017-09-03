<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Paramètres mail</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Accueil</a></li>
	<li><a href="/mailsetting-list.php">Réglages des e-mails</a></li>
	<li class="active">Création</li>
</ol>


<!-- Authentication -->
<?php require_once('functions/setting/setting-update-authentication.php'); ?>

<!-- Create a new setting : Controller -->
<?php include 'functions/controller/mailsetting-create-controller.php'; ?>

<!-- Page content container -->
<div class="container">

	<div class="page-header">
		<h2>Réglages des e-mails <small>Ajout d'un paramètre</small></h2>
	</div>

	<!-- Update setting : Operation status indicator -->
	<?php include 'components/operation-status-indicator.php'; ?>


	<!-- Create a setting : display form -->
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Creation d'un paramètre</h3>
		</div>
		<div class="panel-body">
			<?php require_once('components/setting/mailsetting-create-form.php'); ?>
		</div>
	</div>

</div>

<?php include('components/footer.php'); ?>

<script text='text/javascript'>
	$('#auto-validation-form').validate();
</script>

</body>
</html>
