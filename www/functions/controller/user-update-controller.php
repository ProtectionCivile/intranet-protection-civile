<?php
	require_once('functions/str.php');

	//Authentication 
	$rbac->enforce("admin-users-update", $currentUserID);


	if (empty($genericError)){

		if (isset($_POST['inputUserLogin'])) {
			$login=strtolower(str_replace("'","", $_POST['inputUserLogin']));
		}
		else {
			$login=$user["login"];
		}
		if (isset($_POST['inputUserLastName'])) {
			$lastName=strtolower(str_replace("'","", $_POST['inputUserLastName']));
			$lastNameDB = strtolower(str_replace(" ","-", $lastName));
		}
		else {
			$lastName=$user["last_name"];
		}
		if (isset($_POST['inputUserFirstName'])) {
			$firstName=strtolower(str_replace("'","", $_POST['inputUserFirstName']));
			$firstNameDB = strtolower(str_replace(" ","-", $firstName));
		}
		else {
			$firstName=$user["first_name"];
		}
		if (isset($_POST['inputUserPhone'])) {
			$phone=str_replace("'","", $_POST['inputUserPhone']);
		}
		else {
			$phone=$user["phone"];
		}
		if (isset($_POST['inputUserSection'])) {
			$section=str_replace("'","", $_POST['inputUserSection']);
		}
		else {
			$section=$user["attached_section"];
		}
		if (isset($_POST['inputUserPassword1']) && $_POST['inputUserPassword1'] != "") {
			$password = password_hash($_POST['inputUserPassword1'], PASSWORD_BCRYPT, ['cost' => 9,]);
		}
		else {
			$password=$user["pass"];
		}

		$mail = suppr_accents($firstNameDB.".".$lastNameDB)."@protectioncivile92.org";
		

		if (isset($_POST['updateUser'])) {		
			$sql = "UPDATE users SET login='$login', last_name='$lastName', first_name='$firstName', phone='$phone', pass='$password', login='$login', mail='$mail', attached_section='$section' WHERE ID='$userID'";
			if ($link->query($sql) === TRUE) {
			    $genericSuccess = "Utilisateur mis à jour (".$lastName." ".$firstName.")";
			} else {
			    $genericError = "Utilisateur non mis à jour: " . $link->error;
			}
		}
	}
?>