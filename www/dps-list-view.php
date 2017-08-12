<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Liste des DPS</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php require_once('components/header.php'); ?>
<?php require_once('functions/dps/dps-view-functions.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="dps-list-view.php">Dispositifs de secours</a></li>
	<li class="active">Listing</li>
</ol>


<!-- Compute city calculation according to POST & GET variables (before auth)-->
<?php require_once('functions/dps/dps-compute-city.php'); ?>

<!-- Authentication -->
<?php require_once('functions/dps/dps-list-authentication.php'); ?>


<!-- Page content container -->
<div class="container">



	<?php $base_url="dps-list-view.php"; ?>

	<!-- Beginning of the filter's parent module -->
	<?php include_once('components/filter/filter-dps-list-module.php'); ?>

	<?php require_once('components/filter/filter-dps-list-query-builder.php'); ?>

	<?php require_once('components/filter/parts/paging-query-modifier.php'); ?>

	<?php require_once('functions/dps/dps-select-parameters-computation.php'); ?>


	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				Liste des Dispositifs Prévisionnels de Secours (<?php echo $nb_elements; ?> DPS trouvés)
				<div class='text-right'>
						<?php if ($rbac->check("ope-dps-create-own", $currentUserID) || $rbac->check("ope-dps-create-all", $currentUserID)) {?>
						<a href='dps-create.php?city' class='btn btn-default btn-sm'>Créer un DPS local</a>
					<?php } ?>
					<?php if ($rbac->check("ope-dps-create-dept", $currentUserID) || $rbac->check("ope-dps-create-all", $currentUserID)) {?>
						<a href='dps-create.php?dept' class='btn btn-default btn-sm'>Créer un DPS dép.</a>
					<?php } ?>
				</div>
			</h3>
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
						<th>Prix</th>
						<th>Statut</th>
						<th>Action</th>
					</thead>
					<tbody>
						<?php
						while($dps = mysqli_fetch_assoc($sqlQuery_query)){
							require('functions/dps/dps-compute-status.php');
							require('functions/dps/dps-workflow-authorization.php');
							?>
							<tr class='<?php echo $trClass;?>' >
								<td>
									<?php echo $dps["dps_begin_date"]; ?>
								</td>
								<td>
									<?php echo $dps["cu_full"]; ?>
								</td>
								<td>
									<?php echo compute_dps_department($dps["event_department"]); ?>
								</td>
								<td>
									<?php echo compute_dps_type($dps["dps_type"]); ?>
								</td>
								<td>
									<?php echo $dps["event_name"]; ?>
								</td>
								<td>
									<?php echo $dps["price"]; ?> €
								</td>
								<td>
									<?php echo $dps_display_status; ?>
								</td>
								<td class='text-center'>
									<?php
									if ($canView) {
										?>
										<a href='dps-view.php?id=<?php echo $dps["id"]; ?>' class='btn btn-sm btn-success'><span class='glyphicon glyphicon-eye-open'></span></a>
										<?php
									}
									if ($canEdit) {
										?>
										<a href='dps-edit.php?id=<?php echo $dps["id"]; ?>' class='btn btn-sm btn-warning'><span class='glyphicon glyphicon-pencil'></span></a>
										<?php
									}
									?>
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
