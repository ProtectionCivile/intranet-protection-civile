<?php

	//Authentication
	$rbac->enforce("admin-roles-update", $currentUserID);

	if (isset($_POST['updateRole'])) {
		$role_title = $_POST['role_title'];
		$role_description = $_POST['role_description'];
		$role_phone = $_POST['role_phone'];
		$role_email = $_POST['role_email'];
		$attached_section = $_POST['attached_section'];
		$role_callsign = $_POST['role_callsign'];
		$role_directory = $_POST['role_directory'];
		$role_assignable = $_POST['role_assignable'];
		$role_tags = $_POST['role_tags'];
		$role_hierarchy = $_POST['role_hierarchy'];

		$missingValues = 0;

		if(isNullOrEmpty($role_title)){
			$missingValues++;
			$role_title_error = "Le nom du rôle est obligatoire";
		}
		if(isNullOrEmpty($role_description)){
			$missingValues++;
			$role_description_error = "La description du rôle est obligatoire";
		}
		if(isNullOrEmpty($attached_section)){
			$missingValues++;
			$genericError = "L'antenne de rattachement du rôle est obligatoire";
		}

		if ($missingValues != "0" ) {
			if (!isNullOrEmpty($genericError)){
				$genericError = $genericError.'<br />';
			}
				$genericError = $genericError.'Il y a '.$missingValues.' champs non-renseignés';
		}

		$check_query = "SELECT ID FROM $tablename_roles WHERE Title='$role_title'" or die("Erreur lors de la consultation" . mysqli_error($db_link));
		$verif = mysqli_query($db_link, $check_query);
		$row_verif = mysqli_fetch_assoc($verif);
		$role = mysqli_num_rows($verif);
		if ($role){
			$genericError = "Un rôle du même titre existe déjà (".$role_title.")";
			$role_title_error = "Un rôle du même titre existe déjà (".$role_title.")";
		}

		else if (in_array($role_title, $undeletableRoles)) {
			$genericError = "Il est interdit de mettre à jour le rôle '".$role_title."'";
			$role_title_error = "Il est interdit de mettre à jour le rôle '".$role_title."'";
		}

		if (empty($genericError)){
			$sql = "UPDATE $tablename_roles SET
			Title='".mysqli_real_escape_string($db_link, $role_title)."',
			Description='".mysqli_real_escape_string($db_link, $role_description)."',
			Affiliation='$attached_section',
			Directory='".mysqli_real_escape_string($db_link, $role_directory)."',
			Callsign='".mysqli_real_escape_string($db_link, $role_callsign)."',
			Assignable='".mysqli_real_escape_string($db_link, $role_assignable)."',
			Phone='".mysqli_real_escape_string($db_link, $role_phone)."',
			Tags='".mysqli_real_escape_string($db_link, $role_tags)."',
			Hierarchy='".mysqli_real_escape_string($db_link, $role_hierarchy)."',
			Mail='".mysqli_real_escape_string($db_link, $role_email)."'
			WHERE ID='$id'" or die("Impossible d'ajouter le rôle dans la base de données" . mysqli_error($db_link));
			if ($db_link->query($sql) === TRUE) {
				$genericSuccess = "Rôle mis à jour (".$role_title.")";
			} else {
				$genericError = "Rôle non mis à jour: " . $db_link->error;
			}
		}
	}
?>
