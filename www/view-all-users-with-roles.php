<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Voir les utilisations de rôles</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8";>
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="#">Administration</a></li>
	<li><a href="/role-view.php">Gestion des rôles</a></li>
	<li class="active">Audit des rôles</li>
</ol>

<!-- Common -->
<?php 
	// {
?>


	
<!-- Page content container -->
<div class="container">

	<h2>Audit des rôles</h2>


	<?php 
	$query = "SELECT ID, Title FROM rbac_roles" or die("Erreur lors de la consultation" . mysqli_error($link)); 
	$roles = mysqli_query($link, $query);
	while($role = mysqli_fetch_array($roles)) { 
		$roleID=$role["ID"];
		$roleTitle=$role["Title"];
		?>
		<!-- Role usage : Container -->
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo $roleTitle ?></h3>
			</div>
			<div class="panel-body">

				<!-- Role usage : See users with role -->
				<div class="panel panel-default">
					<div class="panel-heading">Utilisateurs</div>
					<div class="panel-body">
						<?php 
							$query = "SELECT U.id_user, U.nom, U.prenom FROM rbac_rolepermissions AS RP INNER JOIN membres AS U ON RP.PermissionId=U.id_user WHERE R.ID='$roleID' ORDER BY U.nom" or die("Erreur lors de la consultation" . mysqli_error($link)); 
							$users = mysqli_query($link, $query);
							while($user = mysqli_fetch_array($users)) { 
								$userID=$permission["id_user"];
								$userFirstName=$permission["prenom"];
								$userLastName=$permission["nom"];
								echo $prenom." ".$nom.", ";
							}
						?>
					</div>
				</div>

			</div>

		</div>
		<?php
	}
	?>
	
</div>


<?php include('components/footer.php'); ?>
</body>
</html>