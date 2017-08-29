<?php
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	}
	// else if (isset($_GET['id'])) {
	// 	$id = str_replace("'","", $_GET['id']);
	// }

	if($id == ""){
		$genericError = "Aucun utilisateur défini";
	}
	else {
		$sql = "SELECT ID, login, last_name, first_name, mail, phone, attached_section, pass FROM $tablename_users WHERE ID='$id'" or die("Erreur lors de la consultation" . mysqli_error($db_link));
		$query = mysqli_query($db_link, $sql);
		$user = mysqli_fetch_assoc($query);
	 	$userCount = mysqli_num_rows($query);
		if (!$userCount){
			$genericError = "L'utilisateur en question n'existe pas";
		}
	}

	if(empty($genericError)) {
		$user_firstName=$user["first_name"];
		$user_lastName=$user["last_name"];
		$user_login=$user["login"];
		$user_phone=$user["phone"];
		$user_email=$user["mail"];
		$user_section=$user["attached_section"];
	}

?>
