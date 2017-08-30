<?php

	// Authentication
	$rbac->enforce("admin-roles-update", $currentUserID);

	if (isset($_POST['addRole'])) {
		$role_title = $_POST['role_title'];
		$role_description = $_POST['role_description'];

		$missingValues = 0;

		if(isNullOrEmpty($role_title)){
			$missingValues++;
			$role_title_error = "Le nom du rôle est obligatoire";
		}
		if(isNullOrEmpty($role_description)){
			$missingValues++;
			$role_description_error = "La description du rôle est obligatoire";
		}

		if ($missingValues != "0" ) {
			if (!isNullOrEmpty($genericError)){
				$genericError = $genericError.'<br />';
			}
				$genericError = $genericError.'Il y a '.$missingValues.' champs non-renseignés';
		}

		if (empty($genericError)){
			$check_query = "SELECT ID FROM $tablename_roles WHERE Title='$role_title'" or die("Erreur lors de la consultation" . mysqli_error($db_link));
			$verif = mysqli_query($db_link, $check_query);
			$row_verif = mysqli_fetch_assoc($verif);
			$role = mysqli_num_rows($verif);
			if ($role){
				$genericError = "Un rôle du même titre existe déjà";
				$role_title_error = "Un rôle du même titre existe déjà";
			}
			else {
				$id = $rbac->Roles->add($role_title, $role_description);
				if (!isset($id) || $id==-1){
					$genericError = "Echec de la création (ID=".$id.")";
				}
				else {
					$genericSuccess = "Rôle correctement ajouté : ".htmlentities($role_title)." (ID=".$id.")";
				}
			}
		}
	}
?>
