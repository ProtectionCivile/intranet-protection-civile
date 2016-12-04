<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Liste des DPS</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8";>
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
	</head>
<body>
<?php require_once('components/header.php'); ?>
<?php require_once('functions/dps/dps-view-functions.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="#">Opérationnel</a></li>
	<li><a href="#">Dispositifs de secours</a></li>
	<li class="active">Listing</li>
</ol>



<!-- Authentication -->
<?php require_once('functions/dps/dps-authentication.php'); ?>


<!-- Page content container -->
<div class="container">



	<?php $base_url="dps-list-view.php"; ?>

	<!-- Beginning of the filter's parent module -->
	<?php include_once('components/filter/filter-dps-list-module.php'); ?>

	<?php require_once('components/filter/filter-dps-interpretor.php'); ?>

	<?php require_once('components/filter/parts/paging-interpretor.php'); ?>
	

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Liste des Dispositifs Prévisionnels de Secours (<?php echo $nb_elements; ?> DPS trouvés)</h3>
		</div>
		<div class="panel-body">
			<div class="table-responsive" style="vertical-align: middle;">
				<table class="table table-bordered table-condensed">
					<thead>
						<th>Date</th>
						<th>Numéro CU</th>
						<th>Dept</th>
						<th>Type</th>
						<th>Nom</th>
						<th>Validation</th>
						<th>Action</th>
					</thead>
					<tbody>
						<?php
						while($dps = mysqli_fetch_assoc($sqlQuery_query)){
							require('functions/dps/choose-between-dps-type.php');
							?>
							<tr class='<?php echo $trClass;?>' >
								<td>
									<?php echo $dps["dps_debut_poste"]; ?>
								</td>
								<td>
									<?php echo $dps["cu_complet"]; ?>
								</td>
								<td>
									<?php echo compute_dps_department($dps["dept"]); ?>
								</td>
								<td>
									<?php echo compute_dps_type($dps["type_dps"]); ?>
								</td>
								<td>
									<?php echo $dps["description_manif"]; ?>
								</td>
								<td>
									<?php echo $etat; ?>
								</td>
								<td>
									<form role='form' action='<?php echo $urlform; ?>' method='post'>
										<input type='hidden' name='id' value='<?php echo $dps["id"]; ?>'>
										<button type='submit' class='<?php echo $buttonclass; ?>'></button>
									</form>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- Page's pagination module -->
	<?php require_once('components/filter/parts/filter-paging-display.php'); ?>

</div>
<?php require ('components/footer.php'); ?>
</body>
</html>