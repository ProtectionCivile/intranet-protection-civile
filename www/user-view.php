<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Gestion des utilisateurs</title>
	<meta http-equiv="Content-Type" content="text/html">
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="#">Administration</a></li>
	<li class="active">Gestion des utilisateurs</li>
</ol>


<!-- Authentication -->
<?php $rbac->enforce("admin-users-view", $currentUserID); ?>


<!-- Delete a user : Controller -->
<?php include 'functions/controller/user-delete-controller.php'; ?>


<!-- Page content container -->
<div class="container">

	<!-- Update user : Operation status indicator -->
	<?php include 'components/operation-status-indicator.php'; ?>

	<h2>Gestion des utilisateurs</h2>


	<!-- List available users -->
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Visualisation des utilisateurs</h3>
		</div>
		<div class="table-responsive">
			<table class="table table-hover">
				<tr>
					<th>Nom</th>
					<th>Prénom</th>
					<th>Téléphone</th>
					<th>Mail</th>
					<th>Section</th>
					<th colspan='3'>Actions</th>
				</tr>
				<?php 
				$query = "SELECT U.ID, U.last_name, U.first_name, U.phone, U.mail, S.name AS section_name FROM `users` AS U INNER JOIN sections AS S ON `U`.`attached_section` = `S`.`number` ORDER by U.last_name ASC";
				$users = mysqli_query($link, $query);
				while($user = mysqli_fetch_array($users)) { ?>
					<tr>
						<td>
							<?php echo ucfirst($user["last_name"]); ?>
						</td>
						<td>
							<?php echo ucfirst($user["first_name"]); ?>
						</td>
						<td>
							<?php echo $user["phone"]; ?>
						</td>
						<td>
							<?php echo $user["mail"]; ?>
						</td>
						<td>
							<?php echo $user["section_name"]; ?>
						</td>
						<td>
							<?php if ($rbac->check("admin-asssign-roles-to-users", $currentUserID)) { ?>
								<form action='user-assign-roles.php' method='post' accept-charset='utf-8'>
									<input type='hidden' name='userID' value=<?php echo "'".$user['ID']."'"; ?> >
									<button type='submit' class='btn btn-warning glyphicon glyphicon-check' title='Voir / Affecter des rôles'></button>
								</form>
							<?php }?>
						</td>
						<td>
							<?php if ($rbac->check("admin-users-update", $currentUserID)) { ?>
								<form action='user-edit.php' method='post' accept-charset='utf-8'>
									<input type='hidden' name='userID' value=<?php echo "'".$user['ID']."'"; ?> >
									<button type='submit' class='btn btn-warning glyphicon glyphicon-pencil' title="Modifier"></button>
								</form>
							<?php }?>
						</td>
						<td>	
							<?php if ($rbac->check("admin-users-update", $currentUserID)) { ?>							
								<form action='' method='post' accept-charset='utf-8'>
									<input type='hidden' name='delUser' value=<?php echo "'".$user['ID']."'"; ?> >
									<button type='submit' class='btn btn-danger glyphicon glyphicon-trash' title="Supprimer" onclick='return(confirm("Etes-vous sûr de vouloir supprimer cet utilisateur?"));'></button>
								</form>
							<?php }?>
						</td>
					</tr>
				<?php } ?>
			</table>
		</div>
		<?php if ($rbac->check("admin-users-update", $currentUserID)) { ?>
			<div class="panel-footer"><a class="btn btn-default" role="button" href="user-create.php">Ajouter un utilisateur</a></div>
		<?php }?>
	</div>

</div>

<?php include('components/footer.php'); ?>

</body>
</html>