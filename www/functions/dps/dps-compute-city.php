<?php
$canViewAllSections = false;
if ( $rbac->check("ope-dps-view-all", $currentUserID) || $rbac->check("ope-dps-view-dept", $currentUserID) ) {
	$canViewAllSections = true;
}

if (! $canViewAllSections ) {
	$ordered_section = $currentUserSection;
}
if(isset($_POST['city'])){
	$ordered_section = $_POST['city'];
	$forced_section = $_POST['city'];
}
elseif(isset($_GET['own']) ){
	$ordered_section = $currentUserSection;
	$forced_section = $currentUserSection;
}
elseif(isset($_GET['dept']) ){
	$ordered_section = "0";
	$forced_section = "0";
}
elseif(isset($duplicated_dps_array['section']) ){
	$ordered_section = $duplicated_dps_array['section'];
	$forced_section = $duplicated_dps_array['section'];
}
else {
	$ordered_section = $currentUserSection;
}
?>
