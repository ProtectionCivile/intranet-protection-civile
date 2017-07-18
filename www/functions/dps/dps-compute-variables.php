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

	if (isset($duplicated_dps_array['representant_org'])) { $organisateur_represente_par = $duplicated_dps_array['representant_org']; }
	elseif (isset($client_array['represent'])) { $organisateur_represente_par = $client_array['represent']; }
	elseif (isset($_POST['represente_par'])) { $organisateur_represente_par = $_POST['represente_par']; }
	else { $organisateur_represente_par = $dps['representant_org']; }

	if (isset($duplicated_dps_array['qualite_org'])) { $organisateur_qualite = $duplicated_dps_array['qualite_org']; }
	elseif (isset($client_array['title'])) { $organisateur_qualite = $client_array['title']; }
	elseif (isset($_POST['qualite'])) { $organisateur_qualite = $_POST['qualite']; }
	else { $organisateur_qualite = $dps['qualite_org']; }

	if (isset($duplicated_dps_array['adresse_org'])) { $organisateur_adresse = $duplicated_dps_array['adresse_org']; }
	elseif (isset($client_array['address'])) { $organisateur_adresse = $client_array['address']; }
	elseif (isset($_POST['adresse'])) { $organisateur_adresse = $_POST['adresse']; }
	else { $organisateur_adresse = $dps['adresse_org']; }

	if (isset($duplicated_dps_array['tel_org'])) { $organisateur_telephone = $duplicated_dps_array['tel_org']; }
	elseif (isset($client_array['phone'])) { $organisateur_telephone = $client_array['phone']; }
	elseif (isset($_POST['telephone'])) { $organisateur_telephone = $_POST['telephone']; }
	else { $organisateur_telephone = $dps['tel_org']; }

	if (isset($duplicated_dps_array['fax_org'])) { $organisateur_fax = $duplicated_dps_array['fax_org']; }
	elseif (isset($client_array['fax'])) { $organisateur_fax = $client_array['fax']; }
	elseif (isset($_POST['fax'])) { $organisateur_fax = $_POST['fax']; }
	else { $organisateur_fax = $dps['fax_org']; }

	$email = $_POST['email'];
	if (isset($duplicated_dps_array['DANSTABLEDPS'])) { $organisateur_email = $duplicated_dps_array['DANSTABLEDPS']; }
	elseif (isset($client_array['DANSCLIENT'])) { $organisateur_email = $client_array['DANSCLIENT']; }
	elseif (isset($_POST['DANSFORMULAIREPOST'])) { $organisateur_email = $_POST['DANSFORMULAIREPOST']; }
	else { $organisateur_email = $dps['DANSTABLEDPS']; }

	$deja_pref = $_POST['deja_pref'];
	if (isset($duplicated_dps_array['DANSTABLEDPS'])) { $organisateur_dossier_prefecture = $duplicated_dps_array['DANSTABLEDPS']; }
	elseif (isset($client_array['DANSCLIENT'])) { $organisateur_dossier_prefecture = $client_array['DANSCLIENT']; }
	elseif (isset($_POST['deja_pref'])) { $organisateur_dossier_prefecture = $_POST['deja_pref']; }
	else { $organisateur_dossier_prefecture = $dps['DANSTABLEDPS']; }

	$nom_nature = $_POST['nom_nature'];
	$nom_nature = mysqli_real_escape_string($db_link, $nom_nature);
	if (isset($duplicated_dps_array['DANSTABLEDPS'])) { $VARIABLE = $duplicated_dps_array['DANSTABLEDPS']; }
	elseif (isset($client_array['DANSCLIENT'])) { $VARIABLE = $client_array['DANSCLIENT']; }
	elseif (isset($_POST['DANSFORMULAIREPOST'])) { $VARIABLE = $_POST['DANSFORMULAIREPOST']; }
	else { $VARIABLE = $dps['DANSTABLEDPS']; }

	$activite_descriptif = $_POST['activite_descriptif'];
	$activite_descriptif = mysqli_real_escape_string($db_link, $activite_descriptif);
	if (isset($duplicated_dps_array['DANSTABLEDPS'])) { $VARIABLE = $duplicated_dps_array['DANSTABLEDPS']; }
	elseif (isset($client_array['DANSCLIENT'])) { $VARIABLE = $client_array['DANSCLIENT']; }
	elseif (isset($_POST['DANSFORMULAIREPOST'])) { $VARIABLE = $_POST['DANSFORMULAIREPOST']; }
	else { $VARIABLE = $dps['DANSTABLEDPS']; }

	$lieu_precis = $_POST['lieu_precis'];
	$lieu_precis = mysqli_real_escape_string($db_link, $lieu_precis);
	if (isset($duplicated_dps_array['DANSTABLEDPS'])) { $VARIABLE = $duplicated_dps_array['DANSTABLEDPS']; }
	elseif (isset($client_array['DANSCLIENT'])) { $VARIABLE = $client_array['DANSCLIENT']; }
	elseif (isset($_POST['DANSFORMULAIREPOST'])) { $VARIABLE = $_POST['DANSFORMULAIREPOST']; }
	else { $VARIABLE = $dps['DANSTABLEDPS']; }


	$date_debut = $_POST['date_debut'];
	$heure_debut = $_POST['heure_debut'];
	if (isset($duplicated_dps_array['DANSTABLEDPS'])) { $VARIABLE = $duplicated_dps_array['DANSTABLEDPS']; }
	elseif (isset($client_array['DANSCLIENT'])) { $VARIABLE = $client_array['DANSCLIENT']; }
	elseif (isset($_POST['DANSFORMULAIREPOST'])) { $VARIABLE = $_POST['DANSFORMULAIREPOST']; }
	else { $VARIABLE = $dps['DANSTABLEDPS']; }

	$date_fin = $_POST['date_fin'];
	$heure_fin = $_POST['heure_fin'];
	if (isset($duplicated_dps_array['DANSTABLEDPS'])) { $VARIABLE = $duplicated_dps_array['DANSTABLEDPS']; }
	elseif (isset($_POST['DANSFORMULAIREPOST'])) { $VARIABLE = $_POST['DANSFORMULAIREPOST']; }
	else { $VARIABLE = $dps['DANSTABLEDPS']; }


	$departement = $_POST['departement'];
	if (isset($duplicated_dps_array['DANSTABLEDPS'])) { $VARIABLE = $duplicated_dps_array['DANSTABLEDPS']; }
	elseif (isset($_POST['DANSFORMULAIREPOST'])) { $VARIABLE = $_POST['DANSFORMULAIREPOST']; }
	else { $VARIABLE = $dps['DANSTABLEDPS']; }

	$prix = $_POST['prix'];
	if (isset($duplicated_dps_array['DANSTABLEDPS'])) { $VARIABLE = $duplicated_dps_array['DANSTABLEDPS']; }
	elseif (isset($_POST['DANSFORMULAIREPOST'])) { $VARIABLE = $_POST['DANSFORMULAIREPOST']; }
	else { $VARIABLE = $dps['DANSTABLEDPS']; }

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
