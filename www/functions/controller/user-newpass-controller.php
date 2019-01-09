<?php
require_once('functions/mail/Mail.php');

	if (isset($_POST['PassUser'])){
		$newpassID = $_POST['PassUser'];
		if($newpassID == ""){
			$genericError = "Impossible de réinitialiser le mot de passe de l'utilisateur inconnu";
		}
		else{
			$check_query = "SELECT ID, login FROM $tablename_users WHERE ID='$newpassID'" or die("Erreur lors de la consultation" . mysqli_error($db_link));
			$verif = mysqli_query($db_link, $check_query);
			$newpassUser = mysqli_fetch_assoc($verif);
			if (!$newpassUser){
				$genericError = "L'utilisateur en question n'existe pas";
			}
			else {
				function random_password( $length = 8 ) {
					$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
					$password = substr( str_shuffle( $chars ), 0, $length );
					return $password;}
				$newautopass = random_password(8);

				
				$pass_encrypted = password_hash($newautopass, PASSWORD_BCRYPT, ['cost' => 9,]);
				$db_pass = mysqli_real_escape_string($db_link, $pass_encrypted);
				$sql = "UPDATE $tablename_users SET pass='$db_pass' WHERE ID='$id'";
				if ($db_link->query($sql) === TRUE) {
					$genericSuccess .= "Mot de passe mis à jour";
				} else {
					$genericError .= " Erreur pendant la mise à jour du mot de passe: " . $db_link->error;
				}
				
				$sql2 = "SELECT * FROM $tablename_users WHERE id='$newpassID'" or die("Erreur lors de la consultation" . mysqli_error($db_link));
				$query = mysqli_query($db_link, $sql2);
				$users = mysqli_fetch_assoc($query);
				$usermail= $users['mail'];
				
				$from="noreply@protectioncivile92.org";
				$subject="[EXTRANET] Nouveau de passe";
				$message = "Bonjour,<br />
				<br />
				Un mot de passe a été généré pour accéder à l'extranet de la Protection Civile des Hauts-de-Seine.<br />
				Celui-ci a pu être généré par un administrateur à la suite de la création de votre compte, ou à sa demande expresse. <br />
				Ce mot de passe est généré automatiquement et n'est connu que de vous. <br />
				Pour rappel, votre identifiant est votre numéro de membre (carte e-protec).<br />
				Votre mot de passe est : ".$newautopass." <br />
				Le stockage du mot de passe a été sécurisé, rendant impossible sa lecture par d'autre biais que cet e-mail. <br />
				Pour autant nous vous conseillons vivement de changer votre mot de passe dès que possible. <br />
				<br />Nous vous remercions, <br />
				
				Le Pôle informatique de la Protection Civile des Hauts-de-Seine <br />
				<br />
				P.S.: Ne pas répondre à cet e-mail, en cas de besoins, merci de vous adresser au pôle informatique, ou à votre Responsable d'Antenne.";
				
				
				
				$mail = new Mail($db_link, $tablename_mail, $currentUserID, $from, $subject, $message);
				$mail->addTo($usermail);
				$mail->store();
				
				
				
				}
			}
		}
?>
