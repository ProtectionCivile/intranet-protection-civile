<?php
	if (isset($_POST['permissionID'])){
		$permissionID = str_replace("'","", $_POST['permissionID']);
		if($permissionID == ""){
			$genericError = "Impossible de mettre à jour une permission inconnue";
		}
		else{
			$check_query = "SELECT ID FROM $tablename_permissions WHERE ID='$permissionID'" or die("Erreur lors de la consultation" . mysqli_error($db_link));
			$verif = mysqli_query($db_link, $check_query);
			$row_verif = mysqli_fetch_assoc($verif);
			$permission = mysqli_num_rows($verif);
			if (!$permission){
				$genericError = "La permission en question n'existe pas";
			}
			else {
				$permission_title=$rbac->Permissions->getTitle($permissionID);
				$permission_description=$rbac->Permissions->getDescription($permissionID);
				$check_query = "SELECT ID, Title FROM $tablename_roles WHERE ID='$id'" or die("Erreur lors de la consultation" . mysqli_error($db_link));
				$verif = mysqli_query($db_link, $check_query);
				$roleParams = mysqli_fetch_assoc($verif);
				$role = mysqli_num_rows($verif);
				if (!$role){
					$genericError = "Le rôle en question n'existe pas";
				}
				else {
					if ($rbac->Roles->hasPermission($id, $permissionID)) {
						$isDone = $rbac->Roles->unassign($role_title, $permission_title);
					}
					else {
						$isDone = $rbac->Roles->assign($role_title, $permission_title);
					}
					if (!$isDone){
						$genericError = "Echec de la mise à jour ('".htmlentities($permission_title)."')";
					}
					else {
						$genericSuccess = "Rôle '".$roleParams['Title']."' mis à jour avec la permission '".htmlentities($permission_title)."'";
					}
				}
			}
		}
	}
?>
