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
	<li><a href="/">Accueil</a></li>
	<li><a href="/role-list.php">Gestion des rôles</a></li>
	<li class="active">Audit des utilisateurs</li>
</ol>


<!-- Compute city calculation according to POST & GET variables (before auth)-->
<?php require_once('functions/user/user-compute-city.php'); ?>

<!-- Authentication -->
<?php $rbac->enforce("admin-users-view", $currentUserID); ?>

<!-- Page content container -->
<div class="container">

	<div class="page-header">
		<h2>Gestion des rôles <small>Audit des utilisateurs</small></h2>
	</div>

	<?php $base_url="view-all-users-with-roles.php"; ?>

	<!-- Beginning of the filter's parent module -->
	<?php include_once('components/filter/filter-roles-module.php'); ?>

	<?php require_once('components/filter/filter-roles-query-builder.php'); ?>

	<?php require_once('components/filter/parts/paging-query-modifier.php'); ?>


	<?php
	$query_cities = "SELECT name FROM sections WHERE number=".$_SESSION['filtered_section'] or die("Erreur lors de la consultation" . mysqli_error($db_link));
	$cities = mysqli_query($db_link, $query_cities);
	$city = mysqli_fetch_assoc($cities);
	$cityName=$city['name'];
	if (!$cityName) {
		?>
		<br />
		<div class='alert alert-info' role='alert'>
			Trop de résultats pour tout afficher. Sélectionner une commune dans la liste
		</div>
		<?php
	}
	else {

		echo "<h2>".$cityName."</h2>";
		$roles = mysqli_query($db_link, $sqlQuery);
		while($role = mysqli_fetch_array($roles)) {
			$roleID=$role["ID"];
			$role_title=$role["Description"];
			?>
			<!-- Role usage : Container -->
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo htmlentities($role_title) ?></h3>
				</div>
				<div class="panel-body">

					<!-- Role usage : See users with role -->
					<strong>Utilisateurs : </strong>
					<?php
					$query = "SELECT U.first_name, U.last_name FROM users AS U JOIN $tablename_userroles AS UR on U.ID=UR.UserID WHERE UR.RoleID=".$roleID." ORDER BY U.last_name" or die("Erreur lors de la consultation" . mysqli_error($db_link));
					$users = mysqli_query($db_link, $query);
					while($user = mysqli_fetch_array($users)) {
						$userFirstName=$user["first_name"];
						$userLastName=$user["last_name"];
						echo ucfirst(htmlentities($userFirstName))." ".mb_strtoupper($userLastName).", ";
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
