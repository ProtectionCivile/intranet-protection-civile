<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Affectation des rôles</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
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


<!-- Authentication -->
<?php $rbac->enforce("admin-users-asssign-roles", $currentUserID); ?>

<!-- Common -->
<?php include 'functions/controller/user-common.php'; ?>

<?php 
	if(empty($commonError)) {
	?>

	<!-- Update a user's roles : Controller -->
	<?php include 'functions/controller/user-assign-roles-controller.php'; ?>

	<!-- Page content container -->
	<div class="container">
		

		<!-- Update user's roles : Operation status indicator -->
		<?php include 'components/operation-status-indicator.php'; ?>

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
					$queryC = "SELECT name, number FROM sections WHERE attached_section=number" or die("Erreur lors de la consultation" . mysqli_error($link)); 
					$cities = mysqli_query($link, $queryC);
					?>

					<table class='table table-bordered table-hover table-condensed'>
						<thead>
							<th><center>Commune</center></th>
							<th><center>Rôles de l'utilisateur</center></th>
						</thead>
						<tbody>
							<?php while($city = mysqli_fetch_array($cities)) { 
								$queryR="SELECT ID, Description, Title FROM rbac_roles WHERE Assignable='1' AND Affiliation='".$city['number']."'" ;
								$roles = mysqli_query($link, $queryR);
								?>
								<tr>
									<td class="active"><?php echo $city['name']; ?></td>
									<td>
										<?php
										while($role = mysqli_fetch_array($roles)) { 
											$roleID=$role["ID"];
											$roleTitle=$role["Title"];
											$roleDescription=$role["Description"];
											if ($rbac->Users->hasRole($roleID, $userID)) {
												?><button type="button" class="btn btn-default btn-xs active" title="<?php echo $roleTitle;?>" onClick="send(<?php echo $roleID;?>)"><?php echo $roleDescription;?></button><?php
											}
											else {
												?><button type="button" class="btn btn-default btn-xs" title="<?php echo $roleTitle;?>" onClick="send(<?php echo $roleID;?>)"><?php echo $roleDescription;?></button><?php
											}
										}
										?>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>

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