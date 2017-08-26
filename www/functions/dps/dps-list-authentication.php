<?php
	if(isset($ordered_section)){
		// User wants to view a specific city (maybe its own)
		if ($currentUserSection == $ordered_section){
			// User explicitely wants to view its section's DPS
			if (!$rbac->check("ope-dps-view-all", $currentUserID)) {
				$rbac->enforce("ope-dps-view-own", $currentUserID);
			}
			else {
				$rbac->enforce("ope-dps-view-all", $currentUserID);
			}
		}
		elseif ('0' == $ordered_section){
			// User wants to view departement's DPS
			if (!$rbac->check("ope-dps-view-all", $currentUserID)) {
				$rbac->enforce("ope-dps-view-dept", $currentUserID);
			}
			else {
				$rbac->enforce("ope-dps-view-all", $currentUserID);
			}
		}
		else {
			// User wants to view another city's DPS
			$rbac->enforce("ope-dps-view-all", $currentUserID);
		}
	}
	else {
		// User wants to view all DPS from the main link, or the 'ALL' filter
		$rbac->enforce("ope-dps-view-all", $currentUserID);
	}
?>
