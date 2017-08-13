<?php require_once('functions/dps/dps-find-documents.php'); ?>
<?php require_once('functions/dps/dps-compute-status.php'); ?>


<?php
$canValidateLocal = false;
$canRejectLocal = false;
$hasAllAttachements = false;
$canRejectDdo = false;
$canValidateDdo = false;
$canWaitDdo = false;
$canView = false;
$canEdit = false;


if (
	(	$dps_status == 'draft') && (
	( $dps['section'] == $currentUserSection && $rbac->check("ope-dps-validate-local", $currentUserID) ) ||
	( $dps['section'] == '0' && $rbac->check("ope-dps-validate-dept", $currentUserID) ) ||
	( $rbac->check("ope-dps-validate-ddo-to-pref", $currentUserID) )
	)
	) {
	$canValidateLocal = true;
}

if (
	(	$dps_status == 'draft') && (
	( $dps['section'] == $currentUserSection && $rbac->check("ope-dps-validate-local", $currentUserID) ) ||
	( $dps['section'] == '0' && $rbac->check("ope-dps-validate-dept", $currentUserID) )
	) ||
	(	$dps_status != 'canceled') && (
	( $rbac->check("ope-dps-validate-ddo-to-pref", $currentUserID) )
	)
	) {
	$canRejectLocal = true;
}

if (
	(	$dps_status == 'draft' || $dps_status == 'valid_antenne' || $dps_status == 'valid_ddo_attente' ) && (
	( $rbac->check("ope-dps-validate-ddo-to-pref", $currentUserID) )
	)
	) {
	$canRejectDdo = true;
}

if (
	(	$dps_status == 'draft' || $dps_status == 'valid_antenne' || $dps_status == 'refused' || $dps_status == 'valid_ddo_attente' ) && (
	( $rbac->check("ope-dps-validate-ddo-to-pref", $currentUserID) )
	)
	) {
	$canValidateDdo = true;
}

if (
	(	$dps_status == 'draft' || $dps_status == 'valid_antenne' || $dps_status == 'refused' ) && (
	( $rbac->check("ope-dps-validate-ddo-to-pref", $currentUserID) )
	)
	) {
	$canWaitDdo = true;
}

	if (isset($dps['section'])) {
		$antenne = $dps['section'];
	}
	else {
		$antenne = $city;
	}

if (
	((	$dps_status == 'draft' ) ||	( $rbac->check("ope-dps-validate-ddo-to-pref", $currentUserID) ) ) ||
	( $antenne == $currentUserSection && $rbac->check("ope-dps-create-own", $currentUserID) ) ||
	( $antenne == '0' && $rbac->check("ope-dps-create-dept", $currentUserID) ) ||
	( $rbac->check("ope-dps-create-all", $currentUserID) )
	) {
	$canEdit = true;
}

if (
	($antenne == $currentUserSection && $rbac->check("ope-dps-view-own", $currentUserID)) ||
	($antenne == '0' && $rbac->check("ope-dps-view-dept", $currentUserID)) ||
	($rbac->check("ope-dps-view-all", $currentUserID))
	) {
	$canView = true;
}

if ($fileconvention && $filerisk) {
	$hasAllAttachements = true;
}

?>
