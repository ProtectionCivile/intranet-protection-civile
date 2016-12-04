<?php
	if($dps["annul_poste"] != 0){
		$etat="ANNULÉ";
		$urlform = "edit-dps.php";
		$buttonclass = "btn btn-sm btn-warning glyphicon glyphicon-pencil";
		$trClass ="";
	}
	elseif($dps["annul_poste"] == 0 && $dps["etat_demande_dps"] == "0" && $dps["valid_demande_rt"] == 0 ){
		$etat="Non validé";
		$urlform = "edit-dps.php";
		$buttonclass = "btn btn-sm btn-warning glyphicon glyphicon-pencil";
		$trClass ="";
	}
	elseif($dps["annul_poste"] == 0 && $dps["etat_demande_dps"] == "0" && $dps["valid_demande_rt"] != 0 && $dps["valid_demande_dps"] == 0 ){
		$etat="En attente DDO";
		$urlform = "show-dps.php";
		$buttonclass = "btn btn-sm btn-success glyphicon glyphicon-eye-open";
		$trClass ="info";
	}
	elseif($dps["annul_poste"] == 0 && $dps["etat_demande_dps"] == "3"){
		$etat="Attente Préf / ADPC";
		$urlform = "show-dps.php";
		$buttonclass = "btn btn-sm btn-success glyphicon glyphicon-eye-open";
		$trClass ="warning";
	}
	elseif($dps["annul_poste"] == 0 && $dps["etat_demande_dps"] == "1"){
		$etat="Accepté";
		$urlform = "show-dps.php";
		$buttonclass = "btn btn-sm btn-success glyphicon glyphicon-eye-open";
		$trClass ="success";
	}
	elseif($dps["annul_poste"] == 0 && ($dps["etat_demande_dps"] == "2" || $dps["etat_demande_dps"] == "4")){
		$etat="Refusé";
		$urlform = "edit-dps.php";
		$buttonclass = "btn btn-sm btn-danger glyphicon glyphicon-pencil";
		$trClass ="danger";
	}
	else{
		$etat="ETAT INCONNU";
		$urlform = "edit-dps.php";
		$buttonclass = "btn btn-sm btn-info glyphicon glyphicon-fire";
		$trClass ="danger";
	}
?>