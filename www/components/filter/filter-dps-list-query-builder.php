<?php

	$sqlQuery="SELECT id, dps_begin_date, cu_full, event_department, dps_type, event_name, section, status_validation_dlo_date, status_validation_ddo_date, status, status_cancel_date FROM $tablename_dps";
	$addWhereClause = false;


	if (!empty($city) || $city == "0" ) {
		$addWhereClause = true;
		$whereCity = "section='".$city."'";
	}

	if (!empty($status)) {
		$addWhereClause = true;

		if ($status == "canceled") {
			$whereStatus = "status_cancel_date IS NOT NULL ";
		}
		elseif ($status == "not-valid") {
			$whereStatus = "status_cancel_date IS NULL AND status=0 AND status_validation_dlo_date IS NULL ";
		}
		elseif ($status == "valid_antenne") {
			$whereStatus = "status_cancel_date IS NULL AND status=0 AND status_validation_dlo_date IS NOT NULL AND status_validation_ddo_date IS NULL ";
		}
		elseif ($status == "valid_ddo_attente") {
			$whereStatus = "status_cancel_date IS NULL AND status=3 ";
		}
		elseif ($status == "valid_pref") {
			$whereStatus = "status_cancel_date IS NULL AND status=1 ";
		}
		elseif ($status == "refused") {
			$whereStatus = "status_cancel_date IS NULL AND (status=2 OR status=4) ";
		}
		elseif ($status == "fuzzy") {
			$whereStatus = "status_validation_dlo_date IS NOT NULL AND status_validation_ddo_date IS NULL";
		}
	}

	if (!empty($datebegin) && !empty($dateend)) {
		$addWhereClause = true;
		$wherePeriod = "dps_begin_date > '".$datebeginNF->format('Y-m-d')."' AND dps_end_date < '".$dateendNF->format('Y-m-d')."'";
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
