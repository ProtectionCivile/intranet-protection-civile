<?php
	//Authentication 
	$rbac->enforce("admin-permissions-update", $currentUserID);

	if (isset($_POST['inputPermissionTitle'])) {
		$title=$_POST['inputPermissionTitle'];
	}
	else {
		$title=utf8_encode($rbac->Permissions->getTitle($permissionID));
	}
	if (isset($_POST['inputPermissionDescription'])) {
		$description=$_POST['inputPermissionDescription'];
	}
	else {
		$description=utf8_encode($rbac->Permissions->getDescription($permissionID));
	}
	if (isset($_POST['updatePermission'])) {	
		$check_query = "SELECT ID FROM $tablename_permissions WHERE Title='$title'" or die("Erreur lors de la consultation" . mysqli_error($db_link)); 
		$verif = mysqli_query($db_link, $check_query);
		$row_verif = mysqli_fetch_assoc($verif);
		$permission = mysqli_num_rows($verif);		
		if ($permission){
			$genericError = "Une permission du même titre existe déjà (".$title.")";
			$updateErrorTitle = "Une permission du même titre existe déjà (".$title.")";
		}
		
		else if (in_array($title, $undeletablePermissions)) { 
			$genericError = "Il est interdit de mettre à jour la permission '".$title."'";
			$updateErrorTitle = "Il est interdit de mettre à jour la permission '".$title."'";
		}
		else {
			$perm_id = $rbac->Permissions->edit($permissionID, utf8_decode($title), utf8_decode($description));
			if (!$perm_id){
				$genericError = "Echec de la mise à jour (ID=".$permissionID.")";
			}
			else {
				$genericSuccess = "Permission mise à jour (".$title.")";	
			}
		}
	}
?>