<?php
	if (!$canViewAllSections ) {
		$filtered_section = $currentUserSection;
	}

	elseif(isset($forced_section)){ // On vient de demander expréssément telle commune (suite à un clic ou un lien)
		$filtered_section=$forced_section;
	}

	elseif(isset($_POST['formfilteredsection'])){
		if (empty($_POST['formfilteredsection']) && $_POST['formfilteredsection'] != "0" ) {
			$filtered_section=$currentUserSection;
		}
		else {
			if ($currentUserSection == $_POST['formfilteredsection']){
				$filtered_section=$currentUserSection;
			}
			else {
				$filtered_section=$_POST['formfilteredsection'];
			}
		}
	}
	elseif (isset($_GET['formfilteredsection']) && !empty($_GET['formfilteredsection'])) {
		$filtered_section=$_GET['formfilteredsection'];
	}
	else {
		$filtered_section="*";
	}
?>
