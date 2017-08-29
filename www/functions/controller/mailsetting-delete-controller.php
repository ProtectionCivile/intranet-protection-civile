<?php
	if (isset($_POST['id'])){
		echo "ouais ";
		$delID = str_replace("'","", $_POST['id']);
		if($delID == ""){
			$genericError = "Impossible de supprimer un réglage inconnu";
		}
		else{
			$sql = "SELECT * FROM $tablename_settings_mail WHERE ID='$delID'";
			$query = mysqli_query($db_link, $sql);
			if(!$query){
				trigger_error("Erreur lors de la consultation" . mysqli_error($db_link));
			}

			if(mysqli_num_rows($query) == 0){
				$genericError = "Ce paramètre n'existe pas";
			}
			else {
				$setting = mysqli_fetch_assoc($query);
				$settingName = $setting['name'];
				$query_prepare = mysqli_prepare($db_link, "DELETE FROM $tablename_settings_mail WHERE ID=?");
				mysqli_stmt_bind_param($query_prepare, "i", $delID);
				if(!mysqli_stmt_execute($query_prepare)){
					$genericError = "Echec de la suppression ($settingName)";
					trigger_error($genericError . mysqli_error($db_link));
				}
        		else {
					$genericSuccess = "Paramètre correctement supprimé ($settingName)";
				}
			}
		}
	}
?>
