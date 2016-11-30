<?php
	if (!empty($genericError)){ 
	?>
		<div class='alert alert-danger' role='alert'>
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
 			<span class="sr-only">Error:</span>
  			<?php echo $genericError; ?>
		</div>
	
	<?php 
	} elseif (!empty($genericSuccess)){
		?>
		<div class='alert alert-success' role='alert'>
			<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
 			<span class="sr-only">Success:</span>
  			<?php echo $genericSuccess; ?>
		</div>
	
	<?php 
	}
?>