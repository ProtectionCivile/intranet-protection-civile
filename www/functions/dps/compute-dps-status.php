<?php
	if($dps["status"] == "4"){
		$dps_display_status = "ANNULÉ";
		$dps_status = "canceled";
		$urlform = "dps-edit.php";
		$buttonclass = "btn btn-sm btn-warning glyphicon glyphicon-pencil";
		$trClass = "";
	}
	elseif($dps["status"] == "0"){
		$dps_display_status = "Non validé";
		$dps_status = "not-validated";
		$urlform = "dps-edit.php";
		$buttonclass = "btn btn-sm btn-warning glyphicon glyphicon-pencil";
		$trClass = "";
	}
	elseif($dps["status"] == "1"){
		$dps_display_status = "En attente DDO";
		$dps_status = "valid_antenne";
		$urlform = "dps-view.php";
		$buttonclass = "btn btn-sm btn-success glyphicon glyphicon-eye-open";
		$trClass = "info";
	}
	elseif($dps["status"] == "2"){
		$dps_display_status = "Attente Préf / ADPC";
		$dps_status = "valid_ddo_attente";
		$urlform = "dps-view.php";
		$buttonclass = "btn btn-sm btn-success glyphicon glyphicon-eye-open";
		$trClass = "warning";
	}
	elseif($dps["status"] == "3"){
		$dps_display_status = "Accepté";
		$dps_status = "accepted";
		$urlform = "dps-view.php";
		$buttonclass = "btn btn-sm btn-success glyphicon glyphicon-eye-open";
		$trClass = "success";
	}
	elseif($dps["status"] == "5"){
		$dps_display_status = "Refusé";
		$dps_status = "refused";
		$urlform = "dps-edit.php";
		$buttonclass = "btn btn-sm btn-danger glyphicon glyphicon-pencil";
		$trClass = "danger";
	}
	else{
		$dps_display_status = "ETAT INCONNU";
		$dps_status = "unknown";
		$urlform = "dps-edit.php";
		$buttonclass = "btn btn-sm btn-info glyphicon glyphicon-fire";
		$trClass = "danger";
	}
?>
