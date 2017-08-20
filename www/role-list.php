<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Gestion des rôles</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li class="active">Gestion des rôles</li>
</ol>

<!-- Compute city calculation according to POST & GET variables (before auth)-->
<?php require_once('functions/role/role-compute-city.php'); ?>


<!-- Authentication -->
<?php $rbac->enforce("admin-roles-view", $currentUserID); ?>

<!-- Delete a role : Controller -->
<?php include 'functions/controller/role-delete-controller.php'; ?>

<!-- Page content container -->
<div class="container">

	<!-- Update role : Operation status indicator -->
	<?php include 'components/operation-status-indicator.php'; ?>

	<?php $base_url="role-list.php"; ?>

	<!-- Beginning of the filter's parent module -->
	<?php include_once('components/filter/filter-roles-module.php'); ?>

	<?php require_once('components/filter/filter-roles-query-builder.php'); ?>

	<?php require_once('components/filter/parts/paging-query-modifier.php'); ?>

	<h2>Gestion des roles</h2>


	<!-- List available roles -->
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Visualisation des rôles
				<?php if ($rbac->check("admin-roles-update", $currentUserID)) { ?>
					<div class="text-right"><a class="btn btn-warning" role="button" href="role-create.php">Ajouter un rôle</a></div>
				<?php }?>
		</div>
		<div class="table-responsive">
			<table class="table table-hover ">
				<tr>
					<th>ID</th>
					<th>Titre</th>
					<th>Description</th>
					<th>Tél</th>
					<th>Mail</th>
					<th>Affiliation</th>
					<th>Ind. Radio</th>
					<th>Assignable</th>
					<th>Annuaire</th>
					<th colspan='4'>Opérations</th>
				</tr>
				<?php
				$roles = mysqli_query($db_link, $sqlQuery);
				while($role = mysqli_fetch_array($roles)) { ?>
					<tr>
						<td>
							<?php echo $role["ID"]; ?>
						</td>
						<td>
							<span title='.<?php echo $rbac->Roles->getPath($role["ID"]); ?>.'><?php echo $role["Title"];?></span>
						</td>
						<td>
							<?php echo $role["Description"]; ?>
						</td>
						<td>
							<?php echo $role["Phone"]; ?>
						</td>
						<td>
							<?php echo $role["Mail"]; ?>
						</td>
						<td>
							<?php
							$qc = "SELECT name FROM $tablename_sections WHERE number='".$role["Affiliation"]."'";
							$qcr = mysqli_query($db_link, $qc);
							$c = mysqli_fetch_assoc($qcr);
							echo $c['name'];
							?>
						</td>
						<td>
							<?php echo $role["Callsign"]; ?>
						</td>
						<td align="center">

							<?php if($role["Assignable"]) { ?>
								<span class='glyphicon glyphicon-ok' />
							<?php } else { ?>
								<span class='glyphicon glyphicon-remove' />
							<?php } ?>
						</td>
						<td align="center">
							<?php if($role["Directory"]) { ?>
								<span class='glyphicon glyphicon-ok' />
							<?php } else { ?>
								<span class='glyphicon glyphicon-remove' />
							<?php } ?>
						</td>
						<td>
							<form action='role-usage.php' method='post' accept-charset='utf-8'>
								<input type='hidden' name='roleID' value=<?php echo "'".$role['ID']."'"; ?> >
								<button type='submit' class='btn btn-default glyphicon glyphicon-eye-open' title="Voir utilisation"></button>
							</form>
						</td>
						<td>
							<?php if ($rbac->check("admin-roles-update", $currentUserID)) { ?>
								<form action='role-edit.php' method='post' accept-charset='utf-8'>
									<input type='hidden' name='roleID' value=<?php echo "'".$role['ID']."'"; ?> >
									<button type='submit' class='btn btn-warning glyphicon glyphicon-pencil' title="Modifier"></button>
								</form>
							<?php } ?>
						</td>
						<td>
							<?php if ($rbac->check("admin-roles-asssign-permissions", $currentUserID)) { ?>
								<form action='role-assign-permissions.php' method='post' accept-charset='utf-8'>
									<input type='hidden' name='roleID' value=<?php echo "'".$role['ID']."'"; ?> >
									<button type='submit' class='btn btn-warning glyphicon glyphicon-check' title="Voir / Affecter des permissions"></button>
								</form>
							<?php } ?>
						</td>
						<td>
							<?php if ($rbac->check("admin-roles-update", $currentUserID)) { ?>
								<form action='' method='post' accept-charset='utf-8'>
									<input type='hidden' name='delRole' value=<?php echo "'".$role['ID']."'"; ?> >
									<?php if (in_array($role['Title'], $undeletableRoles)) { ?>
										<button type='submit' class='btn btn-danger glyphicon glyphicon-trash' title="Supprimer" disabled='disabled' onclick='return(confirm("Etes-vous sûr de vouloir supprimer le rôle?"));'></button>
									<?php } else { ?>
										<button type='submit' class='btn btn-danger glyphicon glyphicon-trash' title="Supprimer" onclick='return(confirm("Etes-vous sûr de vouloir supprimer le rôle?"));'></button>
									<?php }?>
								</form>
							<?php } ?>
						</td>
					</tr>
				<?php } ?>
			</table>
		</div>
		<?php if ($rbac->check("admin-roles-update", $currentUserID)) { ?>
			<div class="panel-footer"><a class="btn btn-warning" role="button" href="role-create.php">Ajouter un rôle</a></div>
		<?php }?>
	</div>

	<!-- Page's pagination module -->
	<?php require_once('components/filter/parts/filter-paging-display.php'); ?>

</div>

<?php include('components/footer.php'); ?>
</body>
</html>
