<?php require('functions/dps/dps-compute-variables.php'); ?>

<?php

	if (isset($_POST['edit'])) {

		require('functions/dps/dps-error-handling.php');

		if (isNullOrEmpty($genericError)){
			// Update

			$sql = "UPDATE $tablename_dps SET
				section='".mysqli_real_escape_string($db_link, $section)."',
				cu_full='".mysqli_real_escape_string($db_link, $cu_full)."',
				cu_year='".mysqli_real_escape_string($db_link, $cu_year)."',
				cu_yearly_index='".mysqli_real_escape_string($db_link, $cu_yearly_index)."',
				client_name='".mysqli_real_escape_string($db_link, $client_name)."',
				client_represent='".mysqli_real_escape_string($db_link, $client_represent)."',
				client_title='".mysqli_real_escape_string($db_link, $client_title)."',
				client_address='".mysqli_real_escape_string($db_link, $client_address)."',
				client_phone='".mysqli_real_escape_string($db_link, $client_phone)."',
				client_fax='".mysqli_real_escape_string($db_link, $client_fax)."',
				client_email='".mysqli_real_escape_string($db_link, $client_email)."',
				event_name='".mysqli_real_escape_string($db_link, $event_name)."',
				event_description='".mysqli_real_escape_string($db_link, $event_description)."',
				event_address='".mysqli_real_escape_string($db_link, $event_address)."',
				event_department='".mysqli_real_escape_string($db_link, $event_department)."',
				event_begin_date='".formatDateFrToUs($event_begin_date)."',
				event_begin_time='".formatTimeRemoveDoubleDot($event_begin_time)."',
				event_end_date='".formatDateFrToUs($event_end_date)."',
				event_end_time='".formatTimeRemoveDoubleDot($event_end_time)."',
				event_pref_secu='".mysqli_real_escape_string($db_link, $event_pref_secu)."',
				ris_p1_public='".mysqli_real_escape_string($db_link, $ris_p1_public)."',
				ris_p1_actors='".mysqli_real_escape_string($db_link, $ris_p1_actors)."',
				ris_p2='".mysqli_real_escape_string($db_link, $ris_p2)."',
				ris_e1='".mysqli_real_escape_string($db_link, $ris_e1)."',
				ris_e2='".mysqli_real_escape_string($db_link, $ris_e2)."',
				ris_comment='".mysqli_real_escape_string($db_link, $ris_comment)."',
				dps_type='".mysqli_real_escape_string($db_link, $dps_type)."',
				dps_begin_date='".formatDateFrToUs($dps_begin_date)."',
				dps_begin_time='".formatTimeRemoveDoubleDot($dps_begin_time)."',
				dps_end_date='".formatDateFrToUs($dps_end_date)."',
				dps_end_time='".formatTimeRemoveDoubleDot($dps_end_time)."',
				dps_nb_ce='".mysqli_real_escape_string($db_link, $dps_nb_ce)."',
				dps_nb_pse2='".mysqli_real_escape_string($db_link, $dps_nb_pse2)."',
				dps_nb_pse1='".mysqli_real_escape_string($db_link, $dps_nb_pse1)."',
				dps_nb_psc1='".mysqli_real_escape_string($db_link, $dps_nb_psc1)."',
				dps_nb_lot_a='".mysqli_real_escape_string($db_link, $dps_nb_lot_a)."',
				dps_nb_lot_b='".mysqli_real_escape_string($db_link, $dps_nb_lot_b)."',
				dps_nb_lot_c='".mysqli_real_escape_string($db_link, $dps_nb_lot_c)."',
				dps_nb_dae='".mysqli_real_escape_string($db_link, $dps_nb_dae)."',
				dps_nb_vpsp_transp='".mysqli_real_escape_string($db_link, $dps_nb_vpsp_transp)."',
				dps_nb_vpsp_soin='".mysqli_real_escape_string($db_link, $dps_nb_vpsp_soin)."',
				dps_nb_vtu='".mysqli_real_escape_string($db_link, $dps_nb_vtu)."',
				dps_nb_tente='".mysqli_real_escape_string($db_link, $dps_nb_tente)."',
				dps_nb_med_asso='".mysqli_real_escape_string($db_link, $dps_nb_med_asso)."',
				dps_nb_inf_asso='".mysqli_real_escape_string($db_link, $dps_nb_inf_asso)."',
				dps_other_matos_asso='".mysqli_real_escape_string($db_link, $dps_other_matos_asso)."',
				clientmatos_infirmerie='".mysqli_real_escape_string($db_link, $clientmatos_infirmerie)."',
				clientmatos_tente='".mysqli_real_escape_string($db_link, $clientmatos_tente)."',
				clientmatos_other='".mysqli_real_escape_string($db_link, $clientmatos_other)."',
				medicalext_nb_med='".mysqli_real_escape_string($db_link, $medicalext_nb_med)."',
				medicalext_med_company= '".mysqli_real_escape_string($db_link, $medicalext_med_company)."',
				medicalext_nb_inf='".mysqli_real_escape_string($db_link, $medicalext_nb_inf)."',
				medicalext_inf_company='".mysqli_real_escape_string($db_link, $medicalext_inf_company)."',
				samu='".mysqli_real_escape_string($db_link, $samu)."',
				bspp='".mysqli_real_escape_string($db_link, $bspp)."',
				price='".mysqli_real_escape_string($db_link, $price)."',
				cu_yearly_index='".mysqli_real_escape_string($db_link, $cu_yearly_index)."',
				dps_justification='".mysqli_real_escape_string($db_link, $dps_justification)."',
				status='".mysqli_real_escape_string($db_link, $status)."',
				eprotec_number='".mysqli_real_escape_string($db_link, $eprotec_number)."',
				status_justification='".mysqli_real_escape_string($db_link, $status_justification)."'
				WHERE id=$id" or die("Impossible de modifier le DPS dans la base de données" . mysqli_error($db_link));

			if ($db_link->query($sql) === TRUE) {
				$genericSuccess = "Dispositif de Secours mis à jour.
				<a href='dps-list.php' class='btn btn-primary btn-sm' title='Retour à la liste'>Retour à la liste</a>";
			}
			else {
				$genericError = "Erreur pendant la création du DPS ".htmlentities($event_name)." (".htmlentities($cu_full).") " . $db_link->error;
			}
		}
		else {
			// There are errors, do nothing
		}
}

?>
