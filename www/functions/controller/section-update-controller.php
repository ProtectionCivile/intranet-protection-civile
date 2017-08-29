<?php
	//Authentication
	require_once('functions/section/section-update-authentication.php');

	if (isset($_POST['updateSection'])){
		echo (isset($_POST['section_email']) ? "OUI" : "NON") ;
		$section_name = $_POST['section_name'];
		$section_shortname = $_POST['section_shortname'];
		$section_number = $_POST['section_number'];
		$section_address = $_POST['section_address'];
		$section_zipcode = $_POST['section_zipcode'];
		$section_city = $_POST['section_city'];
		$section_phone = $_POST['section_phone'];
		$section_email = $_POST['section_email'];
		$section_website = $_POST['section_website'];
		$attached_section = $_POST['attached_section'];

		$missingValues = 0;

		if(isNullOrEmpty($section_name)){
			$missingValues++;
			$section_name_error = "Le nom de l'antenne est obligatoire";
		}
		if(isNullOrEmpty($section_number)){
			$missingValues++;
			$section_number_error = "Le numéro de l'antenne est obligatoire";
		}
		if(isNullOrEmpty($section_shortname)){
			$missingValues++;
			$section_shortname_error = "Le nom court de l'antenne est obligatoire";
		}

		if ($missingValues != "0" ) {
			if (!isNullOrEmpty($genericError)){
				$genericError = $genericError.'<br />';
			}
				$genericError = $genericError.'Il y a '.$missingValues.' champs non-renseignés';
		}

		if (empty($genericError)){
			$sql = "UPDATE $tablename_sections SET
			name='".mysqli_real_escape_string($db_link, $section_name)."',
			address='".mysqli_real_escape_string($db_link, $section_address)."',
			phone='".mysqli_real_escape_string($db_link, $section_phone)."',
			zip_code='".mysqli_real_escape_string($db_link, $section_zipcode)."',
			website='".mysqli_real_escape_string($db_link, $section_website)."',
			mail='".mysqli_real_escape_string($db_link, $section_email)."',
			attached_section='".mysqli_real_escape_string($db_link, $attached_section)."',
			`number`='".mysqli_real_escape_string($db_link, $section_number)."',
			city='".mysqli_real_escape_string($db_link, $section_city)."',
			shortname='".mysqli_real_escape_string($db_link, $section_shortname)."'
			WHERE number='".mysqli_real_escape_string($db_link, $id)."'";
			if ($db_link->query($sql) === TRUE) {
			    $genericSuccess = "Antenne mise à jour ($section_name)";
			} else {
			    $genericError = "Erreur pendant la mise à jour de l'antenne '$section_name' : " . $db_link->error;
			}
		}
	}
?>
