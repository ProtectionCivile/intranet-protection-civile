<?php

	if (isset($_POST['delClient'])){
		$delID = str_replace("'","", $_POST['delClient']);
		if($delID == ""){
			$genericError = "Impossible de supprimer un client inconnu";
		}
		else{
			$check_query = "SELECT ID, login FROM $tablename_clients WHERE ID='$delID'" or die("Erreur lors de la consultation" . mysqli_error($db_link));
			$verif = mysqli_query($db_link, $check_query);
			$delClient = mysqli_fetch_assoc($verif);
			if (!$delClient){
				$genericError = "Le client en question n'existe pas";
			}
			else {
				$clientName = $delClient['name'];
				$delete_client = "DELETE FROM $tablename_clients WHERE ID='$delID'";
    		$result = mysqli_query($db_link, $delete_client) or die(mysqli_error());
    		if ($result) {
    			$genericSuccess = "Client correctement supprimé (".htmlentities($clientName).")";
    		}
    		else {
					$genericError = "Echec de la suppression (".htmlentities($clientName).")";
				}
			}
		}
	}
?>
