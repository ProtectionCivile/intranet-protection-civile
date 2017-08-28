<?php
	require_once('functions/str.php');

	//Authentication
	require_once('functions/client/client-update-authentication.php');

	if (isset($_POST['addClient'])){
		$client_name = str_replace("'","", $_POST['client_name']); // TODO retirer les replace
		$client_ref = str_replace("'","", $_POST['client_ref']);
		$client_represent = str_replace("'","", $_POST['client_represent']);
		$client_title = str_replace("'","", $_POST['client_title']);
		$client_address = str_replace("'","", $_POST['client_address']);
		$client_phone = str_replace("'","", $_POST['client_phone']);
		$client_fax = str_replace("'","", $_POST['client_fax']);
		$client_email = str_replace("'","", $_POST['client_email']);
		$attached_section = str_replace("'","", $_POST['attached_section']);

		$missingValues = 0;

		if(isNullOrEmpty($client_name)){
			$missingValues++;
			$client_name_error = "Le nom de la société ou de l'association est obligatoire";
		}
		if(isNullOrEmpty($client_represent)){
			$missingValues++;
			$client_represent_error = "Le représentant légal de la structure est obligatoire";
		}
		if(isNullOrEmpty($client_ref)){
			$missingValues++;
			$client_ref_error = "Un nom court est obligatoire pour identifier ce client sur les DPS";
		}
		if(isNullOrEmpty($client_title)){
			$missingValues++;
			$client_title_error = "La fonction du représentant légal est obligatoire";
		}
		if(isNullOrEmpty($client_address)){
			$missingValues++;
			$client_address_error = "L'adresse du client est obligatoire";
		}
		if(isNullOrEmpty($client_phone)){
			$missingValues++;
			$client_phone_error = "Le téléphone du client est obligatoire";
		}
		if(isNullOrEmpty($client_fax)){
			//C'est pas grave
		}
		if(isNullOrEmpty($client_email)){
			//C'est pas grave
		}
		if(isNullOrEmpty($attached_section)){
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
			$sql = "INSERT INTO $tablename_clients (ref, name, attached_section, represent, title, address, phone, fax, mail) VALUES (
				'".mysqli_real_escape_string($db_link, $client_ref)."',
				'".mysqli_real_escape_string($db_link, $client_name)."',
				'$attached_section',
				'".mysqli_real_escape_string($db_link, $client_represent)."',
				'".mysqli_real_escape_string($db_link, $client_title)."',
				'".mysqli_real_escape_string($db_link, $client_address)."',
				'".mysqli_real_escape_string($db_link, $client_phone)."',
				'".mysqli_real_escape_string($db_link, $client_fax)."',
				'".mysqli_real_escape_string($db_link, $client_email)."'
				)" or die("Impossible d'ajouter le client dans la base de données" . mysqli_error($db_link));
			if ( $db_link->query($sql) === TRUE) {
					$genericSuccess = "Client créé avec succès (".$client_name.")";
			} else {
					$genericError = "Client non créé: " . $db_link->error;
			}
		}
	}
?>
