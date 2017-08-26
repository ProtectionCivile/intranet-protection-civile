<?php
$canViewAllSections = false;
if ( $rbac->check("admin-users-view", $currentUserID) ) {
	$canViewAllSections = true;
}
?>
