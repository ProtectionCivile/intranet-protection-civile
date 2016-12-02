<?php 
	if(isset($_GET['city'])){
		if (empty($_GET['city']) ) {
			// User comes from its section's link
			$rbac->enforce("ope-dps-view-own", $currentUserID);
			$city=$currentUserSection; 
		}
		else {
			// User wants to view a specific city (maybe its own)
			if ($currentUserSection == $_GET['city']){
				// User explicitely wants to view its section's DPS
				if (!$rbac->check("ope-dps-view-all", $currentUserID)) {
					$rbac->enforce("ope-dps-view-own", $currentUserID);
				}
				$city=$currentUserSection; 
			}
			else {
				// User wants to view another city's DPS
				$rbac->enforce("ope-dps-view-all", $currentUserID);
				$city=$_GET['city'];
			}
		}
	}
	else {
		// User wants to view all DPS from the main link, or the 'ALL' filter
		$rbac->enforce("ope-dps-view-all", $currentUserID); 
	}
?>