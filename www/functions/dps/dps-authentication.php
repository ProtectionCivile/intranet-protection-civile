<?php 
	if(isset($_GET['city'])){
		if (empty($_GET['city']) || $currentUserSection == $_GET['city']) {
			$rbac->enforce("ope-dps-view-own", $currentUserID);
			$city=$currentUserSection; 
		}
		else {
			$rbac->enforce("ope-dps-view-all", $currentUserID);
			$city=$_GET['city'];
		}
	}
	else {
		$rbac->enforce("ope-dps-view-all", $currentUserID); 
	}
?>