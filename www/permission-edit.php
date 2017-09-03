<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Modifier une permission</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Accueil</a></li>
	<li><a href="/permission-list.php">Gestion des permissions</a></li>
	<li class="active">Modification</li>
</ol>


<!-- Authentication -->
<?php $rbac->enforce("admin-permissions-update", $currentUserID); ?>

<!-- Common -->
<?php include 'functions/controller/permission-common.php'; ?>


	<!-- Update permission : Controller -->
	<?php include 'functions/controller/permission-update-controller.php'; ?>


	<!-- Page content container -->
	<div class="container">

		<div class="page-header">
			<h2>Gestion des permissions <small>Modification de '<?php echo htmlentities($permission_title) ?>'</small></h2>
		</div>

		<!-- Update permission : Operation status indicator -->
		<?php include 'components/operation-status-indicator.php'; ?>


		<!-- Update permission : display form -->
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Informations à mettre à jour</h3>
			</div>
			<div class="panel-body">
				<?php require_once('components/permission/permission-edit-form.php'); ?>
			</div>
		</div>

	</div>

<?php include('components/footer.php'); ?>

<script text='text/javascript'>
	$('#auto-validation-form').validate();
</script>

</body>
</html>
