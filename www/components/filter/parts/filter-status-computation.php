<?php
if (isset($_GET['atraiter'])) {
	$status="atraiter";
}
elseif(isset($_SESSION['dps_status']) && !empty($_SESSION['dps_status']) ){
		$status=$_SESSION['dps_status'];
	}
	else {
		$status="*";
	}
?>
