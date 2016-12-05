<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Utilisations du rôle</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="#">Administration</a></li>
	<li><a href="/role-view.php">Gestion des rôles</a></li>
	<li class="active">Utilisation</li>
</ol>


<!-- Authentication -->
<?php $rbac->enforce("admin-roles-view", $currentUserID); ?>


<!-- Common -->
<?php 
	$roleID = str_replace("'","", $_POST['roleID']);
	if($roleID == ""){
		$roleUpdateError = "Aucun rôle défini";
	}
	else {
		$check_query = "SELECT ID FROM rbac_roles WHERE ID='$roleID'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
		$verif = mysqli_query($link, $check_query);
		$row_verif = mysqli_fetch_assoc($verif);
		$role = mysqli_num_rows($verif);		
		if (!$role){
			$roleUpdateError = "Le rôle en question n'existe pas";
		}
	}
	if(!empty($roleUpdateError)) {
		echo "<div class='alert alert-danger'><strong>Erreur</strong> : ".$roleUpdateError."</div>";
	}
	else {
		$roleTitle=$rbac->Roles->getTitle($roleID);
?>

	
	<!-- Page content container -->
	<div class="container">

		<h2>Utilisation du rôle '<?php echo $roleTitle ?>'</h2>


		<!-- Role usage : Container -->
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Utilisations de ce rôle</h3>
			</div>
			<div class="panel-body">

				<!-- Role usage : See permissions with role -->
				<div class="panel panel-default">
					<div class="panel-heading">Permissions</div>
					<div class="panel-body">
						<?php 
							$query = "SELECT P.ID, P.Title, P.Description FROM rbac_rolepermissions AS RP INNER JOIN rbac_permissions AS P ON RP.PermissionId=P.ID WHERE RP.RoleId='$roleID' ORDER BY P.Title" or die("Erreur lors de la consultation" . mysqli_error($link)); 
							$permissions = mysqli_query($link, $query);
							while($permission = mysqli_fetch_array($permissions)) { 
								$permissionID=$permission["ID"];
								$permissionTitle=$permission["Title"];
								$permissionDesc=$permission["Description"];
								echo $permissionDesc." (".$permissionTitle.")<br />";
							}
						?>
					</div>
				</div>

				<!-- Role usage : See users with role -->
				<div class="panel panel-default">
					<div class="panel-heading">Utilisateurs</div>
					<div class="panel-body">
						<?php 
							$sql = "SELECT U.ID, U.last_name, U.first_name FROM rbac_userroles AS UR INNER JOIN users AS U ON UR.UserId=U.ID WHERE UR.RoleID='$roleID' ORDER BY U.last_name" or die("Erreur lors de la consultation" . mysqli_error($link)); 
							$result = $link->query($sql);
							while($row = $result->fetch_assoc()) {
								$userID=$row["ID"];
								$userFirstName=$row["first_name"];
								$userLastName=$row["last_name"];
								echo $userFirstName." ".$userLastName."<br />";
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