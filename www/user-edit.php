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


<script src="js/jquery.validate.min.js" type="text/javascript"></script>

<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="#">Administration</a></li>
	<li><a href="/user-view.php">Gestion des utilisateurs</a></li>
	<li class="active">Modification</li>
</ol>


<!-- Common -->
<?php include 'functions/controller/user-common.php'; ?>

<?php 
	if(empty($commonError)) {
?>


	<!-- Update user : Controller -->
	<?php include 'functions/controller/user-update-controller.php'; ?>


	<!-- Page content container -->
	<div class="container">

		<!-- Update user : Operation status indicator -->
		<?php include 'functions/operation-status-indicator.php'; ?>

		<h2>Modifier l'utilisateur '<?php echo $firstName." ".$lastName ?>'</h2>


		<!-- Update user : display form -->
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Informations à mettre à jour</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" id="editUserForm" action='' role="form" method='post' accept-charset='utf-8'>
					<input type="hidden" name="updateUser">
					<input type="hidden" name="userID" value="<?php echo $userID;?>">

					<?php if (!empty($createErrorLastName)){ ?>
						<div class="form-group form-group-sm has-error has-feedback">
							<label for="inputUserLastName" class="col-sm-4 control-label">Nom</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="inputUserLastName" name="inputUserLastName" aria-describedby="inputError2Status" placeholder="ex: Dupond" value="<?php echo ucfirst($lastName); ?>">
								<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
								<span id="inputError2Status" class="sr-only">(error)</span>
							</div>	
						</div>
					<?php } else { ?>
						<div class="form-group form-group-sm">
							<label for="inputUserLastName" class="col-sm-4 control-label">Nom</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="inputUserLastName" name="inputUserLastName" aria-describedby="inputError2Status" placeholder="ex: Dupond" value="<?php echo ucfirst($lastName); ?>">
							</div>
						</div>
					<?php } ?>
					
					<?php if (!empty($createErrorFirstName)){ ?>
						<div class="form-group form-group-sm has-error has-feedback">
							<label for="inputUserFirstName" class="col-sm-4 control-label">Prénom</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="inputUserFirstName" name="inputUserFirstName" aria-describedby="inputError2Status" placeholder="ex: Jean" value="<?php echo ucfirst($firstName); ?>">
								<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
								<span id="inputError2Status" class="sr-only">(error)</span>
							</div>
						</div>
					<?php } else { ?>
						<div class="form-group form-group-sm">
							<label for="inputUserFirstName" class="col-sm-4 control-label">Prénom</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="inputUserFirstName" name="inputUserFirstName" aria-describedby="inputError2Status" placeholder="ex: Jean" value="<?php echo ucfirst($firstName); ?>">
							</div>
						</div>
					<?php } ?>
					
					<?php if (!empty($createErrorPassword)){ ?>
						<div class="form-group form-group-sm has-error has-feedback">
							<label for="inputUserPassword1" class="col-sm-4 control-label">Mot de passe</label>
							<div class="col-sm-8">
								<input type="password" class="form-control" id="inputUserPassword1" name="inputUserPassword1" aria-describedby="inputError2Status">
								<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
								<span id="inputError2Status" class="sr-only">(error)</span>
							</div>
						</div>
					<?php } else { ?>
						<div class="form-group form-group-sm">
							<label for="inputUserPassword1" class="col-sm-4 control-label">Mot de passe</label>
							<div class="col-sm-8">
								<input type="password" class="form-control" id="inputUserPassword1" name="inputUserPassword1" aria-describedby="inputError2Status">
							</div>
						</div>
					<?php } ?>
					
					<div class="form-group form-group-sm">
						<label for="inputUserPassword2" class="col-sm-4 control-label">Confirmation du mot de passe</label>
						<div class="col-sm-8">
							<input type="password" class="form-control" id="inputUserPassword2" name="inputUserPassword2" aria-describedby="inputError2Status">
						</div>
					</div>
					
					<div class="form-group form-group-sm">
						<label for="inputUserPhone" class="col-sm-4 control-label">Téléphone</label>
						<div class="col-sm-8">
							<input type="phone" class="form-control" id="inputUserPhone" name="inputUserPhone" aria-describedby="inputError2Status" value="<?php echo $phone; ?>">
						</div>
					</div>

					<div class="form-group form-group-sm">
						<label for="inputUserSection" class="col-sm-4 control-label">Section</label>
						<div class="col-sm-8">
							<select class="form-control" id="inputUserSection" name="inputUserSection">
								<?php							
									$reqliste = "SELECT ID, name FROM sections" or die("Erreur lors de la consultation" . mysqli_error($link)); 
									$sections = mysqli_query($link, $reqliste);
									while($section = mysqli_fetch_array($sections)) {
										echo "<option value='".$section["ID"]."'>".$section["name"]."</option>";
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
							<button type="submit" class="btn btn-warning" id='submitAddUserForm'>Mettre à jour</button>
							<?php if (isset($_POST['addUser']) && !empty($genericSuccess)) { ?>
								<a class="btn btn-default" href="user-view.php" role="button">J'ai terminé ! Retour à la liste</a>
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

<script>

$('#editUserForm').validate({
        rules: {
            inputUserLastName: {
                minlength: 2,
                maxlength: 30,
                required: true
            },
            inputUserFirstName: {
                minlength: 2,
                maxlength: 30,
                required: true
            },
            inputUserPhone: {
                minlength: 10,
                maxlength: 10,
                required: false
            },
			inputUserPassword: {
                minlength: 8,
                maxlength: 25,
                required: true
            },
            inputUserPassword2: {
                minlength: 8,
                maxlength: 25,
                required: false,
				equalTo: "#inputUserPassword1"
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