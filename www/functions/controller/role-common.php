<?php 
	$roleID = str_replace("'","", $_POST['roleID']);

	if($roleID == ""){
		$genericError = "Aucun rôle défini";
	}
	else {
		$check_query = "SELECT ID FROM rbac_roles WHERE ID='$roleID'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
		$verif = mysqli_query($link, $check_query);
		$row_verif = mysqli_fetch_assoc($verif);
		$role = mysqli_num_rows($verif);		
		if (!$role){
			$genericError = "Le rôle en question n'existe pas";
		}
	}
	
	if(empty($genericError)) {
		$roleTitle=utf8_encode($rbac->Roles->getTitle($roleID));
		$roleDescription=utf8_encode($rbac->Roles->getDescription($roleID));
	}
?>