<?php require_once('components/filter/parts/filter-city-computation.php'); ?>
<?php require_once('components/filter/parts/filter-status-computation.php'); ?>
<?php require_once('components/filter/parts/filter-date-computation.php'); ?>
<?php require_once('components/filter/parts/filter-paging-computation.php'); ?>

<?php require_once('components/filter/parts/filter-common-display.php'); ?>



<div class="panel panel-default">
	<div class="panel-heading">
		<button type="button" class="close" aria-label='Close' data-toggle="collapse" data-target=".panel-filters" aria-expanded='true' aria-controls="panel-filters">
			<span aria-hidden="true" >Montrer/Cacher</span>
		</button>
		<h1 class="panel-title">Filtres</h1>
	</div>
	<div class="panel-body" aria-expanded='true'>

		<div class='panel-filters in' aria-expanded='true'>
			<p>
				<!-- Filter on the city holding the DPS -->
				<?php
				if ($rbac->check("ope-dps-view-all", $currentUserID)) {
					include_once('components/filter/parts/filter-city-display.php');
				}
				?>
			</p>
		</div>

		<div class='panel-filters in' aria-expanded='true'>
			<!-- Filter on the DPS date -->
			<?php include_once('components/filter/parts/filter-date-display.php'); ?>
		</div>

		<div class='panel-filters in' aria-expanded='true'>
			<!-- Filter on the DPS status -->
			<?php include_once('components/filter/parts/filter-status-display.php'); ?>
		</div>

	</div>
</div>
