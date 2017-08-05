<?php require_once('functions/dps/dps-find-documents.php'); ?>
<?php require_once('functions/dps/dps-compute-status.php'); ?>


<?php
$canValidateLocal = false;
$canRejectLocal = false;
$hasAllAttachements = false;
$canRejectDdo = false;
$canValidateDdo = false;
$canWaitDdo = false;


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

if ($fileconvention && $filerisk) {
	$hasAllAttachements = true;
}

?>
