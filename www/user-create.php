<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Gestion des utilisateurs</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<script src="js/jquery.validate.min.js" type="text/javascript"></script>

<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="#">Administration</a></li>
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
			<form class="form-horizontal" id="addUserForm" action='' role="form" method='post' accept-charset='utf-8'>
				<input type="hidden" id="wish" name="addUser" />
			

				<?php if (!empty($createErrorLastName)){ ?>
					<div class="form-group form-group-sm has-error has-feedback">
						<label for="inputUserLastName" class="col-sm-4 control-label">Nom</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="inputUserLastName" name="inputUserLastName" aria-describedby="inputError2Status" placeholder="ex: Dupond" value="<?php if (!empty($genericError)) {echo $lastName;} ?>">
							<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
							<span id="inputError2Status" class="sr-only">(error)</span>
						</div>	
					</div>
				<?php } else { ?>
					<div class="form-group form-group-sm">
						<label for="inputUserLastName" class="col-sm-4 control-label">Nom</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="inputUserLastName" name="inputUserLastName" aria-describedby="inputError2Status" placeholder="ex: Dupond" value="<?php if (!empty($genericError)) {echo $lastName;} ?>">
						</div>
					</div>
				<?php } ?>
				
				<?php if (!empty($createErrorFirstName)){ ?>
					<div class="form-group form-group-sm has-error has-feedback">
						<label for="inputUserFirstName" class="col-sm-4 control-label">Prénom</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="inputUserFirstName" name="inputUserFirstName" aria-describedby="inputError2Status" placeholder="ex: Jean" value="<?php if (!empty($genericError)) {echo $firstName;} ?>">
							<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
							<span id="inputError2Status" class="sr-only">(error)</span>
						</div>
					</div>
				<?php } else { ?>
					<div class="form-group form-group-sm">
						<label for="inputUserFirstName" class="col-sm-4 control-label">Prénom</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="inputUserFirstName" name="inputUserFirstName" aria-describedby="inputError2Status" placeholder="ex: Jean" value="<?php if (!empty($genericError)) {echo $firstName;} ?>">
						</div>
					</div>
				<?php } ?>

				<?php if (!empty($createErrorLogin)){ ?>
						<div class="form-group form-group-sm has-error has-feedback">
							<label for="inputUserLogin" class="col-sm-4 control-label">Matricule e-Protec</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="inputUserLogin" name="inputUserLogin" aria-describedby="inputError2Status" placeholder="ex: 49594" value="<?php echo $login; ?>">
								<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
								<span id="inputError2Status" class="sr-only">(error)</span>
							</div>
						</div>
					<?php } else { ?>
						<div class="form-group form-group-sm">
							<label for="inputUserLogin" class="col-sm-4 control-label">Matricule e-Protec</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="inputUserLogin" name="inputUserLogin" placeholder="ex: 49594" value="<?php echo $login; ?>">
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
						<input type="phone" class="form-control" id="inputUserPhone" name="inputUserPhone" aria-describedby="inputError2Status" value="<?php if (!empty($genericError)) {echo $phone;} ?>">
					</div>
				</div>
				
				<div class="form-group form-group-sm">
					<label for="inputUserSection" class="col-sm-4 control-label">Section</label>
					<div class="col-sm-8">
						<select class="form-control" id="inputUserSection" name="inputUserSection">
							<?php							
								$reqliste = "SELECT number, name FROM sections" or die("Erreur lors de la consultation" . mysqli_error($link)); 
								$sections = mysqli_query($link, $reqliste);
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

<script>

$('#addUserForm').validate({
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
            inputUserLogin: {
                minlength: 2,
                maxlength: 7,
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
                required: true,
            }
            inputUserPassword2: {
                minlength: 8,
                maxlength: 25,
                required: true,
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