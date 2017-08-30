<?php 
	function reset_currrent_page() {
		$_SESSION['current_page']=1;
		?>
		<script type='text/javascript'>
			$(document).ready(function(){
				$('#formcurrentpage').val(<?php echo $_SESSION['current_page']; ?>);
			});
		</script>
		<?php
	}
?>
