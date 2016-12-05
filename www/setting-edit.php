<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Paramètres généraux</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<script src="js/jquery.validate.min.js" type="text/javascript"></script>

<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="#">Administration</a></li>
	<li><a href="/setting-view.php">Paramètres généraux</a></li>
	<li class="active">Modification</li>
</ol>


<!-- Authentication -->
<?php $rbac->enforce("admin-settings-update", $currentUserID); ?>

<!-- Common -->
<?php include 'functions/controller/setting-common.php'; ?>

<!-- Create a new setting : Controller -->
<?php include 'functions/controller/setting-update-controller.php'; ?>


<!-- Page content container -->
<div class="container">

	<!-- Operation status indicator -->
	<?php include 'components/operation-status-indicator.php'; ?>

	<h2>Modification d'un paramètre</h2>


	<!-- Update a setting : display form -->
	<form class="form-horizontal" id="ajoutparametre" role="form" action="" name="add" method="post" autocomplete="off">
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
					<input type="text" class="form-control" id="name" name="name" value="<?php echo $name ?>" placeholder="Nom du paramètre">
				</div>
			</div>
			<div class="form-group form-group-sm">
				<label for="value" class="col-sm-4 control-label">Valeur du paramètre</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="value" name="value" value="<?php echo $value ?>" placeholder="Valeur du paramètre">
				</div>
			</div>			
			<div class="form-group">
				<div class="col-sm-offset-4 col-sm-8">
					<?php if (empty($genericSuccess)){ ?>
							<a class="btn btn-default" href="setting-view.php" role="button">Annuler - Retour à la liste</a>
						<?php } ?>
						<button type="submit" class="btn btn-warning">Mettre à jour</button>
						<?php if (isset($_POST['update']) && !empty($genericSuccess)) { ?>
							<a class="btn btn-default" href="setting-view.php" role="button">J'ai terminé ! Retour à la liste</a>
						<?php } ?>
			    </div>
			</div>
		</div>
	</form>
</div>

<?php include('components/footer.php'); ?>
<script>

$('#modifparametre').validate({
        rules: {
            name: {
                minlength: 3,
                maxlength: 120,
                required: true
            },
            value: {
                minlength: 0,
                maxlength: 400,
                required: false
            }
        },
		
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
			$('#submit').addClass('disabled');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
			$('#submit').removeClass('disabled');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });
jQuery.extend(jQuery.validator.messages, {
  required: "Ce champ est requis",
  remote: "Une erreur est présente",
  email: "votre message",
  url: "votre message",
  date: "votre message",
  dateISO: "Une erreur de date est présente",
  number: "votre message",
  digits: "votre message",
  creditcard: "Une erreur est présente",
  equalTo: "Les deux valeurs doivent être identiques",
  accept: "Une erreur est présente",
  maxlength: jQuery.validator.format("Doit contenir moins de {0} caractères."),
  minlength: jQuery.validator.format("Doit contenir plus de {0} caractères."),
  rangelength: jQuery.validator.format("Doit contenir entre {0} et {1} caractères."),
  range: jQuery.validator.format("votre message  entre {0} et {1}."),
  max: jQuery.validator.format("votre message  inférieur ou égal à {0}."),
  min: jQuery.validator.format("votre message  supérieur ou égal à {0}.")
});
</script>
</body>
</html>
