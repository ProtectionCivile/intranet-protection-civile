<?php
	
	if($_POST['mailAccount'] == "" && (isset($_POST['delUser']) || isset($_POST['addUser']) )){
		$genericError = "Impossible de faire un opération sur une liste de diffusion avec un compte mail inconnu";
	}
	else {
		$domainName="@protectioncivile92.org";
		$mailAccount = str_replace("'","", $_POST['mailAccount']).$domainName;
		$from="webmaster".$domainName;
		$to="sympa".$domainName;
		$headers = 'From: '.$from. "\r\n" .
		'Cc: directeur-adj-informatique'.$domainName. "\r\n" .
		'Reply-To: directeur-adj-informatique'.$domainName. "\r\n" .
		'X-Mailer: PHP/' . phpversion();
		$message = 'Command executed via the new PC92 intranet !';

		if (isset($_POST['addUser'])) {
			$nbErrors=0;
			$nbSuccess=0;
			$cmd="QUIET ADD";
			foreach($_POST['lists'] as $mailinglistName){
				$subject=$cmd." ".$mailinglistName." ".$mailAccount;
				$res = mail($to, $subject, $message, $headers);
				if ($res) {
					$nbSuccess++;
				}
				else {
					$nbErrors++;
				}
			}

			// Display result
			if ($nbErrors==0) {
    			$genericSuccess = "Le compte mail '".$mailAccount."' a été abonné à ".$nbSuccess." liste(s) de diffusion";
    		}
    		else {
				$genericError = "Le compte mail '".$mailAccount."' a été abonné à ".$nbSuccess." liste(s) de diffusion et ".$nbErrors." sont en erreur";
			}
		}
		if (isset($_POST['delUser'])){
			$cmd="QUIET DEL";
			$mailinglistName="*";
			$subject=$cmd." ".$mailinglistName." ".$mailAccount;
			$res = mail($to, $subject, $message, $headers);
			if ($res) {
				$genericSuccess = "Le compte mail '".$mailAccount."' a été désabonné de toutes les listes de diffusion";
			}
			else {
				$genericError = "Une erreur est survenue pendant le désabonnement du compte mail '".$mailAccount."' des listes de diffusion";
			}
		}
	}		
?>