<?php
	

	if (isset($_POST['delUser'])){
		$delID = str_replace("'","", $_POST['delUser']);
		if($delID == ""){
			$genericError = "Impossible de supprimer un utilisateur inconnu";
		}
		else{
			$check_query = "SELECT ID, login FROM users WHERE ID='$delID'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
			$verif = mysqli_query($link, $check_query);
			$row_verif = mysqli_fetch_assoc($verif);
			$delUser = mysqli_num_rows($verif);		
			if (!$delUser){
				$genericError = "L'utilisateur en question n'existe pas";
			}
			else {
				$delLogin = $delUser['last_name'];
				$delete_user = "DELETE FROM users WHERE ID='$delID'";
        		$result = mysqli_query($link, $delete_user) or die(mysql_error());
        		if ($result) {
        			$genericSuccess = "Utilisateur correctement supprimé (".$delLogin.")";
        		}
        		else {
					$genericError = "Echec de la suppression (".$delLogin.")";
				}
			}
		}
	}
?>