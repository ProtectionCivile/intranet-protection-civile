<div class='container'>
	<div class="form-group form-group-md">
		<div class='col-md-1 row'>
			<label for='cities' >Antenne</label>
		</div>
		<div class='col-md-11' id='cities'>
			<?php $activeOrNot = ($_SESSION['filtered_section'] == "*") ? "active" : ""; ?>
			<button class='btn btn-primary btn-sm city-filter <?php echo $activeOrNot;?>' data-filter='*' >TOUTES</button>

			<?php
			$query = "SELECT name, shortname, `number` FROM sections WHERE attached_section=number" or die("Erreur lors de la consultation" . mysqli_error($db_link));
			$villes = mysqli_query($db_link, $query);
			while($ville = mysqli_fetch_array($villes)) {
				$activeOrNot = "";
				if ($_SESSION['filtered_section'] == $ville['number']) {
					$activeOrNot = "active";
				} ?>
				<button class='btn btn-default btn-sm city-filter <?php echo $activeOrNot;?>' data-filter='<?php echo $ville['number']; ?>' ><?php echo htmlentities($ville['shortname']); ?></button>
			<?php } ?>

		</div>
	</div>
</div>

<?php
if ($_SESSION['filtered_section'] == "*") {
	$_SESSION['filtered_section']="";
}
?>



<script type='text/javascript'>
	$(document).ready(function(){
		$(".city-filter").click(function(){
			var value = $(this).attr('data-filter');
			$('#formfilteredsection').val(value);
			$('#formfilter').submit();
		});
	});
</script>
