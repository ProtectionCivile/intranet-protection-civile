<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Paramètres généraux</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="#">Administration</a></li>
	<li><a href="/setting-view.php">Paramètres généraux</a></li>
	<li class="active">Création</li>
</ol>


<!-- Authentication -->
<?php $rbac->enforce("admin-settings-update", $currentUserID); ?>

<!-- Create a new setting : Controller -->
<?php include 'functions/controller/setting-create-controller.php'; ?>

<!-- Page content container -->
<div class="container">

	<!-- Update setting : Operation status indicator -->
	<?php include 'components/operation-status-indicator.php'; ?>

	<h2>Ajout d'un paramètre</h2>


	<!-- Create a setting : display form -->
	<form class="form-horizontal" id="auto-validation-form" role="form" action="" name="add" method="post" autocomplete="off">
		<input type="hidden" id="wish" name="addSetting" />
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Informations</h3>
			</div>
			<div class="panel-body">

				<?php if (!empty($createErrorName)){ ?>
					<div class="form-group form-group-sm has-error has-feedback">
						<label for="name" class="col-sm-4 control-label">Nom du paramètre</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="name" name="name" aria-describedby="inputError2Status" placeholder="ex: mail-generique-adpc" minlength='3' maxlength='120' required='true' value="<?php if (!empty($genericError)) {echo $name;} ?>">
							<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
							<span id="inputError2Status" class="sr-only">(error)</span>
						</div>	
					</div>
				<?php } else { ?>
					<div class="form-group form-group-sm">
						<label for="name" class="col-sm-4 control-label">Nom du paramètre</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="name" name="name" placeholder="ex: mail-generique-adpc" minlength='3' maxlength='120' required='true' value="<?php if (!empty($genericError)) {echo $name;} ?>">
						</div>
					</div>
				<?php } ?>

				<div class="form-group form-group-sm">
					<label for="value" class="col-sm-4 control-label">Valeur du paramètre</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="value" name="value" minlength='3' maxlength='400' required='false' placeholder="Valeur du paramètre">
					</div>
				</div>			
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<?php if (empty($genericSuccess)){ ?>
							<a class="btn btn-default" href="setting-view.php" role="button">Annuler - Retour à la liste</a>
						<?php } ?>
						<button type="submit" class="btn btn-success">Créer</button>
						<?php if (isset($_POST['addSetting']) && !empty($genericSuccess)) { ?>
							<a class="btn btn-default" href="setting-view.php" role="button">J'ai terminé ! Retour à la liste</a>
						<?php } ?>
				    </div>
				</div>
			</div>
		</form>
</div>

<?php include('components/footer.php'); ?>

<script text='text/javascript'>
	$('#auto-validation-form').validate();
</script>

</body>
</html>
