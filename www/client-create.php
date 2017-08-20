<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Gestion des clients</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="/client-list.php">Clients</a></li>
	<li class="active">Création</li>
</ol>


<!-- Compute city calculation according to POST & GET variables (before auth)-->
<?php require_once('functions/client/client-compute-city.php'); ?>

<!-- Authentication -->
<?php require_once('functions/client/client-update-authentication.php'); ?>

<!-- Create a new client : Controller -->
<?php include('functions/controller/client-create-controller.php'); ?>

<!-- Page content container -->
<div class="container">

	<!-- Update client : Operation status indicator -->
	<?php include('components/operation-status-indicator.php'); ?>

	<h2>Gestion des clients</h2>


	<!-- Create a user : display form -->
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Création d'un client</h3>
		</div>
		<div class="panel-body">
			<form class="form-horizontal" id="auto-validation-form" action='' role="form" method='post' accept-charset='utf-8'>
				<input type="hidden" id="wish" name="addClient" />

				<?php $feedback = compute_server_feedback($client_name_error);?>
		    <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
		      <label for="client_name" class="col-sm-4 control-label">
		        Nom de l'organisation
		        <span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Nom de la société, association, collectivité, etc." />
		      </label>
		      <div class="col-sm-8">
		        <input type="text" class="form-control" id="client_name" name="client_name" aria-describedby="client-name-error" placeholder="Nom de l'organisation" minlength='8' required='true' value="<?php echo $client_name;?>" />
		        <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
		        <span id='client-name-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
		      </div>
		    </div>

				<?php $feedback = compute_server_feedback($client_ref_error);?>
		    <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
		      <label for="client_ref" class="col-sm-4 control-label">
		        Nom de l'organisation
		        <span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Un nom court qui vous permettra de sélectionner ce client lors de la création d'un DPS." />
		      </label>
		      <div class="col-sm-8">
		        <input type="text" class="form-control" id="client_ref" name="client_ref" aria-describedby="client-ref-error" placeholder="Un nom court qui vous permettra de sélectionner ce client lors de la création d'un DPS" minlength='3' required='true' value="<?php echo $client_ref;?>" />
		        <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
		        <span id='client-ref-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
		      </div>
		    </div>

		    <?php $feedback = compute_server_feedback($client_represent_error);?>
		    <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
		      <label for="client_represent" class="col-sm-4 control-label">
		        Représenté par
		        <span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Personne qui représente l'organisation."></span>
		      </label>
		      <div class="col-sm-8">
		        <input type="text" class="form-control" id="client_represent" name="client_represent" aria-describedby="client-represent-error" placeholder="Monsieur TrucMuche" minlength='4' required='true' value="<?php echo $client_represent;?>" />
		        <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
		        <span id='client-represent-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
		      </div>
		    </div>

		    <?php $feedback = compute_server_feedback($client_title_error);?>
		    <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
		      <label for="client_title" class="col-sm-4 control-label">
		        Qualité
		        <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Statut du représentant."></span>
		      </label>
		      <div class="col-sm-8">
		        <input type="text" class="form-control" id="client_title" name="client_title" aria-describedby="client-title-error" placeholder="Président / Député-Maire / Directeur" minlength='4' required='true' value="<?php echo $client_title;?>" >
		        <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
		        <span id='client-title-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
		      </div>
		    </div>

		    <?php $feedback = compute_server_feedback($client_address_error);?>
		    <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
		      <label for="client_address" class="col-sm-4 control-label">
		        Adresse postale
		        <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Adresse, code postal, ville."></span>
		      </label>
		      <div class="col-sm-8">
		        <input type="text" class="form-control" id="client_address" name="client_address" aria-describedby="client-address-error" placeholder="13 rue de la Poupée qui Tousse, 92230 Gennevilliers" minlength='20' required='true' value="<?php echo $client_address;?>" data-minlength="6" >
		        <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
		        <span id='client-adress-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
		      </div>
		    </div>

		    <?php $feedback = compute_server_feedback($client_phone_error);?>
		    <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
		      <label for="client_phone" class="col-sm-4 control-label">
		        Téléphone
		        <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Format 0XXXXXXXXX"></span>
		      </label>
		      <div class="col-sm-8">
		        <input type="tel" class="form-control" id="client_phone" name="client_phone" aria-describedby="client-phone-error" placeholder="telephone" minlength='10' maxlength='10' required='true' digits='true' value="<?php echo $client_phone;?>" data-minlength="10" >
		        <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
		        <span id='client-phone-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
		      </div>
		    </div>

		    <?php $feedback = compute_server_feedback($client_fax_error);?>
		    <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
		      <label for="client_fax" class="col-sm-4 control-label">
		        Fax
		        <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Format 0XXXXXXXXX"></span>
		      </label>
		      <div class="col-sm-8">
		        <input type="tel" class="form-control" id="client_fax" name="client_fax" aria-describedby="client-fax-error" placeholder="Fax" minlength='10' maxlength='10' digits='true' value="<?php echo $client_fax;?>"data-minlength="10">
		        <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
		        <span id='client-fax-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
		      </div>
		    </div>

		    <?php $feedback = compute_server_feedback($client_email_error);?>
		    <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
		      <label for="client_email" class="col-sm-4 control-label">
		        E-mail
		        <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Adresse e-mail du représentant ou de l'organisation."></span>
		      </label>
		      <div class="col-sm-8">
		        <input type="email" class="form-control" id="client_email" name="client_email" aria-describedby="client-email-error" placeholder="E-mail" minlength='4' email='true' value="<?php echo $client_email;?>" data-minlength="10" />
		        <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
		        <span id='client-email-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
		      </div>
		    </div>

				<?php
				if ($rbac->check("ope-clients-update-all", $currentUserID)) {
					?>
					<div class="form-group form-group-sm">
						<label for="attached_section" class="col-sm-4 control-label">Section</label>
						<div class="col-sm-8">
							<select class="form-control" id="attached_section" name="attached_section">
								<?php
									$reqliste = "SELECT number, name FROM $tablename_sections" or die("Erreur lors de la consultation" . mysqli_error($db_link));
									$sections = mysqli_query($db_link, $reqliste);
									while($section = mysqli_fetch_array($sections)) {
										echo "<option value='".$section["number"]."'>".$section["name"]."</option>";
									}
								?>
							</select>
						</div>
					</div>
					<?php
				}
				else {
					?>
					<input type="hidden" id="attached_section" name="attached_section" value='<?php echo $currentUserSection;?>' />
					<?php
				}
				?>

				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<?php if (empty($genericSuccess)){ ?>
							<a class="btn btn-default" href="client-list.php" role="button">Annuler - Retour à la liste</a>
						<?php } ?>
						<button type="submit" class="btn btn-success" id='submitAddClientForm'>Créer</button>
						<?php if (isset($_POST['addClient']) && !empty($genericSuccess)) { ?>
							<a class="btn btn-default" href="client-list.php" role="button">J'ai terminé ! Retour à la liste</a>
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
