<div class='container'>
	<div class="form-group form-group-md">
		<div class='col-md-1 row'>
			<label for='tags'>Tags</label>
		</div>
		<div class='col-md-11' id='tags'>
			<button type='button' class='btn btn-primary btn-sm tag-filter <?php echo (strstr($_SESSION['tags'], '') ? "active" : "HULK");?>' data-filter='*' >TOUS</button>
			<div class='btn-group' role='group'>
				<button type='button' class='btn btn-warning btn-sm tag-filter <?php echo (strstr($_SESSION['tags'], 'Bureau') ? "active" : "");?>' data-filter='Bureau' >Bur.</button>
				<button type='button' class='btn btn-warning btn-sm tag-filter <?php echo (strstr($_SESSION['tags'], 'Président') ? "active" : "");?>' data-filter='Président' >Prés.</button>
				<button type='button' class='btn btn-warning btn-sm tag-filter <?php echo (strstr($_SESSION['tags'], 'Secrétaire') ? "active" : "");?>' data-filter='Secrétaire' >Secr.</button>
				<button type='button' class='btn btn-warning btn-sm tag-filter <?php echo (strstr($_SESSION['tags'], 'Trésorier') ? "active" : "");?>' data-filter='Trésorier' >Tréso.</button>
			</div>
			<div class='btn-group' role='group'>
				<button type='button' class='btn btn-success btn-sm tag-filter <?php echo (strstr($_SESSION['tags'], 'Opérationnel') ? "active" : "");?>' data-filter='Opérationnel' >Opé.</button>
				<button type='button' class='btn btn-success btn-sm tag-filter <?php echo (strstr($_SESSION['tags'], 'Acso') ? "active" : "");?>' data-filter='Acso' >Social</button>
				<button type='button' class='btn btn-success btn-sm tag-filter <?php echo (strstr($_SESSION['tags'], 'Communication') ? "active" : "");?>' data-filter='Communication' >Com</button>
				<button type='button' class='btn btn-success btn-sm tag-filter <?php echo (strstr($_SESSION['tags'], 'Technique') ? "active" : "");?>' data-filter='Technique' >Tech</button>
				<button type='button' class='btn btn-success btn-sm tag-filter <?php echo (strstr($_SESSION['tags'], 'Formation') ? "active" : "");?>' data-filter='Formation' >For</button>
			</div>
			<button type='button' class='btn btn-info btn-sm tag-filter <?php echo (strstr($_SESSION['tags'], 'Divers') ? "active" : "");?>' data-filter='Divers' >Divers</button>
			<div class='btn-group' role='group'>
				<button type='button' class='btn btn-danger btn-sm tag-filter <?php echo (strstr($_SESSION['tags'], 'Commission') ? "active" : "");?>' data-filter='Commission' >Commission</button>
				<button type='button' class='btn btn-danger btn-sm tag-filter <?php echo (strstr($_SESSION['tags'], 'Permanence') ? "active" : "");?>' data-filter='Permanence' >Permanence</button>
				<button type='button' class='btn btn-danger btn-sm tag-filter <?php echo (strstr($_SESSION['tags'], 'Diffusion') ? "active" : "");?>' data-filter='Diffusion' >Diffusion</button>
			</div>
		</div>
	</div>
</div>

<?php
if ($_SESSION['tags'] == "*") {
	$_SESSION['tags']="";
}
?>



<script type='text/javascript'>
	$(document).ready(function(){
		$(".tag-filter").click(function(){
			var selectedvalue = $(this).attr('data-filter');
			var currentvalue = $('#formtags').val();
			if (selectedvalue == '*') {
				newvalue = '';
			}
			else if (currentvalue.indexOf(selectedvalue) !== -1) {
				newvalue = currentvalue.replace('|' + selectedvalue, '');
			}
			else {
				newvalue = currentvalue + '|' + selectedvalue;
			}
			$('#formtags').val(newvalue);
			$('#formfilter').submit();
		});
	});
</script>
