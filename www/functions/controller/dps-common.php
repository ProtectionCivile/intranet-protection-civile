<?php
	if (isset($_POST['id'])) {
		$id = str_replace("'","", $_POST['id']);
	}
	else if (isset($_GET['id'])) {
		$id = str_replace("'","", $_GET['id']);
	}

	if($id == ""){
		$genericError = "Aucun DPS défini";
	}
	else {
		$check_query = "SELECT * FROM $tablename_dps WHERE id='$id'" or die("Erreur lors de la consultation" . mysqli_error($db_link));
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
