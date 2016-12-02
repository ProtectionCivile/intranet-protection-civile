<?php
	if (isset($_POST['permissionID'])){
		$permissionID = str_replace("'","", $_POST['permissionID']);
		if($permissionID == ""){
			$genericError = "Impossible de mettre à jour une permission inconnue";
		}
		else{
			$check_query = "SELECT ID FROM rbac_permissions WHERE ID='$permissionID'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
			$verif = mysqli_query($link, $check_query);
			$row_verif = mysqli_fetch_assoc($verif);
			$permission = mysqli_num_rows($verif);		
			if (!$permission){
				$genericError = "La permission en question n'existe pas";
			}
			else {
				$permissionTitle=utf8_encode($rbac->Permissions->getTitle($permissionID));
				$permissionDescription=utf8_encode($rbac->Permissions->getDescription($permissionID));
				$check_query = "SELECT ID, Title FROM rbac_roles WHERE ID='$roleID'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
				$verif = mysqli_query($link, $check_query);
				$roleParams = mysqli_fetch_assoc($verif);
				$role = mysqli_num_rows($verif);		
				if (!$role){
					$genericError = "Le rôle en question n'existe pas";
				}
				else {
					if ($rbac->Roles->hasPermission($roleID, $permissionID)) {
						$isDone = $rbac->Roles->unassign(utf8_decode($roleTitle), utf8_decode($permissionTitle);
					}
					else {
						$isDone = $rbac->Roles->assign(utf8_decode($roleTitle), utf8_decode($permissionTitle);
					}
					if (!$isDone){
						$genericError = "Echec de la mise à jour ('".$permissionTitle."')";
					}
					else {
						$genericSuccess = "Rôle '".$roleParams['Title']."' mis à jour avec la permission '".$permissionTitle."'";	
					}
				}
			}
		}
	}
?>