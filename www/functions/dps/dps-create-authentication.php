<?php
	if ($city == $currentUserSection && !$rbac->check("ope-dps-create-all", $currentUserID)) {
		$rbac->enforce("ope-dps-create-own", $currentUserID);
	}
	elseif ($city == '0' && !$rbac->check("ope-dps-create-all", $currentUserID)) {
		$rbac->enforce("ope-dps-create-dept", $currentUserID);
	}
	else {
		$rbac->enforce("ope-dps-create-all", $currentUserID);
	}
?>
