<div class='container'>
	<div class="form-group form-group-md">
		<div class='col-md-1 row'>
			<label for='statuses' >Statut</label>
		</div>
		<div class='col-md-11' id='statuses'>
			<?php $activeOrNot = ($status == "*") ? "active" : ""; ?>
			<button class='btn btn-primary btn-sm status-filter <?php echo $activeOrNot; ?>' data-filter='*'>Afficher tout</button>
			<?php $activeOrNot = ($status == "canceled") ? "active" : ""; ?>
			<button class='btn btn-default btn-sm status-filter <?php echo $activeOrNot; ?>' data-filter='canceled'>Annulé</button>
			<?php $activeOrNot = ($status == "not-valid") ? "active" : ""; ?>
			<button class='btn btn-default btn-sm status-filter <?php echo $activeOrNot; ?>' data-filter='not-valid'>Brouillon</button>
			<?php $activeOrNot = ($status == "valid_antenne") ? "active" : ""; ?>
			<button class='btn btn-info btn-sm status-filter <?php echo $activeOrNot; ?>' data-filter='valid_antenne'>Validé Antenne</button>
			<?php $activeOrNot = ($status == "valid_ddo_attente") ? "active" : ""; ?>
			<button class='btn btn-warning btn-sm status-filter <?php echo $activeOrNot; ?>' data-filter='valid_ddo_attente'>Validé DDO en attente</button>
			<?php $activeOrNot = ($status == "valid_pref") ? "active" : ""; ?>
			<button class='btn btn-success btn-sm status-filter <?php echo $activeOrNot; ?>' data-filter='valid_pref'>Validé DDO et Préfecture</button>
			<?php $activeOrNot = ($status == "refused") ? "active" : ""; ?>
			<button class='btn btn-danger btn-sm status-filter <?php echo $activeOrNot; ?>' data-filter='refused'>Refusé</button>
			<?php $activeOrNot = ($status == "fuzzy") ? "active" : ""; ?>
			<button class='btn btn-danger btn-sm status-filter glyphicon glyphicon-fire <?php echo $activeOrNot; ?>' data-filter='fuzzy'></button>
		</div>
	</div>
</div>

<?php
	if ($status == "*") {
		$status="";
	}
?>


 
<script type='text/javascript'>
	$(document).ready(function(){
		$(".status-filter").click(function(){
			var value = $(this).attr('data-filter');
			$('#formstatus').val(value);
			$('#formfilter').submit();
		});
	});
</script>