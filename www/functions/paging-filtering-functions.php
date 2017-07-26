<?php 
	function reset_currrent_page() {
		$current_page=1;
		?>
		<script type='text/javascript'>
			$(document).ready(function(){
				$('#formcurrentpage').val(<?php echo $current_page; ?>);
			});
		</script>
		<?php
	}
?>