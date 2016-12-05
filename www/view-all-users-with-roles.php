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

	<?php 
	$query = "SELECT name, number FROM sections WHERE attached_section=number" or die("Erreur lors de la consultation" . mysqli_error($link)); 
	$cities = mysqli_query($link, $query);
	while($city = mysqli_fetch_array($cities)) { 
		echo "<a href='view-all-users-with-roles.php?city=".$city['number']."'>".$city['name']."</a>, ";
	}

	if (!isset($_GET['city'])) {
		?>  
		<br />
		<br />
		<div class='alert alert-info' role='alert'>
  			Sélectionner une commune dans la liste
		</div>
		<?php
	}
	else {
		$cityID=$_GET['city'];
		$query = "SELECT name FROM sections WHERE number=".$cityID or die("Erreur lors de la consultation" . mysqli_error($link)); 
		$cities = mysqli_query($link, $query);
		$city = mysqli_fetch_assoc($cities);
		$cityName=$city['name'];
		
		?>
	
		<h2>Audit des rôles pour <?php echo $cityName ?></h2>

		<?php 
		$query = "SELECT ID, Description FROM rbac_roles WHERE Assignable = '1' AND Affiliation=".$cityID or die("Erreur lors de la consultation" . mysqli_error($link)); 
		$roles = mysqli_query($link, $query);
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
					<div class="panel panel-default">
						<div class="panel-heading">Utilisateurs</div>
						<div class="panel-body">
							<?php 
								$query = "SELECT U.first_name, U.last_name FROM users AS U JOIN rbac_userroles AS UR on U.ID=UR.UserID WHERE AND UR.RoleID=".$roleID." ORDER BY U.last_name" or die("Erreur lors de la consultation" . mysqli_error($link)); 
								$users = mysqli_query($link, $query);
								while($user = mysqli_fetch_array($users)) { 
									$userFirstName=$user["first_name"];
									$userLastName=$user["last_name"];
									echo $userFirstName." ".$userLastName.", ";
								}
							?>
						</div>
					</div>

				</div>

			</div>
			<?php
		}
	}
	?>
	
</div>


<?php include('components/footer.php'); ?>
</body>
</html>