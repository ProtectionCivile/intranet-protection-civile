<?php
	if(isset($_POST['city'])){
		$city = $_POST['city'];
	}
	elseif(isset($_GET['own']) ){
		$city = $currentUserSection;
	}
	elseif(isset($_GET['dept']) ){
		$city = "0";
	}
	else {
		$city = $currentUserSection;
	}
?>
