<?php
	if (isset($_POST['ID'])){
		$delID = str_replace("'","", $_POST['ID']);
		if($delID == ""){
			$genericError = "Impossible de supprimer un réglage inconnu";
		}
		else{
			$sql = "SELECT * FROM $tablename_settings_mail WHERE ID='$delID'"; 
			$query = mysqli_query($link, $sql);
			if(!$query){
				trigger_error("Erreur lors de la consultation" . mysqli_error($link));
			}

			if(mysqli_num_rows($query) == 0){
				$genericError = "Ce paramètre n'existe pas";
			}	
			else {
				$setting = mysqli_fetch_assoc($query);
				$settingName = $setting['name'];
				$query_prepare = mysqli_prepare($link, "DELETE FROM $tablename_settings_mail WHERE ID=?");
				mysqli_stmt_bind_param($query_prepare, "i", $delID);
				if(!mysqli_stmt_execute($query_prepare)){
					$genericError = "Echec de la suppression ($settingName)";
					trigger_error($genericError . mysqli_error($link));
				}
        		else {
					$genericSuccess = "Paramètre correctement supprimé ($settingName)";
				}
			}
		}
	}
?>