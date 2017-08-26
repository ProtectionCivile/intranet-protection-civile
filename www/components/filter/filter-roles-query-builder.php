<?php
	$sqlQuery = "SELECT * FROM $tablename_roles ";


	if (!empty($filtered_section) || $filtered_section == "0") {
		$addWhereClause = true;
		$whereCity = "Affiliation='".$filtered_section."'";
	}



	if ($addWhereClause) {
		$sqlQuery = $sqlQuery." WHERE ";
		if (!empty($whereCity)) {
			$sqlQuery = $sqlQuery.$whereCity;
		}
	}

	$sqlQuery = $sqlQuery." ORDER by ID ASC ";
?>
