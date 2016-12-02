<?php 
	function compute_dps_type($type) {
		if($type == "0"){
			return "PAPS";
		}
		elseif($type == "1") {
			return "DPS-PE";
		}
		elseif($type == "2") {
			return "DPS-ME";
		}
		elseif($type == "3") {
			return "DPS-GE";
		}
	}


function compute_dps_department($dpt) {
	if($dpt != "92") {
			return "<strong>".$dpt."</strong>";
		}
		else {
			return $dpt;
		}
	}

function compute_dps_status($refus, $validation_ec, $validation, $dateValid) {
	if($refus == true) {
			return "Refusé";
		}
		elseif($validation_ec == true) {
			return "En attente";
		}
		elseif($validation_ec == false && $validation == true) {
			return $dateValid;
		}
		else {
			return "Non envoyé";
		}
	}
?>