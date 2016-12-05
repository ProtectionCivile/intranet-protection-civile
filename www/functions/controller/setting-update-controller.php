<?php
	//Authentication 
	$rbac->enforce("admin-settings-update", $currentUserID);


	if (empty($genericError)) {

		if (isset($_POST['name'])) {
			$name=str_replace("'","", $_POST['name']);
		}
		else {
			$name=$setting["name"];
		}
		if (isset($_POST['value'])) {
			$value=str_replace("'","", $_POST['value']);
		}
		else {
			$value=$setting["value"];
		}
		
		if (isset($_POST['update'])) {		
			$verif_query = "SELECT * FROM ".$tablename_settings_general." WHERE name='$name'"; 
			$verif = mysqli_query($link, $verif_query);
			if(!$verif){
				trigger_error("Erreur lors de la consultation" . mysqli_error($link));
			}
			$setting = mysqli_num_rows($verif);
			// if ($setting) {
			// 	$genericError = "Ce paramètre '".$name."' existe déjà";
			// }
			// else {
				$query = mysqli_prepare($link, "UPDATE ".$tablename_settings_general." SET name=?, value=? WHERE ID=?");
				mysqli_stmt_bind_param($query, "ssi", $name, $value, $id);
				if(!mysqli_stmt_execute($query)){
					$genericError = "Impossible de mettre à jour le paramètre '".$name."'";
					trigger_error($genericError . mysqli_error($link));
				}
				else {
					$genericSuccess = "Paramètre modifié avec succès (".$name.")";
				}
			// }
		}
	}

?>