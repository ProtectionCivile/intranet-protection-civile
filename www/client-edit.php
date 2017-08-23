<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Gestion des clients</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="/client-list.php">Clients</a></li>
	<li class="active">Modification</li>
</ol>


<!-- Compute city calculation according to POST & GET variables (before auth)-->
<?php require_once('functions/client/client-compute-city.php'); ?>

<!-- Authentication -->
<?php require_once('functions/client/client-update-authentication.php'); ?>

<!-- Common -->
<?php include ('functions/controller/client-common.php'); ?>

<!-- Create a new client : Controller -->
<?php include('functions/controller/client-update-controller.php'); ?>

<!-- Page content container -->
<div class="container">

	<div class="page-header">
		<h2>Modification de client <small><?php echo $client_name; ?></small></h2>
	</div>

	<!-- Update client : Operation status indicator -->
	<?php include('components/operation-status-indicator.php'); ?>

	<!-- Update a client : display form -->
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Modification d'un client</h3>
		</div>
		<div class="panel-body">
			<?php require_once('components/client/client-edit-form.php'); ?>
		</div>
	</div>

</div>

<?php include('components/footer.php'); ?>

<script text='text/javascript'>
	$('#auto-validation-form').validate();
</script>

</body>
</html>
