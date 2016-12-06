<?php 
	$id = str_replace("'","", $_POST['ID']);

	if($id == ""){
		$genericError = "Aucune section définie";
	}
	else {
		$sql = "SELECT ID, number, name, address, zip_code, city, mail, phone, attached_section, shortname FROM sections WHERE number='$id'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
		$query = mysqli_query($link, $sql);
		$section = mysqli_fetch_assoc($query);
	 	$sectionsCount = mysqli_num_rows($query);		
		if (!$sectionsCount){
			$genericError = "La section en question n'existe pas";
		}
	}
	
	if(empty($genericError)) {
		$name=$section["name"];
	}
		
?>