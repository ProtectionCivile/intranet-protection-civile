<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Gestion des utilisateurs</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Accueil</a></li>
	<li><a href='/user-list.php'>Gestion des utilisateurs</a></li>
	<li class='active'>Listing</li>
</ol>


<!-- Compute city calculation according to POST & GET variables (before auth)-->
<?php require_once('functions/user/user-compute-city.php'); ?>

<!-- Authentication -->
<?php require_once('functions/user/user-view-authentication.php'); ?>


<!-- Delete a user : Controller -->
<?php include 'functions/controller/user-delete-controller.php'; ?>


<!-- Page content container -->
<div class="container">

	<div class="page-header">
		<h2>Gestion des utilisateurs</h2>
	</div>

	<!-- Update user : Operation status indicator -->
	<?php include 'components/operation-status-indicator.php'; ?>

	<?php $base_url="user-list.php"; ?>

	<!-- Beginning of the filter's parent module -->
	<?php include_once('components/filter/filter-users-module.php'); ?>

	<?php require_once('components/filter/filter-users-query-builder.php'); ?>

	<?php require_once('components/filter/parts/paging-query-modifier.php'); ?>


	<!-- List available users -->
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Visualisation des utilisateurs
				<?php if ($rbac->check("admin-users-update", $currentUserID)) { ?>
					<div class="text-right"><a class="btn btn-warning" role="button" href="user-create.php">Ajouter un utilisateur</a></div>
				<?php }?>
		</div>
		<div class="table-responsive">
			<table class="table table-hover">
				<tr>
					<th>Nom</th>
					<th>Prénom</th>
					<th>Matricule</th>
					<th>Téléphone</th>
					<th>Mail</th>
					<th>Section</th>
					<th colspan='3'>Actions</th>
				</tr>
				<?php
				$users = mysqli_query($db_link, $sqlQuery);
				while($user = mysqli_fetch_array($users)) { ?>
					<tr>
						<td>
							<?php echo ucfirst($user["last_name"]); ?>
						</td>
						<td>
							<?php echo ucfirst($user["first_name"]); ?>
						</td>
						<td>
							<?php echo $user["login"]; ?>
						</td>
						<td>
							<?php echo $user["phone"]; ?>
						</td>
						<td>
							<?php echo $user["mail"]; ?>
						</td>
						<td>
							<?php echo $user["section_name"]; ?>
						</td>
						<td>
							<?php if ($rbac->check("admin-users-asssign-roles", $currentUserID)) { ?>
								<form action='user-assign-roles.php' method='post' accept-charset='utf-8'>
									<input type='hidden' name='userID' value=<?php echo "'".$user['ID']."'"; ?> >
									<button type='submit' class='btn btn-warning glyphicon glyphicon-check' title='Voir / Affecter des rôles'></button>
								</form>
							<?php }?>
						</td>
						<td>
							<?php if ($rbac->check("admin-users-update", $currentUserID)) { ?>
								<form action='user-edit.php' method='post' accept-charset='utf-8'>
									<input type='hidden' name='id' value=<?php echo "'".$user['ID']."'"; ?> >
									<button type='submit' class='btn btn-warning glyphicon glyphicon-pencil' title="Modifier"></button>
								</form>
							<?php }?>
						</td>
						<td>
							<?php if ($rbac->check("admin-users-update", $currentUserID)) { ?>
								<form action='' method='post' accept-charset='utf-8'>
									<input type='hidden' name='delUser' value=<?php echo "'".$user['ID']."'"; ?> >
									<button type='submit' class='btn btn-danger glyphicon glyphicon-trash' title="Supprimer" onclick='return(confirm("Etes-vous sûr de vouloir supprimer cet utilisateur?"));'></button>
								</form>
							<?php }?>
						</td>
					</tr>
				<?php } ?>
			</table>
		</div>
		<?php if ($rbac->check("admin-users-update", $currentUserID)) { ?>
			<div class="panel-footer"><a class="btn btn-warning" role="button" href="user-create.php">Ajouter un utilisateur</a></div>
		<?php }?>
	</div>

	<!-- Page's pagination module -->
	<?php require_once('components/filter/parts/filter-paging-display.php'); ?>

</div>

<?php include('components/footer.php'); ?>

</body>
</html>
