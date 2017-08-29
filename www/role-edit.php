<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Modifier un rôle</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Accueil</a></li>
	<li><a href="/role-list.php">Gestion des rôles</a></li>
	<li class="active">Modification</li>
</ol>


<!-- Authentication -->
<?php require_once('functions/role/role-update-authentication.php'); ?>

<!-- Common -->
<?php include 'functions/controller/role-common.php'; ?>

<?php
	if(empty($commonError)) {
?>

	<!-- Update role : Controller -->
	<?php include 'functions/controller/role-update-controller.php'; ?>


	<!-- Page content container -->
	<div class="container">

		<div class="page-header">
			<h2>Gestion des rôles <small>Modification de '<?php echo $role_title ?>'</small></h2>
		</div>

		<!-- Update role : Operation status indicator -->
		<?php include 'components/operation-status-indicator.php'; ?>


		<!-- Update role : display form -->
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Informations à mettre à jour</h3>
			</div>
			<div class="panel-body">
				<?php require_once('components/role/role-edit-form.php'); ?>
			</div>
		</div>

	</div>

<?php
	}
?>

<?php include('components/footer.php'); ?>

<script text='text/javascript'>
	$('#auto-validation-form').validate();
</script>

</body>
</html>
