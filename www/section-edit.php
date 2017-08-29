<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Gestion des sections</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<ol class='breadcrumb'>
	<li><a href='/'>Accueil</a></li>
	<li><a href='/section-list.php'>Gestion des sections</a></li>
	<li class='active'>Modification</li>
</ol>



<!-- Authentication -->
<?php require_once('functions/section/section-update-authentication.php'); ?>


<!-- Common -->
<?php include ('functions/controller/section-common.php'); ?>


<!-- Update section : Controller -->
<?php include ('functions/controller/section-update-controller.php'); ?>


<!-- Page content container -->
<div class='container'>

	<div class="page-header">
		<h2>Gestion des sections <small>Modification de '<?php echo $section_name ?>'</small></h2>
	</div>

	<!-- Update user : Operation status indicator -->
	<?php include ('components/operation-status-indicator.php'); ?>


	<!-- Update user : display form -->
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Modifier l'antenne de <strong><?php echo $section_name; ?> - N°<?php echo $section_number;?></strong></h3>
		</div>
		<div class="panel-body">
			<?php require_once('components/section/section-edit-form.php'); ?>
		</div>
	</div>

</div>

<?php include('components/footer.php'); ?>

<script text='text/javascript'>
	$('#auto-validation-form').validate();
</script>

</body>
</html>
