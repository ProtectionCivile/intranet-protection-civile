<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Affectation des permissions</title>
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
	<li class="active">Attributions de permissions</li>
</ol>

<!-- Submits form using the relevant permission -->
<script type="text/javascript">
	function send(pID) {
		document.getElementById('permissionID').value=pID;
		document.forms["permrole"].submit();
	}
</script>


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


	<!-- Update a role's permissions : Controller -->
	<?php
		if (isset($_POST['permissionID'])){
			$permissionID = str_replace("'","", $_POST['permissionID']);
			if($permissionID == ""){
				$genericUpdateError = "Impossible de mettre à jour une permission inconnue";
			}
			else{
				$check_query = "SELECT ID FROM rbac_permissions WHERE ID='$permissionID'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
				$verif = mysqli_query($link, $check_query);
				$row_verif = mysqli_fetch_assoc($verif);
				$permission = mysqli_num_rows($verif);		
				if (!$permission){
					$genericUpdateError = "La permission en question n'existe pas";
				}
				else {
					$permissionTitle=$rbac->Permissions->getTitle($permissionID);
					$check_query = "SELECT ID FROM rbac_roles WHERE ID='$roleID'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
					$verif = mysqli_query($link, $check_query);
					$row_verif = mysqli_fetch_assoc($verif);
					$role = mysqli_num_rows($verif);		
					if (!$role){
						$genericUpdateError = "Le rôle en question n'existe pas";
					}
					else {
						if ($rbac->Roles->hasPermission($roleID, $permissionID)) {
							$isDone = $rbac->Roles->unassign($roleTitle, $permissionTitle);
						}
						else {
							$isDone = $rbac->Roles->assign($roleTitle, $permissionTitle);
						}
						if (!$isDone){
							$genericUpdateError = "Echec de la mise à jour ('".$permissionTitle."')";
						}
						else {
							$genericUpdateSuccess = "Rôle mis à jour avec la permission '".$permissionTitle."'";	
						}
					}
				}
			}
		}
	?>

	<!-- Page content container -->
	<div class="container">
		

		<!-- Update role's permissions : Operation status indicator -->
		<?php
			if (!empty($genericUpdateError)){
				echo "<div class='alert alert-danger'><strong>Erreur</strong> : ".$genericUpdateError."</div>";
			} elseif (!empty($genericUpdateSuccess)){
				echo "<div class='alert alert-success'><strong>Effectué</strong> : ".$genericUpdateSuccess."</div>";
			}
			
		?>

		<h2>Modifier les permissions du rôle '<?php echo $roleTitle ?>'</h2>


		<!-- Update a role's permissions : display form -->
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Permissions associées au rôle</h3>
			</div>
			<div class="panel-body">
				<form id="permrole" class="form-horizontal" action='assign-role-permissions.php' method='post' accept-charset='utf-8'>
					<input type="hidden" name="roleID" value="<?php echo $roleID;?>">
					<input type="hidden" name="permissionID" id="permissionID" value="undefined">
				
					Les changements se font directement en cliquant sur les boutons. 
					<br /> <br />

					<?php 
						$query = "SELECT ID, Title, Description FROM rbac_permissions ORDER by Title ASC";
						$permissions = mysqli_query($link, $query);
						while($permission = mysqli_fetch_array($permissions)) { 
							$permissionID=$permission["ID"];
							$permissionTitle=$permission["Title"];
							$permissionDescription=$permission["Description"];
							
							if ($rbac->Roles->hasPermission($roleID, $permissionID)) {
								?>
								<button type="button" class="btn btn-default btn-xs active" title="<?php echo $permissionTitle;?>" onClick="send(<?php echo $permissionID;?>)"><?php echo $permissionDescription." (".$permissionTitle.")";?></button>
								<?php
							}
							else {
								?>
								<button type="button" class="btn btn-default btn-xs" title="<?php echo $permissionTitle;?>" onClick="send(<?php echo $permissionID;?>)"><?php echo $permissionDescription." (".$permissionTitle.")";?></button>
								<?php
							}

						} ?>
						<br /> <br />


					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-8">
							<a class="btn btn-info" href="role-view.php" role="button">Retour à la liste des rôles</a>
					    </div>
					</div>
				</form>
			</div>
		</div>


	</div>
<?php
	}
?>


<?php include('components/footer.php'); ?>
</body>
</html>