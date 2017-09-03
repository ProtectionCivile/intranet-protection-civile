<?php
	$id = $_POST['id'];

	if($id == ""){
		$genericError = "Aucune permission définie";
	}
	else {
		$check_query = "SELECT ID FROM $tablename_permissions WHERE ID='$id'" or die("Erreur lors de la consultation" . mysqli_error($db_link));
		$verif = mysqli_query($db_link, $check_query);
		$row_verif = mysqli_fetch_assoc($verif);
		$permission = mysqli_num_rows($verif);
		if (!$permission){
			$genericError = "La permission en question n'existe pas";
		}
	}

	if(empty($genericError)) {
		$permission_title=$rbac->Permissions->getTitle($id);
		$permission_description=$rbac->Permissions->getDescription($id);
	}
?>
