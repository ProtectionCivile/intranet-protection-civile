<?php
	if(isset($_SESSION['dps_status']) && !empty($_SESSION['dps_status']) ){
		$status=$_SESSION['dps_status'];
	}
	elseif (isset($_GET['atraiter'])) {
		$status="atraiter";
	}
	else {
		$status="*";
	}
?>
