<?php
	if($listedps["valid_demande_rt"] == 0 && $listedps["etat_demande_dps"] == "0"){
		$validation=false;
		$validation_ec=false;
		$refus=false;
		$urlform = "edit-dps.php";
		$buttonclass = "btn btn-warning glyphicon glyphicon-pencil";
		$trClass ="";
	}
	elseif($listedps["valid_demande_rt"] == 0 && $listedps["etat_demande_dps"] == "2"){
		$refus=true;
		$validation=true;
		$validation_ec=false;
		$urlform = "edit-dps.php";
		$buttonclass = "btn btn-danger glyphicon glyphicon-pencil";
		$trClass ="class='danger'";
	}
	elseif($listedps["etat_demande_dps"] == "1"){
		$validation=true;
		$validation_ec=false;
		$refus=false;
		$urlform = "show-dps.php";
		$buttonclass = "btn btn-success glyphicon glyphicon-eye-open";
		$trClass ="class='success'";
	}
	else{
		$validation=false;
		$validation_ec=true;
		$refus=false;
		$urlform = "show-dps.php";
		$buttonclass = "btn btn-success glyphicon glyphicon-eye-open";
		$trClass ="class='info'";
	}
?>