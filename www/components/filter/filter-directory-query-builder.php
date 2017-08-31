<?php
	$sqlQuery = "SELECT * FROM $tablename_roles ";


	if (!empty($_SESSION['filtered_section']) || $_SESSION['filtered_section'] == "0") {
		$addWhereClause = true;
		$whereCity = "Affiliation='".$_SESSION['filtered_section']."'";
	}


	$sqlQuery = $sqlQuery." WHERE ";
	$sqlQuery = $sqlQuery." Directory = '1' ";
	if ($addWhereClause) {
		$sqlQuery = $sqlQuery." AND ";
		if (!empty($whereCity)) {
			$sqlQuery = $sqlQuery.$whereCity;
		}
	}

	$sqlQuery = $sqlQuery." ORDER by Hierarchy ASC ";
?>
