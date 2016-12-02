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

	<!-- Filter on the city holding the DPS -->
	<?php include_once('components/dps-city-filter.php'); ?>
	
	<br />

	<!-- Filter on the DPS' status -->
	<?php include_once('components/dps-status-filter.php'); ?>
	
	<br />

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Liste des Dispositifs Prévisionnels de Secours</h3>
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
						$dpsperpage = 50;

						require('functions/dps/get_all_visible_dps_query.php');
						$listedps_result = mysqli_query($link, $listedps_query);

						while($listedps = mysqli_fetch_array($listedps_result)){
							require('functions/dps/choose-between-dps-type.php'); 
							?>
							<tr <?php echo $trClass;?> >
								<td>
									<?php echo $listedps["dps_debut_poste"]; ?>
								</td>
								<td>
									<?php echo $listedps["cu_complet"]; ?>
								</td>
								<td>
									<?php echo compute_dps_department($listedps["dept"]); ?>
								</td>
								<td>
									<?php echo compute_dps_type($listedps["type_dps"]); ?>
								</td>
								<td>
									<?php echo $listedps["description_manif"]; ?>
								</td>
								<td>
									<?php echo compute_dps_status($refus, $validation_ec, $validation, $listedps["valid_demande_dps"]); ?>
								</td>
								<td>
									<form role='form' action='<?php echo $urlform; ?>' method='post'>
										<input type='hidden' name='id' value='<?php echo $listedps["id"]; ?>'>
										<button type='submit' class='<?php echo $buttonclass; ?>'></button>
									</form>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
				
				<!-- Page's pagination module -->
				<?php include_once('components/dps-pagination-module.php'); ?>
				
			</div>
		</div>
	</div>
</div>
<?php require ('components/footer.php'); ?>
</body>
</html>