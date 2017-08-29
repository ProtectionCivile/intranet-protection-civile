<?php
	require_once('functions/str.php');

	//Authentication
	require_once('functions/client/client-update-authentication.php');

	if (isset($_POST['updateClient'])){
		$client_id = $_POST['id'];
		$client_name = $_POST['client_name'];
		$client_ref = $_POST['client_ref'];
		$client_represent = $_POST['client_represent'];
		$client_title = $_POST['client_title'];
		$client_address = $_POST['client_address'];
		$client_phone = $_POST['client_phone'];
		$client_fax = $_POST['client_fax'];
		$client_email = $_POST['client_email'];
		$attached_section = $_POST['attached_section'];

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
			$client_phone_error = "Le téléphone du client est obligatoire";
			$genericError = "Le téléphone du client est obligatoire";
		}

		if ($missingValues != "0" ) {
			if (!isNullOrEmpty($genericError)){
				$genericError = $genericError.'<br />';
			}
				$genericError = $genericError.'Il y a '.$missingValues.' champs non-renseignés';
		}

		if (empty($genericError)){
			$sql = "UPDATE $tablename_clients SET
			ref='".mysqli_real_escape_string($db_link, $client_ref)."',
			name='".mysqli_real_escape_string($db_link, $client_name)."',
			attached_section='".mysqli_real_escape_string($db_link, $attached_section)."',
			represent='".mysqli_real_escape_string($db_link, $client_represent)."',
			title='".mysqli_real_escape_string($db_link, $client_title)."',
			address='".mysqli_real_escape_string($db_link, $client_address)."',
			phone='".mysqli_real_escape_string($db_link, $client_phone)."',
			fax='".mysqli_real_escape_string($db_link, $client_fax)."',
			mail='".mysqli_real_escape_string($db_link, $client_email)."' WHERE ID='$id'" or die("Impossible d'ajouter le client dans la base de données" . mysqli_error($db_link));
			if ($db_link->query($sql) === TRUE) {
				$genericSuccess = "Client mis à jour (".$client_name.")";
			} else {
				$genericError = "Client non mis à jour: " . $db_link->error;
			}
		}
	}
?>
