<?php
	$id = $_POST['id'];

	if($id == ""){
		$genericError = "Aucun paramètre défini";
	}
	else {
		$sql = "SELECT ID, name, value FROM $tablename_settings_mail WHERE ID='$id'" or die("Erreur lors de la consultation" . mysqli_error($db_link));
		$query = mysqli_query($db_link, $sql);
		$setting = mysqli_fetch_assoc($query);
	 	$settingCount = mysqli_num_rows($query);
		if (!$settingCount){
			$genericError = "Le paramètre en question n'existe pas";
		}

		if(empty($genericError)) {
			$name = $setting['name'];
			$value = $setting['value'];
		}
	}

?>
