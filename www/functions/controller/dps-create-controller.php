<?php require('functions/dps/dps-compute-variables.php'); ?>

<?php include('functions/dps/dps-compute-next-available-cu.php'); ?>

<?php

	if (isset($_POST['create'])) {

		require('functions/dps/dps-error-handling.php');

		if (isNullOrEmpty($genericError)){
			// Create
			$status="0";

			// Ensure it does not exist
			$sql = "SELECT ID FROM $tablename_dps WHERE cu_full='$cu_full'" or die("Erreur lors de la consultation" . mysqli_error($db_link));
			$verif = mysqli_query($db_link, $sql);
			$how_many_dps_found = mysqli_num_rows($verif);
			if ($how_many_dps_found){
				$genericError = "Un DPS avec le même certificat unique existe déjà (".$cu_full.")";
			}
			else {
				$sql = "INSERT INTO $tablename_dps (section, cu_full, cu_year, cu_yearly_index,
					client_name, client_represent, client_title, client_address, client_phone, client_fax, client_email,
					event_name, event_description, event_address, event_department, event_begin_date, event_begin_time, event_end_date, event_end_time, event_pref_secu,
					ris_p1_public, ris_p1_actors, ris_p2, ris_e1, ris_e2, ris_comment,
					dps_type, dps_begin_date, dps_begin_time, dps_end_date, dps_end_time, dps_nb_ce, dps_nb_pse2, dps_nb_pse1, dps_nb_psc1, dps_nb_lot_a, dps_nb_lot_b, dps_nb_lot_c, dps_nb_dae, dps_nb_vpsp_transp, dps_nb_vpsp_soin, dps_nb_vtu, dps_nb_tente, dps_nb_med_asso, dps_nb_inf_asso, dps_other_matos_asso,
					clientmatos_infirmerie, clientmatos_tente, clientmatos_other,
					medicalext_nb_med, medicalext_med_company, medicalext_nb_inf, medicalext_inf_company, samu, bspp,
					price, dps_justification, eprotec_number, status, status_justification, status_creation_date) VALUES
				('$section', '$cu_full', '$cu_year', '$cu_yearly_index',
					'".mysqli_escape_string($db_link, $client_name)."',
					'".mysqli_escape_string($db_link, $client_represent)."',
					'".mysqli_escape_string($db_link, $client_title)."',
					'".mysqli_escape_string($db_link, $client_address)."',
					'$client_phone',
					'$client_fax',
					'$client_email',
					'".mysqli_escape_string($db_link, $event_name)."',
					'".mysqli_escape_string($db_link, $event_description)."',
					'".mysqli_escape_string($db_link, $event_address)."',
					'".mysqli_escape_string($db_link, $event_department)."',
					'".formatDateFrToUs($event_begin_date)."', '".formatTimeRemoveDoubleDot($event_begin_time)."',
					'".formatDateFrToUs($event_end_date)."', '".formatTimeRemoveDoubleDot($event_end_time)."',
					'$event_pref_secu',
					'$ris_p1_public', '$ris_p1_actors', '$ris_p2', '$ris_e1', '$ris_e2',
					'".mysqli_escape_string($db_link, $ris_comment)."',
					'$dps_type',
					'".formatDateFrToUs($dps_begin_date)."', '".formatTimeRemoveDoubleDot($dps_begin_time)."',
					'".formatDateFrToUs($dps_end_date)."', '".formatTimeRemoveDoubleDot($dps_end_time)."',
					'$dps_nb_ce', '$dps_nb_pse2', '$dps_nb_pse1', '$dps_nb_psc1',
					'$dps_nb_lot_a', '$dps_nb_lot_b', '$dps_nb_lot_c', '$dps_nb_dae',
					'$dps_nb_vpsp_transp', '$dps_nb_vpsp_soin', '$dps_nb_vtu', '$dps_nb_tente', '$dps_nb_med_asso', '$dps_nb_inf_asso',
					'".mysqli_escape_string($db_link, $dps_other_matos_asso)."',
					'$clientmatos_infirmerie', '$clientmatos_tente',
					'".mysqli_escape_string($db_link, $clientmatos_other)."',
					'$medicalext_nb_med', '".mysqli_escape_string($db_link, $medicalext_med_company)."', '$medicalext_nb_inf', '".mysqli_escape_string($db_link, $medicalext_inf_company)."',
					'$samu', '$bspp',
					'$price',
					'".mysqli_escape_string($db_link, $dps_justification)."',
					'$eprotec_number',
					'$status',
					'".mysqli_escape_string($db_link, $status_justification)."',
					'$today')" or die("Impossible d'ajouter le DPS dans la base de données" . mysqli_error($db_link));


				if ($db_link->query($sql) === TRUE) {
					$sql = "SELECT id FROM $tablename_dps WHERE cu_full='$cu_full'";
					$query = mysqli_query($db_link, $sql);
					$found_dps = mysqli_fetch_assoc($query);

					$genericSuccess = "Dispositif de Secours créé.
					<a href='dps-view.php?id=".$found_dps['id']."' class='btn btn-default btn-sm' title='Voir le DPS'>Voir le DPS ".$cu_full."</a>
					<a href='dps-list-view.php' class='btn btn-primary btn-sm' title='Retour à la liste'>Retour à la liste</a>
					<a href='dps-create.php?city=".$section."' class='btn btn-info btn-sm' title='Créer un autre DPS'>Créer un autre DPS</a>";
				} else {
						$genericError = "Erreur pendant la création du DPS ".$event_name." (".$cu_full.") " . $db_link->error;
				}
			}
		}
		else {
			// There are errors, do nothing
		}
}

?>
