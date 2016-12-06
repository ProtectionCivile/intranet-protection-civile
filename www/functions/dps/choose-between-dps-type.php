<?php
	if($dps["annul_poste"] != 0){
		$dps_display_status="ANNULÉ";
		$dps_status = "canceled";
		$urlform = "edit-dps.php";
		$buttonclass = "btn btn-sm btn-warning glyphicon glyphicon-pencil";
		$trClass ="";
	}
	elseif($dps["annul_poste"] == 0 && $dps["etat_demande_dps"] == "0" && $dps["valid_demande_rt"] == 0 ){
		$dps_display_status="Non validé";
		$dps_status = "canceled";
		$dps_status = "canceled";
		$urlform = "edit-dps.php";
		$buttonclass = "btn btn-sm btn-warning glyphicon glyphicon-pencil";
		$trClass ="";
	}
	elseif($dps["annul_poste"] == 0 && $dps["etat_demande_dps"] == "0" && $dps["valid_demande_rt"] != 0 && $dps["valid_demande_dps"] == 0 ){
		$dps_display_status="En attente DDO";
		$dps_status = "canceled";
		$urlform = "show-dps.php";
		$buttonclass = "btn btn-sm btn-success glyphicon glyphicon-eye-open";
		$trClass ="info";
	}
	elseif($dps["annul_poste"] == 0 && $dps["etat_demande_dps"] == "3"){
		$dps_display_status="Attente Préf / ADPC";
		$dps_status = "canceled";
		$urlform = "show-dps.php";
		$buttonclass = "btn btn-sm btn-success glyphicon glyphicon-eye-open";
		$trClass ="warning";
	}
	elseif($dps["annul_poste"] == 0 && $dps["etat_demande_dps"] == "1"){
		$dps_display_status="Accepté";
		$dps_status = "canceled";
		$urlform = "show-dps.php";
		$buttonclass = "btn btn-sm btn-success glyphicon glyphicon-eye-open";
		$trClass ="success";
	}
	elseif($dps["annul_poste"] == 0 && ($dps["etat_demande_dps"] == "2" || $dps["etat_demande_dps"] == "4")){
		$dps_display_status="Refusé";
		$dps_status = "canceled";
		$urlform = "edit-dps.php";
		$buttonclass = "btn btn-sm btn-danger glyphicon glyphicon-pencil";
		$trClass ="danger";
	}
	else{
		$dps_display_status="ETAT INCONNU";
		$dps_status = "canceled";
		$urlform = "edit-dps.php";
		$buttonclass = "btn btn-sm btn-info glyphicon glyphicon-fire";
		$trClass ="danger";
	}
?>