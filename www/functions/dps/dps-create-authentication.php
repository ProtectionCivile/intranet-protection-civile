<?php require_once('functions/dps/dps-workflow-authorization.php'); ?>

<?php
	if ($dps['section'] == $currentUserSection && !$rbac->check("ope-dps-create-all", $currentUserID)) {
		$rbac->enforce("ope-dps-create-own", $currentUserID);
	}
	elseif ($dps['section'] == '0' && !$rbac->check("ope-dps-create-all", $currentUserID)) {
		$rbac->enforce("ope-dps-create-dept", $currentUserID);
	}
	else {
		$rbac->enforce("ope-dps-create-all", $currentUserID);
	}

	if (!$canEdit) {
		$genericError = 'Le DPS est dans un état qui ne permet pas sa modification avec vos droits actuels. En revanche, vous pourrez peut-être <a href="dps-view.php?id='.$id.'">le visualiser</a>.';
	}
?>
