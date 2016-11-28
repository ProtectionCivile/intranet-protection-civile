<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Modifier un rôle</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8";>
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="#">Administration</a></li>
	<li><a href="/role-view.php">Gestion des rôles</a></li>
	<li class="active">Modification</li>
</ol>

<!-- Common -->
<?php include 'functions/controller/role-common.php'; ?>

<?php 
	if(empty($commonError)) {
?>

	<!-- Update role : Controller -->
	<?php include 'functions/controller/role-update-controller.php'; ?>


	<!-- Page content container -->
	<div class="container">

		<!-- Update role : Operation status indicator -->
		<?php include 'functions/operation-status-indicator.php'; ?>


		<h2>Modifier le rôle '<?php echo $roleTitle ?>'</h2>


		<!-- Update role : display form -->
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Informations à mettre à jour</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" action='' method='post' accept-charset='utf-8'>
					<input type="hidden" name="updateRole">
					<input type="hidden" name="roleID" value="<?php echo $roleID;?>">
				
					<?php if (!empty($updateErrorTitle)){ ?>
						<div class="form-group has-error has-feedback">
							<label for="inputRoleTitle" class="col-sm-4 control-label">Nouveau titre</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="inputRoleTitle" name="inputRoleTitle" aria-describedby="inputError2Status" placeholder="Directeur Local des Opérations" value="<?php echo $title;?>">
							</div>
							<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
							<span id="inputError2Status" class="sr-only">(error)</span>
						</div>
					<?php } else { ?>
						<div class="form-group">
							<label for="inputRoleTitle" class="col-sm-4 control-label">Nouveau titre</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="inputRoleTitle" name="inputRoleTitle" aria-describedby="inputError2Status" placeholder="Directeur Local des Opérations" value="<?php echo $title;?>">
							</div>
						</div>
					<?php } ?>

					<div class="form-group">
						<label for="inputRoleDescription" class="col-sm-4 control-label">Nouvelle description</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="inputRoleDescription" name="inputRoleDescription" placeholder="Décrire l'utilité du rôle" value="<?php echo $description;?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-8">
							<?php if (empty($genericSuccess)){ ?>
								<a class="btn btn-default" href="role-view.php" role="button">Annuler - Retour à la liste</a>
							<?php } ?>
							<button type="submit" class="btn btn-warning">Mettre à jour</button>
							<?php if (isset($_POST['updateRole']) && !empty($genericSuccess)) { ?>
								<a class="btn btn-success" href="role-view.php" role="button">J'ai terminé ! Retour à la liste</a>
							<?php } ?>
					    </div>
					</div>
				</form>	
			</div>
		</div>

	</div>

<?php
	}
?>

<?php include('components/footer.php'); ?>
</body>
</html>