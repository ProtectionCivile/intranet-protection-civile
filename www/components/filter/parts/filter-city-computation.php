<?php
	if(isset($_POST['formcity'])){
		if (empty($_POST['formcity']) ) {
			$city=$currentUserSection; 
		}
		else {
			if ($currentUserSection == $_POST['formcity']){
				$city=$currentUserSection;
			}
			else {
				$city=$_POST['formcity'];
			}
		}
	}
	elseif (isset($_GET['city']) && !empty($_GET['city'])) {
		$city=$_GET['city'];
	}
	else {
		$city="*";
	}
?>