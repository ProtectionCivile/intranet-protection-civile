<?php
require_once('functions/mail/Mail.php');
require_once('functions/mail/mail-functions.php');

	//Authentication
	$rbac->enforce("admin-mailinglist-manage", $currentUserID);

	if(isNullOrEmpty($_POST['mailAccount']) && (isset($_POST['delUser']) || isset($_POST['delUserEverywhere']) || isset($_POST['addUser']) ) ){
		$genericError = "Entrez un compte mail valide svp !";
	}
	elseif(isset($_POST['delUser']) || isset($_POST['delUserEverywhere']) || isset($_POST['addUser']) ) {
		$domainName="@protectioncivile92.org";
		$mailAccount = str_replace("'","", $_POST['mailAccount']).$domainName;
		$from="webmaster".$domainName;
		$to="sympa".$domainName;
		$cc="directeur-adj-informatique".$domainName;
		$message = 'Command executed via the new PC92 intranet !';


		if (isset($_POST['addUser'])) {
			$nb = 0;
			$cmd="QUIET ADD";
			if (count($_POST['lists']) == 0) {
				$genericError = "Sélectionnez au-moins une liste de diffusion !";
			}
			else {
				foreach($_POST['lists'] as $mailinglistName){
					$nb++;
					$subject=$cmd." ".$mailinglistName." ".$mailAccount;
					$mail = new Mail($db_link, $tablename_mail, $currentUserID, $from, $subject, $message);
				  $mail->addTo($to);
				  $mail->addCc($cc);
					$mail->displayInfos();
					$mail->store();
				}
  			$genericSuccess = "La demande d'abonnement du compte mail '".$mailAccount."' a été demandée pour ".$nb." liste(s) de diffusion, et sera traitée dans l'heure";
			}
		}

		if (isset($_POST['delUser'])) {
			$nb = 0;
			$cmd="QUIET DEL";
			if (count($_POST['lists']) == 0) {
				$genericError = "Sélectionnez au-moins une liste de diffusion !";
			}
			else {
				foreach($_POST['lists'] as $mailinglistName){
					$nb++;
					$subject=$cmd." ".$mailinglistName." ".$mailAccount;
					$mail = new Mail($db_link, $tablename_mail, $currentUserID, $from, $subject, $message);
				  $mail->addTo($to);
				  $mail->addCc($cc);
					$mail->store();
				}
  			$genericSuccess = "La demande de désabonnement du compte mail '".$mailAccount."' a été demandée pour ".$nb." liste(s) de diffusion, et sera traitée dans l'heure";
			}
		}

		elseif (isset($_POST['delUserEverywhere'])){
			$cmd="QUIET DEL";
			$mailinglistName="*";
			$subject=$cmd." ".$mailinglistName." ".$mailAccount;
			$mail = new Mail($db_link, $tablename_mail, $currentUserID, $from, $subject, $message);
			$mail->addTo($to);
			$mail->addCc($cc);
			$mail->store();
			$genericSuccess = "La demande de désabonnement du compte mail '".$mailAccount."' a été demandée pour toutes les listes de diffusion, et sera traitée dans l'heure";
		}
	}
?>
