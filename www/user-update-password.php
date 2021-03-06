<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Mot de passe</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Accueil</a></li>
	<li class="active">Modification de mon mot de passe</li>
</ol>


<!-- Authentication -->
<?php require_once('functions/user/user-update-authentication.php'); ?>

<!-- Common -->
<?php include ('functions/controller/user-common.php'); ?>

<!-- Update user : Controller -->
<?php include ('functions/controller/user-update-controller.php'); ?>


<!-- Page content container -->
<div class="container">

	<div class="page-header">
		<h2>Mon profil <small>Modification de mon mot de passe</small></h2>
	</div>

	<!-- Update user : Operation status indicator -->
	<?php include ('components/operation-status-indicator.php'); ?>

	<!-- Update user : display form -->
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Informations à mettre à jour</h3>
		</div>
		<div class="panel-body">
			<?php require_once('components/user/user-update-password-form.php'); ?>
		</div>
	</div>

</div>

<?php include('components/footer.php'); ?>

<script text='text/javascript'>
	$('#auto-validation-form').validate();
</script>

</body>
</html>
