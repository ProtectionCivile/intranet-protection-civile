<?php

	$sqlQuery="SELECT id, dps_begin_date, cu_full, event_department, dps_type, event_name, section, status, price FROM $tablename_dps";
	$addWhereClause = false;


	if (!empty($filtered_section) || $filtered_section == "0" ) {
		$addWhereClause = true;
		if ($filtered_section == "*") {
			$whereCity = "section='".$currentUserSection."'";
		}
		else {
			$whereCity = "section='".$filtered_section."'";
		}
	}

	if (!empty($status)) {
		$addWhereClause = true;

		if ($status == "canceled") {
			$whereStatus = "status=4 ";
		}
		elseif ($status == "not-valid") {
			$whereStatus = "status=0 ";
		}
		elseif ($status == "valid_antenne") {
			$whereStatus = "status=1 ";
		}
		elseif ($status == "valid_ddo_attente") {
			$whereStatus = "status=2 ";
		}
		elseif ($status == "valid_pref") {
			$whereStatus = "status=3 ";
		}
		elseif ($status == "refused") {
			$whereStatus = "status=5 ";
		}
		elseif ($status == "atraiter") {
			$whereStatus = "(status=1 OR status=2) ";
		}
		else {
			$whereStatus = "status IS NULL";
		}
	}

	if (!empty($_SESSION['datebegin']) && !empty($_SESSION['dateend'])) {
		$addWhereClause = true;
		$wherePeriod = "dps_begin_date BETWEEN '".$datebeginNF->format('Y-m-d')."' AND '".$dateendNF->format('Y-m-d')."'";
		echo 'je fais ma requete sql avec session begin='.$_SESSION['datebegin'].' et beginNF='.$datebeginNF->format('Y-m-d');
	}


	if ($addWhereClause) {
		$sqlQuery = $sqlQuery." WHERE ";
		if (!empty($whereCity)) {
			$sqlQuery = $sqlQuery.$whereCity;
		}

		if (!empty($whereStatus)) {
			if (!empty($whereCity)) {
				$sqlQuery = $sqlQuery." AND ";
			}
			$sqlQuery = $sqlQuery.$whereStatus;
		}

		if (!empty($wherePeriod)) {
			if (!empty($whereCity) || !empty($whereStatus)) {
				$sqlQuery = $sqlQuery." AND ";
			}
			$sqlQuery = $sqlQuery.$wherePeriod;
		}
	}
?>
