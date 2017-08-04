<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Gestion des utilisateurs</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="/user-view.php">Gestion des utilisateurs</a></li>
	<li class="active">Création</li>
</ol>


<!-- Authentication -->
<?php $rbac->enforce("admin-users-update", $currentUserID); ?>

<!-- Create a new user : Controller -->
<?php include 'functions/controller/user-create-controller.php'; ?>

<!-- Page content container -->
<div class="container">

	<!-- Update user : Operation status indicator -->
	<?php include 'components/operation-status-indicator.php'; ?>

	<h2>Gestion des utilisateurs</h2>


	<!-- Create a user : display form -->
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Création d'un utilisateur</h3>
		</div>
		<div class="panel-body">
			<form class="form-horizontal" id="auto-validation-form" action='' role="form" method='post' accept-charset='utf-8'>
				<input type="hidden" id="wish" name="addUser" />


				<?php if (!empty($createErrorLastName)){ ?>
					<div class="form-group form-group-sm has-error has-feedback">
						<label for="inputUserLastName" class="col-sm-4 control-label">Nom</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="inputUserLastName" name="inputUserLastName" aria-describedby="inputError2Status" placeholder="ex: Dupond" minlength='2' maxlength='20' required='true' value="<?php if (!empty($genericError)) {echo $lastName;} ?>">
							<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
							<span id="inputError2Status" class="sr-only">(error)</span>
						</div>
					</div>
				<?php } else { ?>
					<div class="form-group form-group-sm">
						<label for="inputUserLastName" class="col-sm-4 control-label">Nom</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="inputUserLastName" name="inputUserLastName" aria-describedby="inputError2Status" placeholder="ex: Dupond" minlength='2' maxlength='20' required='true' value="<?php if (!empty($genericError)) {echo $lastName;} ?>">
						</div>
					</div>
				<?php } ?>

				<?php $feedback = compute_server_feedback($createErrorFirstName);?>
				<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
					<label for="inputUserFirstName" class="col-sm-4 control-label">Prénom</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="inputUserFirstName" name="inputUserFirstName" aria-describedby="inputUserFirstName-error" placeholder="ex: Jean" minlength='2' maxlength='20' required='true' value="<?php echo ucfirst($firstName); ?>">
						<span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
						<span id='inputUserLogin-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
					</div>
				</div>

				<?php $feedback = compute_server_feedback($createErrorLogin);?>
				<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
					<label for="inputUserLogin" class="col-sm-4 control-label">Matricule e-Protec</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="inputUserLogin" name="inputUserLogin" aria-describedby="inputUserLogin-error" placeholder="ex: 49594" minlength='4' maxlength='8' required='true' digits='true' value="<?php echo $login; ?>">
						<span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
					<span id='inputUserLogin-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
					</div>
				</div>

				<?php if (!empty($createErrorPassword)){ ?>
					<div class="form-group form-group-sm has-error has-feedback">
						<label for="inputUserPassword1" class="col-sm-4 control-label">Mot de passe</label>
						<div class="col-sm-8">
							<input type="password" class="form-control" id="inputUserPassword1" name="inputUserPassword1" minlength='6' maxlength='20' required='true' aria-describedby="inputError2Status">
							<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
							<span id="inputError2Status" class="sr-only">(error)</span>
						</div>
					</div>
				<?php } else { ?>
					<div class="form-group form-group-sm">
						<label for="inputUserPassword1" class="col-sm-4 control-label">Mot de passe</label>
						<div class="col-sm-8">
							<input type="password" class="form-control" id="inputUserPassword1" name="inputUserPassword1" minlength='6' maxlength='20' required='true' aria-describedby="inputError2Status">
						</div>
					</div>
				<?php } ?>

				<div class="form-group form-group-sm">
					<label for="inputUserPassword2" class="col-sm-4 control-label">Confirmation du mot de passe</label>
					<div class="col-sm-8">
						<input type="password" class="form-control" id="inputUserPassword2" name="inputUserPassword2" minlength='6' maxlength='20' required='true' equalTo='#inputUserPassword1' aria-describedby="inputError2Status">
					</div>
				</div>
				<div class="form-group form-group-sm">
					<label for="inputUserPhone" class="col-sm-4 control-label">Téléphone</label>
					<div class="col-sm-8">
						<input type="phone" class="form-control" id="inputUserPhone" name="inputUserPhone" aria-describedby="inputError2Status" minlength='10' maxlength='10' required='false' digits='true' value="<?php if (!empty($genericError)) {echo $phone;} ?>">
					</div>
				</div>

				<div class="form-group form-group-sm">
					<label for="inputUserSection" class="col-sm-4 control-label">Section</label>
					<div class="col-sm-8">
						<select class="form-control" id="inputUserSection" name="inputUserSection">
							<?php
								$reqliste = "SELECT number, name FROM sections" or die("Erreur lors de la consultation" . mysqli_error($db_link));
								$sections = mysqli_query($db_link, $reqliste);
								while($section = mysqli_fetch_array($sections)) {
									echo "<option value='".$section["number"]."'>".$section["name"]."</option>";
								}
							?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<?php if (empty($genericSuccess)){ ?>
							<a class="btn btn-default" href="user-view.php" role="button">Annuler - Retour à la liste</a>
						<?php } ?>
						<button type="submit" class="btn btn-success" id='submitAddUserForm'>Créer</button>
						<?php if (isset($_POST['addUser']) && !empty($genericSuccess)) { ?>
							<a class="btn btn-default" href="user-view.php" role="button">J'ai terminé ! Retour à la liste</a>
						<?php } ?>
				   </div>
				</div>
			</form>
		</div>
	</div>

</div>

<?php include('components/footer.php'); ?>

<script text='text/javascript'>
	$('#auto-validation-form').validate();
</script>

</body>
</html>
