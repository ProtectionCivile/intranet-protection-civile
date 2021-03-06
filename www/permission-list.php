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
	<li class="active">Listing</li>
</ol>


<!-- Authentication -->
<?php $rbac->enforce("admin-permissions-view", $currentUserID); ?>


<!-- Delete a permission : Controller -->
<?php include 'functions/controller/permission-delete-controller.php'; ?>


<!-- Page content container -->
<div class="container">

	<div class="page-header">
		<h2>Gestion des permissions</h2>
	</div>

	<!-- Update permission : Operation status indicator -->
	<?php include 'components/operation-status-indicator.php'; ?>


	<!-- List available permissions -->
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Visualisation des permissions
				<?php if ($rbac->check("admin-permissions-update", $currentUserID)) { ?>
					<div class="text-right"><a class="btn btn-warning" role="button" href="permission-create.php">Ajouter une permission</a></div>
				<?php } ?>
			</h3>
		</div>
		<div class="table-responsive">
			<table class="table table-hover ">
				<tr>
					<th>ID</th>
					<th>Titre</th>
					<th>Description</th>
					<th colspan='3'>Opérations</th>
				</tr>
				<?php
				$query = "SELECT ID, Title, Description FROM $tablename_permissions ORDER by ID ASC";
				$permissions = mysqli_query($db_link, $query);
				while($permission = mysqli_fetch_array($permissions)) { ?>
					<tr>
						<td>
							<?php echo htmlentities($permission["ID"]); ?>
						</td>
						<td>
							<?php echo htmlentities($permission["Title"])."<br />(".$rbac->Permissions->getPath($permission["ID"]).")";?>
						</td>
						<td>
							<?php echo htmlentities($permission["Description"]); ?>
						</td>
						<td>
							<form action='permission-usage.php' method='post' accept-charset='utf-8'>
								<input type='hidden' name='id' value=<?php echo "'".$permission['ID']."'"; ?> >
								<button type='submit' class='btn btn-default glyphicon glyphicon-eye-open' title="Voir utilisation"></button>
							</form>
						</td>
						<td>
							<?php if ($rbac->check("admin-permissions-update", $currentUserID)) { ?>
									<form action='permission-edit.php' method='post' accept-charset='utf-8'>
									<input type='hidden' name='id' value=<?php echo "'".$permission['ID']."'"; ?> >
									<button type='submit' class='btn btn-warning glyphicon glyphicon-pencil' title="Modifier"></button>
								</form>
							<?php } ?>
						</td>
						<td>
							<?php if ($rbac->check("admin-permissions-update", $currentUserID)) { ?>
								<form action='' method='post' accept-charset='utf-8'>
									<input type='hidden' name='delPermission' value=<?php echo "'".$permission['ID']."'"; ?> >
									<?php if (in_array($permission['Title'], $undeletablePermissions)) { ?>
										<button type='submit' class='btn btn-danger glyphicon glyphicon-trash' title="Supprimer" disabled='disabled' onclick='return(confirm("Etes-vous sûr de vouloir supprimer la permission ainsi que toutes ses subordonnées?"));'></button>
									<?php } else { ?>
										<button type='submit' class='btn btn-danger glyphicon glyphicon-trash' title="Supprimer" onclick='return(confirm("Etes-vous sûr de vouloir supprimer la permission ainsi que toutes ses subordonnées?"));'></button>
									<?php }?>
								</form>
							<?php } ?>
						</td>
					</tr>
				<?php } ?>
			</table>
		</div>
		<?php if ($rbac->check("admin-permissions-update", $currentUserID)) { ?>
			<div class="panel-footer"><a class="btn btn-warning" role="button" href="permission-create.php">Ajouter une permission</a></div>
		<?php } ?>
	</div>

</div>


<?php include('components/footer.php'); ?>
</body>
</html>
