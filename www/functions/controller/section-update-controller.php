<?php
	//Authentication 
	$rbac->enforce("admin-sections-update", $currentUserID);

	if (empty($genericError)){

		if (isset($_POST['name'])) {
			$name=str_replace("'","", $_POST['name']);
		}
		else {
			$name=$section["name"];
		}
		if (isset($_POST['address'])) {
			$address=str_replace("'","", $_POST['address']);
		}
		else {
			$address=$section["address"];
		}
		if (isset($_POST['zipcode'])) {
			$zipcode=str_replace("'","", $_POST['zipcode']);
		}
		else {
			$zipcode=$section["zip_code"];
		}
		if (isset($_POST['city'])) {
			$city=str_replace("'","", $_POST['city']);
		}
		else {
			$city=$section["city"];
		}
		if (isset($_POST['number'])) {
			$number=str_replace("'","", $_POST['number']);
		}
		else {
			$number=$section["number"];
		}
		if (isset($_POST['shortname'])) {
			$shortname=str_replace("'","", $_POST['shortname']);
		}
		else {
			$shortname=$section["shortname"];
		}
		if (isset($_POST['phone'])) {
			$phone=str_replace("'","", $_POST['phone']);
		}
		else {
			$phone=$section["phone"];
		}
		if (isset($_POST['website'])) {
			$website=str_replace("'","", $_POST['website']);
		}
		else {
			$website=$section["website"];
		}
		if (isset($_POST['mail'])) {
			$mail=str_replace("'","", $_POST['mail']);
		}
		else {
			$mail=$section["mail"];
		}
		if (isset($_POST['attached_section'])) {
			$attached_section=str_replace("'","", $_POST['attached_section']);
		}
		else {
			$attached_section=$section["attached_section"];
		}

		if (isset($_POST['update'])) {		
			echo "MAJ";
			$sql = "UPDATE $tablename_sections SET name='$name', address='$address', phone='$phone', zip_code='$zipcode', website='$website', mail='$mail', attached_section='$attached_section', `number`='$number', city='$city', shortname='$shortname' WHERE number='$id'";
			echo $sql;
			if ($db_link->query($sql) === TRUE) {
			    $genericSuccess = "Section mis à jour ($name)";
			} else {
			    $genericError = "Erreur pendant la mise à jour de la section '$name' : " . $db_link->error;
			}
		}
	}
?>