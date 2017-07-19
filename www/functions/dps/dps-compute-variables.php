<?php

	$dept = $_POST['departement'];
	$year = $_POST['year'];
	$num_cu = $_POST['num_cu'];
	$code_commune = $_POST['code_commune'];

	// Organisateur
	if (isset($duplicated_dps_array['client_name'])) { $client_name = $duplicated_dps_array['client_name']; }
	elseif (isset($client_array['name'])) { $client_name = $client_array['name']; }
	elseif (isset($_POST['client_name'])) { $client_name = $_POST['client_name']; }
	else { $client_name = $dps['client_name']; }

	if (isset($duplicated_dps_array['$client_reprensent'])) { $client_reprensent = $duplicated_dps_array['$client_reprensent']; }
	elseif (isset($client_array['represent'])) { $client_reprensent = $client_array['represent']; }
	elseif (isset($_POST['$client_reprensent'])) { $client_reprensent = $_POST['$client_reprensent']; }
	else { $client_reprensent = $dps['$client_reprensent']; }

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
	elseif (isset($client_array['fax'])) { $client_fax = $client_array['client_fax']; }
	elseif (isset($_POST['fax'])) { $client_fax = $_POST['client_fax']; }
	else { $client_fax = $dps['client_fax']; }

	if (isset($duplicated_dps_array['client_email'])) { $client_email = $duplicated_dps_array['client_email']; }
	elseif (isset($client_array['mail'])) { $client_email = $client_array['mail']; }
	elseif (isset($_POST['client_email'])) { $client_email = $_POST['client_email']; }
	else { $client_email = $dps['client_email']; }




	// Evenement
	////////////////////////////////////////////////////////////////////////$nom_nature = mysqli_real_escape_string($db_link, $nom_nature); // TODO A mettre lors de la création de requete SQL

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

	if (isset($duplicated_dps_array['event_begin_date'])) { $event_begin_date = $duplicated_dps_array['event_begin_date']; }
	elseif (isset($_POST['event_begin_date'])) { $event_begin_date = $_POST['event_begin_date']; }
	else { $event_begin_date = $dps['event_begin_date']; }

	if (isset($duplicated_dps_array['event_begin_time'])) { $event_begin_time = $duplicated_dps_array['event_begin_time']; }
	elseif (isset($_POST['event_begin_time'])) { $event_begin_time = $_POST['event_begin_time']; }
	else { $event_begin_time = $dps['event_begin_time']; }

	if (isset($duplicated_dps_array['event_begin_date'])) { $event_begin_date = $duplicated_dps_array['event_begin_date']; }
	elseif (isset($_POST['event_begin_date'])) { $event_begin_date = $_POST['event_begin_date']; }
	else { $event_begin_date = $dps['event_begin_date']; }

	if (isset($duplicated_dps_array['event_end_time'])) { $event_end_time = $duplicated_dps_array['event_end_time']; }
	elseif (isset($_POST['event_end_time'])) { $event_end_time = $_POST['event_end_time']; }
	else { $event_end_time = $dps['event_end_time']; }

	if (isset($duplicated_dps_array['event_pref_secu'])) { $event_pref_secu = $duplicated_dps_array['event_pref_secu']; }
	elseif (isset($_POST['event_pref_secu'])) { $event_pref_secu = $_POST['event_pref_secu']; }
	else { $event_pref_secu = $dps['event_pref_secu']; }







	$prix = $_POST['dps_price'];
	if (isset($duplicated_dps_array['dps_price'])) { $dps_price = $duplicated_dps_array['dps_price']; }
	elseif (isset($_POST['dps_price'])) { $dps_price = $_POST['dps_price']; }
	else { $dps_price = $dps['dps_price']; }



// C'est ici qu'il faut faire les modifications !!
// Quitte à renommer les variables pour qu'elles soient plus lisibles dans la page de DPS
// renommer $dps en $existingDps


	$spectateurs = $_POST['spectateurs'];
	$participants = $_POST['participants'];
	$activite = $_POST['activite'];
	$environnement = $_POST['environnement'];
	$delai = $_POST['delai'];
	$commentaire_ris = $_POST['commentaire_ris'];
	$commentaire_ris = mysqli_real_escape_string($db_link, $commentaire_ris);

	$p1_spec = $spectateurs;
	$p1_part = $participants;
	$p1 = $p1_spec + $p1_part;
	if($activite == "1"){$p2 = 0.25;}elseif($activite == "2"){$p2 = 0.35;}elseif($activite == "3"){$p2 = 0.35;}else{$p2 = 0.40;}
	if($environnement == "1"){$e1 = 0.25;}elseif($environnement == "2"){$e1 = 0.35;}elseif($environnement == "3"){$e1 = 0.35;}else{$e1 = 0.40;}
	if($delai == "1"){$e2 = 0.25;}elseif($delai == "2"){$e2 = 0.35;}elseif($delai == "3"){$e2 = 0.35;}else{$e2 = 0.40;}
	$i = $p2 + $e1 + $e2;
	if($p1 <= 100000){$p = $p1;}else{
	$p = 100000 + (($p1 - 100000)/2);}
	$ris = $i * $p / 1000;
	if($ris <= "1.125"){$type_dps = "0";}elseif($ris <= "12"){$type_dps = "1";}elseif($ris <= "36"){$type_dps = "2";}else{$type_dps = "3";}
	$p2 = $activite;
	$e1 = $environnement;
	$e2 = $delai;


	$date_debut_poste = $_POST['date_debut_poste'];
	$heure_debut_poste = $_POST['heure_debut_poste'];
	$date_fin_poste = $_POST['date_fin_poste'];
	$heure_fin_poste = $_POST['heure_fin_poste'];

	$nb_ce = $_POST['nb_ce'];
	$nb_pse2 = $_POST['nb_pse2'];
	$nb_pse1 = $_POST['nb_pse1'];
	$nb_psc1 = $_POST['nb_psc1'];
	$vpsp_transport = $_POST['vpsp_transport'];
	$vpsp_soin = $_POST['vpsp_soin'];
	$vl = $_POST['vl'];
	$tente = $_POST['tente'];
	$local = $_POST['local'];
	$supplement = $_POST['supplement'];
	$supplement = mysqli_real_escape_string($db_link, $supplement);
	$medecin_asso = $_POST['medecin_asso'];
	$medecin_autre = $_POST['medecin_autre'];
	$medecin_appartenance = $_POST['medecin_appartenance'];
	$medecin_appartenance = mysqli_real_escape_string($db_link, $medecin_appartenance);
	$infirmier_asso = $_POST['infirmier_asso'];
	$infirmier_autre = $_POST['infirmier_autre'];
	$infirmier_appartenance = $_POST['infirmier_appartenance'];
	$infirmier_appartenance = mysqli_real_escape_string($db_link, $infirmier_appartenance);
	$samu = $_POST['samu'];
	$bspp_sdis = $_POST['bspp_sdis'];
	$justificatif = $_POST['justificatif'];
	$justificatif = mysqli_real_escape_string($db_link, $justificatif);
?>
