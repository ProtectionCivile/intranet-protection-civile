<?php
	if (isset($_POST['roleID'])){
		$roleID = str_replace("'","", $_POST['roleID']);
		if($roleID == ""){
			$genericError = "Impossible de mettre à jour un rôle inconnu";
		}
		else{
			$check_query = "SELECT ID FROM $tablename_roles WHERE ID='$roleID'" or die("Erreur lors de la consultation" . mysqli_error($db_link));
			$verif = mysqli_query($db_link, $check_query);
			$row_verif = mysqli_fetch_assoc($verif);
			$role = mysqli_num_rows($verif);
			if (!$role){
				$genericError = "Le rôle en question n'existe pas";
			}
			else {
				$role_title=$rbac->Roles->getTitle($roleID);
				$role_description=$rbac->Roles->getDescription($roleID);
				if ($rbac->Users->hasRole($role_title, $userID)) {
					$isDone = $rbac->Users->unassign($role_title, $userID);
				}
				else {
					$isDone = $rbac->Users->assign($role_title, $userID);
				}
				if (!$isDone){
					$genericError = "Echec de la mise à jour ('".htmlentities($role_description)."')";
				}
				else {
					$genericSuccess = "L'utilisateur a été mis à jour avec le rôle '".htmlentities($role_description)."'";
				}
			}
		}
	}
?>
