<?php
$canViewAllSections = false;
if ( $rbac->check("admin-roles-view", $currentUserID) ) {
	$canViewAllSections = true;
}
?>
