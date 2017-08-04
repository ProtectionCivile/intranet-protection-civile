<?php
	if ($dps['section'] == $currentUserSection && !$rbac->check("ope-dps-view-all", $currentUserID)) {
		$rbac->enforce("ope-dps-view-own", $currentUserID);
	}
	elseif ($dps['section'] == '0' && !$rbac->check("ope-dps-view-all", $currentUserID)) {
		$rbac->enforce("ope-dps-view-dept", $currentUserID);
	}
	else {
		$rbac->enforce("ope-dps-view-all", $currentUserID);
	}
?>
