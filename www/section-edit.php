<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Gestion des sections</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<ol class='breadcrumb'>
	<li><a href='/'>Home</a></li>
	<li><a href='/section-view.php'>Gestion des sections</a></li>
	<li class='active'>Modification</li>
</ol>



<!-- Authentication -->
<?php $rbac->enforce('admin-users-update', $currentUserID); ?>


<!-- Common -->
<?php include ('functions/controller/section-common.php'); ?>


<!-- Update section : Controller -->
<?php include ('functions/controller/section-update-controller.php'); ?>


<!-- Page content container -->
<div class='container'>

	<!-- Update user : Operation status indicator -->
	<?php include ('components/operation-status-indicator.php'); ?>

	<h2>Modifier la section '<?php echo $name ?>'</h2>


	<!-- Update user : display form -->
	<div class='panel panel-info'>
		<div class='panel-heading'>
			<h3 class='panel-title'>Modifier la commune de <strong><?php echo $name; ?> - Antenne N°<?php echo $number;?></strong></h3>
		</div>
		<div class='panel-body'>
			<form class='form-horizontal' id='auto-validation-form' action='' role='form' method='post' accept-charset='utf-8'>
				<input type='hidden' name='update'>
				<input type='hidden' name='ID' type='text' value='<?php echo $id;?>'>

				<div class='form-group form-group-sm'>
					<label for='name' class='col-sm-4 control-label'>Nom</label>
					<div class='col-sm-8'>
						<input type='text' class='form-control' id='name' name='name' minlength='3' maxlength='50' required='true' value='<?php echo $name; ?>'>
					</div>
				</div>

				<div class='form-group form-group-sm'>
					<label for='number' class='col-sm-4 control-label'>Numéro interne</label>
					<div class='col-sm-8'>
						<input type='text' class='form-control' id='number' name='number' minlength='1' maxlength='2' digits='true' required='true' value='<?php echo $number; ?>'>
					</div>
				</div>

				<div class='form-group form-group-sm'>
					<label for='shortname' class='col-sm-4 control-label'>Nom court</label>
					<div class='col-sm-8'>
						<input type='text' class='form-control' id='shortname' name='shortname' minlength='3' maxlength='3' required='true' value='<?php echo $shortname; ?>'>
					</div>
				</div>

				<div class='form-group form-group-sm'>
					<label for='address' class='col-sm-4 control-label'>Adresse postale</label>
					<div class='col-sm-8'>
						<input type='text' class='form-control' id='address' name='address' value='<?php echo $address; ?>'>
					</div>
				</div>

				<div class='form-group form-group-sm'>
					<label for='zipcode' class='col-sm-4 control-label'>Code postal</label>
					<div class='col-sm-8'>
						<input type='text' class='form-control' id='zipcode' name='zipcode' minlength='5' maxlength='5' digits='true' value='<?php echo $zipcode; ?>'>
					</div>
				</div>

				<div class='form-group form-group-sm'>
					<label for='city' class='col-sm-4 control-label'>Ville</label>
					<div class='col-sm-8'>
						<input type='text' class='form-control' id='city' name='city' minlength='3' maxlength='40' value='<?php echo $city; ?>'>
					</div>
				</div>

				<div class='form-group form-group-sm'>
					<label for='phone' class='col-sm-4 control-label'>Téléphone de contact</label>
					<div class='col-sm-8'>
						<input type='text' class='form-control' id='phone' name='phone' minlength='10' maxlength='10' required='true' digits='true' value='<?php echo $phone; ?>'>
					</div>
				</div>

				<div class='form-group form-group-sm'>
					<label for='mail' class='col-sm-4 control-label'>Adresse mail de contact</label>
					<div class='col-sm-8'>
						<input type='text' class='form-control' id='mail' name='mail' minlength='3' maxlength='40' email='true' required='true' value='<?php echo $mail; ?>'>
					</div>
				</div>

				<div class='form-group form-group-sm'>
					<label for='website' class='col-sm-4 control-label'>Site internet</label>
					<div class='col-sm-8'>
						<input type='text' class='form-control' id='website' name='website' minlength='1' maxlength='40' url='true' required='true' value='<?php echo $website; ?>'>
					</div>
				</div>

				<div class='form-group form-group-sm'>
					<label for='attached_section' class='col-sm-4 control-label'>Section</label>
					<div class='col-sm-8'>
						<select class='form-control' id='attached_section' name='attached_section'>
							<?php
								$reqliste = "SELECT `number`, name FROM sections ORDER BY number" or die("Erreur lors de la consultation" . mysqli_error($db_link));
								$sections = mysqli_query($db_link, $reqliste);

								while($sectionX = mysqli_fetch_array($sections)) {
									if ($sectionX['number'] == $attached_section){
										echo "<option value='".$sectionX['number']."' selected>".$sectionX['name']."</option>";
									}
									else {
										echo "<option value='".$sectionX['number']."'>".$sectionX['name']."</option>";
									}

								}
							?>
						</select>
					</div>
				</div>

				<div class='form-group'>
					<div class='col-sm-offset-4 col-sm-8'>
						<?php if (empty($genericSuccess)){ ?>
							<a class='btn btn-default' href='section-view.php' role='button'>Annuler - Retour à la liste</a>
						<?php } ?>
						<button type='submit' class='btn btn-warning' id='submit'>Mettre à jour</button>
						<?php if (isset($_POST['update']) && !empty($genericSuccess)) { ?>
							<a class='btn btn-default' href='section-view.php' role='button'>J'ai terminé ! Retour à la liste</a>
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
