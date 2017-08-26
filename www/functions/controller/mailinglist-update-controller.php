<?php
	//Authentication 
	$rbac->enforce("admin-mailinglist-manage", $currentUserID); 

	if(isNullOrEmpty($_POST['mailAccount']) && ((isset($_POST['delUser']) || isset($_POST['addUser'])) )){
		$genericError = "Entrez un compte mail valide svp !";
	}
	elseif(isset($_POST['delUser']) || isset($_POST['addUser']) ) {
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
			if (count($_POST['lists']) == 0) {
				$genericError = "Sélectionnez au-moins une liste de diffusion !";
			}
			else {
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
		}
		elseif (isset($_POST['delUser'])){
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