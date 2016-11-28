<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Gestion des permissions</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8";>
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="#">Administration</a></li>
	<li><a href="/permission-view.php">Gestion des permissions</a></li>
	<li class="active">Création</li>
</ol>




<!-- Create a new permission by title : Controller -->
<?php include 'functions/controller/permission-create-controller.php'; ?>


<!-- Page content container -->
<div class="container">

	<!-- Update permission : Operation status indicator -->
	<?php include 'functions/operation-status-indicator.php'; ?>


	
	<h2>Gestion des permissions</h2>


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
					<form class="form-inline" action='' method='post' accept-charset='utf-8'>
						<input type="hidden" id="wish" name="addPermission">

						<?php if (!empty($createErrorTitle)){ ?>
							<div class="form-group has-error has-feedback">
								<label for="inputPermissionTitle" class="control-label">Titre</label>
								<input type="text" class="form-control" id="inputPermissionTitle" name="inputPermissionTitle" aria-describedby="inputError2Status" placeholder="ex: Visualiser DPS" value="<?php echo $title;?>">
								<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
								<span id="inputError2Status" class="sr-only">(error)</span>
							</div>
						<?php } else { ?>
							<div class="form-group">
								<label for="inputPermissionTitle" class="control-label">Titre</label>
								<input type="text" class="form-control" id="inputPermissionTitle" name="inputPermissionTitle" aria-describedby="inputError2Status" placeholder="ex: Visualiser DPS">
							</div>
						<?php } ?>

						<div class="form-group">
							<label for="inputPermissionDescription" class="control-label">Description</label>
							<input type="text" class="form-control" id="inputPermissionDescription" name="inputPermissionDescription" placeholder="Description ?"
								<?php
									if (isset($_POST['addPermission']) && isset($_POST['genericError'])) {
										echo "value='$description'";
									}
								?>
							>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-success">Créer</button>
						</div>

					</form	>

				</div>
			</div>

			<!-- Create a permission by path : display form -->
			<div class="panel panel-default">
				<div class="panel-heading">Au niveau personnalisable</div>
				<div class="panel-body">
					<form class="form-inline" action='' method='post' accept-charset='utf-8'>
						<input type="hidden" id="wish" name="addPermissionPath">
						<?php if (!empty($createErrorPath)){ ?>
							<div class="form-group has-error has-feedback">
								<label for="inputPermissionPath" class="control-label">Chemin</label>
								<input type="text" class="form-control" id="inputPermissionPath" name="inputPermissionPath" aria-describedby="inputError2Status" placeholder="ex: edit-dps/view-dps" value="<?php echo $path;?>">
								<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
								<span id="inputError2Status" class="sr-only">(error)</span>
							</div>
						<?php } else { ?>
							<div class="form-group">
								<label for="inputPermissionPath" class="control-label">Chemin</label>
								<input type="text" class="form-control" id="inputPermissionPath" name="inputPermissionPath" aria-describedby="inputError2Status" placeholder="ex: edit-dps/view-dps">
							</div>
						<?php } ?>

						<div class="form-group">
							<label for="inputPermissionDescription" class="control-label">Descriptions</label>
							<input type="text" class="form-control" id="inputPermissionDescriptions" name="inputPermissionDescriptions" placeholder="Desc 1/Desc 2/ Desc 3..."
								<?php
									if (isset($_POST['addPermission']) && isset($_POST['genericError'])) {
										echo "value='$description'";
									}
								?>
							>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-success">Créer</button>
						</div>
					</form	>

				</div>
			</div>

		</div>
	</div>

</div>


<?php include('components/footer.php'); ?>
</body>
</html>
