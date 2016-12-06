<?php

	if (isset($_POST['delUser'])){
		$delID = str_replace("'","", $_POST['delUser']);
		if($delID == ""){
			$genericError = "Impossible de supprimer un utilisateur inconnu";
		}
		else{
			$check_query = "SELECT ID, login FROM $tablename_users WHERE ID='$delID'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
			$verif = mysqli_query($link, $check_query);
			$delUser = mysqli_fetch_assoc($verif);
			if (!$delUser){
				$genericError = "L'utilisateur en question n'existe pas";
			}
			else {
				$delLogin = $delUser['login'];
				$delete_user = "DELETE FROM $tablename_users WHERE ID='$delID'";
        		$result = mysqli_query($link, $delete_user) or die(mysql_error());

        		// Then unassign all its roles
        		$allUserRoles="";
        		$roles = $rbac->Users->allRoles($delID);
				foreach ($roles as &$role) {
					$allUserRoles = $allUserRoles.utf8_encode($role['Description']).", ";
					$rbac->Users->unassign($role['ID'], $delID);
				}
        		$perm_id = $rbac->Roles->remove($id, true);
        		if ($result) {
        			$genericSuccess = "Utilisateur correctement supprimé (".$delLogin.") et ses rôles aussi (".$allUserRoles.")";
        		}
        		else {
					$genericError = "Echec de la suppression (".$delLogin.")";
				}
			}
		}
	}
?>