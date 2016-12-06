<?php 
	$userID = str_replace("'","", $_POST['userID']);

	if($userID == ""){
		$commonError = "Aucun utilisateur défini";
	}
	else {
		$check_query = "SELECT ID, last_name, first_name, mail, phone, attached_section, pass FROM users WHERE ID='$userID'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
		$verif = mysqli_query($link, $check_query);
		$user = mysqli_fetch_assoc($verif);
	 	$userCount = mysqli_num_rows($verif);		
		if (!$userCount){
			$commonError = "Le user en question n'existe pas";
		}
	}
	
	if(!empty($commonError)) {
		echo "<div class='alert alert-danger'><strong>Erreur</strong> : ".$commonError."</div>";
	}
	else {
		$userFirstName=$user["first_name"];
		$userLastName=$user["last_name"];
		$usersection=$user["attached_section"];
	}
		
?>