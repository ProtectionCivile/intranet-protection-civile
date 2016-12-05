<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Gestion des sections</title>
	<meta http-equiv='Content-Type' content='text/html'>
	<meta charset='UTF-8'>
	<link rel='stylesheet' href='css/bootstrap.min.css' type='text/css' media='all' title='no title' charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0 user-scalable=no'>


	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript" src='js/jquery.validate.min.js' ></script>
	<script type="text/javascript" src="js/bootstrap.min.js" ></script>
</head>
<body>
<?php include('components/header.php'); ?>


<ol class='breadcrumb'>
	<li><a href='/'>Home</a></li>
	<li><a href='#'>Administration</a></li>
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
			<h3 class='panel-title'>Modifier la commune de <strong><?php echo $nom; ?> - Antenne N°<?php echo $number;?></strong></h3>
		</div>
		<div class='panel-body'>
			<form class='form-horizontal' id='editForm' action='' role='form' method='post' accept-charset='utf-8'>
				<input type='hidden' name='update'>
				<input type='hidden' name='ID' type='text' value='<?php echo $id;?>'>

				<div class='form-group form-group-sm'>
					<label for='name' class='col-sm-4 control-label'>Nom</label>
					<div class='col-sm-8'>
						<input type='text' class='form-control' id='name' name='name' value='<?php echo $name; ?>'>
					</div>
				</div>

				<div class='form-group form-group-sm'>
					<label for='number' class='col-sm-4 control-label'>Numéro interne</label>
					<div class='col-sm-8'>
						<input type='text' class='form-control' id='number' name='number' value='<?php echo $number; ?>'>
					</div>
				</div>

				<div class='form-group form-group-sm'>
					<label for='shortname' class='col-sm-4 control-label'>Nom court</label>
					<div class='col-sm-8'>
						<input type='text' class='form-control' id='shortname' name='shortname' value='<?php echo $shortname; ?>'>
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
						<input type='text' class='form-control' id='zipcode' name='zipcode' value='<?php echo $zipcode; ?>'>
					</div>
				</div>

				<div class='form-group form-group-sm'>
					<label for='city' class='col-sm-4 control-label'>Ville</label>
					<div class='col-sm-8'>
						<input type='text' class='form-control' id='city' name='city' value='<?php echo $city; ?>'>
					</div>
				</div>

				<div class='form-group form-group-sm'>
					<label for='phone' class='col-sm-4 control-label'>Téléphone de contact</label>
					<div class='col-sm-8'>
						<input type='text' class='form-control' id='phone' name='phone' minlength='2' maxlength='5' required value='<?php echo $phone; ?>'>
					</div>
				</div>

				<div class='form-group form-group-sm'>
					<label for='mail' class='col-sm-4 control-label'>Adresse mail de contact</label>
					<div class='col-sm-8'>
						<input type='text' class='form-control' id='mail' name='mail' value='<?php echo $mail; ?>'>
					</div>
				</div>

				<div class='form-group form-group-sm'>
					<label for='website' class='col-sm-4 control-label'>Site internet</label>
					<div class='col-sm-8'>
						<input type='text' class='form-control' id='website' name='website' value='<?php echo $website; ?>'>
					</div>
				</div>

				<div class='form-group form-group-sm'>
					<label for='attached_section' class='col-sm-4 control-label'>Section</label>
					<div class='col-sm-8'>
						<select class='form-control' id='attached_section' name='attached_section'>
							<?php							
								$reqliste = "SELECT `number`, name FROM sections ORDER BY number" or die("Erreur lors de la consultation" . mysqli_error($link)); 
								$sections = mysqli_query($link, $reqliste);

								while($sectionX = mysqli_fetch_array($sections)) {
									echo $userSection;
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
						<button type='submit' class='btn btn-warning' id='submitAddUserForm'>Mettre à jour</button>
						<?php if (isset($_POST['update']) && !empty($genericSuccess)) { ?>
							<a class='btn btn-default' href='section-view.php' role='button'>J'ai terminé ! Retour à la liste</a>
						<?php } ?>
				   </div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>

<script type='text/javascript' >

$('#editForm').validate({
        rules: {
            name: {
                minlength: 2,
                maxlength: 30,
                required: true
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
