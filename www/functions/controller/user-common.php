<?php
	$userID = str_replace("'","", $_POST['userID']);

	if($userID == ""){
		$genericError = "Aucun utilisateur défini";
	}
	else {
		$check_query = "SELECT ID, login, last_name, first_name, mail, phone, attached_section, pass FROM $tablename_users WHERE ID='$userID'" or die("Erreur lors de la consultation" . mysqli_error($db_link));
		$verif = mysqli_query($db_link, $check_query);
		$user = mysqli_fetch_assoc($verif);
	 	$userCount = mysqli_num_rows($verif);
		if (!$userCount){
			$genericError = "L'utilisateur en question n'existe pas";
		}
	}

	if(empty($genericError)) {
		$userFirstName=$user["first_name"];
		$login=$user["login"];
		$userLastName=$user["last_name"];
		$usersection=$user["attached_section"];
	}

?>
