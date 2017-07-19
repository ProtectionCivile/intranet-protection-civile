<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Créer un DPS</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>




<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="#">Opérationnel</a></li>
	<li><a href="dps-list-view.php">Dispositifs de secours</a></li>
	<li class="active">Création</li>
</ol>


<!-- Compute city calculation according to POST & GET variables (before auth)-->
<?php require_once('components/dps/dps-compute-city.php'); ?>

<!-- Authentication -->
<?php //require_once('functions/dps/dps-create-authentication.php'); ?>

<!-- DPS duplication or client insertion : interpretor -->
	<?php require_once('components/dps/dps-preselect-client-or-duplicate-computation.php'); ?>

<!-- Create a new DPS : Controller -->
<?php require_once('functions/controller/dps-create-controller.php'); ?>

<!-- Page content container -->
<div class="container">

	<!-- Update : Operation status indicator -->
	<?php require_once('components/operation-status-indicator.php'); ?>

	<h2><center>Création d'un Dispositif Prévisionnel de Secours</center></h2>
	<h3><center><?php echo $cu; ?></center></h3>


	<!-- Notice after DPS duplication -->
	<?php if(isset($_POST['duplicate_dps'])){?>
		<div class='alert alert-warning'>
			<span class="glyphicon glyphicon-alert" style="font-size:2em"></span>
			<strong>Attention : </strong>Tous les champs ne sont pas dupliqués.	Vous devez vérifier tous les champs avant d'envoyer en validation.
		</div>
	<?php }?>



	<!-- Panel Accès spécial DDO : préselect section -->
	<?php require_once('components/dps/dps-create-ddo-access-select-section.php'); ?>


	<!-- Panel d'aide à la création de DPS -->
	<?php require_once('components/dps/dps-preselect-client-or-duplicate-module.php'); ?>



	<form class="form-horizontal" id='auto-validation-form' name='auto-validation-form' data-toggle="validator" role="form" action="" method="post">
		<input type='hidden' name='cu' value='<?php echo $cu;?>' />
		<input type='hidden' name='year' value='<?php echo $year;?>' />
		<input type='hidden' name='code_commune' value='<?php echo $city;?>'/>
		<input type='hidden' name='num_cu' value='<?php echo $num_cu;?>'/>

		<div class="panel panel-primary">
			<div class="panel-heading">
				<button type="button" class="close" aria-label='Close' data-toggle="collapse" data-target="#orga-panel-filter" aria-expanded='true' aria-controls="orga-panel-filter">
					<span aria-hidden="true" >Montrer/Cacher</span>
				</button>
				<h3 class="panel-title">Organisateur</h3>
			</div>

			<div id='orga-panel-filter' aria-expanded='true' class="panel-body in">
				<?php $feedback = compute_server_feedback($client_name_error);?>
				<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
					<label for="client_name" class="col-sm-4 control-label">
						Nom de l'organisation
						<span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Nom de la société, association, collectivité, etc." />
					</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="client_name" name="client_name" aria-describedby="client-name-error" placeholder="Nom de l'organisation" minlength='8' required='true' value="<?php echo $client_name;?>" >
						<span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
						<span id='client-name-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
					</div>
				</div>

				<?php $feedback = compute_server_feedback($client_reprensent_error);?>
				<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
					<label for="client_reprensent" class="col-sm-4 control-label">
						Représenté par
						<span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Personne qui représente l'organisation."></span>
					</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="client_reprensent" name="client_reprensent" aria-describedby="client-reprensent-error" placeholder="Représentant" minlength='4' required='true' value="<?php echo $client_reprensent;?>" >
						<span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
						<span id='client-reprensent-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
					</div>
				</div>

				<?php $feedback = compute_server_feedback($client_title_error);?>
				<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
					<label for="client_title" class="col-sm-4 control-label">
						Qualité
						<span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Statut du représentant."></span>
					</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="client_title" name="client_title" aria-describedby="client-title-error" placeholder="Qualité" minlength='4' required='true' value="<?php echo $client_title;?>" >
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
						<input type="text" class="form-control" id="client_address" name="client_address" aria-describedby="client-address-error" placeholder="Adresse" minlength='20' required='true' value="<?php echo $client_address;?>" data-minlength="6" >
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
						<input type="email" class="form-control" id="client_email" name="client_email" aria-describedby="client-email-error" placeholder="E-mail" minlength='4' email='true' value="<?php echo $client_email;?>" data-minlength="10" >
						<span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
						<span id='client-email-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
					</div>
				</div>


			</div>
		</div>

		<div class="panel panel-primary">
			<div class="panel-heading">
				<button type="button" class="close" aria-label='Close' data-toggle="collapse" data-target="#manif-panel-filter" aria-expanded='true' aria-controls="manif-panel-filter">
					<span aria-hidden="true" >Montrer/Cacher</span>
				</button>
				<h3 class="panel-title">Évènement</h3>
			</div>

			<div id='manif-panel-filter' class="panel-body in">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Nature de la manifestation</h3>
					</div>
					<div class="panel-body">

						<?php $feedback = compute_server_feedback($event_name_error);?>
						<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
							<label for="event_name" class="col-sm-4 control-label">
								Nom / Nature
								<span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Nom/Nature de la manifestation"></span>
							</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="event_name" name="event_name" aria-describedby="event-name-error" minlength='5' required='true' placeholder="Nom / Nature" value="<?php echo $event_name; ?>" data-minlength="10" >
								<span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
								<span id='event-name-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
							</div>
						</div>

						<?php $feedback = compute_server_feedback($event_description_error);?>
						<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
							<label for="event_description" class="col-sm-4 control-label">
								Activité / Descriptif
								<span class="glyphicon glyphicon-info-sign" data-trigger="hover" rel="popover" data-toggle="popover" data-content="Descriptif court."></span>
							</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="event_description" name="event_description" aria-describedby="event-description-error" minlength='5' required='true' placeholder="Activité / Descriptif" value="<?php echo $event_description; ?>" data-minlength="10" >
								<span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
								<span id='event-description-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
							</div>
						</div>

						<?php $feedback = compute_server_feedback($lieu_precis_error);?>
						<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
							<label for="lieu_precis" class="col-sm-4 control-label">
								Lieu précis avec adresse exacte
								<span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Adresse la plus précise possible du lieu de l'événement."></span>
							</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="lieu_precis" name="lieu_precis" aria-describedby="lieu_precis-error" minlength='10' required='true' placeholder="Adresse précise du lien de l'évenement" value="<?php echo $event_address; ?>" data-minlength="10" >
								<span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
								<span id='lieu_precis-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
							</div>
						</div>

						<?php $feedback = compute_server_feedback($event_department_error);?>
						<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
							<label for="event_department" class="col-sm-4 control-label">
								Département où se situe la manifestation
								<span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Exemple : 92"></span>
							</label>
							<div class="col-sm-2">
								<input type="number" class="form-control" id="event_department" name="event_department" aria-describedby="event-department-error" minlength='2' maxlength='3' required='true' digits='true' placeholder="92" value="<?php echo $event_department; ?>" data-minlength="10" >
								<span class="form-control-feedback" aria-hidden="true"></span>
								<span id='event-department-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
							</div>
						</div>

						<div class="form-group form-group-sm form-inline row datetimestart">
							<label for="date_debut" class="col-sm-4 control-label">Date et heure du début de l'évènement</label>
							<div class="col-sm-3">
								<div class='input-group date' id='event_begin_date_div' name="event_begin_date_div">
									<input type='text' class="form-control" id='event_begin_date' name="event_begin_date" aria-describedby="event-begin-date-error" required='true' value="<?php echo $event_begin_date; ?>" / >
									<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</div>
								<span class="form-control-feedback" aria-hidden="true"></span>
								<span id='event-begin-date-error' class="help-block" aria-hidden="true"></span>
							</div>
							<div class="col-sm-3">
								<div class='input-group date' id='event_begin_time_div' name="event_begin_time_div">
									<input type='text' class="form-control" id='event_begin_time' name="event_begin_time" required='true' aria-describedby="event-begin-time-error" value="<?php echo $event_begin_time; ?>" />
									<span class="input-group-addon">
									<span class="glyphicon glyphicon-time"></span>
								</div>
								<span class="form-control-feedback" aria-hidden="true"></span>
								<span id='event-begin-time-error' class="help-block" aria-hidden="true"></span>
							</div>
							<script type="text/javascript">
								$(function () {
									$('#event_begin_date_div').datetimepicker({
										locale: 'fr',
										format: 'DD-MM-YYYY',
										showClear:true,
										showClose:true,
										toolbarPlacement: 'bottom',
									});
								});
								$(function () {
									$('#event_begin_time_div').datetimepicker({
										locale: 'fr',
										format: 'HH:mm',
										showClear:true,
										showClose:true,
										toolbarPlacement: 'bottom',
										useCurrent:false,
										stepping:'15'
									});
								});
							</script>
						</div>

						<div class="form-group form-group-sm form-inline row">
							<label for="date_fin" class="col-sm-4 control-label">Date et heure de fin de l'évènement</label>
							<div class="col-sm-3">
								<div class='input-group date' id='event_end_date_div' name="event_end_date_div">
									<input type='text' class="form-control" id='event_end_date' name="event_end_date" required='true' aria-describedby="event-end-date-error" value="<?php echo $event_end_date; ?>" />
									<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</div>
								<span class="form-control-feedback" aria-hidden="true"></span>
								<span id='event-end-date-error' class="help-block" aria-hidden="true"></span>
							</div>
							<div class="col-sm-3">
								<div class='input-group date' id='event_end_time_div' name="event_end_time_div" >
									<input type='text' class="form-control" id='event_end_time' name="event_end_time" required='true' aria-describedby="event-end-time-error" value="<?php echo $event_end_time; ?>"/>
									<span class="input-group-addon">
									<span class="glyphicon glyphicon-time"></span>
								</div>
								<span class="form-control-feedback" aria-hidden="true"></span>
								<span id='event-end-time-error' class="help-block" aria-hidden="true"></span>
							</div>
							<script type="text/javascript">
								$(function () {
									$('#event_end_date_div').datetimepicker({
										locale: 'fr',
										format: 'DD-MM-YYYY',
										showClear:true,
										showClose:true,
										toolbarPlacement: 'bottom'

									});
								});
								$(function () {
									$('#event_end_time_div').datetimepicker({
										locale: 'fr',
										format: 'HH:mm',
										showClear:true,
										showClose:true,
										toolbarPlacement: 'bottom',
										useCurrent:false,
										stepping:'15'

									});
								});
							</script>
						</div>





						<div class="form-group form-group-sm">
							<label for="event_pref_secu" class="col-sm-4 control-label">
								Dossier déjà déposé en préfecture ?
							</label>
							<div class="col-sm-2">
								<select class="form-control" name="event_pref_secu" id="event_pref_secu" aria-describedby="event-pref-secu-error" >
									<option value="false">Non</option>
									<option value="true" <?php if ($event_pref_secu) {echo 'selected';}?> >Oui</option>
								</select>
								<span class="form-control-feedback glyphicon" aria-hidden="true"></span>
								<span id='event-pref-secu-error' class="help-block" aria-hidden="true"></span>
							</div>
						</div>
					</div>
				</div>



				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">
							Évaluation du risque
							<span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Permet le calcul de la grille des risques."></span>
						</h3>
					</div>
					<div class="panel-body">

						<div class="form-group form-group-sm has-feedback">
							<label for="spectateurs" class="col-sm-4 control-label">
								Nombre de spectateurs
								<span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Chiffres uniquement"></span>
							</label>
							<div class="col-sm-8">
								<input type="number" class="form-control risp" id="spectateurs" name="spectateurs" aria-describedby="spectateurs-error" required='true' digits='true' placeholder="Spectateurs" >
								<span class="form-control-feedback" aria-hidden="true"></span>
								<span id='spectateurs-error' class="help-block" aria-hidden="true"></span>
							</div>
						</div>

						<div class="form-group form-group-sm has-feedback">
							<label for="participants" class="col-sm-4 control-label">
								Nombre de participants
								<span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Chiffres uniquement."></span>
							</label>
							<div class="col-sm-8">
								<input type="number" class="form-control risp" id="participants" name="participants" aria-describedby="participants-error" required='true' digits='true' placeholder="Participants" >
								<span class="form-control-feedback" aria-hidden="true"></span>
								<span id='participants-error' class="help-block" aria-hidden="true"></span>
							</div>
						</div>

						<div class="form-group form-group-sm has-feedback">
							<label for="activite" class="col-sm-4 control-label">Activité du rassemblement </label>
							<div class="col-sm-8">
								<select class="form-control risi" id="activite" name="activite" aria-describedby="activite-error" >
									<option value="1">Public assis (spectacle, réunion, restauration, etc.)</option>
									<option value="2">Public debout (Exposition, foire, salon, exposition, etc.)</option>
									<option value="3">Public debout actif (Spectacle avec public statique, fête foraine, etc.)</option>
									<option value="4">Public debout à risque (public dynamique, danse, féria, carnaval, etc.)</option>
								</select>
								<span class="form-control-feedback glyphicon" aria-hidden="true"></span>
								<span id='activite-error' class="help-block" aria-hidden="true">Niveau de risque (P2)</span>
							</div>
						</div>

						<div class="form-group form-group-sm has-feedback">
							<label for="environnement" class="col-sm-4 control-label">Environnement et accessibilité</label>
							<div class="col-sm-8">
								<select class="form-control risi" id="environnement" name="environnement" aria-describedby="environnement-error" >
									<option value="1">Faible (Structure permanente, voies publiques, etc.)</option>
									<option value="2">Modéré (Gradins, tribunes, mois de 2 hectares, etc.)</option>
									<option value="3">Moyen (Entre 2 et 5 hectares, autres conditions, etc.)</option>
									<option value="4">Elevé (Brancardage > 600m, pas d'accès VPSP, etc.)</option>
								</select>
								<span class="form-control-feedback glyphicon" aria-hidden="true"></span>
								<span id='environnement-error' class="help-block" aria-hidden="true">Caractéristiques de l'environnement et accessibilité du site (E1)</span>
								<div id="e1"></div>
							</div>
						</div>

						<div class="form-group form-group-sm has-feedback">
							<label for="delai" class="col-sm-4 control-label">Délai d'intervention des secours publics</label>
							<div class="col-sm-8">
								<select class="form-control risi" id="delai" name="delai" aria-describedby="delai-error" >
									<option value="1">Faible (Moins de 10 minutes)</option>
									<option value="2">Modéré (Entre 10 et 20 minutes)</option>
									<option value="3">Moyen (Entre 20 et 30 minutes)</option>
									<option value="4">Elevé (Plus de 30 minutes)</option>
								</select>
								<span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
								<span id='delai-error' class="help-block" aria-hidden="true">Délai d'intervention (E2)</span>
							</div>
						</div>

						<label for="delai">Commentaires concernant le RIS</label>
						<textarea class="form-control" rows="4" id="commentaire_ris" name="commentaire_ris" placeholder="Indiquer ici tout commentaire(s) concernant le RIS"></textarea>
						<span class="help-block"></span>

						<div class="alert " id="resultatris" role="alert">
							<h4>Grille d'évaluation des risques</h4>
							<p>Classification du type de poste : <strong><span id="typeposte"></span></strong><br>
							Nombre de secouristes : <strong><span id="nbsec"></span></strong></p>
							<p id="grosris">
								<span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span>
								<strong> Attention !</strong> Ce type de poste impose un contact avec la DDO.
							</p>
						</div>

					</div>
				</div>
			</div>
		</div>

		<div class="panel panel-primary">
			<div class="panel-heading">
				<button type="button" class="close" aria-label='Close' data-toggle="collapse" data-target="#dps-panel-filter" aria-controls="dps-panel-filter">
					<span aria-hidden="true" >Montrer/Cacher</span>
				</button>
				<h3 class="panel-title">Dispositif Prévisionnel de Secours mis en place</h3>
			</div>
			<div id='dps-panel-filter' aria-expanded='true' class="panel-body in">

				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Horaires de mise en place du dispositif</h3>
					</div>
					<div class="panel-body">

						<div class="form-group form-group-sm form-inline row">
							<label for="date_debut_poste" class="col-sm-4 control-label">Date et heure du début de poste</label>
							<div class="col-sm-3">

								<div class='input-group date' id='date_debut_poste' name="date_debut_poste">
									<input type='text' class="form-control" id='date_debut_poste' name="date_debut_poste" required='true' aria-describedby="date_debut_poste-error" value="" />
									<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</div>
								<span class="form-control-feedback" aria-hidden="true"></span>
								<span id='date_debut_poste-error' class="help-block" aria-hidden="true"></span>
							</div>
							<div class="col-sm-3">

								<div class='input-group date' id='heure_debut_poste' name="heure_debut_poste" aria-describedby="heure_debut_poste-error" >
									<input type='text' class="form-control" id='heure_debut_poste' required='true' name="heure_debut_poste" />
									<span class="input-group-addon">
									<span class="glyphicon glyphicon-time"></span>
								</div>
								<span class="form-control-feedback" aria-hidden="true"></span>
								<span id='heure_debut_poste-error' class="help-block" aria-hidden="true"></span>
							</div>
							<script type="text/javascript">
								$(function () {
									$('#date_debut_poste').datetimepicker({
										locale: 'fr',
										format: 'DD-MM-YYYY',
										showClear:true,
										showClose:true,
										toolbarPlacement: 'bottom',

									});
								});
								$(function () {
									$('#heure_debut_poste').datetimepicker({
										locale: 'fr',
										format: 'HH:mm',
										showClear:true,
										showClose:true,
										toolbarPlacement: 'bottom',
										useCurrent:false,
										stepping:'15'

									});
								});
							</script>
						</div>
					<div class="form-group form-group-sm form-inline row">
						<label for="date_fin_poste" class="col-sm-4 control-label">Date et heure de fin de poste</label>
						<div class="col-sm-3">

							<div class='input-group date' id='date_fin_poste' name="date_fin_poste" aria-describedby="date_fin_poste-error" >
								<input type='text' class="form-control" id='date_fin_poste' required='true' name="date_fin_poste" />
								<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</div>
							<span class="form-control-feedback" aria-hidden="true"></span>
							<span id='date_fin_poste-error' class="help-block" aria-hidden="true"></span>
						</div>
						<div class="col-sm-3">

							<div class='input-group date' id='heure_fin_poste' name="heure_fin_poste">
								<input type='text' class="form-control" id='heure_fin_poste' required='true' name="heure_fin_poste" aria-describedby="heure_fin_poste-error" />
								<span class="input-group-addon">
								<span class="glyphicon glyphicon-time"></span>
							</div>
							<span class="form-control-feedback" aria-hidden="true"></span>
							<span id='heure_fin_poste-error' class="help-block" aria-hidden="true"></span>
						</div>
						<script type="text/javascript">
							$(function () {
								$('#date_fin_poste').datetimepicker({
									locale: 'fr',
									format: 'DD-MM-YYYY',
									showClear:true,
									showClose:true,
									toolbarPlacement: 'bottom'

								});
							});
							$(function () {
								$('#heure_fin_poste').datetimepicker({
									locale: 'fr',
									format: 'HH:mm',
									showClear:true,
									showClose:true,
									toolbarPlacement: 'bottom',
									useCurrent:false,
									stepping:'15'

								});
							});
						</script>
					</div>
				</div>
			</div>
				<div class="panel panel-default">
					<div class="panel-heading">Moyens fournis par la Protection Civile <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Permet la comparaison avec la grille des risques."></span></div>
					<div class="panel-body">

						<div class="form-group form-group-sm">
							<label for="nb_ce" class="col-sm-4 control-label">Chef d'équipe</label>
							<div class="col-sm-2">
								<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
									<input type="number" class="form-control" id="nb_ce" name="nb_ce" aria-describedby="nb_ce-error" required='true' digits='true' placeholder="00" >
									<span class="form-control-feedback" aria-hidden="true"></span>
									<span id='nb_ce-error' class="help-block" aria-hidden="true"></span>
								</div>
							</div>
							<label for="nb-pse2" class="col-sm-3 control-label">PSE-2</label>
							<div class="col-sm-2">
								<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
									<input type="number" class="form-control" id="nb_pse2" name="nb_pse2" aria-describedby="nb_pse2-error" required='true' digits='true' placeholder="00" >
									<span class="form-control-feedback" aria-hidden="true"></span>
									<span id='nb_pse2-error' class="help-block" aria-hidden="true"></span>
								</div>
							</div>
							<label for="nb_pse1" class="col-sm-4 control-label">PSE-1</label>
							<div class="col-sm-2">
								<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
									<input type="number" class="form-control" id="nb_pse1" name="nb_pse1" aria-describedby="nb_pse1-error" required='true' digits='true' placeholder="00" >
									<span class="form-control-feedback" aria-hidden="true"></span>
									<span id='nb_pse1-error' class="help-block" aria-hidden="true"></span>
								</div>
							</div>
							<label for="nb_psc1" class="col-sm-3 control-label">Stagiaire PSC-1</label>
							<div class="col-sm-2">
								<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
									<input type="number" class="form-control" id="nb_psc1" name="nb_psc1" aria-describedby="nb_psc1-error" required='true' digits='true' placeholder="00" >
									<span class="form-control-feedback" aria-hidden="true"></span>
									<span id='nb_psc1-error' class="help-block" aria-hidden="true"></span>
								</div>
							</div>
						</div>
					</div>
					<div class="panel-body">
						<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
							<label for="vpsp_transport" class="col-sm-4 control-label">VPSP Transport (évacuation)</label>
							<div class="col-sm-2">
								<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
									<input type="number" class="form-control" id="vpsp_transport" name="vpsp_transport" aria-describedby="vpsp_transport-error" min='0' required='true' digits='true' placeholder="00" >
									<span class="form-control-feedback" aria-hidden="true"></span>
									<span id='vpsp_transport-error' class="help-block" aria-hidden="true"></span>
								</div>
							</div>
							<label for="vpsp_soin" class="col-sm-3 control-label">VPSP fixe (poste de soins)</label>
							<div class="col-sm-2">
								<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
									<input type="number" class="form-control" id="vpsp_soin" name="vpsp_soin" aria-describedby="vpsp_soin-error" min='0' required='true' digits='true' placeholder="00" >
									<span class="form-control-feedback" aria-hidden="true"></span>
									<span id='vpsp_soin-error' class="help-block" aria-hidden="true"></span>
								</div>
							</div>
							<label for="vl" class="col-sm-4 control-label">VL / VTU / Goliath...</label>
							<div class="col-sm-2">
								<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
									<input type="number" class="form-control" id="vl" name="vl" aria-describedby="vl-error" min='0' required='true' digits='true' placeholder="00">
									<span class="form-control-feedback" aria-hidden="true"></span>
									<span id='vl-error' class="help-block" aria-hidden="true"></span>
								</div>
							</div>
							<label for="tente" class="col-sm-3 control-label">Tente (Protec)</label>
							<div class="col-sm-2">
								<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
									<input type="number" class="form-control" id="tente" name="tente" aria-describedby="tente-error" min='0' required='true' digits='true' placeholder="00">
									<span class="form-control-feedback" aria-hidden="true"></span>
									<span id='tente-error' class="help-block" aria-hidden="true"></span>
								</div>
							</div>
						</div>
					</div>
					<div class="panel-body">
						<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
							<label for="medecin_asso" class="col-sm-4 control-label">Nombre de médecins Protec</label>
							<div class="col-sm-2">
								<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
									<input type="number" class="form-control" id="medecin_asso" name="medecin_asso" aria-describedby="medecin_asso-error" min='0' digits='true' placeholder="00">
									<span class="form-control-feedback" aria-hidden="true"></span>
									<span id='medecin_asso-error' class="help-block" aria-hidden="true"></span>
								</div>
							</div>
							<label for="infirmier_asso" class="col-sm-3 control-label">Nombre d'infirmiers Protec</label>
							<div class="col-sm-2">
								<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
									<input type="number" class="form-control" id="infirmier_asso" name="infirmier_asso" aria-describedby="infirmier_asso-error" min='0' digits='true' placeholder="00">
									<span class="form-control-feedback" aria-hidden="true"></span>
									<span id='infirmier_asso-error' class="help-block" aria-hidden="true"></span>
								</div>
							</div>
						</div>
					</div>
					<div class="panel-body">

						<div class="form-group form-group-sm">
							<label for="supplement" class="col-sm-4 control-label">Moyens humains / logistiques supplémentaires</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="supplement" name="supplement" placeholder="entrer ici tout moyen supplémentaire">
							</div>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">Moyens fournis par l'organisateur <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Permet la comparaison avec la grille des risques."></span></div>
					<div class="panel-body">

						<div class="form-group form-group-sm">
							<label for="local" class="col-sm-4 control-label">Local infirmerie</label>
							<div class="col-sm-2">
								<select class="form-control" id="local" name="local">
									<option value="false">Non</option>
									<option value="true">Oui</option>
								</select>
							</div>
							<label for="tente_orga" class="col-sm-3 control-label">Tente</label>
							<div class="col-sm-2">
								<select class="form-control" id="tente_orga" name="tente_orga">
									<option value="false">Non</option>
									<option value="true">Oui</option>
								</select>
							</div>
						</div>

						<div class="form-group form-group-sm">
							<label for="supplement" class="col-sm-4 control-label">Autre</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="supplement" name="supplement" placeholder="entrer ici tout moyen supplémentaire fourni par l'organisateur">
							</div>
						</div>

					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">Moyens médicaux / structures</div>
					<div class="panel-body">



						<div class="form-group form-group-sm has-feedback">
							<label for="medecin_autre" class="col-sm-4 control-label">Nombre de médecins extérieurs (préciser)</label>
							<div class="col-sm-2">
								<input type="number" class="form-control" id="medecin_autre" name="medecin_autre" aria-describedby="medecin_autre-error" min='0' digits='true' placeholder="00">
								<span class="form-control-feedback" aria-hidden="true"></span>
								<span id='medecin_autre-error' class="help-block" aria-hidden="true"></span>
							</div>
							<label for="medecin_appartenance" class="col-sm-2 control-label">Appartenance</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="medecin_appartenance" name="medecin_appartenance" aria-describedby="medecin_appartenance-error" placeholder="Appartenance">
								<span class="form-control-feedback" aria-hidden="true"></span>
								<span id='medecin_appartenance-error' class="help-block" aria-hidden="true"></span>
							</div>
						</div>
						<div class="form-group form-group-sm has-feedback">
							<label for="infirmier_autre" class="col-sm-4 control-label">Nombre d'infirmiers extérieurs (préciser)</label>
							<div class="col-sm-2">
								<input type="number" class="form-control" id="infirmier_autre" name="infirmier_autre" aria-describedby="infirmier_autre-error" min='0' digits='true' placeholder="00">
								<span class="form-control-feedback" aria-hidden="true"></span>
								<span id='infirmier_autre-error' class="help-block" aria-hidden="true"></span>
							</div>
							<label for="infirmier_appartenance" class="col-sm-2 control-label">Appartenance</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="infirmier_appartenance" name="infirmier_appartenance" aria-describedby="infirmier_appartenance-error" placeholder="Appartenance">
								<span class="form-control-feedback glyphicon" aria-hidden="true"></span>
								<span id='infirmier_appartenance-error' class="help-block" aria-hidden="true"></span>
							</div>
						</div>
					</div>
					<div class="panel-body">
						<div class="form-group form-group-sm">
							<label for="samu" class="col-sm-3 control-label">SAMU</label>
							<div class="col-sm-3">
								<select class="form-control" id="samu" name="samu">
									<option value="0">Ni informé, ni présent</option>
									<option value="1" selected>Informé, non présent</option>
									<option value="2">Informé et présent</option>
								</select>
							</div>
							<label for="bspp_sdis" class="col-sm-3 control-label">SDIS / BSPP</label>
							<div class="col-sm-3">
								<select class="form-control" id="bspp_sdis" name="bspp_sdis">
									<option value="0">Ni informé, ni présent</option>
									<option value="1">Informé, non présent</option>
									<option value="2">Informé et présent</option>
								</select>
							</div>
						</div>
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Justificatif du dispositif mis en place</h3>
					</div>
					<div class="panel-body">

						<?php $feedback = compute_server_feedback($dps_price_error);?>
						<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
							<label for="dps_price" class="col-sm-4 control-label">
								Prix
								<span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Tarif facturé au client."></span>
							</label>
							<div class="col-sm-2">
								<div class="input-group">
									<input type="number" class="form-control" id="dps_price" name="dps_price" aria-describedby="dps-price-error" minlength='1' required='true' number='true' placeholder="Prix" value="<?php echo $dps_price; ?>" data-minlength="1" >
									<div class="input-group-addon glyphicon glyphicon-euro"></div>
								</div>
								<span class="form-control-feedback" aria-hidden="true"></span>
								<span id='dps-price-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
							</div>
						</div>

						<textarea class="form-control" rows="5" id="justificatif" name="justificatif" placeholder="Indiquer tout justificatif sur les moyens, structures, etc. ou toute information utile pour la bonne gestion administrative du poste."></textarea>
					</div>
				</div>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-8 ">
				<button type="submit" class="btn btn-warning">Envoyer <span class="glyphicon glyphicon-send"></span></button>
			</div>
		</div>
	</form>

</div>


<script src='js/dps-compute-ris.js' type='text/javascript'></script>

<?php require_once('components/footer.php'); ?>

<script text='text/javascript'>
	$('#auto-validation-form').validate();
</script>
</body>
</html>
