<?php

	if (isset($_POST['del'])){
		$delID = str_replace("'","", $_POST['del']);
		if($delID == ""){
			$genericError = "Impossible de supprimer une section inconnue";
		}
		else{
			$check_query = "SELECT name FROM sections WHERE number='$delID'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
			$verif = mysqli_query($link, $check_query);
			$delSection = mysqli_fetch_assoc($verif);
			if (!$delSection){
				$genericError = "La section en question n'existe pas";
			}
			else {
				$delName = $delSection['name'];
				$sql = "DELETE FROM sections WHERE number='$delID'";
        		$query = mysqli_query($link, $sql) or die(mysql_error());

        		if ($result) {
        			$genericSuccess = "Section correctement supprimée (".$delName.")";
        		}
        		else {
					$genericError = "Echec de la suppression (".$delName.")";
				}
			}
		}
	}
?>