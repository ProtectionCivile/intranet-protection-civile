<?php

if ($city == $currentUserSection && !$rbac->check("ope-clients-view-all", $currentUserID)) {
		$rbac->enforce("ope-clients-view-own", $currentUserID);
	}
	else {
		$rbac->enforce("ope-clients-view-all", $currentUserID);
	}
?>
