<?php 
	$permissionID = str_replace("'","", $_POST['permissionID']);

	if($permissionID == ""){
		$genericError = "Aucune permission définie";
	}
	else {
		$check_query = "SELECT ID FROM $tablename_permissions WHERE ID='$permissionID'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
		$verif = mysqli_query($link, $check_query);
		$row_verif = mysqli_fetch_assoc($verif);
		$permission = mysqli_num_rows($verif);		
		if (!$permission){
			$genericError = "La permission en question n'existe pas";
		}
	}
	
	if(empty($genericError)) {
		$permissionTitle=utf8_encode($rbac->Permissions->getTitle($permissionID));
	}
?>