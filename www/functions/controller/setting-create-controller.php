<?php

	//Authentication
	$rbac->enforce("admin-settings-update", $currentUserID);

	if (isset($_POST['addSetting'])){
		$name = $_POST['name'];
		$value = $_POST['value'];

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

		if (empty($genericError)){
			$verif_query = "SELECT * FROM $tablename_settings_general WHERE name='$name'";
			$verif = mysqli_query($db_link, $verif_query);
			if(!$verif){
				trigger_error("Erreur lors de la consultation" . mysqli_error($db_link));
			}
			$setting = mysqli_num_rows($verif);
			if ($setting) {
				$genericError = "Un réglage du même nom existe déjà (".htmlentities($name).")";
			}
			else {
				$query = mysqli_prepare($db_link, "INSERT INTO $tablename_settings_general (name, value) VALUES (?, ?)");
				mysqli_stmt_bind_param($query, "ss", mysqli_real_escape_string($db_link, $name), mysqli_real_escape_string($db_link, $value));

				if(!mysqli_stmt_execute($query)){
					$genericError = "Impossible d'ajouter le paramètre '".htmlentities($name)."'";
					trigger_error($genericError . mysqli_error($db_link));
				}
				else {
					$genericSuccess = "Paramètre créé avec succès (".htmlentities($name).")";
				}
			}
		}
	}
?>
