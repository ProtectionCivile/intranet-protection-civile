<?php
	if(isset($city)){
		$query = "SELECT id, commune_ris FROM demande_dps WHERE commune_ris = $city";
		include ('decide-how-many-pages.php');
		$premiereEntree=($pagecurrent-1)*$dpsperpage;
		$listedps_query = "SELECT id, dps_debut_poste, cu_complet, dept, type_dps, description_manif, commune_ris, valid_demande_rt, valid_demande_dps, etat_demande_dps FROM demande_dps WHERE commune_ris = $city ORDER BY id DESC LIMIT $premiereEntree, $dpsperpage";
	}
	elseif(isset($_GET['filter'])){
		if($filter == "en-attente"){
			$query = "SELECT id, etat_demande_dps, valid_demande_rt FROM demande_dps WHERE valid_demande_rt NOT LIKE '0000-00-00' AND valid_demande_dps LIKE '0000-00-00'";
		}
		include ('functions/dps/decide-how-many-pages.php');
		$premiereEntree=($pagecurrent-1)*$dpsperpage;
		$listedps_query = "SELECT id, dps_debut_poste, cu_complet, dept, type_dps, description_manif, commune_ris, valid_demande_rt, valid_demande_dps, etat_demande_dps FROM demande_dps WHERE valid_demande_rt NOT LIKE '0000-00-00' AND valid_demande_dps LIKE '0000-00-00' ORDER BY id DESC LIMIT $premiereEntree, $dpsperpage";
	}
	else{
		$query = "SELECT id FROM demande_dps";
		include ('functions/dps/decide-how-many-pages.php');
		$premiereEntree=($pagecurrent-1)*$dpsperpage;
		$listedps_query = "SELECT id, dps_debut_poste, cu_complet, dept, type_dps, description_manif, commune_ris, valid_demande_rt, valid_demande_dps, etat_demande_dps FROM demande_dps ORDER BY id DESC LIMIT $premiereEntree, $dpsperpage";
	}
?>