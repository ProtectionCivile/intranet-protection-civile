<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Utilisations de la permission</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Accueil</a></li>
	<li><a href="/permission-list.php">Gestion des permissions</a></li>
	<li class="active">Utilisation</li>
</ol>



<!-- Authentication -->
<?php $rbac->enforce("admin-permissions-view", $currentUserID); ?>


<!-- Common -->
<?php include('functions/controller/permission-common.php'); ?>

<?php
	if(empty($commonError)) {
?>


	<!-- Page content container -->
	<div class="container">

		<div class="page-header">
			<h2>Gestion des permissions <small>Utilisations de '<?php echo $permissionTitle ?>'</small></h2>
		</div>


		<!-- Permission usage : Container -->
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Utilisations de cette permission</h3>
			</div>
			<div class="panel-body">

				<!-- Permission usage : See roles with permission -->
				<div class="panel panel-default">
					<div class="panel-heading">Rôles ayant cette permission</div>
					<div class="panel-body">
						<?php
							$query = "SELECT R.ID, R.Title FROM $tablename_rolepermissions AS RP INNER JOIN rbac_roles AS R ON RP.RoleId=R.ID WHERE RP.PermissionId='$permissionID' ORDER BY R.Title" or die("Erreur lors de la consultation" . mysqli_error($db_link));
							$roles = mysqli_query($db_link, $query);
							while($role = mysqli_fetch_array($roles)) {
								$roleID=$role["ID"];
								$role_title=$role["Title"];
								echo $role_title.", ";
							}
						?>
					</div>
				</div>

				<!-- Permission usage : See users with permission -->
				<div class="panel panel-default">
					<div class="panel-heading">Utilisateurs ayant cette permission</div>
					<div class="panel-body">
						<div class='alert alert-warning' role='alert'>NE FONCTIONNE PAS POUR LE MOMENT (FONCTIONNALITÉ PAS DÉVELOPPÉE)</div>
						<?php
							$query = "SELECT U.ID, U.last_name, U.first_name FROM $tablename_rolepermissions AS RP INNER JOIN users AS U ON RP.RoleId=R.ID WHERE RP.PermissionId='$permissionID' ORDER BY U.nom" or die("Erreur lors de la consultation" . mysqli_error($db_link));
							$users = mysqli_query($db_link, $query);
							while($user = mysqli_fetch_array($users)) {
								$userID=$user["id_user"];
								$userFirstName=$user["prenom"];
								$userLastName=$user["nom"];
								echo $userFirstName." ".$userLastName.", ";
							}
						?>
					</div>
				</div>

			</div>

		</div>

	</div>

<?php
	}
?>

<?php include('components/footer.php'); ?>
</body>
</html>
