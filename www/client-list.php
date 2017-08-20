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
	<li><a href="client-list.php">Clients</a></li>
	<li class="active">Listing</li>
</ol>


<!-- Compute city calculation according to POST & GET variables (before auth)-->
<?php require_once('functions/client/client-compute-city.php'); ?>

<!-- Authentication -->
<?php require_once('functions/client/client-view-authentication.php'); ?>

<!-- Delete a client : Controller -->
<?php include 'functions/controller/client-delete-controller.php'; ?>

<!-- Page content container -->
<div class="container">

	<!-- Update client : Operation status indicator -->
	<?php include 'components/operation-status-indicator.php'; ?>

	<?php $base_url="client-list.php"; ?>

	<!-- Beginning of the filter's parent module -->
	<?php include_once('components/filter/filter-clients-module.php'); ?>

	<?php require_once('components/filter/filter-clients-query-builder.php'); ?>

	<?php require_once('components/filter/parts/paging-query-modifier.php'); ?>

	<h2>Gestion des clients</h2>


	<!-- List available clients -->
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Visualisation des clients
				<?php if ($rbac->check("ope-clients-update-own", $currentUserID) || $rbac->check("ope-clients-update-all", $currentUserID)) { ?>
					<div class="text-right"><a class="btn btn-warning" role="button" href="client-create.php">Ajouter un client</a></div>
				<?php }?>
			</h3>
		</div>
		<div class="table-responsive">
			<table class="table table-hover">
				<tr>
					<th>Section</th>
					<th>Nom</th>
					<th>Nom court</th>
					<th>Représentant</th>
					<th>Qualité</th>
					<th>Adresse</th>
					<th>Téléphone</th>
					<th>Fax</th>
					<th>Mail</th>
					<th colspan='2'>Actions</th>
				</tr>
				<?php
				$clients = mysqli_query($db_link, $sqlQuery);
				while($client = mysqli_fetch_array($clients)) { ?>
					<tr>
						<td>
							<?php
							$reqliste = "SELECT shortname FROM $tablename_sections WHERE number=".$client['attached_section'] or die("Erreur lors de la consultation" . mysqli_error($db_link));
							$sections = mysqli_query($db_link, $reqliste);
							while($section = mysqli_fetch_array($sections)) {
								echo $section["shortname"];
							}
							?>
						</td>
						<td>
							<?php echo ucfirst($client["name"]); ?>
						</td>
						<td>
							<?php echo ucfirst($client["ref"]); ?>
						</td>
						<td>
							<?php echo ucfirst($client["represent"]); ?>
						</td>
						<td>
							<?php echo ucfirst($client["title"]); ?>
						</td>
						<td>
							<?php echo $client["address"]; ?>
						</td>
						<td>
							<?php echo $client["phone"]; ?>
						</td>
						<td>
							<?php echo ucfirst($client["fax"]); ?>
						</td>
						<td>
							<?php echo $client["mail"]; ?>
						</td>
						<td>
							<?php if ($rbac->check("ope-clients-update-own", $currentUserID) || $rbac->check("ope-clients-update-all", $currentUserID)) { ?>
								<form action='client-edit.php' method='post' accept-charset='utf-8'>
									<input type='hidden' name='clientID' value=<?php echo "'".$client['id']."'"; ?> >
									<button type='submit' class='btn btn-warning glyphicon glyphicon-pencil' title="Modifier"></button>
								</form>
							<?php }?>
						</td>
						<td>
							<?php if ($rbac->check("ope-clients-update-own", $currentUserID) || $rbac->check("ope-clients-update-all", $currentUserID)) { ?>
								<form action='' method='post' accept-charset='utf-8'>
									<input type='hidden' name='delClient' value=<?php echo "'".$client['id']."'"; ?> >
									<button type='submit' class='btn btn-danger glyphicon glyphicon-trash' title="Supprimer" onclick='return(confirm("Etes-vous sûr de vouloir supprimer ce client?"));'></button>
								</form>
							<?php }?>
						</td>
					</tr>
				<?php } ?>
			</table>
		</div>
		<?php if ($rbac->check("ope-clients-update-own", $currentUserID) || $rbac->check("ope-clients-update-all", $currentUserID)) { ?>
			<div class="panel-footer"><a class="btn btn-warning" role="button" href="client-create.php">Ajouter un client</a></div>
		<?php }?>
	</div>

	<!-- Page's pagination module -->
	<?php require_once('components/filter/parts/filter-paging-display.php'); ?>

</div>

<?php include('components/footer.php'); ?>

</body>
</html>
