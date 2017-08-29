<?php
	require_once('functions/str.php');

	//Authentication
	require_once('functions/user/user-update-authentication.php');


if (isset($_POST['updateUser'])) {
	$user_login = $_POST['user_login'];
	$user_lastName = mb_strtolower($_POST['user_lastName']);
	$lastNameDB = str_replace(" ","-", $user_lastName);
	$user_firstName = mb_strtolower($_POST['user_firstName']);
	$firstNameDB = str_replace(" ","-", $user_firstName);
	$pass1 = $_POST['user_password1'];
	$pass2 = $_POST['user_password2'];
	$passDB = password_hash($passwordFromPost, PASSWORD_BCRYPT, ['cost' => 9,]);
	$user_phone = $_POST['user_phone'];
	$user_email = $_POST['user_email'];
	$user_section = $_POST['attached_section'];

	$missingValues = 0;

	if(isNullOrEmpty($user_login)){
		$missingValues++;
		$user_login_error = "Le matricule e-Protec est obligatoire";
	}
	if(isNullOrEmpty($user_lastName)){
		$missingValues++;
		$user_lastName_error = "Le nom de famille est obligatoire";
	}
	if(isNullOrEmpty($user_phone)){
		$missingValues++;
		$user_phone_error = "Le téléphone est obligatoire";
	}
	if(isNullOrEmpty($user_email)){
		$user_email = suppr_accents($firstNameDB.".".$lastNameDB)."@protectioncivile92.org";
	}
	if(isNullOrEmpty($pass1)){
		$missingValues++;
		$user_password_error = "Le mot de passe est obligatoire";
	}
	if($pass1 !== $pass2){
		$createErrorPassword = "Les deux mots de passe ne concordent pas";
	}
	if(isNullOrEmpty($user_section)){
		$missingValues++;
		$genericError = "L'antenne de rattachement est obligatoire";
	}

	if ($missingValues != "0" ) {
		if (!isNullOrEmpty($genericError)){
			$genericError = $genericError.'<br />';
		}
			$genericError = $genericError.'Il y a '.$missingValues.' champs non-renseignés';
	}

	if (empty($genericError)){
		$db_lastname = mysqli_real_escape_string($db_link, $user_lastName);
		$db_firstname = mysqli_real_escape_string($db_link, $user_firstName);
		$db_phone = mysqli_real_escape_string($db_link, $user_phone);
		$db_email = mysqli_real_escape_string($db_link, $user_email);
		$db_section= mysqli_real_escape_string($db_link, $user_section);
		$db_login = mysqli_real_escape_string($db_link, $user_login);
		$db_pass = mysqli_real_escape_string($db_link, $user_password);
		$sql = "UPDATE $tablename_users SET login='$db_login', last_name='$db_lastname', first_name='$db_firstname', phone='$db_phone', pass='$db_pass', mail='$db_email', attached_section='$db_section' WHERE ID='$id'";
		if ($db_link->query($sql) === TRUE) {
				$genericSuccess = "Utilisateur mis à jour (".$user_lastName." ".$user_firstName.")";
		} else {
				$genericError = "Utilisateur non mis à jour: " . $db_link->error;
		}
	}
}
?>
