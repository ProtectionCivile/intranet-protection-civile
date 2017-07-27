<?php
	require_once('components/dps/dps-init-variables-module.php');


	if (isset($_POST['cu_full'])) { $cu_full = $_POST['cu_full']; }
	if (isset($_POST['section'])) { $section = $_POST['section']; }

	// Organisateur
	if (isset($duplicated_dps_array['client_name'])) { $client_name = $duplicated_dps_array['client_name']; }
	elseif (isset($client_array['name'])) { $client_name = $client_array['name']; }
	elseif (isset($_POST['client_name'])) { $client_name = $_POST['client_name']; }
	elseif (isset($dps) && isset($dps['client_name'])) { $client_name = $dps['client_name']; }
  else { $client_name = ''; }

	if (isset($duplicated_dps_array['client_represent'])) { $client_represent = $duplicated_dps_array['client_represent']; }
	elseif (isset($client_array['represent'])) { $client_represent = $client_array['represent']; }
	elseif (isset($_POST['client_represent'])) { $client_represent = $_POST['client_represent']; }
	elseif (isset($dps) && isset($dps['client_represent'])) { $client_represent = $dps['client_represent']; }
  else { $client_represent = ''; }

	if (isset($duplicated_dps_array['client_title'])) { $client_title = $duplicated_dps_array['client_title']; }
	elseif (isset($client_array['title'])) { $client_title = $client_array['title']; }
	elseif (isset($_POST['client_title'])) { $client_title = $_POST['client_title']; }
	elseif (isset($dps) && isset($dps['client_title'])) { $client_title = $dps['client_title']; }
  else { $client_title = ''; }

	if (isset($duplicated_dps_array['client_address'])) { $client_address = $duplicated_dps_array['client_address']; }
	elseif (isset($client_array['address'])) { $client_address = $client_array['address']; }
	elseif (isset($_POST['client_address'])) { $client_address = $_POST['client_address']; }
	elseif (isset($dps) && isset($dps['client_address'])) { $client_address = $dps['client_address']; }
  else { $client_address = ''; }

	if (isset($duplicated_dps_array['client_phone'])) { $client_phone = $duplicated_dps_array['client_phone']; }
	elseif (isset($client_array['phone'])) { $client_phone = $client_array['phone']; }
	elseif (isset($_POST['client_phone'])) { $client_phone = $_POST['client_phone']; }
	elseif (isset($dps) && isset($dps['client_phone'])) { $client_phone = $dps['client_phone']; }
  else { $client_phone = ''; }

	if (isset($duplicated_dps_array['client_fax'])) { $client_fax = $duplicated_dps_array['client_fax']; }
	elseif (isset($client_array['fax'])) { $client_fax = $client_array['fax']; }
	elseif (isset($_POST['client_fax'])) { $client_fax = $_POST['client_fax']; }
	elseif (isset($dps) && isset($dps['client_fax'])) { $client_fax = $dps['client_fax']; }
  else { $client_fax = ''; }

	if (isset($duplicated_dps_array['client_email'])) { $client_email = $duplicated_dps_array['client_email']; }
	elseif (isset($client_array['mail'])) { $client_email = $client_array['mail']; }
	elseif (isset($_POST['client_email'])) { $client_email = $_POST['client_email']; }
	elseif (isset($dps) && isset($dps['client_email'])) { $client_email = $dps['client_email']; }
  else { $client_email = ''; }



	// Evenement
	if (isset($duplicated_dps_array['event_name'])) { $event_name = $duplicated_dps_array['event_name']; }
	elseif (isset($_POST['event_name'])) { $event_name = $_POST['event_name']; }
	elseif (isset($dps) && isset($dps['event_name'])) { $event_name = $dps['event_name']; }
  else { $event_name = ''; }

	if (isset($duplicated_dps_array['event_description'])) { $event_description = $duplicated_dps_array['event_description']; }
	elseif (isset($_POST['event_description'])) { $event_description = $_POST['event_description']; }
	elseif (isset($dps) && isset($dps['event_description'])) { $event_description = $dps['event_description']; }
  else { $event_description = ''; }

	if (isset($duplicated_dps_array['event_address'])) { $event_address = $duplicated_dps_array['event_address']; }
	elseif (isset($_POST['event_address'])) { $event_address = $_POST['event_address']; }
	elseif (isset($dps) && isset($dps['event_address'])) { $event_address = $dps['event_address']; }
  else { $event_address = ''; }

	if (isset($duplicated_dps_array['event_department'])) { $event_department = $duplicated_dps_array['event_department']; }
	elseif (isset($_POST['event_department'])) { $event_department = $_POST['event_department']; }
	elseif (isset($dps) && isset($dps['event_department'])) { $event_department = $dps['event_department']; }
  else { $event_department = ''; }

	if (isset($duplicated_dps_array['event_begin_date'])) { $event_begin_date = formatDateUsToFr($duplicated_dps_array['event_begin_date']); }
	elseif (isset($_POST['event_begin_date'])) { $event_begin_date = $_POST['event_begin_date']; }
	else { $event_begin_date = formatDateUsToFr($dps['event_begin_date']); }

	if (isset($duplicated_dps_array['event_begin_time'])) { $event_begin_time = $duplicated_dps_array['event_begin_time']; }
	elseif (isset($_POST['event_begin_time'])) { $event_begin_time = $_POST['event_begin_time']; }
	elseif (isset($dps) && isset($dps['event_begin_time'])) { $event_begin_time = $dps['event_begin_time']; }
  else { $event_begin_time = ''; }

	if (isset($duplicated_dps_array['event_end_date'])) { $event_end_date = formatDateUsToFr($duplicated_dps_array['event_end_date']); }
	elseif (isset($_POST['event_end_date'])) { $event_end_date = $_POST['event_end_date']; }
	else { $event_end_date = formatDateUsToFr($dps['event_end_date']); }

	if (isset($duplicated_dps_array['event_end_time'])) { $event_end_time = $duplicated_dps_array['event_end_time']; }
	elseif (isset($_POST['event_end_time'])) { $event_end_time = $_POST['event_end_time']; }
	elseif (isset($dps) && isset($dps['event_end_time'])) { $event_end_time = $dps['event_end_time']; }
  else { $event_end_time = ''; }

	if (isset($duplicated_dps_array['event_pref_secu'])) { $event_pref_secu = $duplicated_dps_array['event_pref_secu']; }
	elseif (isset($_POST['event_pref_secu'])) { $event_pref_secu = $_POST['event_pref_secu']; }
	elseif (isset($dps) && isset($dps['event_pref_secu'])) { $event_pref_secu = $dps['event_pref_secu']; }
  else { $event_pref_secu = ''; }


	// RIS
	if (isset($duplicated_dps_array['ris_p1_public'])) { $ris_p1_public = $duplicated_dps_array['ris_p1_public']; }
	elseif (isset($_POST['ris_p1_public'])) { $ris_p1_public = $_POST['ris_p1_public']; }
	elseif (isset($dps) && isset($dps['ris_p1_public'])) { $ris_p1_public = $dps['ris_p1_public']; }
  else { $ris_p1_public = ''; }

	if (isset($duplicated_dps_array['ris_p1_actors'])) { $ris_p1_actors = $duplicated_dps_array['ris_p1_actors']; }
	elseif (isset($_POST['ris_p1_actors'])) { $ris_p1_actors = $_POST['ris_p1_actors']; }
	elseif (isset($dps) && isset($dps['ris_p1_actors'])) { $ris_p1_actors = $dps['ris_p1_actors']; }
  else { $ris_p1_actors = ''; }

	if (isset($duplicated_dps_array['ris_p2'])) { $ris_p2 = $duplicated_dps_array['ris_p2']; }
	elseif (isset($_POST['ris_p2'])) { $ris_p2 = $_POST['ris_p2']; }
	elseif (isset($dps) && isset($dps['ris_p2'])) { $ris_p2 = $dps['ris_p2']; }
  else { $ris_p2 = ''; }

	if (isset($duplicated_dps_array['ris_e1'])) { $ris_e1 = $duplicated_dps_array['ris_e1']; }
	elseif (isset($_POST['ris_e1'])) { $ris_e1 = $_POST['ris_e1']; }
	elseif (isset($dps) && isset($dps['ris_e1'])) { $ris_e1 = $dps['ris_e1']; }
  else { $ris_e1 = ''; }

	if (isset($duplicated_dps_array['ris_e2'])) { $ris_e2 = $duplicated_dps_array['ris_e2']; }
	elseif (isset($_POST['ris_e2'])) { $ris_e2 = $_POST['ris_e2']; }
	elseif (isset($dps) && isset($dps['ris_e2'])) { $ris_e2 = $dps['ris_e2']; }
  else { $ris_e2 = ''; }

	if (isset($duplicated_dps_array['ris_comment'])) { $ris_comment = $duplicated_dps_array['ris_comment']; }
	elseif (isset($_POST['ris_comment'])) { $ris_comment = $_POST['ris_comment']; }
	elseif (isset($dps) && isset($dps['ris_comment'])) { $ris_comment = $dps['ris_comment']; }
  else { $ris_comment = ''; }


	// Horaires du dispositif
	if (isset($duplicated_dps_array['dps_begin_date'])) { $dps_begin_date = formatDateUsToFr($duplicated_dps_array['dps_begin_date']); }
	elseif (isset($_POST['dps_begin_date'])) { $dps_begin_date = $_POST['dps_begin_date']; }
	else { $dps_begin_date = formatDateUsToFr($dps['dps_begin_date']); }

	if (isset($duplicated_dps_array['dps_begin_time'])) { $dps_begin_time = $duplicated_dps_array['dps_begin_time']; }
	elseif (isset($_POST['dps_begin_time'])) { $dps_begin_time = $_POST['dps_begin_time']; }
	elseif (isset($dps) && isset($dps['dps_begin_time'])) { $dps_begin_time = $dps['dps_begin_time']; }
  else { $dps_begin_time = ''; }

	if (isset($duplicated_dps_array['dps_end_date'])) { $dps_end_date = formatDateUsToFr($duplicated_dps_array['dps_end_date']); }
	elseif (isset($_POST['dps_end_date'])) { $dps_end_date = $_POST['dps_end_date']; }
	else { $dps_end_date = formatDateUsToFr($dps['dps_end_date']); }

	if (isset($duplicated_dps_array['dps_end_time'])) { $dps_end_time = $duplicated_dps_array['dps_end_time']; }
	elseif (isset($_POST['dps_end_time'])) { $dps_end_time = $_POST['dps_end_time']; }
	elseif (isset($dps) && isset($dps['dps_end_time'])) { $dps_end_time = $dps['dps_end_time']; }
  else { $dps_end_time = ''; }


	// DPS
	if (isset($duplicated_dps_array['dps_nb_ce'])) { $dps_nb_ce = $duplicated_dps_array['dps_nb_ce']; }
	elseif (isset($_POST['dps_nb_ce'])) { $dps_nb_ce = $_POST['dps_nb_ce']; }
	elseif (isset($dps) && isset($dps['dps_nb_ce'])) { $dps_nb_ce = $dps['dps_nb_ce']; }
  else { $dps_nb_ce = ''; }

	if (isset($duplicated_dps_array['dps_nb_pse2'])) { $dps_nb_pse2 = $duplicated_dps_array['dps_nb_pse2']; }
	elseif (isset($_POST['dps_nb_pse2'])) { $dps_nb_pse2 = $_POST['dps_nb_pse2']; }
	elseif (isset($dps) && isset($dps['dps_nb_pse2'])) { $dps_nb_pse2 = $dps['dps_nb_pse2']; }
  else { $dps_nb_pse2 = ''; }

	if (isset($duplicated_dps_array['dps_nb_pse1'])) { $dps_nb_pse1 = $duplicated_dps_array['dps_nb_pse1']; }
	elseif (isset($_POST['dps_nb_pse1'])) { $dps_nb_pse1 = $_POST['dps_nb_pse1']; }
	elseif (isset($dps) && isset($dps['dps_nb_pse1'])) { $dps_nb_pse1 = $dps['dps_nb_pse1']; }
  else { $dps_nb_pse1 = ''; }

	if (isset($duplicated_dps_array['dps_nb_psc1'])) { $dps_nb_psc1 = $duplicated_dps_array['dps_nb_psc1']; }
	elseif (isset($_POST['dps_nb_psc1'])) { $dps_nb_psc1 = $_POST['dps_nb_psc1']; }
	elseif (isset($dps) && isset($dps['dps_nb_psc1'])) { $dps_nb_psc1 = $dps['dps_nb_psc1']; }
  else { $dps_nb_psc1 = ''; }

	if (isset($duplicated_dps_array['dps_nb_vpsp_transp'])) { $dps_nb_vpsp_transp = $duplicated_dps_array['dps_nb_vpsp_transp']; }
	elseif (isset($_POST['dps_nb_vpsp_transp'])) { $dps_nb_vpsp_transp = $_POST['dps_nb_vpsp_transp']; }
	elseif (isset($dps) && isset($dps['dps_nb_vpsp_transp'])) { $dps_nb_vpsp_transp = $dps['dps_nb_vpsp_transp']; }
  else { $dps_nb_vpsp_transp = ''; }

	if (isset($duplicated_dps_array['dps_nb_vpsp_soin'])) { $dps_nb_vpsp_soin = $duplicated_dps_array['dps_nb_vpsp_soin']; }
	elseif (isset($_POST['dps_nb_vpsp_soin'])) { $dps_nb_vpsp_soin = $_POST['dps_nb_vpsp_soin']; }
	elseif (isset($dps) && isset($dps['dps_nb_vpsp_soin'])) { $dps_nb_vpsp_soin = $dps['dps_nb_vpsp_soin']; }
  else { $dps_nb_vpsp_soin = ''; }

	if (isset($duplicated_dps_array['dps_nb_vtu'])) { $dps_nb_vtu = $duplicated_dps_array['dps_nb_vtu']; }
	elseif (isset($_POST['dps_nb_vtu'])) { $dps_nb_vtu = $_POST['dps_nb_vtu']; }
	elseif (isset($dps) && isset($dps['dps_nb_vtu'])) { $dps_nb_vtu = $dps['dps_nb_vtu']; }
  else { $dps_nb_vtu = ''; }

	if (isset($duplicated_dps_array['dps_nb_tente'])) { $dps_nb_tente = $duplicated_dps_array['dps_nb_tente']; }
	elseif (isset($_POST['dps_nb_tente'])) { $dps_nb_tente = $_POST['dps_nb_tente']; }
	elseif (isset($dps) && isset($dps['dps_nb_tente'])) { $dps_nb_tente = $dps['dps_nb_tente']; }
  else { $dps_nb_tente = ''; }

	if (isset($duplicated_dps_array['dps_nb_med_asso'])) { $dps_nb_med_asso = $duplicated_dps_array['dps_nb_med_asso']; }
	elseif (isset($_POST['dps_nb_med_asso'])) { $dps_nb_med_asso = $_POST['dps_nb_med_asso']; }
	elseif (isset($dps) && isset($dps['dps_nb_med_asso'])) { $dps_nb_med_asso = $dps['dps_nb_med_asso']; }
  else { $dps_nb_med_asso = ''; }

	if (isset($duplicated_dps_array['dps_nb_inf_asso'])) { $dps_nb_inf_asso = $duplicated_dps_array['dps_nb_inf_asso']; }
	elseif (isset($_POST['dps_nb_inf_asso'])) { $dps_nb_inf_asso = $_POST['dps_nb_inf_asso']; }
	elseif (isset($dps) && isset($dps['dps_nb_inf_asso'])) { $dps_nb_inf_asso = $dps['dps_nb_inf_asso']; }
  else { $dps_nb_inf_asso = ''; }

	if (isset($duplicated_dps_array['dps_nb_lot_a'])) { $dps_nb_lot_a = $duplicated_dps_array['dps_nb_lot_a']; }
	elseif (isset($_POST['dps_nb_lot_a'])) { $dps_nb_lot_a = $_POST['dps_nb_lot_a']; }
	elseif (isset($dps) && isset($dps['dps_nb_lot_a'])) { $dps_nb_lot_a = $dps['dps_nb_lot_a']; }
  else { $dps_nb_lot_a = ''; }

	if (isset($duplicated_dps_array['dps_nb_lot_b'])) { $dps_nb_lot_b = $duplicated_dps_array['dps_nb_lot_b']; }
	elseif (isset($_POST['dps_nb_lot_b'])) { $dps_nb_lot_b = $_POST['dps_nb_lot_b']; }
	elseif (isset($dps) && isset($dps['dps_nb_lot_b'])) { $dps_nb_lot_b = $dps['dps_nb_lot_b']; }
  else { $dps_nb_lot_b = ''; }

	if (isset($duplicated_dps_array['dps_nb_lot_c'])) { $dps_nb_lot_c = $duplicated_dps_array['dps_nb_lot_c']; }
	elseif (isset($_POST['dps_nb_lot_c'])) { $dps_nb_lot_c = $_POST['dps_nb_lot_c']; }
	elseif (isset($dps) && isset($dps['dps_nb_lot_c'])) { $dps_nb_lot_c = $dps['dps_nb_lot_c']; }
  else { $dps_nb_lot_c = ''; }

	if (isset($duplicated_dps_array['dps_nb_dae'])) { $dps_nb_dae = $duplicated_dps_array['dps_nb_dae']; }
	elseif (isset($_POST['dps_nb_dae'])) { $dps_nb_dae = $_POST['dps_nb_dae']; }
	elseif (isset($dps) && isset($dps['dps_nb_dae'])) { $dps_nb_dae = $dps['dps_nb_dae']; }
  else { $dps_nb_dae = ''; }

	if (isset($duplicated_dps_array['dps_other_matos_asso'])) { $dps_other_matos_asso = $duplicated_dps_array['dps_other_matos_asso']; }
	elseif (isset($_POST['dps_other_matos_asso'])) { $dps_other_matos_asso = $_POST['dps_other_matos_asso']; }
	elseif (isset($dps) && isset($dps['dps_other_matos_asso'])) { $dps_other_matos_asso = $dps['dps_other_matos_asso']; }
  else { $dps_other_matos_asso = ''; }

	if (isset($duplicated_dps_array['clientmatos_infirmerie'])) { $clientmatos_infirmerie = $duplicated_dps_array['clientmatos_infirmerie']; }
	elseif (isset($_POST['clientmatos_infirmerie'])) { $clientmatos_infirmerie = $_POST['clientmatos_infirmerie']; }
	elseif (isset($dps) && isset($dps['clientmatos_infirmerie'])) { $clientmatos_infirmerie = $dps['clientmatos_infirmerie']; }
  else { $clientmatos_infirmerie = ''; }

	if (isset($duplicated_dps_array['clientmatos_tente'])) { $clientmatos_tente = $duplicated_dps_array['clientmatos_tente']; }
	elseif (isset($_POST['clientmatos_tente'])) { $clientmatos_tente = $_POST['clientmatos_tente']; }
	elseif (isset($dps) && isset($dps['clientmatos_tente'])) { $clientmatos_tente = $dps['clientmatos_tente']; }
  else { $clientmatos_tente = ''; }

	if (isset($duplicated_dps_array['clientmatos_other'])) { $clientmatos_other = $duplicated_dps_array['clientmatos_other']; }
	elseif (isset($_POST['clientmatos_other'])) { $clientmatos_other = $_POST['clientmatos_other']; }
	elseif (isset($dps) && isset($dps['clientmatos_other'])) { $clientmatos_other = $dps['clientmatos_other']; }
  else { $clientmatos_other = ''; }

	if (isset($duplicated_dps_array['medicalext_nb_med'])) { $medicalext_nb_med = $duplicated_dps_array['medicalext_nb_med']; }
	elseif (isset($_POST['medicalext_nb_med'])) { $medicalext_nb_med = $_POST['medicalext_nb_med']; }
	elseif (isset($dps) && isset($dps['medicalext_nb_med'])) { $medicalext_nb_med = $dps['medicalext_nb_med']; }
  else { $medicalext_nb_med = ''; }

	if (isset($duplicated_dps_array['medicalext_med_company'])) { $medicalext_med_company = $duplicated_dps_array['medicalext_med_company']; }
	elseif (isset($_POST['medicalext_med_company'])) { $medicalext_med_company = $_POST['medicalext_med_company']; }
	elseif (isset($dps) && isset($dps['medicalext_med_company'])) { $medicalext_med_company = $dps['medicalext_med_company']; }
  else { $medicalext_med_company = ''; }

	if (isset($duplicated_dps_array['medicalext_nb_inf'])) { $medicalext_nb_inf = $duplicated_dps_array['medicalext_nb_inf']; }
	elseif (isset($_POST['medicalext_nb_inf'])) { $medicalext_nb_inf = $_POST['medicalext_nb_inf']; }
	elseif (isset($dps) && isset($dps['medicalext_nb_inf'])) { $medicalext_nb_inf = $dps['medicalext_nb_inf']; }
  else { $medicalext_nb_inf = ''; }

	if (isset($duplicated_dps_array['medicalext_inf_company'])) { $medicalext_inf_company = $duplicated_dps_array['medicalext_inf_company']; }
	elseif (isset($_POST['medicalext_inf_company'])) { $medicalext_inf_company = $_POST['medicalext_inf_company']; }
	elseif (isset($dps) && isset($dps['medicalext_inf_company'])) { $medicalext_inf_company = $dps['medicalext_inf_company']; }
  else { $medicalext_inf_company = ''; }

	if (isset($duplicated_dps_array['samu'])) { $samu = $duplicated_dps_array['samu']; }
	elseif (isset($_POST['samu'])) { $samu = $_POST['samu']; }
	elseif (isset($dps) && isset($dps['samu'])) { $samu = $dps['samu']; }
  else { $samu = ''; }

	if (isset($duplicated_dps_array['bspp'])) { $bspp = $duplicated_dps_array['bspp']; }
	elseif (isset($_POST['bspp'])) { $bspp = $_POST['bspp']; }
	elseif (isset($dps) && isset($dps['bspp'])) { $bspp = $dps['bspp']; }
  else { $bspp = ''; }

	if (isset($duplicated_dps_array['dps_type'])) { $dps_type = $duplicated_dps_array['dps_type']; }
	elseif (isset($_POST['dps_type'])) { $dps_type = $_POST['dps_type']; }
	elseif (isset($dps) && isset($dps['dps_type'])) { $dps_type = $dps['dps_type']; }
  else { $dps_type = ''; }

	if (isset($duplicated_dps_array['price'])) { $price = $duplicated_dps_array['price']; }
	elseif (isset($_POST['price'])) { $price = $_POST['price']; }
	elseif (isset($dps) && isset($dps['price'])) { $price = $dps['price']; }
  else { $price = ''; }

	if (isset($duplicated_dps_array['dps_justification'])) { $dps_justification = $duplicated_dps_array['dps_justification']; }
	elseif (isset($_POST['dps_justification'])) { $dps_justification = $_POST['dps_justification']; }
	elseif (isset($dps) && isset($dps['dps_justification'])) { $dps_justification = $dps['dps_justification']; }
  else { $dps_justification = ''; }

	if (isset($duplicated_dps_array['status'])) { $status = $duplicated_dps_array['status']; }
	elseif (isset($_POST['status'])) { $status = $_POST['status']; }
	elseif (isset($dps) && isset($dps['status'])) { $status = $dps['status']; }
  else { $status = ''; }

	if (isset($duplicated_dps_array['cu_year'])) { $cu_year = $duplicated_dps_array['cu_year']; }
	elseif (isset($_POST['cu_year'])) { $cu_year = $_POST['cu_year']; }
	elseif (isset($dps) && isset($dps['cu_year'])) { $cu_year = $dps['cu_year']; }
  else { $cu_year = ''; }



?>
