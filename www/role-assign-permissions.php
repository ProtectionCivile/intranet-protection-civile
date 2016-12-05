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


<!-- Authentication -->
<?php $rbac->enforce("admin-roles-asssign-permissions", $currentUserID); ?>

<!-- Common -->
<?php include 'functions/controller/role-common.php'; ?>

<?php 
if(empty($commonError)) {
	?>

	<!-- Update a role's permissions : Controller -->
	<?php include 'functions/controller/role-assign-permissions-controller.php'; ?>

	<!-- Page content container -->
	<div class="container">
		

		<!-- Update role's permissions : Operation status indicator -->
		<?php include 'components/operation-status-indicator.php'; ?>

		<h2>Modifier les permissions du rôle '<?php echo $roleDescription ?>'</h2>


		<!-- Update a role's permissions : display form -->
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Permissions associées au rôle</h3>
			</div>
			<div class="panel-body">
				<form id="permrole" class="form-horizontal" action='role-assign-permissions.php' method='post' accept-charset='utf-8'>
					<input type="hidden" name="roleID" value="<?php echo $roleID;?>">
					<input type="hidden" name="permissionID" id="permissionID" value="undefined">
				
					Les changements se font directement en cliquant sur les boutons. 
					<br /> <br />
					<ul>
					<?php 
					$query = "SELECT ID, Title, Description FROM rbac_permissions ORDER by Title ASC";
					$permissions = mysqli_query($link, $query);
					while($permission = mysqli_fetch_array($permissions)) { 
						$permissionID=$permission["ID"];
						$permissionTitle=$permission["Title"];
						$permissionDescription=$permission["Description"];
						?>
						<li>
						<?php
						if ($rbac->Roles->hasPermission($roleID, $permissionID)) {
							?>
							<button type="button" class="btn btn-default btn-xs active" title="<?php echo $permissionTitle;?>" onClick="send(<?php echo $permissionID;?>)"><?php echo $permissionDescription;?></button>
							<?php
						}
						else {
							?>
							<button type="button" class="btn btn-default btn-xs" title="<?php echo $permissionTitle;?>" onClick="send(<?php echo $permissionID;?>)"><?php echo $permissionDescription;?></button>
							<?php
						}
						?>
						</li>

					<?php } ?>
					</ul>
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