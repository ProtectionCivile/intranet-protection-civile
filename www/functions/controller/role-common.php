<?php
	$id = $_POST['id'];

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	}

	if($id == ""){
		$genericError = "Aucun rôle défini";
	}
	else {
		$check_query = "SELECT * FROM $tablename_roles WHERE ID='$id'" or die("Erreur lors de la consultation" . mysqli_error($db_link));
		$verif = mysqli_query($db_link, $check_query);
		$row_verif = mysqli_fetch_assoc($verif);
		$role = mysqli_num_rows($verif);
		if (!$role){
			$genericError = "Le rôle en question n'existe pas";
		}
	}

	if(empty($genericError)) {
		$role_title=$rbac->Roles->getTitle($id);
		$role_description=$rbac->Roles->getDescription($id);
		$role_phone=$row_verif['Phone'];
		$role_email=$row_verif['Mail'];
		$attached_section=$row_verif['Affiliation'];
		$role_callsign=$row_verif['Callsign'];
		$role_directory=$row_verif['Directory'];
		$role_assignable=$row_verif['Assignable'];
		$role_tags=$row_verif['Tags'];
		$role_hierarchy=$row_verif['Hierarchy'];
	}
?>
