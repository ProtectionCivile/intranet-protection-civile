<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Gestion des rôles</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="#">Administration</a></li>
	<li class="active">Gestion des rôles</li>
</ol>


<!-- Delete a role : Controller -->
<?php include 'functions/controller/role-delete-controller.php'; ?>

<!-- Page content container -->
<div class="container">

	<!-- Update role : Operation status indicator -->
	<?php include 'functions/operation-status-indicator.php'; ?>

	<h2>Gestion des roles</h2>


	<!-- List available roles -->
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Visualisation des rôles</h3>
		</div>
		<div class="table-responsive">
			<table class="table table-hover ">
				<tr>
					<th>ID</th>
					<th>Titre</th>
					<th>Description</th>
					<th>Utilisation</th>
					<th>Modifier</th>
					<th>Permissions</th>
					<th>Supprimer</th>
				</tr>
				<?php 
				$query = "SELECT ID, Title, Description FROM rbac_roles ORDER by ID ASC";
				$roles = mysqli_query($link, $query);
				while($role = mysqli_fetch_array($roles)) { ?>
					<tr>
						<td>
							<?php echo $role["ID"]; ?>
						</td>
						<td>
							<?php echo $role["Title"]."<br />(".$rbac->Roles->getPath($role["ID"]).")";?>
						</td>
						<td>
							<?php echo $role["Description"]; ?>
						</td>
						<td>
							<form action='role-usage.php' method='post' accept-charset='utf-8'>
								<input type='hidden' name='roleID' value=<?php echo "'".$role['ID']."'"; ?> >
								<button type='submit' class='btn btn-default'>Voir utilisation</button>
							</form>
						</td>
						<td>
							<form action='role-edit.php' method='post' accept-charset='utf-8'>
								<input type='hidden' name='roleID' value=<?php echo "'".$role['ID']."'"; ?> >
								<button type='submit' class='btn btn-warning'>Modifier</button>
							</form>
						</td>
						<td>
							<form action='assign-role-permissions.php' method='post' accept-charset='utf-8'>
								<input type='hidden' name='roleID' value=<?php echo "'".$role['ID']."'"; ?> >
								<button type='submit' class='btn btn-warning'>Permissions</button>
							</form>
						</td>
						<td>
							<form action='' method='post' accept-charset='utf-8'>
								<input type='hidden' name='delRole' value=<?php echo "'".$role['ID']."'"; ?> >
								<?php if (in_array($role['Title'], $undeletableRoles)) { ?>
									<button type='submit' class='btn btn-danger' disabled='disabled'>Supprimer</button>
								<?php } else { ?>
									<button type='submit' class='btn btn-danger' onclick='return(confirm("Etes-vous sûr de vouloir supprimer le rôle?"));'>Supprimer</button>
								<?php }?>
							</form>
						</td>
					</tr>
				<?php } ?>
			</table>
		</div>
		<div class="panel-footer"><a class="btn btn-default" role="button" href="role-create.php">Ajouter un rôle</a></div>
	</div>

</div>

<?php include('components/footer.php'); ?>
</body>
</html>
