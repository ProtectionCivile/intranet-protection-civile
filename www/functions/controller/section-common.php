<?php
	$id = str_replace("'","", $_POST['id']);

	if($id == ""){
		$genericError = "Aucune section définie";
	}
	else {
		$sql = "SELECT ID, number, name, address, zip_code, city, mail, phone, attached_section, website, shortname FROM $tablename_sections WHERE number='$id'" or die("Erreur lors de la consultation" . mysqli_error($db_link));
		$query = mysqli_query($db_link, $sql);
		$section = mysqli_fetch_assoc($query);
	 	$sectionsCount = mysqli_num_rows($query);
		if (!$sectionsCount){
			$genericError = "La section en question n'existe pas";
		}
	}

	if(empty($genericError)) {
		$name=$section["name"];
	}

	if(empty($genericError)) {
		$section_name = $section['name'];
		$section_shortname = $section['shortname'];
		$section_number = $section['number'];
		$section_address = $section['address'];
		$section_zipcode = $section['zip_code'];
		$section_city = $section['city'];
		$section_phone = $section['phone'];
		$section_email = $section['mail'];
		$section_website = $section['website'];
		$attached_section = $section['attached_section'];
	}

?>
