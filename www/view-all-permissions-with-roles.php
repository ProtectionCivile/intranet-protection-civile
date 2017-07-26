<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Voir les utilisations de permissions</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="#">Administration</a></li>
	<li><a href="/role-view.php">Gestion des permissions</a></li>
	<li class="active">Audit des rôles</li>
</ol>


<!-- Authentication -->
<?php $rbac->enforce("admin-permissions-view", $currentUserID); ?>

<!-- Page content container -->
<div class="container">

	<?php $base_url="view-all-permissions-with-roles.php"; ?>

	<!-- Beginning of the filter's parent module -->
	<?php include_once('components/filter/filter-roles-module.php'); ?>

	<?php require_once('components/filter/filter-roles-query-builder.php'); ?>


	<?php
	$query_cities = "SELECT name FROM sections WHERE number=".$city or die("Erreur lors de la consultation" . mysqli_error($db_link));
	$cities = mysqli_query($db_link, $query_cities);
	$city = mysqli_fetch_assoc($cities);
	$cityName=$city['name'];
	if (!$cityName) {
		?>
		<br />
		<br />
		<div class='alert alert-info' role='alert'>
			Trop de résultats pour tout afficher. Sélectionner une commune dans la liste
		</div>
		<?php
	}
	else {
		?>
		<h2>Audit des permissions pour <?php echo $cityName ?></h2>
		<?php

		$query = "SELECT ID, Title, Description FROM $tablename_permissions ORDER BY Title ASC" or die("Erreur lors de la consultation" . mysqli_error($db_link));
		$permissions = mysqli_query($db_link, $query);
		?>
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Utilisation des permissions</h3>
			</div>
			<div class="table-responsive">
				<table class='table table-hover table-striped table-condensed'>
					<thead>
						<tr>
							<th class='text-center'>Permission</th>
							<?php
							$roles = mysqli_query($db_link, $sqlQuery);
							while($role = mysqli_fetch_array($roles)) {
								$roleID=$role["ID"];
								$roleTitle=$role["Title"];
								$roleDescription=$role["Description"];
								?>
									<th class='text-center' title='<?php echo $roleDescription; ?>'><?php echo $roleTitle; ?></th>
								<?php
							}
							?>
						</tr>
					</thead>
					<tbody>
						<?php
						while($permission = mysqli_fetch_array($permissions)) {
							$permissionID=$permission["ID"];
							$permissionTitle=$permission["Title"];
							$permissionDescription=$permission["Description"];
							?>
							<tr>
								<td class='text-nowrap'><?php echo $permissionDescription; ?></td>
								<?php
								$roles = mysqli_query($db_link, $sqlQuery);
							 	while($role = mysqli_fetch_array($roles)) {
									$roleID=$role["ID"];
									$roleTitle=$role["Title"];
									?>
									<td class='text-center'>
										<?php
										if ($rbac->Roles->hasPermission($roleID, $permissionID)) {
											?> <span class="text-success glyphicon glyphicon-ok" title='<?php echo $roleTitle; ?>' aria-hidden="true"></span> <?php
										}
										else {
											?> <span class="text-danger glyphicon glyphicon-minus" title='<?php echo $roleTitle; ?>' aria-hidden="true"></span> <?php
										}
										?>
									</td>
									<?php
								}
								?>
							</tr>
							<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<?php
	}
	?>

</div>


<?php include('components/footer.php'); ?>
</body>
</html>
