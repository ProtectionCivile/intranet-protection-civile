<?php

	$undeletablePermissions=array("admin-permissions-view", "admin-permissions-update", "admin-roles-view", "admin-roles-update");

	if (isset($_POST['delPermission'])){
		$id = str_replace("'","", $_POST['delPermission']);
		if($id == ""){
			$genericError = "Impossible de supprimer une permission inconnue";
		}
		else{
			$check_query = "SELECT ID, Title FROM $tablename_permissions WHERE ID='$id'" or die("Erreur lors de la consultation" . mysqli_error($db_link)); 
			$verif = mysqli_query($db_link, $check_query);
			$row_verif = mysqli_fetch_assoc($verif);
			$permission = mysqli_num_rows($verif);		
			if (!$permission){
				$genericError = "La permission en question n'existe pas";
			}
			else {
				$permissionTitle = utf8_encode($rbac->Permissions->getTitle($id));
				if (in_array($permissionTitle, $undeletablePermissions)) { 
					$genericError = "Il est interdit de supprimer la permission '".$permissionTitle."'";
				}
				else {
					$perm_id = $rbac->Permissions->remove($id, true);
					if (!$perm_id){
						$genericError = "Echec de la suppression (ID=".$id.")";
					}
					else {
						$genericSuccess = "Permission correctement supprimée (".$permissionTitle.")";	
					}
				}
			}
		}
	}
?>