<?php
	//Authentication
	$rbac->enforce("admin-permissions-update", $currentUserID);

	if (isset($_POST['updatePermission'])) {

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
				$genericError = "Une permission du même titre existe déjà (".htmlentities($permission_title).")";
				$permission_title_error = "Une permission du même titre existe déjà (".htmlentities($permission_title).")";
			}

			else if (in_array($permission_title, $undeletablePermissions)) {
				$genericError = "Il est interdit de mettre à jour la permission '".htmlentities($permission_title)."'";
				$permission_title_error = "Il est interdit de mettre à jour la permission '".htmlentities($permission_title)."'";
			}
			else {
				$perm_id = $rbac->Permissions->edit($id, $permission_title, $permission_description);
				if (!$perm_id){
					$genericError = "Echec de la mise à jour (ID=".$id.")";
				}
				else {
					$genericSuccess = "Permission mise à jour (".htmlentities($permission_title).")";
				}
			}
		}
	}
?>
