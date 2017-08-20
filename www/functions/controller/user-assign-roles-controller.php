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
				$roleTitle=$rbac->Roles->getTitle($roleID);
				$roleDescription=$rbac->Roles->getDescription($roleID);
				if ($rbac->Users->hasRole($roleTitle, $userID)) {
					$isDone = $rbac->Users->unassign($roleTitle, $userID);
				}
				else {
					$isDone = $rbac->Users->assign($roleTitle, $userID);
				}
				if (!$isDone){
					$genericError = "Echec de la mise à jour ('".$roleDescription."')";
				}
				else {
					$genericSuccess = "L'utilisateur a été mis à jour avec le rôle '".$roleDescription."'";
				}
			}
		}
	}
?>
