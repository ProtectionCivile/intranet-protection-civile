<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Créer un rôle</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="#">Administration</a></li>
	<li><a href="/role-view.php">Gestion des rôles</a></li>
	<li class="active">Création</li>
</ol>


<!-- Authentication -->
<?php $rbac->enforce("admin-roles-update", $currentUserID); ?>


<!-- Create a new role : Controller -->
<?php include 'functions/controller/role-create-controller.php'; ?>


<!-- Page content container -->
<div class="container">

	<!-- Update role : Operation status indicator -->
	<?php include 'components/operation-status-indicator.php'; ?>

	<h2>Gestion des roles</h2>


	<!-- Create a role : display form -->
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Création d'un rôle</h3>
		</div>
		<div class="panel-body">
			<form class="form-horizontal" action='' method='post' accept-charset='utf-8'>
				<input type="hidden" id="wish" name="addRole">
			

				<?php if (!empty($createErrorTitle)){ ?>
					<div class="form-group has-error has-feedback">
						<label for="inputRoleTitle" class="col-sm-4 control-label">Titre</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="inputRoleTitle" name="inputRoleTitle" aria-describedby="inputError2Status" placeholder="ex: Directeur Local des Opérations" value="<?php echo $title;?>">
						</div>
						<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true" />
						<span id="inputError2Status" class="sr-only">(error)</span>
					</div>
				<?php } else { ?>
					<div class="form-group">
						<label for="inputRoleTitle" class="col-sm-4 control-label">Titre</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="inputRoleTitle" name="inputRoleTitle" aria-describedby="inputError2Status" placeholder="ex: Directeur Local des Opérations">
						</div>
					</div>
				<?php } ?>

				<div class="form-group">
					<label for="inputRoleDescription" class="col-sm-4 control-label">Description</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="inputRoleDescription" name="inputRoleDescription" placeholder="Description ?"
						<?php
							if (isset($_POST['addRole']) && isset($_POST['genericError'])) {
								echo "value='$description'";
							}
						?>
						/>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<?php if (empty($genericSuccess)){ ?>
							<a class="btn btn-default" href="role-view.php" role="button">Annuler - Retour à la liste</a>
						<?php } ?>
						<button type="submit" class="btn btn-success">Créer</button>
						<?php if (isset($_POST['addRole']) && !empty($genericSuccess)) { ?>
							<a class="btn btn-default" href="role-view.php" role="button">J'ai terminé ! Retour à la liste</a>
						<?php } ?>
				   </div>
				</div>
			</form>
		</div>
	</div>

</div>

<?php include('components/footer.php'); ?>
</body>
</html>
