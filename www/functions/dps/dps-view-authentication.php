<?php
	if ($dps['section'] == $currentUserSection && !$rbac->check("ope-dps-view-all", $currentUserID)) {
		$rbac->enforce("ope-dps-view-own", $currentUserID);
	}
	else {
		$rbac->enforce("ope-dps-view-all", $currentUserID);
	}
?>
