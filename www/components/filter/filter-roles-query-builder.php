<?php
	$sqlQuery = "SELECT * FROM $tablename_roles ";


	if (!empty($_SESSION['filtered_section']) || $_SESSION['filtered_section'] == "0") {
		$addWhereClause = true;
		$whereCity = "Affiliation='".$_SESSION['filtered_section']."'";
	}



	if ($addWhereClause) {
		$sqlQuery = $sqlQuery." WHERE ";
		if (!empty($whereCity)) {
			$sqlQuery = $sqlQuery.$whereCity;
		}
	}

	$sqlQuery = $sqlQuery." ORDER by ID ASC ";
?>
