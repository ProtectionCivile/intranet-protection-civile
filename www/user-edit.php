<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Gestion des utilisateurs</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Accueil</a></li>
	<li><a href="/user-list.php">Gestion des utilisateurs</a></li>
	<li class="active">Modification</li>
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
		<h2>Gestion des utilisateurs <small>Modification de '<?php echo ucfirst(htmlentities($user_firstName))." ".mb_strtoupper($user_lastName) ?>'</small></h2>
	</div>

	<!-- Update user : Operation status indicator -->
	<?php include ('components/operation-status-indicator.php'); ?>

	<!-- Display user picture -->
	<?php require_once('functions/user/user-picture-retriever.php'); ?>
	<center><img src='<?php echo getUserPicturePath($setting_service, $user_login) ?>' alt='user picture' class='img-circle'/></center>

	<!-- Update user : display form -->
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Informations à mettre à jour</h3>
		</div>
		<div class="panel-body">
			<?php require_once('components/user/user-edit-form.php'); ?>
		</div>
	</div>

</div>

<?php include('components/footer.php'); ?>

<script text='text/javascript'>
	$('#auto-validation-form').validate();
</script>

</body>
</html>
