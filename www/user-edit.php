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
	<li><a href="#">Administration</a></li>
	<li><a href="/user-view.php">Gestion des utilisateurs</a></li>
	<li class="active">Modification</li>
</ol>


<!-- Authentication -->
<?php $rbac->enforce("admin-users-update", $currentUserID); ?>


<!-- Common -->
<?php include ('functions/controller/user-common.php'); ?>


<!-- Update user : Controller -->
<?php include ('functions/controller/user-update-controller.php'); ?>


<!-- Page content container -->
<div class="container">

	<!-- Update user : Operation status indicator -->
	<?php include ('components/operation-status-indicator.php'); ?>

	<h2>Modifier l'utilisateur '<?php echo $firstName." ".$lastName ?>'</h2>


	<!-- Update user : display form -->
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Informations à mettre à jour</h3>
		</div>
		<div class="panel-body">
			<form class="form-horizontal" id="auto-validation-form" action='' role="form" method='post' accept-charset='utf-8'>
				<input type="hidden" name="updateUser">
				<input type="hidden" name="userID" value="<?php echo $userID;?>">

				<?php if (!empty($createErrorLastName)){ ?>
					<div class="form-group form-group-sm has-error has-feedback">
						<label for="inputUserLastName" class="col-sm-4 control-label">Nom</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="inputUserLastName" name="inputUserLastName" aria-describedby="inputError2Status" placeholder="ex: Dupond" minlength='2' maxlength='20' required='true' value="<?php echo ucfirst($lastName); ?>">
							<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
							<span id="inputError2Status" class="sr-only">(error)</span>
						</div>	
					</div>
				<?php } else { ?>
					<div class="form-group form-group-sm">
						<label for="inputUserLastName" class="col-sm-4 control-label">Nom</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="inputUserLastName" name="inputUserLastName" aria-describedby="inputError2Status" placeholder="ex: Dupond" minlength='2' maxlength='20' required='true' value="<?php echo ucfirst($lastName); ?>">
						</div>
					</div>
				<?php } ?>
				
				
				<div class="form-group form-group-sm has-feedback <?php if(!empty($createErrorLogin)){echo "has-error";}?>">
					<label for="inputUserFirstName" class="col-sm-4 control-label">Prénom</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="inputUserFirstName" name="inputUserFirstName" aria-describedby="inputUserLogin-error" placeholder="ex: Jean" minlength='2' maxlength='20' required='true' value="<?php echo ucfirst($firstName); ?>">
						<span class="form-control-feedback glyphicon" aria-hidden="true"></span>
						<span id='inputUserLogin-error' class="help-block" aria-hidden="true"><?php if(!empty($createErrorFirstName)){echo $createErrorFirstName;}?></span>
					</div>
				</div>

				<div class="form-group form-group-sm has-feedback <?php if(!empty($createErrorLogin)){echo "has-error";}?>">
					<label for="inputUserLogin" class="col-sm-4 control-label">Matricule e-Protec</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="inputUserLogin" name="inputUserLogin" aria-describedby="inputUserLogin-error" placeholder="ex: 49594" minlength='4' maxlength='8' required='true' digits='true' value="<?php echo $login; ?>">
						<span class="form-control-feedback glyphicon" aria-hidden="true"></span>
						<span id='inputUserLogin-error' class="help-block" aria-hidden="true"><?php if(!empty($createErrorLogin)){echo $createErrorLogin;}?></span>
					</div>
				</div>
				
				<?php if (!empty($createErrorPassword)){ ?>
					<div class="form-group form-group-sm has-error has-feedback">
						<label for="inputUserPassword1" class="col-sm-4 control-label">Mot de passe</label>
						<div class="col-sm-8">
							<input type="password" class="form-control" id="inputUserPassword1" name="inputUserPassword1" minlength='6' maxlength='20' required='false' aria-describedby="inputError2Status">
							<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
							<span id="inputError2Status" class="sr-only">(error)</span>
						</div>
					</div>
				<?php } else { ?>
					<div class="form-group form-group-sm">
						<label for="inputUserPassword1" class="col-sm-4 control-label">Mot de passe</label>
						<div class="col-sm-8">
							<input type="password" class="form-control" id="inputUserPassword1" name="inputUserPassword1" minlength='6' maxlength='20' required='false' aria-describedby="inputError2Status">
						</div>
					</div>
				<?php } ?>
				
				<div class="form-group form-group-sm">
					<label for="inputUserPassword2" class="col-sm-4 control-label">Confirmation du mot de passe</label>
					<div class="col-sm-8">
						<input type="password" class="form-control" id="inputUserPassword2" name="inputUserPassword2" minlength='6' maxlength='20' required='false' equalTo='#inputUserPassword1' aria-describedby="inputError2Status">
					</div>
				</div>
				
				<div class="form-group form-group-sm">
					<label for="inputUserPhone" class="col-sm-4 control-label">Téléphone</label>
					<div class="col-sm-8">
						<input type="phone" class="form-control" id="inputUserPhone" name="inputUserPhone" aria-describedby="inputError2Status" minlength='10' maxlength='10' required='false' digits='true' value="<?php echo $phone; ?>">
					</div>
				</div>

				<div class="form-group form-group-sm">
					<label for="inputUserSection" class="col-sm-4 control-label">Section</label>
					<div class="col-sm-8">
						<select class="form-control" id="inputUserSection" name="inputUserSection">
							<?php							
								$reqliste = "SELECT `number`, name FROM sections" or die("Erreur lors de la consultation" . mysqli_error($db_link)); 
								$sections = mysqli_query($db_link, $reqliste);

								while($sectionX = mysqli_fetch_array($sections)) {
									echo $userSection;
									if ($sectionX['number'] == $section){
										echo "<option value='".$sectionX["number"]."' selected>".$sectionX["name"]."</option>";
									}
									else {
										echo "<option value='".$sectionX["number"]."'>".$sectionX["name"]."</option>";
									}
									
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
						<button type="submit" class="btn btn-warning" id='submit'>Mettre à jour</button>
						<?php if (isset($_POST['updateUser']) && !empty($genericSuccess)) { ?>
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
