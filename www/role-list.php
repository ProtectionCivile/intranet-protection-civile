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
	<li><a href="/">Accueil</a></li>
	<li><a href="/role-list.php">Gestion des rôles</a></li>
	<li class="active">Listing</li>
</ol>

<!-- Compute city calculation according to POST & GET variables (before auth)-->
<?php require_once('functions/role/role-compute-city.php'); ?>


<!-- Authentication -->
<?php require_once('functions/role/role-update-authentication.php'); ?>

<!-- Delete a role : Controller -->
<?php include 'functions/controller/role-delete-controller.php'; ?>

<!-- Page content container -->
<div class="container">

	<div class="page-header">
		<h2>Gestion des rôles</h2>
	</div>

	<!-- Update role : Operation status indicator -->
	<?php include 'components/operation-status-indicator.php'; ?>

	<?php $base_url="role-list.php"; ?>

	<!-- Beginning of the filter's parent module -->
	<?php include_once('components/filter/filter-roles-module.php'); ?>

	<?php require_once('components/filter/filter-roles-query-builder.php'); ?>

	<?php require_once('components/filter/parts/paging-query-modifier.php'); ?>


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
					<th>Rattachement</th>
					<th>Indicatif radio</th>
					<th>Assignable</th>
					<th>Annuaire</th>
					<th>Tags</th>
					<th>Hiérarchie</th>
					<th colspan='4'>Opérations</th>
				</tr>
				<?php
				$roles = mysqli_query($db_link, $sqlQuery);
				while($role = mysqli_fetch_array($roles)) { ?>
					<tr <?php echo (isset($role["Affiliation"])) ? "" : "class='danger'" ?> >
						<td>
							<?php echo htmlentities($role["ID"]); ?>
						</td>
						<td>
							<span title='.<?php echo $rbac->Roles->getPath($role["ID"]); ?>.'><?php echo htmlentities($role["Title"]);?></span>
						</td>
						<td>
							<?php echo htmlentities($role["Description"]); ?>
						</td>
						<td>
							<?php echo htmlentities($role["Phone"]); ?>
						</td>
						<td>
							<?php echo htmlentities($role["Mail"]); ?>
						</td>
						<td>
							<?php
							if (! isset($role["Affiliation"])) {
								echo '---';
							}
							else {
								$qc = "SELECT shortname FROM $tablename_sections WHERE number='".$role["Affiliation"]."'";
								$qcr = mysqli_query($db_link, $qc);
								$c = mysqli_fetch_assoc($qcr);
								echo htmlentities($c['shortname']);
							}
							?>
						</td>
						<td>
							<?php echo htmlentities($role["Callsign"]); ?>
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
							<?php echo htmlentities($role["Tags"]); ?>
						</td>
						<td>
							<?php echo htmlentities($role["Hierarchy"]); ?>
						</td>
						<td>
							<form action='role-usage.php' method='post' accept-charset='utf-8'>
								<input type='hidden' name='id' value=<?php echo "'".$role['ID']."'"; ?> >
								<button type='submit' class='btn btn-success glyphicon glyphicon-eye-open' title="Voir utilisation"></button>
							</form>
						</td>
						<td>
							<?php if ($rbac->check("admin-roles-update", $currentUserID)) { ?>
								<form action='role-edit.php' method='post' accept-charset='utf-8'>
									<input type='hidden' name='id' value=<?php echo "'".$role['ID']."'"; ?> >
									<button type='submit' class='btn btn-warning glyphicon glyphicon-pencil' title="Modifier"></button>
								</form>
							<?php } ?>
						</td>
						<td>
							<?php if ($rbac->check("admin-roles-asssign-permissions", $currentUserID)) { ?>
								<form action='role-assign-permissions.php' method='post' accept-charset='utf-8'>
									<input type='hidden' name='id' value=<?php echo "'".$role['ID']."'"; ?> >
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
