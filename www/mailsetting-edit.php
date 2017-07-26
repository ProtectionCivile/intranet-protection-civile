<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Paramètres mail</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="#">Administration</a></li>
	<li><a href="/setting-view.php">Paramètres mail</a></li>
	<li class="active">Modification</li>
</ol>


<!-- Authentication -->
<?php $rbac->enforce("admin-settings-update", $currentUserID); ?>

<!-- Common -->
<?php include 'functions/controller/mailsetting-common.php'; ?>

<!-- Create a new setting : Controller -->
<?php include 'functions/controller/mailsetting-update-controller.php'; ?>


<!-- Page content container -->
<div class="container">

	<!-- Operation status indicator -->
	<?php include 'components/operation-status-indicator.php'; ?>

	<h2>Modification d'un paramètre</h2>


	<!-- Update a setting : display form -->
	<form class="form-horizontal" id="auto-validation-form" role="form" action="" name="add" method="post" autocomplete="off">
		<input type="hidden" id="wish" name='update'/>
		<input type="hidden" name="ID" value="<?php echo $id;?>">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Informations</h3>
			</div>
		<div class="panel-body">
			<div class="form-group form-group-sm">
				<label for="name" class="col-sm-4 control-label">Nom du paramètre</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="name" name="name" value="<?php echo $name ?>" minlength='3' maxlength='120' required='true' placeholder="Nom du paramètre">
				</div>
			</div>
			<div class="form-group form-group-sm">
				<label for="value" class="col-sm-4 control-label">Valeur du paramètre</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="value" name="value" value="<?php echo $value ?>" minlength='3' maxlength='400' required='false' placeholder="Valeur du paramètre">
				</div>
			</div>			
			<div class="form-group">
				<div class="col-sm-offset-4 col-sm-8">
					<?php if (empty($genericSuccess)){ ?>
							<a class="btn btn-default" href="mailsetting-view.php" role="button">Annuler - Retour à la liste</a>
						<?php } ?>
						<button type="submit" class="btn btn-warning">Mettre à jour</button>
						<?php if (isset($_POST['update']) && !empty($genericSuccess)) { ?>
							<a class="btn btn-default" href="mailsetting-view.php" role="button">J'ai terminé ! Retour à la liste</a>
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

