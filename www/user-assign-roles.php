<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Affectation des rôles</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8";>
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
</head>
<body>
<?php include('components/header.php'); ?>

<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="#">Administration</a></li>
	<li><a href="/user-view.php">Gestion des utilisateurs</a></li>
	<li class="active">Attributions de rôles</li>
</ol>

<!-- Submits form using the relevant permission -->
<script type="text/javascript">
	function send(rID) {
		document.getElementById('roleID').value=rID;
		document.forms["roleuser"].submit();
	}
</script>


<!-- Common -->
<?php include 'functions/controller/user-common.php'; ?>

<?php 
	if(empty($commonError)) {
?>


	<!-- Update a user's roles : Controller -->
	<?php
		if (isset($_POST['roleID'])){
			$roleID = str_replace("'","", $_POST['roleID']);
			if($roleID == ""){
				$genericError = "Impossible de mettre à jour un rôle inconnu";
			}
			else{
				$check_query = "SELECT ID FROM rbac_roles WHERE ID='$roleID'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
				$verif = mysqli_query($link, $check_query);
				$row_verif = mysqli_fetch_assoc($verif);
				$role = mysqli_num_rows($verif);		
				if (!$role){
					$genericError = "Le rôle en question n'existe pas";
				}
				else {
					$roleTitle=$rbac->Roles->getTitle($roleID);
					if ($rbac->Users->hasRole($roleTitle, $userID)) {
						$isDone = $rbac->Users->unassign($roleTitle, $userID);
					}
					else {
						$isDone = $rbac->Users->assign($roleTitle, $userID);
					}
					if (!$isDone){
						$genericError = "Echec de la mise à jour ('".$roleTitle."')";
					}
					else {
						$genericSucces = "Rôle mis à jour avec la permission '".$roleTitle."'";	
					}
				}
			}
		}
	?>

	<!-- Page content container -->
	<div class="container">
		

		<!-- Update user's roles : Operation status indicator -->
		<?php include 'functions/operation-status-indicator.php'; ?>

		<h2>Modifier les rôles de '<?php echo $userFirstName." ".$userLastName ?>'</h2>


		<!-- Update a user's roles : display form -->
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Rôles associés à l'utilisateur</h3>
			</div>
			<div class="panel-body">
				<form id="roleuser" class="form-horizontal" action='user-assign-roles.php' method='post' accept-charset='utf-8'>
					<input type="hidden" name="userID" value="<?php echo $userID;?>">
					<input type="hidden" name="roleID" id="roleID" value="undefined">
				
					Les changements se font directement en cliquant sur les boutons. 
					<br /> <br />

					<?php 
						$query = "SELECT ID, Title, Description FROM rbac_roles ORDER by Title ASC";
						$roles = mysqli_query($link, $query);
						while($role = mysqli_fetch_array($roles)) { 
							$roleID=$role["ID"];
							$roleTitle=$role["Title"];
							$roleDescription=$role["Description"];
							
							if ($rbac->Users->hasRole($roleID, $userID)) {
								?>
								<button type="button" class="btn btn-default btn-xs active" title="<?php echo $roleDescription;?>" onClick="send(<?php echo $roleID;?>)"><?php echo $roleTitle;?></button>
								<?php
							}
							else {
								?>
								<button type="button" class="btn btn-default btn-xs" title="<?php echo $roleDescription;?>" onClick="send(<?php echo $roleID;?>)"><?php echo $roleTitle;?></button>
								<?php
							}

						} ?>
						<br /> <br />


					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-8">
							<a class="btn btn-info" href="user-view.php" role="button">Retour à la liste des utilisateurs</a>
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