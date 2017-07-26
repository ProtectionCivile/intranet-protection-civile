<?php
	if ($city == $currentUserSection && !$rbac->check("ope-dps-create-all", $currentUserID)) {
		$rbac->enforce("ope-dps-create-own", $currentUserID);
	}
	else {
		$rbac->enforce("ope-dps-create-all", $currentUserID);
	}
?>
