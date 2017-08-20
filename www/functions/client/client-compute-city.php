<?php
	$canViewAllSections = false;
	if ($rbac->check("ope-clients-view-all", $currentUserID)) {
		$canViewAllSections = true;
	}

	if (!$canViewAllSections) {
		$ordered_section = $currentUserSection;
	}
	// elseif(isset($_POST['city'])){
	// 	$ordered_section = $_POST['city'];
	// }
	// elseif(isset($_GET['city']) ){
	// 	$ordered_section = $currentUserSection;
	// }
	else {
		$ordered_section = $currentUserSection;
	}

	echo '<br /><small><strong>client compute city:</strong> ordered_section='.$ordered_section.'</small>';

?>
