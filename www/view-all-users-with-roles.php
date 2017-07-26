<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Voir les utilisations de rôles</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="#">Administration</a></li>
	<li><a href="/role-view.php">Gestion des rôles</a></li>
	<li class="active">Audit des rôles</li>
</ol>


<!-- Authentication -->
<?php $rbac->enforce("admin-users-view", $currentUserID); ?>

<!-- Page content container -->
<div class="container">

	<?php $base_url="view-all-users-with-roles.php"; ?>

	<!-- Beginning of the filter's parent module -->
	<?php include_once('components/filter/filter-roles-module.php'); ?>

	<?php require_once('components/filter/filter-roles-query-builder.php'); ?>

	<?php require_once('components/filter/parts/paging-query-modifier.php'); ?>


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
		?><h2>Audit des rôles pour <?php echo $cityName ?></h2><?php
		$roles = mysqli_query($db_link, $sqlQuery);
		while($role = mysqli_fetch_array($roles)) {
			$roleID=$role["ID"];
			$roleTitle=$role["Description"];
			?>
			<!-- Role usage : Container -->
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo $roleTitle ?></h3>
				</div>
				<div class="panel-body">

					<!-- Role usage : See users with role -->
					<strong>Utilisateurs : </strong>
					<?php
					$query = "SELECT U.first_name, U.last_name FROM users AS U JOIN rbac_userroles AS UR on U.ID=UR.UserID WHERE UR.RoleID=".$roleID." ORDER BY U.last_name" or die("Erreur lors de la consultation" . mysqli_error($db_link));
					$users = mysqli_query($db_link, $query);
					while($user = mysqli_fetch_array($users)) {
						$userFirstName=$user["first_name"];
						$userLastName=$user["last_name"];
						echo $userFirstName." ".$userLastName.", ";
					}
					?>
				</div>

			</div>
			<?php
		}
		?>

	<!-- Page's pagination module -->
	<?php require_once('components/filter/parts/filter-paging-display.php'); ?>
	<?php
	}
	?>

</div>


<?php include('components/footer.php'); ?>
</body>
</html>
