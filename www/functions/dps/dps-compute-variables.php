<?php
	require_once('components/dps/dps-init-variables-module.php');

	// $dept = $_POST['departement'];
	// $cu_year = $_POST['cu_year'];
	if (isset($_POST['cu_full'])) { $cu_full = $_POST['cu_full']; }
	if (isset($_POST['section'])) { $section = $_POST['section']; }

	// Organisateur
	if (isset($duplicated_dps_array['client_name'])) { $client_name = $duplicated_dps_array['client_name']; }
	elseif (isset($client_array['name'])) { $client_name = $client_array['name']; }
	elseif (isset($_POST['client_name'])) { $client_name = $_POST['client_name']; }
	else { $client_name = $dps['client_name']; }

	if (isset($duplicated_dps_array['client_represent'])) { $client_represent = $duplicated_dps_array['client_represent']; }
	elseif (isset($client_array['represent'])) { $client_represent = $client_array['represent']; }
	elseif (isset($_POST['client_represent'])) { $client_represent = $_POST['client_represent']; }
	else { $client_represent = $dps['client_represent']; }

	if (isset($duplicated_dps_array['client_title'])) { $client_title = $duplicated_dps_array['client_title']; }
	elseif (isset($client_array['title'])) { $client_title = $client_array['title']; }
	elseif (isset($_POST['client_title'])) { $client_title = $_POST['client_title']; }
	else { $client_title = $dps['client_title']; }

	if (isset($duplicated_dps_array['client_address'])) { $client_address = $duplicated_dps_array['client_address']; }
	elseif (isset($client_array['address'])) { $client_address = $client_array['address']; }
	elseif (isset($_POST['client_address'])) { $client_address = $_POST['client_address']; }
	else { $client_address = $dps['client_address']; }

	if (isset($duplicated_dps_array['client_phone'])) { $client_phone = $duplicated_dps_array['client_phone']; }
	elseif (isset($client_array['phone'])) { $client_phone = $client_array['phone']; }
	elseif (isset($_POST['client_phone'])) { $client_phone = $_POST['client_phone']; }
	else { $client_phone = $dps['client_phone']; }

	if (isset($duplicated_dps_array['client_fax'])) { $client_fax = $duplicated_dps_array['client_fax']; }
	elseif (isset($client_array['fax'])) { $client_fax = $client_array['fax']; }
	elseif (isset($_POST['client_fax'])) { $client_fax = $_POST['client_fax']; }
	else { $client_fax = $dps['client_fax']; }

	if (isset($duplicated_dps_array['client_email'])) { $client_email = $duplicated_dps_array['client_email']; }
	elseif (isset($client_array['mail'])) { $client_email = $client_array['mail']; }
	elseif (isset($_POST['client_email'])) { $client_email = $_POST['client_email']; }
	else { $client_email = $dps['client_email']; }



	// Evenement
	if (isset($duplicated_dps_array['event_name'])) { $event_name = $duplicated_dps_array['event_name']; }
	elseif (isset($_POST['event_name'])) { $event_name = $_POST['event_name']; }
	else { $event_name = $dps['event_name']; }

	if (isset($duplicated_dps_array['event_description'])) { $event_description = $duplicated_dps_array['event_description']; }
	elseif (isset($_POST['event_description'])) { $event_description = $_POST['event_description']; }
	else { $event_description = $dps['event_description']; }

	if (isset($duplicated_dps_array['event_address'])) { $event_address = $duplicated_dps_array['event_address']; }
	elseif (isset($_POST['event_address'])) { $event_address = $_POST['event_address']; }
	else { $event_address = $dps['event_address']; }

	if (isset($duplicated_dps_array['event_department'])) { $event_department = $duplicated_dps_array['event_department']; }
	elseif (isset($_POST['event_department'])) { $event_department = $_POST['event_department']; }
	else { $event_department = $dps['event_department']; }

	if (isset($duplicated_dps_array['event_begin_date'])) { $event_begin_date = formatDateUsToFr($duplicated_dps_array['event_begin_date']); }
	elseif (isset($_POST['event_begin_date'])) { $event_begin_date = $_POST['event_begin_date']; }
	else { $event_begin_date = formatDateUsToFr($dps['event_begin_date']); }

	if (isset($duplicated_dps_array['event_begin_time'])) { $event_begin_time = $duplicated_dps_array['event_begin_time']; }
	elseif (isset($_POST['event_begin_time'])) { $event_begin_time = $_POST['event_begin_time']; }
	else { $event_begin_time = $dps['event_begin_time']; }

	if (isset($duplicated_dps_array['event_end_date'])) { $event_end_date = formatDateUsToFr($duplicated_dps_array['event_end_date']); }
	elseif (isset($_POST['event_end_date'])) { $event_end_date = $_POST['event_end_date']; }
	else { $event_end_date = formatDateUsToFr($dps['event_end_date']); }

	if (isset($duplicated_dps_array['event_end_time'])) { $event_end_time = $duplicated_dps_array['event_end_time']; }
	elseif (isset($_POST['event_end_time'])) { $event_end_time = $_POST['event_end_time']; }
	else { $event_end_time = $dps['event_end_time']; }

	if (isset($duplicated_dps_array['event_pref_secu'])) { $event_pref_secu = $duplicated_dps_array['event_pref_secu']; }
	elseif (isset($_POST['event_pref_secu'])) { $event_pref_secu = $_POST['event_pref_secu']; }
	else { $event_pref_secu = $dps['event_pref_secu']; }


	// RIS
	if (isset($duplicated_dps_array['ris_p1_public'])) { $ris_p1_public = $duplicated_dps_array['ris_p1_public']; }
	elseif (isset($_POST['ris_p1_public'])) { $ris_p1_public = $_POST['ris_p1_public']; }
	else { $ris_p1_public = $dps['ris_p1_public']; }

	if (isset($duplicated_dps_array['ris_p1_actors'])) { $ris_p1_actors = $duplicated_dps_array['ris_p1_actors']; }
	elseif (isset($_POST['ris_p1_actors'])) { $ris_p1_actors = $_POST['ris_p1_actors']; }
	else { $ris_p1_actors = $dps['ris_p1_actors']; }

	if (isset($duplicated_dps_array['ris_p2'])) { $ris_p2 = $duplicated_dps_array['ris_p2']; }
	elseif (isset($_POST['ris_p2'])) { $ris_p2 = $_POST['ris_p2']; }
	else { $ris_p2 = $dps['ris_p2']; }

	if (isset($duplicated_dps_array['ris_e1'])) { $ris_e1 = $duplicated_dps_array['ris_e1']; }
	elseif (isset($_POST['ris_e1'])) { $ris_e1 = $_POST['ris_e1']; }
	else { $ris_e1 = $dps['ris_e1']; }

	if (isset($duplicated_dps_array['ris_e2'])) { $ris_e2 = $duplicated_dps_array['ris_e2']; }
	elseif (isset($_POST['ris_e2'])) { $ris_e2 = $_POST['ris_e2']; }
	else { $ris_e2 = $dps['ris_e2']; }

	if (isset($duplicated_dps_array['ris_comment'])) { $ris_comment = $duplicated_dps_array['ris_comment']; }
	elseif (isset($_POST['ris_comment'])) { $ris_comment = $_POST['ris_comment']; }
	else { $ris_comment = $dps['ris_comment']; }


	// Horaires du dispositif
	if (isset($duplicated_dps_array['dps_begin_date'])) { $dps_begin_date = formatDateUsToFr($duplicated_dps_array['dps_begin_date']); }
	elseif (isset($_POST['dps_begin_date'])) { $dps_begin_date = $_POST['dps_begin_date']; }
	else { $dps_begin_date = formatDateUsToFr($dps['dps_begin_date']); }

	if (isset($duplicated_dps_array['dps_begin_time'])) { $dps_begin_time = $duplicated_dps_array['dps_begin_time']; }
	elseif (isset($_POST['dps_begin_time'])) { $dps_begin_time = $_POST['dps_begin_time']; }
	else { $dps_begin_time = $dps['dps_begin_time']; }

	if (isset($duplicated_dps_array['dps_end_date'])) { $dps_end_date = formatDateUsToFr($duplicated_dps_array['dps_end_date']); }
	elseif (isset($_POST['dps_end_date'])) { $dps_end_date = $_POST['dps_end_date']; }
	else { $dps_end_date = formatDateUsToFr($dps['dps_end_date']); }

	if (isset($duplicated_dps_array['dps_end_time'])) { $dps_end_time = $duplicated_dps_array['dps_end_time']; }
	elseif (isset($_POST['dps_end_time'])) { $dps_end_time = $_POST['dps_end_time']; }
	else { $dps_end_time = $dps['dps_end_time']; }


	// DPS
	if (isset($duplicated_dps_array['dps_nb_ce'])) { $dps_nb_ce = $duplicated_dps_array['dps_nb_ce']; }
	elseif (isset($_POST['dps_nb_ce'])) { $dps_nb_ce = $_POST['dps_nb_ce']; }
	else { $dps_nb_ce = $dps['dps_nb_ce']; }

	if (isset($duplicated_dps_array['dps_nb_pse2'])) { $dps_nb_pse2 = $duplicated_dps_array['dps_nb_pse2']; }
	elseif (isset($_POST['dps_nb_pse2'])) { $dps_nb_pse2 = $_POST['dps_nb_pse2']; }
	else { $dps_nb_pse2 = $dps['dps_nb_pse2']; }

	if (isset($duplicated_dps_array['dps_nb_pse1'])) { $dps_nb_pse1 = $duplicated_dps_array['dps_nb_pse1']; }
	elseif (isset($_POST['dps_nb_pse1'])) { $dps_nb_pse1 = $_POST['dps_nb_pse1']; }
	else { $dps_nb_pse1 = $dps['dps_nb_pse1']; }

	if (isset($duplicated_dps_array['dps_nb_psc1'])) { $dps_nb_psc1 = $duplicated_dps_array['dps_nb_psc1']; }
	elseif (isset($_POST['dps_nb_psc1'])) { $dps_nb_psc1 = $_POST['dps_nb_psc1']; }
	else { $dps_nb_psc1 = $dps['dps_nb_psc1']; }

	if (isset($duplicated_dps_array['dps_nb_vpsp_transp'])) { $dps_nb_vpsp_transp = $duplicated_dps_array['dps_nb_vpsp_transp']; }
	elseif (isset($_POST['dps_nb_vpsp_transp'])) { $dps_nb_vpsp_transp = $_POST['dps_nb_vpsp_transp']; }
	else { $dps_nb_vpsp_transp = $dps['dps_nb_vpsp_transp']; }

	if (isset($duplicated_dps_array['dps_nb_vpsp_soin'])) { $dps_nb_vpsp_soin = $duplicated_dps_array['dps_nb_vpsp_soin']; }
	elseif (isset($_POST['dps_nb_vpsp_soin'])) { $dps_nb_vpsp_soin = $_POST['dps_nb_vpsp_soin']; }
	else { $dps_nb_vpsp_soin = $dps['dps_nb_vpsp_soin']; }

	if (isset($duplicated_dps_array['dps_nb_vtu'])) { $dps_nb_vtu = $duplicated_dps_array['dps_nb_vtu']; }
	elseif (isset($_POST['dps_nb_vtu'])) { $dps_nb_vtu = $_POST['dps_nb_vtu']; }
	else { $dps_nb_vtu = $dps['dps_nb_vtu']; }

	if (isset($duplicated_dps_array['dps_nb_tente'])) { $dps_nb_tente = $duplicated_dps_array['dps_nb_tente']; }
	elseif (isset($_POST['dps_nb_tente'])) { $dps_nb_tente = $_POST['dps_nb_tente']; }
	else { $dps_nb_tente = $dps['dps_nb_tente']; }

	if (isset($duplicated_dps_array['dps_nb_med_asso'])) { $dps_nb_med_asso = $duplicated_dps_array['dps_nb_med_asso']; }
	elseif (isset($_POST['dps_nb_med_asso'])) { $dps_nb_med_asso = $_POST['dps_nb_med_asso']; }
	else { $dps_nb_med_asso = $dps['dps_nb_med_asso']; }

	if (isset($duplicated_dps_array['dps_nb_inf_asso'])) { $dps_nb_inf_asso = $duplicated_dps_array['dps_nb_inf_asso']; }
	elseif (isset($_POST['dps_nb_inf_asso'])) { $dps_nb_inf_asso = $_POST['dps_nb_inf_asso']; }
	else { $dps_nb_inf_asso = $dps['dps_nb_inf_asso']; }

	if (isset($duplicated_dps_array['dps_nb_lot_a'])) { $dps_nb_lot_a = $duplicated_dps_array['dps_nb_lot_a']; }
	elseif (isset($_POST['dps_nb_lot_a'])) { $dps_nb_lot_a = $_POST['dps_nb_lot_a']; }
	else { $dps_nb_lot_a = $dps['dps_nb_lot_a']; }

	if (isset($duplicated_dps_array['dps_nb_lot_b'])) { $dps_nb_lot_b = $duplicated_dps_array['dps_nb_lot_b']; }
	elseif (isset($_POST['dps_nb_lot_b'])) { $dps_nb_lot_b = $_POST['dps_nb_lot_b']; }
	else { $dps_nb_lot_b = $dps['dps_nb_lot_b']; }

	if (isset($duplicated_dps_array['dps_nb_lot_c'])) { $dps_nb_lot_c = $duplicated_dps_array['dps_nb_lot_c']; }
	elseif (isset($_POST['dps_nb_lot_c'])) { $dps_nb_lot_c = $_POST['dps_nb_lot_c']; }
	else { $dps_nb_lot_c = $dps['dps_nb_lot_c']; }

	if (isset($duplicated_dps_array['dps_nb_dae'])) { $dps_nb_dae = $duplicated_dps_array['dps_nb_dae']; }
	elseif (isset($_POST['dps_nb_dae'])) { $dps_nb_dae = $_POST['dps_nb_dae']; }
	else { $dps_nb_dae = $dps['dps_nb_dae']; }

	if (isset($duplicated_dps_array['dps_other_matos_asso'])) { $dps_other_matos_asso = $duplicated_dps_array['dps_other_matos_asso']; }
	elseif (isset($_POST['dps_other_matos_asso'])) { $dps_other_matos_asso = $_POST['dps_other_matos_asso']; }
	else { $dps_other_matos_asso = $dps['dps_other_matos_asso']; }

	if (isset($duplicated_dps_array['clientmatos_infirmerie'])) { $clientmatos_infirmerie = $duplicated_dps_array['clientmatos_infirmerie']; }
	elseif (isset($_POST['clientmatos_infirmerie'])) { $clientmatos_infirmerie = $_POST['clientmatos_infirmerie']; }
	else { $clientmatos_infirmerie = $dps['clientmatos_infirmerie']; }

	if (isset($duplicated_dps_array['clientmatos_tente'])) { $clientmatos_tente = $duplicated_dps_array['clientmatos_tente']; }
	elseif (isset($_POST['clientmatos_tente'])) { $clientmatos_tente = $_POST['clientmatos_tente']; }
	else { $clientmatos_tente = $dps['clientmatos_tente']; }

	if (isset($duplicated_dps_array['clientmatos_other'])) { $clientmatos_other = $duplicated_dps_array['clientmatos_other']; }
	elseif (isset($_POST['clientmatos_other'])) { $clientmatos_other = $_POST['clientmatos_other']; }
	else { $clientmatos_other = $dps['clientmatos_other']; }

	if (isset($duplicated_dps_array['medicalext_nb_med'])) { $medicalext_nb_med = $duplicated_dps_array['medicalext_nb_med']; }
	elseif (isset($_POST['medicalext_nb_med'])) { $medicalext_nb_med = $_POST['medicalext_nb_med']; }
	else { $medicalext_nb_med = $dps['medicalext_nb_med']; }

	if (isset($duplicated_dps_array['medicalext_med_company'])) { $medicalext_med_company = $duplicated_dps_array['medicalext_med_company']; }
	elseif (isset($_POST['medicalext_med_company'])) { $medicalext_med_company = $_POST['medicalext_med_company']; }
	else { $medicalext_med_company = $dps['medicalext_med_company']; }

	if (isset($duplicated_dps_array['medicalext_nb_inf'])) { $medicalext_nb_inf = $duplicated_dps_array['medicalext_nb_inf']; }
	elseif (isset($_POST['medicalext_nb_inf'])) { $medicalext_nb_inf = $_POST['medicalext_nb_inf']; }
	else { $medicalext_nb_inf = $dps['medicalext_nb_inf']; }

	if (isset($duplicated_dps_array['medicalext_inf_company'])) { $medicalext_inf_company = $duplicated_dps_array['medicalext_inf_company']; }
	elseif (isset($_POST['medicalext_inf_company'])) { $medicalext_inf_company = $_POST['medicalext_inf_company']; }
	else { $medicalext_inf_company = $dps['medicalext_inf_company']; }

	if (isset($duplicated_dps_array['samu'])) { $samu = $duplicated_dps_array['samu']; }
	elseif (isset($_POST['samu'])) { $samu = $_POST['samu']; }
	else { $samu = $dps['samu']; }

	if (isset($duplicated_dps_array['bspp'])) { $bspp = $duplicated_dps_array['bspp']; }
	elseif (isset($_POST['bspp'])) { $bspp = $_POST['bspp']; }
	else { $bspp = $dps['bspp']; }

	if (isset($duplicated_dps_array['price'])) { $price = $duplicated_dps_array['price']; }
	elseif (isset($_POST['price'])) { $price = $_POST['price']; }
	else { $price = $dps['price']; }

	if (isset($duplicated_dps_array['dps_justification'])) { $dps_justification = $duplicated_dps_array['dps_justification']; }
	elseif (isset($_POST['dps_justification'])) { $dps_justification = $_POST['dps_justification']; }
	else { $dps_justification = $dps['dps_justification']; }


// TODO Renommer $dps en $existingDps


	// $spectateurs = $_POST['spectateurs'];
	// $participants = $_POST['participants'];
	// $activite = $_POST['activite'];
	// $environnement = $_POST['environnement'];
	// $delai = $_POST['delai'];
	// $commentaire_ris = $_POST['commentaire_ris'];
	// $commentaire_ris = mysqli_real_escape_string($db_link, $commentaire_ris);


// TODO Externaliser le calcul du RIS dans une méthode

	// $p1_spec = $spectateurs;
	// $p1_part = $participants;
	// $p1 = $p1_spec + $p1_part;
	// if($activite == "1"){$p2 = 0.25;}elseif($activite == "2"){$p2 = 0.35;}elseif($activite == "3"){$p2 = 0.35;}else{$p2 = 0.40;}
	// if($environnement == "1"){$e1 = 0.25;}elseif($environnement == "2"){$e1 = 0.35;}elseif($environnement == "3"){$e1 = 0.35;}else{$e1 = 0.40;}
	// if($delai == "1"){$e2 = 0.25;}elseif($delai == "2"){$e2 = 0.35;}elseif($delai == "3"){$e2 = 0.35;}else{$e2 = 0.40;}
	// $i = $p2 + $e1 + $e2;
	// if($p1 <= 100000){$p = $p1;}else{
	// $p = 100000 + (($p1 - 100000)/2);}
	// $ris = $i * $p / 1000;
	// if($ris <= "1.125"){$type_dps = "0";}elseif($ris <= "12"){$type_dps = "1";}elseif($ris <= "36"){$type_dps = "2";}else{$type_dps = "3";}
	// $p2 = $activite;
	// $e1 = $environnement;
	// $e2 = $delai;
?>
