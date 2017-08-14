<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Modifier un rôle</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="/role-list.php">Gestion des rôles</a></li>
	<li class="active">Modification</li>
</ol>


<!-- Authentication -->
<?php $rbac->enforce("admin-roles-update", $currentUserID); ?>

<!-- Common -->
<?php include 'functions/controller/role-common.php'; ?>

<?php
	if(empty($commonError)) {
?>

	<!-- Update role : Controller -->
	<?php include 'functions/controller/role-update-controller.php'; ?>


	<!-- Page content container -->
	<div class="container">

		<!-- Update role : Operation status indicator -->
		<?php include 'components/operation-status-indicator.php'; ?>


		<h2>Modifier le rôle '<?php echo $roleTitle ?>'</h2>


		<!-- Update role : display form -->
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Informations à mettre à jour</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" action='' id='auto-validation-form' method='post' accept-charset='utf-8'>
					<input type="hidden" name="updateRole">
					<input type="hidden" name="roleID" value="<?php echo $roleID;?>">

					<?php if (!empty($updateErrorTitle)){ ?>
						<div class="form-group has-error has-feedback">
							<label for="inputRoleTitle" class="col-sm-4 control-label">Nouveau titre</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="inputRoleTitle" name="inputRoleTitle" aria-describedby="inputError2Status" placeholder="Directeur Local des Opérations" minlength='3' maxlength='120' required='true' value="<?php echo $title;?>" />
							</div>
							<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
							<span id="inputError2Status" class="sr-only">(error)</span>
						</div>
					<?php } else { ?>
						<div class="form-group">
							<label for="inputRoleTitle" class="col-sm-4 control-label">Nouveau titre</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="inputRoleTitle" name="inputRoleTitle" aria-describedby="inputError2Status" placeholder="Directeur Local des Opérations" minlength='3' maxlength='120' required='true' value="<?php echo $title;?>" />
							</div>
						</div>
					<?php } ?>

					<div class="form-group">
						<label for="inputRoleDescription" class="col-sm-4 control-label">Nouvelle description</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="inputRoleDescription" name="inputRoleDescription" placeholder="Décrire l'utilité du rôle" minlength='3' maxlength='120' required='true' value="<?php echo $description;?>" />
						</div>
					</div>

					<div class="form-group">
						<label for="inputRolePhone" class="col-sm-4 control-label">Téléphone</label>
						<div class="col-sm-8">
							<input type="tel" class="form-control" id="inputRolePhone" name="inputRolePhone" minlength='10' maxlength='10' required='false' digits='true' value="<?php echo $r['Phone']; ?>"/>
						</div>
					</div>

					<div class="form-group">
						<label for="inputRoleMail" class="col-sm-4 control-label">e-Mail</label>
						<div class="col-sm-8">
							<input type="email" class="form-control" id="inputRoleMail" name="inputRoleMail" minlength='3' maxlength='120' required='false' email='true' value="<?php echo $r['Mail']; ?>"/>
						</div>
					</div>

					<div class="form-group">
						<label for="inputRoleCallsign" class="col-sm-4 control-label">Indicatif radio</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="inputRoleCallsign" name="inputRoleCallsign" minlength='3' maxlength='120' required='false' value="<?php echo $r['Callsign']; ?>" />
						</div>
					</div>

					<div class="form-group">
						<label for="inputRoleAssignable" class="col-sm-4 control-label">Assignable à un utilisateur</label>
						<div class="col-sm-8 checkbox">
							<input type="checkbox" id="inputRoleAssignable" name="inputRoleAssignable" <?php if ($r['Assignable']) echo "checked"; ?> />
						</div>
					</div>

					<div class="form-group">
						<label for="inputRoleDirectory" class="col-sm-4 control-label">Apparaît dans annuaire</label>
						<div class="col-sm-8 checkbox">
							<input type="checkbox" id="inputRoleDirectory" name="inputRoleDirectory" <?php if ($r['Directory']) echo "checked"; ?> />
						</div>
					</div>

					<div class="form-group">
						<label for="inputRoleAffiliation" class="col-sm-4 control-label">Rattachement</label>
						<div class="col-sm-8 radio"><?php
							$query = "SELECT numero, nom FROM commune";
							$query_result = mysqli_query($db_link, $query);
							while($data = mysqli_fetch_array($query_result)){ ?>
								<label>
									<input type="radio" name="inputRoleAffiliation" value="<?php echo $data['numero'];?>" <?php if ($r['Affiliation']==$data['numero']) echo "checked"; ?> />
									<?php echo $data['nom'];?>
								</label>
							 <?php
							} ?>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-8">
							<?php if (empty($genericSuccess)){ ?>
								<a class="btn btn-default" href="role-list.php" role="button">Annuler - Retour à la liste</a>
							<?php } ?>
							<button type="submit" class="btn btn-warning">Mettre à jour</button>
							<?php if (isset($_POST['updateRole']) && !empty($genericSuccess)) { ?>
								<a class="btn btn-success" href="role-list.php" role="button">J'ai terminé ! Retour à la liste</a>
							<?php } ?>
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

<script text='text/javascript'>
	$('#auto-validation-form').validate();
</script>

</body>
</html>
