<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Modification d'un paramètre</title>
	<meta http-equiv="Content-Type" content="text/html">
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
</head>
<body>

	<?php
include('components/header.php'); 
require_once('functions/settings_queries.php');
require_once('functions/str.php');

?>
<script src="js/jquery.validate.min.js" type="text/javascript"></script>
<?php


// Authentication
$rbac->enforce("admin-settings-update", $currentUserID);

// script de traitement

if(isset($_POST['name'], $_POST['value'])){

	$erreur = null;
	if(empty($_POST['name'])){
		$erreur = "Erreur champ nom vide";
	}
	if (empty($_POST['value'])) {
		$erreur = "Erreur champ valeur vide";
	}

	if(is_null($erreur)){
		if(update_settings($link, $_GET['id'], $_POST['name'], $_POST['value'])){
			$succes = "Paramètre modifié avec succès";	
		}
		
	}

	$setting = load_setting($link, $_GET['id']);
	if(is_null($setting)){
		$erreur = "Paramètre inconnu";
	}

}
elseif(isset($_GET['id'])){
	$setting = load_setting($link, $_GET['id']);
	if(is_null($setting)){
		$erreur = "Paramètre inconnu";
	}
}
else{
	$erreur = "Paramètre inconnu";
}

?>


<div class="container">
<?php
if (!empty($erreur)){
echo "<div class='alert alert-danger'><strong>Erreur</strong> : ".$erreur."</div>";
}elseif (!empty($succes)){
echo "<div class='alert alert-success'><strong>Réussi</strong> : ".$succes."</div>";
}else{}
?>

		<h2>Modification d'un paramètre</h2>
		<h4><?php if(isset($_GET['add']) && ($_GET['add'] == "ok")) { ?>Paramètre modifié avec succès. <?php } ?></h4>
		<form class="form-horizontal" id="ajoutparametre" role="form" action="" name="add" method="post" autocomplete="off">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Informations</h3>
				</div>
			<div class="panel-body">
				<div class="form-group form-group-sm">
					<label for="name" class="col-sm-4 control-label">Nom du paramètre</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="name" name="name" value="<?php echo $setting['setting_name'] ?>" placeholder="Nom du paramètre">
					</div>
				</div>
				<div class="form-group form-group-sm">
					<label for="value" class="col-sm-4 control-label">Valeur du paramètre</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="value" name="value" value="<?php echo $setting['setting_value'] ?>" placeholder="Valeur du paramètre">
					</div>
				</div>			
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<button type="submit" class="btn btn-warning" id="submit">Envoyer</button>
						<a class="btn btn-default" role="button" href="settings-view.php">Retour</a>
				    </div>
				</div>
			</div>
		</form>
</div>
<?php include 'footer.php'; ?>
<script>

$('#modifparametre').validate({
        rules: {
            name: {
                minlength: 3,
                maxlength: 20,
                required: true
            },
            value: {
                minlength: 3,
                maxlength: 20,
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
