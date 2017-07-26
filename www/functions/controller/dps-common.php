<?php
	if (isset($_POST['dpsID'])) {
		$dpsID = str_replace("'","", $_POST['dpsID']);
	}
	else if (isset($_GET['dpsID'])) {
		$dpsID = str_replace("'","", $_GET['dpsID']);
	}

	if($dpsID == ""){
		$genericError = "Aucun DPS défini";
	}
	else {
		$check_query = "SELECT * FROM $tablename_dps WHERE id='$dpsID'" or die("Erreur lors de la consultation" . mysqli_error($db_link));
		$verif = mysqli_query($db_link, $check_query);
		$dps = mysqli_fetch_assoc($verif);
	 	$dpsCount = mysqli_num_rows($verif);
		if (!$dpsCount){
			$genericError = "Le DPS en question n'existe pas";
		}
	}

	if(empty($genericError)) {
		$cu_full=$dps["cu_full"];
	}

?>
