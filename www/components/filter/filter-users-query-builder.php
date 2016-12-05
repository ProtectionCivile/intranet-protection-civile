<?php
	$sqlQuery = "SELECT U.ID, U.last_name, U.first_name, U.phone, U.mail, S.name AS section_name FROM `users` AS U INNER JOIN sections AS S ON `U`.`attached_section` = `S`.`number`";
				

	if (!empty($city) || $city == "0") {
		$addWhereClause = true;
		$whereCity = "U.attached_section='".$city."'";
	}

	

	if ($addWhereClause) {
		$sqlQuery = $sqlQuery." WHERE ";
		if (!empty($whereCity)) {
			$sqlQuery = $sqlQuery.$whereCity;
		}
	}

	$sqlQuery = $sqlQuery." ORDER by U.last_name ASC ";
?>