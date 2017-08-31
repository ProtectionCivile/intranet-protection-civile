<?php
$canViewAllSections = true;
if ( $rbac->check("directory-view", $currentUserID) ) {
	$canViewAllSections = true;
}
?>
