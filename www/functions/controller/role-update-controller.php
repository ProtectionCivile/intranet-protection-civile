<?php
	if (isset($_POST['inputRoleTitle'])) {
		$title=$_POST['inputRoleTitle'];
	}
	else {
		$title=$rbac->Roles->getTitle($roleID);
	}
	if (isset($_POST['inputRoleDescription'])) {
		$description=$_POST['inputRoleDescription'];
	}
	else {
		$description=$rbac->Roles->getDescription($roleID);
	}
	
	if (isset($_POST['updateRole'])) {	

		$check_query = "SELECT ID FROM rbac_roles WHERE Title='$title'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
		$verif = mysqli_query($link, $check_query);
		$row_verif = mysqli_fetch_assoc($verif);
		$role = mysqli_num_rows($verif);		
		if ($role){
			$genericError = "Un rôle du même titre existe déjà (".$title.")";
			$updateErrorTitle = "Un rôle du même titre existe déjà (".$title.")";
		}
		
		else if (in_array($title, $undeletableRoles)) { 
			$genericError = "Il est interdit de mettre à jour le rôle '".$title."'";
			$updateErrorTitle = "Il est interdit de mettre à jour le rôle '".$title."'";
		}
		else {
			//$perm_id = $rbac->Roles->edit($roleID, $title, $description);

			// Next part is super crade. To be changed ASAP
			if (isset($_POST['inputRoleAffiliation']) && $_POST['inputRoleAffiliation'] != "") {
				$check_query = "UPDATE rbac_roles SET `Affiliation`=".$_POST['inputRoleAffiliation']." WHERE ID=".$roleID or die("Erreur lors de la consultation" . mysqli_error($link)); 
				$exec = mysqli_query($link, $check_query);
			}
			if (isset($_POST['inputRolePhone']) && $_POST['inputRolePhone'] != "") {
				$check_query = "UPDATE rbac_roles SET `Phone`='".$_POST['inputRolePhone']."' WHERE ID=".$roleID or die("Erreur lors de la consultation" . mysqli_error($link)); 
				$exec = mysqli_query($link, $check_query);
			}
			if (isset($_POST['inputRoleMail']) && $_POST['inputRoleMail'] != "") {
				$check_query = "UPDATE rbac_roles SET `Mail`='".$_POST['inputRoleMail']."' WHERE ID=".$roleID or die("Erreur lors de la consultation" . mysqli_error($link)); 
				$exec = mysqli_query($link, $check_query);
			}
			if (isset($_POST['inputRoleCallsign']) && $_POST['inputRoleCallsign'] != "") {
				$check_query = "UPDATE rbac_roles SET `Callsign`='".$_POST['inputRoleCallsign']."' WHERE ID=".$roleID or die("Erreur lors de la consultation" . mysqli_error($link)); 
				$exec = mysqli_query($link, $check_query);
			}
			if (isset($_POST['inputRoleAssignable'])) {
				$check_query = "UPDATE rbac_roles SET `Assignable`='1' WHERE ID=".$roleID or die("Erreur lors de la consultation" . mysqli_error($link)); 
				$exec = mysqli_query($link, $check_query);
			}
			else {
				$check_query = "UPDATE rbac_roles SET `Assignable`='0' WHERE ID=".$roleID or die("Erreur lors de la consultation" . mysqli_error($link)); 
				$exec = mysqli_query($link, $check_query);
			}
			if (isset($_POST['inputRoleDirectory'])) {
				$check_query = "UPDATE rbac_roles SET `Directory`='1' WHERE ID=".$roleID or die("Erreur lors de la consultation" . mysqli_error($link)); 
				$exec = mysqli_query($link, $check_query);
			}
			else {
				$check_query = "UPDATE rbac_roles SET `Directory`='0' WHERE ID=".$roleID or die("Erreur lors de la consultation" . mysqli_error($link)); 
				$exec = mysqli_query($link, $check_query);
			}
			if (isset($_POST['inputRoleTitle'])) {
				$check_query = "UPDATE rbac_roles SET `Titre`='".$title."' WHERE ID=".$roleID or die("Erreur lors de la consultation" . mysqli_error($link)); 
				$exec = mysqli_query($link, $check_query);
			}
			if (isset($_POST['inputRoleDescription'])) {
				$check_query = "UPDATE rbac_roles SET `Description`='".$description."' WHERE ID=".$roleID or die("Erreur lors de la consultation" . mysqli_error($link)); 
				$exec = mysqli_query($link, $check_query);
			}
				
			$genericSuccess = "Rôle mis à jour (".$title.")";	
		}
	}

	$query = "SELECT * FROM rbac_roles WHERE ID='".$roleID."'";
	$query_result = mysqli_query($link, $query);
	$r = mysqli_fetch_array($query_result);
?>