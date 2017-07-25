<?php require('functions/dps/dps-compute-variables.php'); ?>

<?php

	$missingValues = 0;

	include('functions/dps/dps-compute-next-available-cu.php');

	if (isset($_POST['create'])) {
		$cu_full = $_POST['cu_full'];
		$today = date("Y-m-d");

		if(isNullOrEmpty($client_name)){
			$missingValues++;
			$client_name_error = "Le nom de l'organisateur est obligatoire";
		}
		if(isNullOrEmpty($client_represent)){
			$missingValues++;
			$client_represent_error = "Le représentant légal de la structure est obligatoire";
		}
		if(isNullOrEmpty($client_title)){
			$missingValues++;
			$client_title_error = "La fonction du représentant légal est obligatoire";
		}
		if(isNullOrEmpty($client_address)){
			$missingValues++;
			$client_address_error = "L'adresse de la structure organisatrice est obligatoire";
		}
		if(isNullOrEmpty($client_phone)){
			$missingValues++;
			$client_phone_error = "Le téléphone de l'organisateur est obligatoire";
		}
		if(isNullOrEmpty($client_fax)){
			//C'est pas grave
		}
		if(isNullOrEmpty($client_email)){
			$missingValues++;
			$client_email_error = "L'adresse mail de l'organisateur est obligatoire";
		}


		if(isNullOrEmpty($event_name)){
			$missingValues++;
			$event_name_error = "Le nom de l'évènement est obligatoire";
		}
		if(isNullOrEmpty($event_description)){
			$missingValues++;
			$event_description_error = "Le descriptif de l'activité du rassemblement est obligatoire";
		}
		if(isNullOrEmpty($event_address)){
			$missingValues++;
			$event_address_error = "L'adresse exacte de la manifestation est obligatoire";
		}
		if(isNullOrEmpty($event_department)){
			$missingValues++;
			$event_department_error = "Le département de la manifestation est obligatoire";
		}
		if(isNullOrEmpty($event_begin_date)){
			$missingValues++;
			$event_begin_date_error = "La date de début de manifestation est obligatoire";
		}
		if(isNullOrEmpty($event_begin_time)){
			$missingValues++;
			$event_begin_time_error = "L'heure de début de manifestation est obligatoire";
		}
		if(isNullOrEmpty($event_end_date)){
			$missingValues++;
			$event_end_date_error = "La date de fin de manifestation est obligatoire";
		}
		if(isNullOrEmpty($event_end_time)){
			$missingValues++;
			$event_end_time_error = "L'heure de fin de manifestation est obligatoire";
		}
		if(isNullOrEmpty($event_pref_secu)){
			$event_pref_secu = "0";
		}


		if(isNullOrEmpty($ris_p1_public)){
			$missingValues++;
			$ris_p1_public_error = "Le nombre de spectateurs est obligatoire pour le calcul du RIS";
		}
		if(isNullOrEmpty($ris_p1_actors)){
			$missingValues++;
			$ris_p1_actors_error = "Le nombre de participants est obligatoire pour le calcul du RIS";
		}
		if(isNullOrEmpty($ris_p2)){
			$missingValues++;
			$ris_p2_error = "La typologie du public est obligatoire pour le calcul du RIS";
		}
		if(isNullOrEmpty($ris_e1)){
			$missingValues++;
			$ris_e1_error = "Les risques environnementaux sont obligatoires pour le calcul du RIS";
		}
		if(isNullOrEmpty($ris_e2)){
			$missingValues++;
			$ris_e2_error = "Le délai d'intervention des secours publics est obligatoire pour le calcul du RIS";
		}
		if(isNullOrEmpty($ris_comment)){
			//$ris_comment_error = "Pas d'erreur";
		}


		if(isNullOrEmpty($dps_begin_date)){
			$missingValues++;
			$dps_begin_date_error = "La date de mise en place du poste de secours est obligatoire";
		}
		if(isNullOrEmpty($dps_begin_time)){
			$missingValues++;
			$dps_begin_time_error = "L'heure de mise en place du poste de secours est obligatoire";
		}
		if(isNullOrEmpty($dps_end_date)){
			$missingValues++;
			$dps_end_date_error = "La date de levée du dispositif de secours est obligatoire";
		}
		if(isNullOrEmpty($dps_end_time)){
			$missingValues++;
			$dps_end_time_error = "L'heure de levée du dispositif de secours est obligatoire";
		}


		if(isNullOrEmpty($dps_nb_ce)){
			$missingValues++;
			// $dps_nb_ce = "0";
			$dps_nb_ce_error = "Merci d'indiquer le nombre de CE / CP...";
		}
		if(isNullOrEmpty($dps_nb_pse2)){
			$missingValues++;
			// $nb_pse2 = "0";
			$dps_nb_pse2_error = "Merci d'indiquer le nombre de PSE-2";
		}
		if(isNullOrEmpty($dps_nb_pse1)){
			$missingValues++;
			// $nb_pse1 = "0";
			$dps_nb_pse1_error = "Merci d'indiquer le nombre de PSE-1";
		}
		if(isNullOrEmpty($dps_nb_psc1)){
		 	$dps_nb_psc1 = "0";
		}
		if(isNullOrEmpty($dps_nb_lot_a)){
			$missingValues++;
			$dps_nb_lot_a_error = "Merci d'indiquer le nombre de lots A";
		}
		if(isNullOrEmpty($dps_nb_lot_b)){
			$missingValues++;
			$dps_nb_lot_b_error = "Merci d'indiquer le nombre de lots B";
		}
		if(isNullOrEmpty($dps_nb_lot_c)){
			$missingValues++;
			$dps_nb_lot_c_error = "Merci d'indiquer le nombre de lots C";
		}
		if(isNullOrEmpty($dps_nb_dae)){
		 $missingValues++;
			$dps_nb_dae_error = "Merci d'indiquer le nombre de défibrillateurs";
		}
		if(isNullOrEmpty($dps_nb_vpsp_transp)){
			$missingValues++;
			// $vpsp_transport = "0";
			$dps_nb_vpsp_transp_error = "Merci d'indiquer le nombre de VPSP assurant les évacuations";
		}
		if(isNullOrEmpty($dps_nb_vpsp_soin)){
			$missingValues++;
			// $vpsp_soin = "0";
			$dps_nb_vpsp_soin_error = "Merci d'indiquer le nombre de VPSP en poste de soins";
		}
		if(isNullOrEmpty($dps_nb_vtu)){
			$missingValues++;
			// $vl = "0";
			$dps_nb_vtu_error = "Merci d'indiquer le nombre d'autres véhicules prévus";
		}
		if(isNullOrEmpty($dps_nb_tente)){
			$missingValues++;
			// $tente = "0";
			$dps_nb_tente_error = "Merci d'indiquer le nombre de tentes";
		}
		if(isNullOrEmpty($dps_nb_med_asso)){
			$dps_nb_med_asso = "0";
		}
		if(isNullOrEmpty($dps_nb_inf_asso)){
			$dps_nb_inf_asso = "0";
		}
		if(isNullOrEmpty($dps_other_matos_asso)){
			// Nothing
		}


		if(isNullOrEmpty($clientmatos_infirmerie)){
			$clientmatos_infirmerie = "0";
		}
		if(isNullOrEmpty($clientmatos_tente)){
			$clientmatos_tente = "0";
		}
		if(isNullOrEmpty($clientmatos_other)){
			// Nothing
		}


		if(isNullOrEmpty($medicalext_nb_med)){
			$medicalext_nb_med = "0";
		}
		if(isNullOrEmpty($medicalext_med_company)){
			// Nothing
		}
		if(isNullOrEmpty($medicalext_nb_inf)){
			$missingValues++;
			$medicalext_nb_inf = "0";
		}
		if(isNullOrEmpty($medicalext_inf_company)){
			// Nothing
		}
		if(isNullOrEmpty($samu)){
			$samu = "1";
		}
		if(isNullOrEmpty($bspp)){
			$bspp = '0';
		}

		if(isNullOrEmpty($price)){
			$missingValues++;
			$price_error = "Le prix de la prestation est obligatoire";
		}
		if(isNullOrEmpty($dps_justification)){
			// Nothing
		}


		if ($missingValues != "0" ) {
			if (!isNullOrEmpty($genericError)){
				$genericError = $genericError.'<br />';
			}
				$genericError = $genericError.'Il y a '.$missingValues.' champs non-renseignés';
		}

		if(isNullOrEmpty($cu_year)){
			if (!isNullOrEmpty($genericError)){
				$genericError = $genericError.'<br />';
			}
			$genericError = $genericError."L'année est obligatoire";
		}
		if(isNullOrEmpty($section)){
			if (!isNullOrEmpty($genericError)){
				$genericError = $genericError.'<br />';
			}
			$genericError = $genericError."La commune est obligatoire";
		}

		if(isNullOrEmpty($dps_type)){
			if (!isNullOrEmpty($genericError)){
				$genericError = $genericError.'<br />';
			}
			$genericError = $genericError."Le type de DPS est obligatoire";
		}

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
					ris_p1_public, ris_p1_actors, ris_p2, ris_e1, ris_e2, ris_override, ris_comment,
					dps_type, dps_begin_date, dps_begin_time, dps_end_date, dps_end_time, dps_nb_ce, dps_nb_pse2, dps_nb_pse1, dps_nb_psc1, dps_nb_lot_a, dps_nb_lot_b, dps_nb_lot_c, dps_nb_dae, dps_nb_vpsp_transp, dps_nb_vpsp_soin, dps_nb_vtu, dps_nb_tente, dps_nb_med_asso, dps_nb_inf_asso, dps_other_matos_asso,
					clientmatos_infirmerie, clientmatos_tente, clientmatos_other,
					medicalext_nb_med, medicalext_med_company, medicalext_nb_inf, medicalext_inf_company, samu, bspp,
					price, dps_justification, status, status_justification, status_creation_date) VALUES
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
					'$ris_p1_public', '$ris_p1_actors', '$ris_p2', '$ris_e1', '$ris_e2', '$ris_override',
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
					'$status',
					'".mysqli_escape_string($db_link, $status_justification)."',
					'$today')" or die("Impossible d'ajouter le DPS dans la base de données" . mysqli_error($db_link));


				if ($db_link->query($sql) === TRUE) {
					$sql = "SELECT id FROM $tablename_dps WHERE cu_full='$cu_full'";
					$query = mysqli_query($db_link, $sql);
					$found_dps = mysqli_fetch_assoc($query);

					$genericSuccess = "Dispositif de Secours créé.
					<a href='dps-edit.php?id=".$found_dps['id']."' class='btn btn-default btn-sm' title='Voir le DPS'>Voir le DPS ".$cu_full."</a>
					<a href='dps-list-view.php' class='btn btn-primary btn-sm' title='Retour à la liste'>Retour à la liste</a>
					<a href='dps-create.php?city=".$section."' class='btn btn-info btn-sm' title='Créer un autre DPS'>Créer un autre DPS</a>";
				} else {
						$genericError = "Erreur pendant la création du DPS ".$event_name." (".$cu_full.") " . $db_link->error;
				}
			}
		}
		else {
			echo "Tant quil y a des erreurs on ne crée pas TODO A SUPPRIMER";
		}
}

?>
