<?php

	if (isset($_POST['del'])){
		$delID = $_POST['del'];
		if($delID == ""){
			$genericError = "Impossible de supprimer une section inconnue";
		}
		else{
			$check_query = "SELECT name FROM $tablename_sections WHERE number='$delID'" or die("Erreur lors de la consultation" . mysqli_error($db_link));
			$verif = mysqli_query($db_link, $check_query);
			$delSection = mysqli_fetch_assoc($verif);
			if (!$delSection){
				$genericError = "La section en question n'existe pas";
			}
			else {
				$delName = $delSection['name'];
				$sql = "DELETE FROM $tablename_sections WHERE number='$delID'";
        		$query = mysqli_query($db_link, $sql) or die(mysqli_error());

        		if ($result) {
        			$genericSuccess = "Section correctement supprimée (".htmlentities($delName).")";
        		}
        		else {
					$genericError = "Echec de la suppression (".htmlentities($delName).")";
				}
			}
		}
	}
?>
