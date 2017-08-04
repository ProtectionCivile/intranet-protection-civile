<?php require('functions/dps/dps-compute-variables.php'); ?>

<?php

	if (isset($_POST['edit'])) {

		require('functions/dps/dps-error-handling.php');

		if (isNullOrEmpty($genericError)){
			// Update

			$sql = "UPDATE $tablename_dps SET
				section='$section',
				cu_full='$cu_full',
				cu_year='$cu_year',
				cu_yearly_index='$cu_yearly_index',
				client_name='".mysqli_escape_string($db_link, $client_name)."',
				client_represent='".mysqli_escape_string($db_link, $client_represent)."',
				client_title='".mysqli_escape_string($db_link, $client_title)."',
				client_address='".mysqli_escape_string($db_link, $client_address)."',
				client_phone='$client_phone',
				client_fax='$client_fax',
				client_email='$client_email',
				event_name='".mysqli_escape_string($db_link, $event_name)."',
				event_description='".mysqli_escape_string($db_link, $event_description)."',
				event_address='".mysqli_escape_string($db_link, $event_address)."',
				event_department='".mysqli_escape_string($db_link, $event_department)."',
				event_begin_date='".formatDateFrToUs($event_begin_date)."',
				event_begin_time='".formatTimeRemoveDoubleDot($event_begin_time)."',
				event_end_date='".formatDateFrToUs($event_end_date)."',
				event_end_time='".formatTimeRemoveDoubleDot($event_end_time)."',
				event_pref_secu='$event_pref_secu',
				ris_p1_public='$ris_p1_public',
				ris_p1_actors='$ris_p1_actors',
				ris_p2='$ris_p2',
				ris_e1='$ris_e1',
				ris_e2='$ris_e2',
				ris_override='$ris_override',
				ris_comment='".mysqli_escape_string($db_link, $ris_comment)."',
				dps_type='$dps_type',
				dps_begin_date='".formatDateFrToUs($dps_begin_date)."',
				dps_begin_time='".formatTimeRemoveDoubleDot($dps_begin_time)."',
				dps_end_date='".formatDateFrToUs($dps_end_date)."',
				dps_end_time='".formatTimeRemoveDoubleDot($dps_end_time)."',
				dps_nb_ce='$dps_nb_ce',
				dps_nb_pse2='$dps_nb_pse2',
				dps_nb_pse1='$dps_nb_pse1',
				dps_nb_psc1='$dps_nb_psc1',
				dps_nb_lot_a='$dps_nb_lot_a',
				dps_nb_lot_b='$dps_nb_lot_b',
				dps_nb_lot_c='$dps_nb_lot_c',
				dps_nb_dae='$dps_nb_dae',
				dps_nb_vpsp_transp='$dps_nb_vpsp_transp',
				dps_nb_vpsp_soin='$dps_nb_vpsp_soin',
				dps_nb_vtu='$dps_nb_vtu',
				dps_nb_tente='$dps_nb_tente',
				dps_nb_med_asso='$dps_nb_med_asso',
				dps_nb_inf_asso='$dps_nb_inf_asso',
				dps_other_matos_asso='".mysqli_escape_string($db_link, $dps_other_matos_asso)."',
				clientmatos_infirmerie='$clientmatos_infirmerie',
				clientmatos_tente='$clientmatos_tente',
				clientmatos_other='".mysqli_escape_string($db_link, $clientmatos_other)."',
				medicalext_nb_med='$medicalext_nb_med',
				medicalext_med_company= '".mysqli_escape_string($db_link, $medicalext_med_company)."',
				medicalext_nb_inf='$medicalext_nb_inf',
				medicalext_inf_company='".mysqli_escape_string($db_link, $medicalext_inf_company)."',
				samu='$samu',
				bspp='$bspp',
				price='$price',
				cu_yearly_index='$cu_yearly_index',
				dps_justification='".mysqli_escape_string($db_link, $dps_justification)."',
				status='$status',
				status_justification='".mysqli_escape_string($db_link, $status_justification)."'
				WHERE id=$id" or die("Impossible de modifier le DPS dans la base de données" . mysqli_error($db_link));

			if ($db_link->query($sql) === TRUE) {
				$genericSuccess = "Dispositif de Secours mis à jour.
				<a href='dps-list-view.php' class='btn btn-primary btn-sm' title='Retour à la liste'>Retour à la liste</a>";
			}
			else {
				$genericError = "Erreur pendant la création du DPS ".$event_name." (".$cu_full.") " . $db_link->error;
			}
		}
		else {
			// There are errors, do nothing
		}
}

?>
