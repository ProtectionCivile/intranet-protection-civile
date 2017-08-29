<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Affectation des permissions</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Accueil</a></li>
	<li><a href="/role-list.php">Gestion des rôles</a></li>
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

		<div class="page-header">
			<h2>Gestion des rôles <small>Modifier les permissions de '<?php echo $role_title ?>'</small></h2>
		</div>


		<!-- Update role's permissions : Operation status indicator -->
		<?php include 'components/operation-status-indicator.php'; ?>


		<!-- Update a role's permissions : display form -->
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Permissions associées au rôle</h3>
			</div>
			<div class="panel-body">
				<form id="permrole" class="form-horizontal" action='role-assign-permissions.php' method='post' accept-charset='utf-8'>
					<input type="hidden" name="id" value="<?php echo $id;?>">
					<input type="hidden" name="permissionID" id="permissionID" value="undefined">

					Les changements se font directement en cliquant sur les boutons.
					<br /> <br />
					<ul>
					<?php
					$query = "SELECT ID, Title, Description FROM $tablename_permissions ORDER by Title DESC";
					$permissions = mysqli_query($db_link, $query);
					while($permission = mysqli_fetch_array($permissions)) {
						$permissionID=$permission["ID"];
						$permission_title=$permission["Title"];
						$permission_description=$permission["Description"];
						?>
						<li>
						<?php
						if ($rbac->Roles->hasPermission($id, $permissionID)) {
							?>
							<button type="button" class="btn btn-default btn-xs active" title="<?php echo $permission_title;?>" onClick="send(<?php echo $permissionID;?>)"><?php echo $permission_description;?></button>
							<?php
						}
						else {
							?>
							<button type="button" class="btn btn-default btn-xs" title="<?php echo $permission_title;?>" onClick="send(<?php echo $permissionID;?>)"><?php echo $permission_description;?></button>
							<?php
						}
						?>
						</li>

					<?php } ?>
					</ul>
						<br /> <br />


					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-8">
							<a class="btn btn-info" href="role-list.php" role="button">Retour à la liste des rôles</a>
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
