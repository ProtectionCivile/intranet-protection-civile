<?php require_once('functions/dps/dps-find-documents.php'); ?>
<?php require_once('functions/dps/dps-compute-status.php'); ?>


<?php
$canValidateLocal = false;
$hasAllAttachements = false;

if (
	(	$dps_status == 'draft') && (
	( $dps['section'] == $currentUserSection && $rbac->check("ope-dps-validate-local", $currentUserID) ) ||
	( $dps['section'] == '0' && $rbac->check("ope-dps-validate-dept", $currentUserID) ) ||
	( $rbac->check("ope-dps-validate-ddo-to-pref", $currentUserID) )
	)
) {
	$canValidateLocal = true;
}

$fileconvention;
$filerisk;

if ($fileconvention && $filerisk) {
	$hasAllAttachements = true;
}

?>
