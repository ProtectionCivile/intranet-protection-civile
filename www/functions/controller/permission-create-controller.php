<!-- Create a new permission by title : Controller -->
<?php

	//Authentication
	$rbac->enforce("admin-permissions-update", $currentUserID);

	if (isset($_POST['addPermission'])){
		$permission_title = str_replace("'","", $_POST['permission_title']);
		$permission_description = str_replace("'","", $_POST['permission_description']);

		$missingValues = 0;

		if(isNullOrEmpty($permission_title)){
			$missingValues++;
			$permission_title_error = "Le nom de la permission est obligatoire";
		}
		if(isNullOrEmpty($permission_description)){
			$missingValues++;
			$permission_description_error = "La description de la permission est obligatoire";
		}

		if ($missingValues != "0" ) {
			if (!isNullOrEmpty($genericError)){
				$genericError = $genericError.'<br />';
			}
				$genericError = $genericError.'Il y a '.$missingValues.' champs non-renseignés';
		}

		if (empty($genericError)){
			$check_query = "SELECT ID FROM $tablename_permissions WHERE Title='$permission_title'" or die("Erreur lors de la consultation" . mysqli_error($db_link));
			$verif = mysqli_query($db_link, $check_query);
			$row_verif = mysqli_fetch_assoc($verif);
			$permission = mysqli_num_rows($verif);
			if ($permission){
				$genericError = "Une permission du même titre existe déjà";
				$permission_title_error = "Une permission du même titre existe déjà";
			}
			else {
				$perm_id = $rbac->Permissions->add($permission_title, $permission_description);
				if (!isset($perm_id) || $perm_id==-1){
					$genericError = "Echec de la création (ID=".$perm_id.")";
				}
				else {
					$genericSuccess = "Permission correctement ajoutée : ".$permission_title." (ID=".$perm_id.")";
				}
			}
		}
	}
?>


<!-- Create a new permission by path : Controller -->
<?php
	if (isset($_POST['addPermissionPath'])){
		$path = str_replace("'","", $_POST['permission_title_path']);
		$descriptions = str_replace("'","", $_POST['permission_description_path']);
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
