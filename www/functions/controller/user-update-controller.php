<?php
	require_once('functions/str.php');

	//Authentication 
	$rbac->enforce("admin-users-update", $currentUserID);


	if (empty($commonError)){

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
		if (isset($_POST['inputUserPassword1'])) {
			$password=sha1(str_replace("'","", $_POST['inputUserPassword1']));
		}
		else {
			$password=$user["pass"];
		}

		$login = suppr_accents($firstNameDB.".".$lastNameDB);
		$mail = $login."@protectioncivile92.org";
		

		if (isset($_POST['updateUser'])) {		
			$sql = "UPDATE users SET last_name='$lastName', first_name='$firstName', phone='$phone', pass='$password', login='$login', mail='$mail', attached_section='$section' WHERE ID='$userID'";
			if ($link->query($sql) === TRUE) {
			    $genericSuccess = "Utilisateur mis à jour (".$lastName." ".$firstName.")";
			} else {
			    $genericError = "Utilisateur non mis à jour: " . $link->error;
			}
		}
	}
?>