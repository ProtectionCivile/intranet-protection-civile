<?php

	if($dps["status"] == "4"){
		$dps_display_status = "ANNULÉ";
		$dps_status = "canceled";
		$trClass = "";
	}
	elseif($dps["status"] == "0"){
		$dps_display_status = "Non validé";
		$dps_status = "draft";
		$trClass = "";
	}
	elseif($dps["status"] == "1"){
		$dps_display_status = "En attente DDO";
		$dps_status = "valid_antenne";
		$trClass = "info";
	}
	elseif($dps["status"] == "2"){
		$dps_display_status = "Attente Préf / ADPC";
		$dps_status = "valid_ddo_attente";
		$trClass = "warning";
	}
	elseif($dps["status"] == "3"){
		$dps_display_status = "Accepté";
		$dps_status = "accepted";
		$trClass = "success";
	}
	elseif($dps["status"] == "5"){
		$dps_display_status = "Refusé";
		$dps_status = "refused";
		$trClass = "danger";
	}
	else{
		$dps_display_status = "ETAT INCONNU";
		$dps_status = "unknown";
		$trClass = "danger";
	}

?>
