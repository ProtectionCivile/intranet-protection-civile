<?php require_once('components/filter/parts/filter-city-computation.php'); ?>
<?php require_once('components/filter/parts/filter-paging-computation.php'); ?>

<?php require_once('components/filter/parts/filter-common-display.php'); ?>

<?php if ($rbac->check("ope-clients-view-all", $currentUserID)) {?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<button type="button" class="close" aria-label='Close' data-toggle="collapse" data-target=".panel-filters" aria-expanded='true' aria-controls="panel-filters">
				<span aria-hidden="true" >Montrer/Cacher</span>
			</button>
			<h1 class="panel-title">Filtres</h1>
		</div>
		<div id='panel-filters' class="panel-body" aria-expanded='true'>

			<div class='panel-filters in' aria-expanded='true'>
				<p>
					<!-- Filter on the city -->
					<?php include_once('components/filter/parts/filter-city-display.php'); ?>
				</p>
			</div>

		</div>
	</div>
<?php } ?>
