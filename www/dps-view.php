<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>DPS</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="#">Opérationnel</a></li>
	<li><a href="dps-list-view.php">Dispositifs de secours</a></li>
	<li class="active">Visualisation</li>
</ol>

<?php
	if(isset($_POST['id'])){
		$id = $_POST['id'];
	}
	else if (isset($_GET['id'])){
		$id = $_GET['id'];
	}
	if (isset($id) ){
		$sql = "SELECT * FROM $tablename_dps WHERE id = $id";
		$query = mysqli_query($db_link, $sql);
		$dps = mysqli_fetch_array($query);
	}
?>


<!-- Compute city calculation according to POST & GET variables (before auth)-->
<?php //require_once('functions/dps/dps-compute-city.php'); ?>


<!-- Authentication -->
<?php require_once('functions/dps/dps-view-authentication.php'); ?>

<?php require_once('functions/dps/dps-compute-variables.php'); ?>

<?php require_once('functions/dps/dps-view-functions.php'); ?>

<?php require_once('functions/dps/dps-select-parameters-computation.php'); ?>

<!-- Common -->
<?php //include ('functions/controller/dps-common.php'); ?>


<!-- Update a DPS : Controller -->
<?php //require_once('functions/controller/dps-update-controller.php'); ?>

<!-- Page content container -->
<div class="container">

	<!-- Update : Operation status indicator -->
	<?php //require_once('components/operation-status-indicator.php'); ?>

	<h2><center>DPS <?php echo $cu_full; ?></center></h2>


	<!-- Formulaire de création de DPS -->
	<?php require_once('components/dps/dps-view-form.php'); ?>

</div>

<?php require_once('components/footer.php'); ?>


</body>
</html>
