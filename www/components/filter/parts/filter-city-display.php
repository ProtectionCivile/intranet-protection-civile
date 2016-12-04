<div class='container'>
	<div class="form-group form-group-md">
		<div class='col-md-1 row'>
			<label for='cities' >Section</label>
		</div>
		<div class='col-md-11' id='cities'>
			<?php 
			if ($rbac->check("ope-dps-view-all", $currentUserID)) { ?>
				<?php $activeOrNot = ($city == "*") ? "active" : ""; ?>
				<button class='btn btn-primary btn-sm city-filter <?php echo $activeOrNot;?>' data-filter='*' >TOUTES</button>
				
				<?php 
				$query = "SELECT name, shortname, `number` FROM sections WHERE attached_section=number" or die("Erreur lors de la consultation" . mysqli_error($link)); 
				$villes = mysqli_query($link, $query);
				while($ville = mysqli_fetch_array($villes)) { 
					$activeOrNot = "";
					if ($city == $ville['number']) {
						$activeOrNot = "active";
					} ?>
					<button class='btn btn-default btn-sm city-filter <?php echo $activeOrNot;?>' data-filter='<?php echo $ville['number']; ?>' ><?php echo $ville['shortname']; ?></button>
				<?php } ?>

			<?php } ?>
		</div>
	</div>
</div>

<?php
if ($city == "*") {
	$city="";
}
?>


 
<script type='text/javascript'>
	$(document).ready(function(){
		$(".city-filter").click(function(){
			var value = $(this).attr('data-filter');
			$('#formcity').val(value);
			$('#formfilter').submit();
		});
	});

</script>