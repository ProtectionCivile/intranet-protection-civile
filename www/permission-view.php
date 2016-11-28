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
	<li class="active">Gestion des permissions</li>
</ol>


<!-- Delete a permission : Controller -->
<?php include 'functions/controller/permission-delete-controller.php'; ?>


<!-- Page content container -->
<div class="container">

	<!-- Update permission : Operation status indicator -->
	<?php include 'functions/operation-status-indicator.php'; ?>

	
	<h2>Gestion des permissions</h2>


	<!-- List available permissions -->
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Visualisation des permissions</h3>
		</div>
		<div class="table-responsive">
			<table class="table table-hover ">
				<tr>
					<th>ID</th>
					<th>Titre</th>
					<th>Description</th>
					<th>Utilisation</th>
					<th>Modifier</th>
					<th>Supprimer</th>
				</tr>
				<?php 
				$query = "SELECT ID, Title, Description FROM rbac_permissions ORDER by ID ASC";
				$permissions = mysqli_query($link, $query);
				while($permission = mysqli_fetch_array($permissions)) { ?>
					<tr>
						<td>
							<?php echo $permission["ID"]; ?>
						</td>
						<td>
							<?php echo $permission["Title"]."<br />(".$rbac->Permissions->getPath($permission["ID"]).")";?>
						</td>
						<td>
							<?php echo $permission["Description"]; ?>
						</td>
						<td>
							<form action='permission-view-usage.php' method='post' accept-charset='utf-8'>
								<input type='hidden' name='permissionID' value=<?php echo "'".$permission['ID']."'"; ?> >
								<button type='submit' class='btn btn-default'>Voir utilisation</button>
							</form>
						</td>
						<td>
							<form action='permission-edit.php' method='post' accept-charset='utf-8'>
								<input type='hidden' name='permissionID' value=<?php echo "'".$permission['ID']."'"; ?> >
								<button type='submit' class='btn btn-warning'>Modifier</button>
							</form>
						</td>
						<td>
							<form action='' method='post' accept-charset='utf-8'>
								<input type='hidden' name='delPermission' value=<?php echo "'".$permission['ID']."'"; ?> >
								<?php if (in_array($permission['Title'], $undeletablePermissions)) { ?>
									<button type='submit' class='btn btn-danger' disabled='disabled'>Supprimer</button>
								<?php } else { ?>
									<button type='submit' class='btn btn-danger' onclick='return(confirm("Etes-vous sûr de vouloir supprimer la permission ainsi que toutes ses subordonnées?"));'>Supprimer</button>
								<?php }?>
							</form>
						</td>
					</tr>
				<?php } ?>
			</table>
		</div>
		<div class="panel-footer"><a class="btn btn-default" role="button" href="permission-create.php">Ajouter une permission</a></div>
	</div>		

</div>


<?php include('components/footer.php'); ?>
</body>
</html>
