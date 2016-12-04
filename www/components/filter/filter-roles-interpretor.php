<?php
	$sqlQuery = "SELECT * FROM rbac_roles ";


	if (!empty($city)) {
		$addWhereClause = true;
		$whereCity = "Affiliation='".$city."'";
	}

	

	if ($addWhereClause) {
		$sqlQuery = $sqlQuery." WHERE ";
		if (!empty($whereCity)) {
			$sqlQuery = $sqlQuery.$whereCity;
		}
	}

	$sqlQuery = $sqlQuery." ORDER by ID ASC ";
?>