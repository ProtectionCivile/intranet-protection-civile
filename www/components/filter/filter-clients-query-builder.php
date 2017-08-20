<?php
	$sqlQuery = "SELECT C.id, C.attached_section, C.ref, C.name, C.represent, C.title, C.address, C.fax, C.phone, C.mail, S.name AS section_name FROM `$tablename_clients` AS C INNER JOIN sections AS S ON `C`.`attached_section` = `S`.`number`";

	if (!empty($filtered_section) || $filtered_section == "0") {
		$addWhereClause = true;
		$whereCity = "C.attached_section='".$filtered_section."'";
	}



	if ($addWhereClause) {
		$sqlQuery = $sqlQuery." WHERE ";
		if (!empty($whereCity)) {
			$sqlQuery = $sqlQuery.$whereCity;
		}
	}

	$sqlQuery = $sqlQuery." ORDER by C.name ASC ";
?>
