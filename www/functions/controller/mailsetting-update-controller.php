<?php
	//Authentication
	$rbac->enforce("admin-settings-update", $currentUserID);


	if (isset($_POST['updateSetting'])) {

		if (isset($_POST['name'])) {
			$name = $_POST['name'];
		}
		else {
			$name = $setting["name"];
		}
		if (isset($_POST['value'])) {
			$value = $_POST['value'];
		}
		else {
			$value=$setting["value"];
		}

		$missingValues = 0;

		if(isNullOrEmpty($name)){
			$missingValues++;
			$name_error = "Le nom est obligatoire";
		}

		if ($missingValues != "0" ) {
			if (!isNullOrEmpty($genericError)){
				$genericError = $genericError.'<br />';
			}
				$genericError = $genericError.'Il y a '.$missingValues.' champs non-renseignés';
		}


		$verif_query = "SELECT * FROM $tablename_settings_mail WHERE name='$name'";
		$verif = mysqli_query($db_link, $verif_query);
		if(!$verif){
			trigger_error("Erreur lors de la consultation" . mysqli_error($db_link));
		}
		$setting = mysqli_num_rows($verif);
		// if ($setting) {
		// 	$genericError = "Ce paramètre '".$name."' existe déjà";
		// }
		// else {
		$query = mysqli_prepare($db_link, "UPDATE $tablename_settings_mail SET name=?, value=? WHERE ID=?");
		mysqli_stmt_bind_param($query, "ssi", mysqli_real_escape_string($db_link, $name), mysqli_real_escape_string($db_link, $value), $id);
		if(!mysqli_stmt_execute($query)){
			$genericError = "Impossible de mettre à jour le paramètre '".$name."'";
			trigger_error($genericError . mysqli_error($db_link));
		}
		else {
			$genericSuccess = "Paramètre modifié avec succès (".$name.")";
		}
		// }
	}

?>
