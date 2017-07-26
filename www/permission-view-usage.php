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
	<li><a href="/">Home</a></li>
	<li><a href="#">Administration</a></li>
	<li><a href="/permission-manage.php">Gestion des permissions</a></li>
	<li class="active">Utilisation</li>
</ol>



<!-- Authentication -->
<?php $rbac->enforce("admin-permissions-view", $currentUserID); ?>


<!-- Common -->
<?php 
	$permissionID = str_replace("'","", $_POST['permissionID']);
	if($permissionID == ""){
		$rpermissionpdateError = "Aucune permission définie";
	}
	else {
		$check_query = "SELECT ID FROM $tablename_permissions WHERE ID='$permissionID'" or die("Erreur lors de la consultation" . mysqli_error($db_link)); 
		$verif = mysqli_query($db_link, $check_query);
		$row_verif = mysqli_fetch_assoc($verif);
		$permission = mysqli_num_rows($verif);		
		if (!$permission){
			$permissionUpdateError = "La permission en question n'existe pas";
		}
	}
	if(!empty($permissionUpdateError)) {
		echo "<div class='alert alert-danger'><strong>Erreur</strong> : ".$rpermissionUpdateError."</div>";
	}
	else {
		$permissionTitle=$rbac->Permissions->getTitle($permissionID);
?>

	
	<!-- Page content container -->
	<div class="container">

		<h2>Utilisation de la permission '<?php echo $permissionTitle ?>'</h2>


		<!-- Permission usage : Container -->
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Utilisations de cette permission</h3>
			</div>
			<div class="panel-body">

				<!-- Permission usage : See roles with permission -->
				<div class="panel panel-default">
					<div class="panel-heading">Rôles</div>
					<div class="panel-body">
						<?php 
							$query = "SELECT R.ID, R.Title FROM $tablename_rolepermissions AS RP INNER JOIN rbac_roles AS R ON RP.RoleId=R.ID WHERE RP.PermissionId='$permissionID' ORDER BY R.Title" or die("Erreur lors de la consultation" . mysqli_error($db_link)); 
							$roles = mysqli_query($db_link, $query);
							while($role = mysqli_fetch_array($roles)) { 
								$roleID=$role["ID"];
								$roleTitle=$role["Title"];
								echo $roleTitle.", ";
							}
						?>
					</div>
				</div>

				<!-- Permission usage : See users with permission -->
				<div class="panel panel-default">
					<div class="panel-heading">Utilisateurs</div>
					<div class="panel-body">
						NE FONCTIONNE PAS POUR LE MOMENT (FONCTIONNALITE PAS DEVELOPPEE)
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