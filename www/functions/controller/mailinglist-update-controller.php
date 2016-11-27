<?php
	if (!(isset($_POST['delUser']) || isset($_POST['addUser']) )) {
	}
	else{
		if (isset($_POST['addUser'])) {
			if($_POST['mailAccount'] == ""){
				$genericError = "Impossible d'ajouter un compte mail inconnu à une liste de diffusion";
			}
			else{
				$domainName="protectioncivile92.org";
				$mailAccount = str_replace("'","", $_POST['mailAccount'])."@".$domainName;

				$nbErrors=0;
				$nbSuccess=0;
				$from="webmaster"."@".$domainName;
				$to="sympa"."@".$domainName;
				$cmd="QUIET ADD";
				$message = 'Command executed via the new PC92 intranet !';
				$headers = 'From: '.$from. "\r\n" .
				'Cc: directeur-adj-informatique'."@".$domainName. "\r\n" .
				'Reply-To: directeur-adj-informatique'."@".$domainName. "\r\n" .
				'X-Mailer: PHP/' . phpversion();
				
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
        			$genericSuccess = "Le compte mail '".$mailAccount."' a été ajouté à ".$nbSuccess." liste(s) de diffusion";
        		}
        		else {
					$genericError = "Le compte mail '".$mailAccount."' a été ajouté à ".$nbSuccess." liste(s) de diffusion et ".$nbErrors." sont en erreur";
				}
			}
		}
		if (isset($_POST['delUser'])){
		}
	}		
?>