<?php
	if (!$canViewAllSections ) {
		$_SESSION['filtered_section'] = $currentUserSection;
	}

	elseif(isset($forced_section)){ // On vient de demander expréssément telle commune (suite à un clic ou un lien)
		$_SESSION['filtered_section']=$forced_section;
	}

	elseif(isset($_SESSION['filtered_section'])){
		if (empty($_SESSION['filtered_section']) && $_SESSION['filtered_section'] != "0" ) {
			$_SESSION['filtered_section']=$currentUserSection;
		}
		else {
			if ($currentUserSection == $_SESSION['filtered_section']){
				$_SESSION['filtered_section']=$currentUserSection;
			}
			else {
				$_SESSION['filtered_section']=$_SESSION['filtered_section'];
			}
		}
	}
	elseif (isset($_GET['formfilteredsection']) && !empty($_GET['formfilteredsection'])) {
		$_SESSION['filtered_section']=$_GET['formfilteredsection'];
	}
	else {
		$_SESSION['filtered_section']="*";
	}
?>
