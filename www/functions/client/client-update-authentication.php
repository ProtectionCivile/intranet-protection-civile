<?php

if ($city == $currentUserSection && !$rbac->check("ope-clients-update-all", $currentUserID)) {
	$rbac->enforce("ope-clients-update-own", $currentUserID);
}
else {
	$rbac->enforce("ope-clients-update-all", $currentUserID);
}
?>
