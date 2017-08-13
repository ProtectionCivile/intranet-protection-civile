<!-- Create a new permission by title : Controller -->
<?php

	//Authentication
	$rbac->enforce("admin-permissions-update", $currentUserID);

	if (isset($_POST['addPermission'])){
		$title = str_replace("'","", $_POST['inputPermissionTitle']);
		$description = str_replace("'","", $_POST['inputPermissionDescription']);
		if($title == ""){
			$genericError = "Le titre de la permission est obligatoire";
			$createErrorTitle = "Le titre de la permission est obligatoire";
		}
		if($description == ""){
			$genericError = "La description de la permission est obligatoire";
			$createErrorDesc = "La description de la permission est obligatoire";
		}
		else {
			$check_query = "SELECT ID FROM $tablename_permissions WHERE Title='$title'" or die("Erreur lors de la consultation" . mysqli_error($db_link));
			$verif = mysqli_query($db_link, $check_query);
			$row_verif = mysqli_fetch_assoc($verif);
			$permission = mysqli_num_rows($verif);
			if ($permission){
				$genericError = "Une permission du même titre existe déjà";
				$createErrorTitle = "Une permission du même titre existe déjà";
			}
			else {
				$perm_id = $rbac->Permissions->add($title, $description);
				if (!isset($perm_id) || $perm_id==-1){
					$genericError = "Echec de la création (ID=".$perm_id.")";
				}
				else {
					$genericSuccess = "Permission correctement ajoutée : ".$title." (ID=".$perm_id.")";
				}
			}
		}
	}
?>


<!-- Create a new permission by path : Controller -->
<?php
	if (isset($_POST['addPermissionPath'])){
		$path = str_replace("'","", $_POST['inputPermissionPath']);
		$descriptions = str_replace("'","", $_POST['inputPermissionDescriptions']);
		if($path == ""){
			$genericError = "Le titre de la permission est obligatoire";
			$createErrorTitle = "Le titre de la permission est obligatoire";
		}
		else {
			$perm_id = $rbac->Permissions->addPath("/".$path, explode("/", $descriptions));
			if (!isset($perm_id) || $perm_id==-1){
				$genericError = "Echec de la création (ID=".$perm_id.")";
			}
			else {
				$genericSuccess = "Permissions correctement ajoutées : ".$path." (ID=".$perm_id.")";
			}
		}
	}
?>
