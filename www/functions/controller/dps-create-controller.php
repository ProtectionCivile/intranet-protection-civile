<?php require('functions/dps/dps-compute-variables.php'); ?>

<?php

// TODO Revoir le fonctionnement général : peut etre que le message générique peut etre simplifié, et que le message specifique plus détaillé.
// Par exemple, pour l'email si y'en a pas ça nedoit pas etre considéré comme une erreur...


	if (isset($_POST['cu'])){
		$cu = $_POST['cu'];
		$today = date("Y-m-d");

		if(isNullOrEmpty($client_name)){
			$genericError = "Le nom de l'organisateur est obligatoire";
			$client_name_error = $genericError;
		}
		if(isNullOrEmpty($client_reprensent)){
			$genericError = "Le représentant légal de la structure est obligatoire";
			$client_reprensent_error = $genericError;
		}
		if(isNullOrEmpty($client_title)){
			$genericError = "La fonction du représentant légal est obligatoire";
			$client_title_error = $genericError;
		}
		if(isNullOrEmpty($client_address)){
			$genericError = "L'adresse de la structure organisatrice est obligatoire";
			$client_address_error = $genericError;
		}
		if(isNullOrEmpty($client_phone)){
			$genericError = "Le téléphone de l'organisateur est obligatoire";
			$client_phone_error = $genericError;
		}
		if(isNullOrEmpty($client_fax)){
			//C'est pas grave
		}
		if(isNullOrEmpty($client_email)){
			$genericError = "L'adresse mail de l'organisateur est obligatoire";
			$client_email_error = $genericError;
		}



		if(isNullOrEmpty($event_name)){
			$genericError = "Le nom de l'évènement est obligatoire";
			$event_name_error = $genericError;
		}
		if(isNullOrEmpty($event_description)){
			$genericError = "Le descriptif de l'activité du rassemblement est obligatoire";
			$event_description_error = $genericError;
		}
		if(isNullOrEmpty($event_address)){
			$genericError = "L'adresse exacte de la manifestation est obligatoire";
			$event_address_error = $genericError;
		}
		if(isNullOrEmpty($event_department)){
			$genericError = "Le département de la manifestation est obligatoire";
			$event_department_error = $genericError;
		}
		if(isNullOrEmpty($event_begin_date)){
			$genericError = "La date de début de manifestation est obligatoire";
			$event_begin_date_error = $genericError;
		}
		if(isNullOrEmpty($event_begin_time)){
			$genericError = "L'heure de début de manifestation est obligatoire";
			$event_begin_time_error = $genericError;
		}
		if(isNullOrEmpty($event_end_date)){
			$genericError = "La date de fin de manifestation est obligatoire";
			$event_end_date_error = $genericError;
		}
		if(isNullOrEmpty($event_end_time)){
			$genericError = "L'heure de fin de manifestation est obligatoire";
			$event_end_time_error = $genericError;
		}
		if(isNullOrEmpty($event_pref_secu)){
			$event_pref_secu = "false";
		}


		elseif(isNullOrEmpty($year)){
			$genericError = "L'année est obligatoire";
		}
		elseif(isNullOrEmpty($code_commune)){
			$genericError = "La commune est obligatoire";
		}
		elseif(isNullOrEmpty($type_dps)){
			$genericError = "le type de DPS est obligatoire";
		}

		elseif(isNullOrEmpty($dps_debut_poste)){
			$genericError = "La date de début de poste est obligatoire";
		}
		elseif(isNullOrEmpty($dps_fin_poste)){
			$genericError = "La date de fin de poste est obligatoire";
		}

		elseif(isNullOrEmpty($dps_debut_poste)){
			$genericError = "L'heure de début de poste est obligatoire";
		}
		elseif(isNullOrEmpty($heure_fin_poste)){
			$genericError = "L'heure de fin de poste est obligatoire";
		}

		elseif(isNullOrEmpty($dps_price)){
			$genericError = "Le prix de la prestation est obligatoire";
			$dps_price_error = $genericError;
		}
		elseif(isNullOrEmpty($p1_part)){
			$genericError = "Le nombre de participants est obligatoire pour le calcul du RIS";
		}
		elseif(isNullOrEmpty($p1_spec)){
			$genericError = "Le nombre de spectateurs est obligatoire pour le calcul du RIS";
		}
		elseif(isNullOrEmpty($p2)){
			$genericError = "La typologie du public est obligatoire pour le calcul du RIS";
		}
		elseif(isNullOrEmpty($e1)){
			$genericError = "Les risques environnementaux sont obligatoires pour le calcul du RIS";
		}
		elseif(isNullOrEmpty($e2)){
			$genericError = "Le délai d'intervention des secours publics est obligatoire pour le calcul du RIS";
		}
		else {
			if(isNullOrEmpty($nb_ce)){
				$nb_ce = "0";
			}
			if(isNullOrEmpty($nb_pse2)){
				$nb_pse2 = "0";
			}
			if(isNullOrEmpty($nb_pse1)){
				$nb_pse1 = "0";
			}
			if(isNullOrEmpty($nb_psc1)){
				$nb_psc1 = "0";
			}
			if(isNullOrEmpty($vpsp_transport)){
				$vpsp_transport = "0";
			}
			if(isNullOrEmpty($vpsp_soin)){
				$vpsp_soin = "0";
			}
			if(isNullOrEmpty($vl)){
				$vl = "0";
			}
			if(isNullOrEmpty($tente)){
				$tente = "0";
			}
			if(isNullOrEmpty($medecin_asso)){
				$medecin_asso = "0";
			}
			if(isNullOrEmpty($medecin_autre)){
				$medecin_autre = "0";
			}
			if(isNullOrEmpty($infirmier_asso)){
				$infirmier_asso = "0";
			}
			if(isNullOrEmpty($infirmier_autre)){
				$infirmier_autre = "0";
			}
			if(isNullOrEmpty($samu)){
				$samu = "1";
			}
			if(isNullOrEmpty($bspp_sdis)){
				$bspp_sdis = "0";
			}
			if(isNullOrEmpty($local)){
				$local = "false";
			}

			$sql = "SELECT ID FROM $tablename_dps WHERE cu_complet='$cu_complet'" or die("Erreur lors de la consultation" . mysqli_error($db_link));
			$verif = mysqli_query($db_link, $sql);
			$how_many_dps_found = mysqli_num_rows($verif);
			if ($how_many_dps_found){
				$genericError = "Un DPS avec le même certificat unique existe déjà (".$cu_complet.")";
			}
			else {
				$sql = "INSERT INTO $tablename_dps (num_cu, cu_complet, annee_poste, commune_ris, type_dps, dps_debut, dps_fin, dps_debut_poste, dps_fin_poste, heure_debut, heure_fin, heure_debut_poste, heure_fin_poste, dept, prix, description_manif, activite, adresse_manif, organisateur, representant_org, qualite_org, adresse_org, tel_org, fax_org, email_org, dossier_pref, p1_part, p1_spec, p2, e1, e2, date_creation, comment_ris, justif_poste, cei, PSE2, PSE1, PSC1, vpsp, vpsp_soin, vl, tente, local, moyen_supp, med_asso, med_autre, medecin, inf_asso, inf_autre, infirmier, samu, pompier) VALUES ('$num_cu', '$cu', '$year', '$code_commune', '$type_dps','$date_debut', '$date_fin', '$date_debut_poste', '$date_fin_poste', '$heure_debut', '$heure_fin', '$heure_debut_poste', '$heure_fin_poste', '$dept', '$prix', '".mysqli_real_escape_string($db_link, $nom_nature)."', '".mysqli_real_escape_string($db_link, $activite_descriptif)."', '".mysqli_real_escape_string($db_link, $lieu_precis)."', '".mysqli_real_escape_string($db_link, $nom_organisation)."', '".mysqli_real_escape_string($db_link, $represente_par)."', '".mysqli_real_escape_string($db_link, $qualite)."', '".mysqli_real_escape_string($db_link, $adresse)."', '$telephone', '$fax', '$email', '$deja_pref', '$p1_part', '$p1_spec', '$p2', '$e1', '$e2', '$today', '".mysqli_real_escape_string($db_link, $commentaire_ris)."', '".mysqli_real_escape_string($db_link, $justificatif)."', '$nb_ce', '$nb_pse2' , '$nb_pse1', '$nb_psc1', '$vpsp_transport', '$vpsp_soin', '$vl', '$tente', '$local', '".mysqli_real_escape_string($db_link, $supplement)."', '$medecin_asso', '$medecin_autre', '".mysqli_real_escape_string($db_link, $medecin_appartenance)."', '$infirmier_asso', '$infirmier_autre', '".mysqli_real_escape_string($db_link, $infirmier_appartenance)."', '$samu', '$bspp_sdis')" or die("Impossible d'ajouter le DPS dans la base de donn&eacute;e" . mysqli_error($db_link));
				mysqli_query($db_link, $sql);
				header("Location: dps-list-view.php");
			}
		}
	}

?>


<?php
	$dept = "92";
	$year = date("y");
	$query_code = "SELECT shortname FROM $tablename_sections WHERE number=$city";
	$code_result = mysqli_query($db_link, $query_code);
	$code_array = mysqli_fetch_array($code_result);
	$code_commune = $code_array['shortname'];
	mysqli_free_result($code_result);
	$query_cu = "SELECT num_cu FROM $tablename_dps WHERE annee_poste=$year AND commune_ris=$city ORDER BY id DESC LIMIT 1";
	$cu_result = mysqli_query($db_link, $query_cu);
	$cu_array = mysqli_fetch_array($cu_result);
	$num_cu = $cu_array['num_cu'];
	$num_cu = $num_cu + 1;
	if($num_cu < 10){
		$num_cu = "00".$num_cu;
	}
	elseif($num_cu < 100){
		$num_cu = "0".$num_cu;
	}
	$cu = $dept."-".$year."-".$code_commune."-".$num_cu;
?>
