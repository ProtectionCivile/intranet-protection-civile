<?php
	
	//Authentication 
	$rbac->enforce("admin-settings-update", $currentUserID);

	if (isset($_POST['addSetting'])){
		$name = str_replace("'","", $_POST['name']);
		$value = str_replace("'","", $_POST['value']);

		if($name == ""){
			$genericError = "Le nom est obligatoire";
			$createErrorName = "Le nom est obligatoire";
		}
		
		if (empty($genericError)){
			$verif_query = "SELECT * FROM $tablename_settings_mail WHERE name='$name'"; 
			$verif = mysqli_query($db_link, $verif_query);
			if(!$verif){
				trigger_error("Erreur lors de la consultation" . mysqli_error($db_link));
			}
			$setting = mysqli_num_rows($verif);
			if ($setting) {
				$genericError = "Un réglage du même nom existe déjà (".$name.")";
			}
			else {
				$query = mysqli_prepare($db_link, "INSERT INTO $tablename_settings_mail (name, value) VALUES (?, ?)");
				mysqli_stmt_bind_param($query, "ss", $name, $value);
				if(!mysqli_stmt_execute($query)){
					$genericError = "Impossible d'ajouter le paramètre '".$name."'";
					trigger_error($genericError . mysqli_error($db_link));
				}
				else {
					$genericSuccess = "Paramètre créé avec succès (".$name.")";
				}
			}
		}
	}
?>