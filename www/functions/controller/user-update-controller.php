<?php
	require_once('functions/str.php');

	//Authentication
	require_once('functions/user/user-update-authentication.php');


if (isset($_POST['updateUser']) || isset($_POST['updatePassword'])) {
	$missingValues = 0;

	if (isset($_POST['updateUser']) ) {
		$user_login = $_POST['user_login'];
		$user_lastName = mb_strtolower($_POST['user_lastName']);
		$lastNameDB = str_replace(" ","-", $user_lastName);
		$user_firstName = mb_strtolower($_POST['user_firstName']);
		$firstNameDB = str_replace(" ","-", $user_firstName);
		$user_phone = $_POST['user_phone'];
		$user_email = $_POST['user_email'];
		$user_section = $_POST['attached_section'];

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
		if(isNullOrEmpty($user_section)){
			$missingValues++;
			$genericError = "L'antenne de rattachement est obligatoire";
		}
	}

	if (isset($_POST['updatePassword']) ) {
		$user_pass1 = $_POST['user_password1'];
		$user_pass2 = $_POST['user_password2'];
		$pass_encrypted = password_hash($user_pass1, PASSWORD_BCRYPT, ['cost' => 9,]);
		$changePassword = true;

		if(isNullOrEmpty($user_pass1)){
			// C'est pas grave
			$changePassword = false;
		}
		if($user_pass1 !== $user_pass2){
			$genericError = "Les deux mots de passe ne concordent pas";
			$changePassword = false;
		}
	}

	if ($missingValues != "0" ) {
		if (!isNullOrEmpty($genericError)){
			$genericError = $genericError.'<br />';
		}
			$genericError = $genericError.'Il y a '.$missingValues.' champs non-renseignés';
	}

	if (empty($genericError)){
		if (isset($_POST['updateUser']) ) {
			$db_lastname = mysqli_real_escape_string($db_link, $user_lastName);
			$db_firstname = mysqli_real_escape_string($db_link, $user_firstName);
			$db_phone = mysqli_real_escape_string($db_link, $user_phone);
			$db_email = mysqli_real_escape_string($db_link, $user_email);
			$db_section= mysqli_real_escape_string($db_link, $user_section);
			$db_login = mysqli_real_escape_string($db_link, $user_login);
			$sql = "UPDATE $tablename_users SET login='$db_login', last_name='$db_lastname', first_name='$db_firstname', phone='$db_phone', mail='$db_email', attached_section='$db_section' WHERE ID='$id'";
			if ($db_link->query($sql) === TRUE) {
					$genericSuccess = "Utilisateur mis à jour (".htmlentities($user_lastName)." ".htmlentities($user_firstName).")";
			} else {
					$genericError = "Utilisateur non mis à jour: " . $db_link->error;
			}
		}

		if ($changePassword) {
			$db_pass = mysqli_real_escape_string($db_link, $pass_encrypted);
			$sql = "UPDATE $tablename_users SET pass='$db_pass' WHERE ID='$id'";
			if ($db_link->query($sql) === TRUE) {
					$genericSuccess .= ". Mot de passe mis à jour";
			} else {
					$genericError .= " Erreur pendant la mise à jour du mot de passe: " . $db_link->error;
			}
		}
	}
}
?>
