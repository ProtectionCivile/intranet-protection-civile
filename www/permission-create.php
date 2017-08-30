<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Gestion des permissions</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Accueil</a></li>
	<li><a href="/permission-list.php">Gestion des permissions</a></li>
	<li class="active">Création</li>
</ol>


<!-- Authentication -->
<?php $rbac->enforce("admin-permissions-update", $currentUserID); ?>

<!-- Create a new permission by title : Controller -->
<?php include 'functions/controller/permission-create-controller.php'; ?>

<!-- Page content container -->
<div class="container">

	<div class="page-header">
		<h2>Gestion des permissions <small>Création</small></h2>
	</div>

	<!-- Update permission : Operation status indicator -->
	<?php include 'components/operation-status-indicator.php'; ?>


	<!-- Create a permission : Container -->
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Création d'une permission</h3>
		</div>
		<div class="panel-body">

			<!-- Create a permission by title : display form -->
			<div class="panel panel-default">
				<div class="panel-heading">Au niveau racine</div>
				<div class="panel-body">
					<?php require_once('components/permission/permission-create-form-root.php'); ?>
				</div>
			</div>

			<!-- Create a permission by path : display form -->
			<div class="panel panel-default">
				<div class="panel-heading">Au niveau personnalisable</div>
				<div class="panel-body">
					<?php require_once('components/permission/permission-create-form-path.php'); ?>
				</div>
			</div>

		</div>
	</div>

</div>


<?php include('components/footer.php'); ?>

<script text='text/javascript'>
	$('#auto-validation-form').validate();
</script>

</body>
</html>
