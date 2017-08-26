<?php
	if(isset($_POST['formstatus']) && !empty($_POST['formstatus']) ){
		$status=$_POST['formstatus'];
	}
	elseif (isset($_GET['atraiter'])) {
		$status="atraiter";
	}
	else {
		$status="*";
	}
?>
