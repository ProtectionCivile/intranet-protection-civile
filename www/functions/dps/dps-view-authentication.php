<?php require_once('functions/dps/dps-workflow-authorization.php'); ?>

<?php

if (isset($dps['section'])) {
	$antenne = $dps['section'];
}
else {
	$antenne = $ordered_section;
}

if ($antenne == $currentUserSection && !$rbac->check("ope-dps-view-all", $currentUserID)) {
		$rbac->enforce("ope-dps-view-own", $currentUserID);
	}
	elseif ($antenne == '0' && !$rbac->check("ope-dps-view-all", $currentUserID)) {
		$rbac->enforce("ope-dps-view-dept", $currentUserID);
	}
	else {
		$rbac->enforce("ope-dps-view-all", $currentUserID);
	}

	if (!$canView) {
		$genericError = 'Le DPS est dans un état qui ne permet pas sa visualisation avec vos droits actuels.';
	}
?>
