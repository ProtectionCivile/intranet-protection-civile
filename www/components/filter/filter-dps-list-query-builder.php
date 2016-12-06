<?php

	$sqlQuery="SELECT id, dps_debut_poste, cu_complet, dept, type_dps, description_manif, commune_ris, valid_demande_rt, valid_demande_dps, etat_demande_dps, annul_poste FROM $tablename_dps";
	$addWhereClause = false;


	if (!empty($city) || $city == "0" ) {
		$addWhereClause = true;
		$whereCity = "commune_ris='".$city."'";
	}

	if (!empty($status)) {
		$addWhereClause = true;
		
		if ($status == "canceled") {
			$whereStatus = "annul_poste <> '0000-00-00' ";
		}
		elseif ($status == "not-valid") {
			$whereStatus = "annul_poste = '0000-00-00' AND etat_demande_dps='0' AND valid_demande_rt = '0000-00-00' ";
		}
		elseif ($status == "valid_antenne") {
			$whereStatus = "annul_poste = '0000-00-00' AND etat_demande_dps='0' AND valid_demande_rt <> '0000-00-00' AND valid_demande_dps = '0000-00-00' ";
		}
		elseif ($status == "valid_ddo_attente") {
			$whereStatus = "annul_poste = '0000-00-00' AND etat_demande_dps='3' ";
		}
		elseif ($status == "valid_pref") {
			$whereStatus = "annul_poste = '0000-00-00' AND etat_demande_dps='1' ";
		}
		elseif ($status == "refused") {
			$whereStatus = "annul_poste = '0000-00-00' AND (etat_demande_dps='2' OR etat_demande_dps='4') ";
		}
		elseif ($status == "fuzzy") {
			$whereStatus = "valid_demande_rt <> '0000-00-00' AND valid_demande_dps = '0000-00-00'";
		}
	}

	if (!empty($datebegin) && !empty($dateend)) {
		$addWhereClause = true;
		$wherePeriod = "dps_debut > '".$datebeginNF->format('Y-m-d')."' AND dps_fin < '".$dateendNF->format('Y-m-d')."'";
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